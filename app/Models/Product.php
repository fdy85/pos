<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'barcode', 'type', 'cost', 'price', 'qty', 'low_stock', 'status', 'brand_id', 'category_id'];

    //Inverse One to Many relationship
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    //Inverse One to Many relationship
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //One to Many relationship
    public function saledetails(){
        return $this->hasMany(saledetail::class);
    }

    //One to Many Polymorphic
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
