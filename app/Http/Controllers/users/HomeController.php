<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
//        \Illuminate\Support\Facades\Session::forget("cart");
        $cart = session()->get("cart");

        if($cart == null){
            $cart = [];
        }
        return view("home.index",compact(["products","cart"]));

    }

    public function addToCart(Request $request){
        session()->put("cart",$request->post("cart"));

        return response()->json([
            "status"=>"added"
        ]);
    }
}
