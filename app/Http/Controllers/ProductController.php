<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseAPIController {
    public function __construct() {
        $this->primaryKey = "id";
        $this->elequentModel = new Product();
        $this->addIndexActionsRequired = true;
    }

    public function addIndexActions() {
        $dataRaw = DB::table('products')
            ->select([
                DB::raw('SQL_CALC_FOUND_ROWS products.name AS name'),
                'products.id AS id',
                'products.name AS name',
                'products.stock_keeping_unit AS sku',
                'products.description AS description',
                'products.price AS price',
                'products.status AS status',
                'products.short_description AS short_description'
            ])
            ->where('status', '1')
            ->orderBy("id", "desc")
            ->get()->toArray();

    $data = [];
    $actions = '';
    foreach($dataRaw as $row) {
        $actions .= "<button class='btn btn-primary' onclick='editProduct(".$row->id.")'>Edit</button>";
        $actions .= "<button class='btn btn-danger' onclick='deleteProduct(".$row->id.")'>Delete</button>";
        $actions .= "<button class='btn btn-warning' onclick='updateImage(".$row->id.")'>Update</button>";

        $temp = [
            'id' => $row->id,
            'name' => $row->name,
            'stock_keeping_unit' => $row->sku,
            'description' => $row->description,
            'price' => $row->price,
            'short_description' => $row->short_description,
            'status' => $row->status,
            'actions' => $actions
        ];
        $data[] = $temp;
    }
        return $data;
    }

    function uploadDocument(Request $request) {
        $photos = $request->file('file');
        $id = $request->post("id");
        $paths  = [];

        $filename = $photos->getClientOriginalName();
        Storage::disk('local')->put("photos", $photos);
        $url = Storage::url('photos' . $photos);
        
        
    }
}