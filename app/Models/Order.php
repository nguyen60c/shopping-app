<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "order";

    protected $guarded = [];

    public function order_details(){
        return $this->hasMany(Order_details::class,"order_details_id");
    }
}
