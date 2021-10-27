<?php
namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

use App\Models\product;

class ProductControllerAPI extends Controller{

    public function testQuery(){

        $product = Product::all();

        return response()->json(['product',$product]);
    }

}