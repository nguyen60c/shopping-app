<?php

namespace App\Http\Controllers\orders;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Product;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailsController extends Controller
{
    private $total = 0;
    private $data = [];

    private function getUserId()
    {
        return auth()->user()->id;
    }

    /*
     * @return Collection products
     */
    private function getProductsUserCart($product_id)
    {
        return Order_details::where("id", $product_id);
    }

    public function index()
    {
        $orderDetails = Cart::where("user_id", $this->getUserId());
        $details = $orderDetails->get();
        foreach ($details as $item) {
            $product = Product::where("id", $item["product_id"])->get()->toArray()[0];
            $product["quantity_temp"] = $item["quantity"];
            $this->total += $item->quantity * $product["price"];
            array_push($this->data, (array)$product);
        }
        $data = $this->data;
        $total = $this->total;

        return view("orders_details.index")
            ->with(compact("data"))
            ->with(compact("total"));
    }


    public function store()
    {
        $cart_items_raw = Cart::where("user_id", $this->getUserId());
        $cart_items = $cart_items_raw->get()->toArray();
        foreach ($cart_items as $item) {
            $order_details = new Order_details();
            $order_details->quantity = $item["quantity"];
            $order_details->user_id = $item["user_id"];
            $order_details->product_id = $item["product_id"];
            $order_details->save();

            $order = new Order();
            $order->user_id = $item["user_id"];
            $order->order_details_id = $order_details->id;
            $order->save();
        }

        $cart_items_raw->delete();

        return redirect()->route("home.index");
    }

}
