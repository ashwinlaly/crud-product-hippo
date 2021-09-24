<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseAPIController extends Controller {
    protected $primaryKey;
    protected $elequentModel;
    protected $addIndexActionsRequired = false;
    protected $selectCols = ['*'];

    public function index(Request $request) {
        if($this->addIndexActionsRequired) {
            $data = $this->addIndexActions();
        } else {
            $data = $this->elequentModel::select($this->selectCols)->get()->toArray();
        }
        return response()->json([
            "message" => "get all resource",
            "status"  => 200,
            "data" => $data
        ], 200);
    }

    public function show($id) {
        $data = $this->elequentModel->where($this->primaryKey, $id)->first();
        return $data ? response()->json($data, 200) : response([
            "message" => "unable to find resource",
            "status"  => 400
        ], 400);
    }

    public function update(Request $request, $id) {
        $id = $id ? (int) $id : 0;
        $validator = Validator::make($request->all(), $this->elequentModel->rules($id));
        if(!$validator->passes())
            return response()->json($validator->messages(), 422);
        
        $dataRaw = $request->only($this->elequentModel->fillable);
        $res = $id ? $this->elequentModel->where($this->primaryKey, $id)->update($dataRaw) : $this->elequentModel->insertGetId($dataRaw);
        return response($res, 200);
    }

    public function delete(Request $request, $id) {
        $res = $this->elequentModel->where($this->primaryKey, $id)->delete();
        return $res ? response()->json($res, 200) : response([
            "message" => "Failed, Object does not exist, Already deleted?",
            "status"  => 200
        ], 200);
    }
}