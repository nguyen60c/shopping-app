<?php

namespace App\Http\Controllers\carts;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cart;
    private $products_arr = [];
    private $total_quan = 0;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function index()
    {
        /*Lấy cart_items của user hiện tại*/
        $items_cart_userCurrent = Cart::where("user_id", $this->userId())
            ->get();
        $total = 0;
        $total_quan = $this->total_quan;
        $data = [];
        /*Lấy product_id trong cart_item để tìm kiếm ra product*/
        foreach ($items_cart_userCurrent as $item) {
            $products = Product::where("id", $item->product_id)
                ->get();

            foreach ($products as $product) {
                $product->quantity = $item->quantity;
                $total += $product->price * $product->quantity;
                array_push($data, $product);
            }

        }
        return view("carts.index")
            ->withTitle("E-COMMERCE STORE | CART")
            ->with(compact("data"))
            ->with(compact("total"))
            ->with(compact("total_quan"));
    }

    public function products(){
        $cart = Cart::where("user_id",$this->userId())->get();
        foreach($cart as $item){
            $products = Product::where("id",$item->product_id)->get()->toArray()[0];
            array_push($this->products_arr,$products);
        }
        $data = $this->products_arr;
        $this->total_quan = count($data);
        return compact(["data"]);
    }

    public function userId()
    {
        return auth()->user()->id;
    }

    public function add(Request $request)
    {

        /*Make sure quantity always is one*/
        if ($request->quantity == 1) {

            /*Get orders details items and turn it to array*/
            $cart_items = Cart::
            where("product_id", $request->id)
                ->where("user_id", $this->userId())->get()->toArray();

            if (count($cart_items) > 0) {
                foreach($cart_items as $item){
                    Cart::
                    where("product_id", $request->id)
                        ->where("user_id", $this->userId())
                        ->update(["quantity" => $item["quantity"] + 1]);
                }
            } else {
                $this->cart->user_id = $this->userId();
                $this->cart->quantity = $request->quantity;
                $this->cart->product_id = $request->id;
                $this->cart->save();
            }

            return redirect()
                ->route('cart.index')
                ->with('success_msg', 'Item is Added to Cart!');

        }

        /*Case user change attribute of implement in html*/
        return redirect()
            ->route('home.index')
            ->withErrors('Item is not Added successfully to Cart!');

    }

    public function remove(Request $request)
    {
        Cart::where("user_id", $this->userId())
            ->where("product_id", $request->id)
            ->delete();

        return redirect()->route("cart.index")
            ->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request)
    {
        if ($request->quantity > 0) {

            Cart::where("user_id", $this->userId())
                ->where("product_id", $request->id)
                ->update(["quantity" => $request->quantity]);

            return redirect()
                ->route("cart.index")
                ->with('success_msg', 'Cart is Updated!');
        }

        return redirect()
            ->route("cart.index");
    }

    public function clear()
    {
        Cart::where("user_id", $this->userId())->delete();

        return redirect()
            ->route('cart.index')
            ->with('success_msg', 'Car is cleared!');
    }


}
