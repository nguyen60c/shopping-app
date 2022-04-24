<?php

namespace App\Http\Controllers\orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Product;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    private $array_time = [];

    public function getUserId()
    {
        return auth()->user()->id;
    }

    public function index()
    {
        $details_raw = Order_details::
        select("id", "quantity", "user_id", "product_id",
            DB::raw('DATE(created_at) as time'), "created_at")
            ->where("user_id", $this->getUserId())
            ->latest()
            ->get()->toArray();

        $data = $details_raw;
        $arr_time = [];
        $arr_temp = [];

        foreach ($data as $item) {
            array_push($arr_time, $item["time"]);
        }

        $unique_val_arr = array_values(array_unique($arr_time));

        $total_price = 0;
        foreach ($data as $item) {
            if (array_search($item["time"], $unique_val_arr) >= 0) {
                $status = Order::where("order_details_id", $item["id"])->get()->toArray();
                $product = Product::where("id", $item["product_id"])->get()->toArray();
                $item["position"] = array_search($item["time"], $unique_val_arr);
                $item["product_name"] = $product[0]["name"];
                if (isset($status[0]["status"])) {
                    $item["status"] = $status[0]["status"];
                }else{
                    $item["status"] = "bị lỗi";
                }
                $item["total"] = $item["quantity"] * $product[0]["price"];
//                ddd($item);
//                $total_price = $total_price + $item["total"];
//                $item["total_price"] = $total_price;
                array_push($arr_temp, $item);
//                ddd($arr_temp);
            }
        }

        return view("orders.index")
            ->with(compact("arr_temp"))
            ->with(compact("unique_val_arr"));
    }
}
