<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['qty', 'price', 'product_id', 'sale_id'];

    //One to one relationship Inverse
    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    //One to Many relationship Inverse
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
