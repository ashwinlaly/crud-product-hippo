<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "id";

    public $fillable = [
        "name", 
        "price",
        "status",
        "description",
        "short_description",
        "stock_keeping_unit",
    ];

    public static function rules($id) {
        return [
            "name" => "required",
            "price" => "required",
            "status" => "required",
            "description" => "required",
            "short_description" => "required",
            "stock_keeping_unit"  => "required"
        ];
    }

    public static function messages() {
        return [
            "name.required" => "Name is required",
            "price.required" => "Price is required",
            "status.required" => "Status is required",
            "description.required" => "Description is required",
            "short_description.required" => "Short Description is required",
            "stock_keeping_unit.required"  => "SKU code is required"
        ];
    }
}