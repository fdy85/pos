<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $filable = ['name'];

    //Many to Many relationship
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    // One to Many relationship
    public function products(){
        return $this->hasMany(Product::class);
    }
}
