<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "original",
        "price",
        "quantity",
        "image"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){

    }
}
