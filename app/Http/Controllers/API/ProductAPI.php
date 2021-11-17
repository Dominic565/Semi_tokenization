<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Flash;
use Response;

class ProductAPI extends Controller {

    public $successStatus = 200;

    public function getAllPosts(Request $request) {
        $token = $request['t']; 
        $userid = $request['u']; // u = userid

        $user = User::where('id', $userid) ->where('remember_token', $token)->first();

        if ($user != null) {
            $product = Product::all();

            return response()->json($product, $this->successStatus);
        }else {
            return response()->json(['response' => 'Bad Call'], 501);
        }
    }

    public function getProduct(Request $request) {
        $id = $request['pro_id']; // pro_id = pro id
        $token = $request['t']; // t = token
        $userid = $request['u']; // u = userid

        $user = User::where('id', $userid)->where('remember_token', $token)->first();

        if ($user != null) {
            $product = Product::where('id', $id)->first();

            if ($product != null) {
                return response()->json($product, $this->successStatus);
            } else {
                return response()->json(['response' => 'Product not found!'], 404);
            }
        } else {
            return response()->json(['response' => 'Bad Call'], 501);
        }
    }

    public function searchProduct(Request $request) {
        $token = $request['t']; // t = token
        $userid = $request['u']; // u = userid
        $pro_id = $request['pro_id']; // pro_id = pro id

        $user = User::where('id', $userid)->where('remember_token', $token)->first();

        if ($user != null) {
            $product = Product::where('Description', 'LIKE', '%' . $product . '%')
                ->orWhere('Brand', 'LIKE', '%' . $product . '%')
                ->get();
            // SELECT * FROM product  WHERE description LIKE '%productno%' OR title LIKE '%pro%'
            if ($product != null) {
                return response()->json($product, $this->successStatus);
            } else {
                return response()->json(['response' => 'Product not found!'], 404);
            }
        } else {
            return response()->json(['response' => 'Bad Call'], 501);
        }
    }
}