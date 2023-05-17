<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status', 'icon'];

    //Many to Many relationship
    public function brands(){
        return $this->belongsToMany(Brand::class);
    }

    //One to Many relationship
    public function products(){
        return $this->hasMany(Product::class);
    }


}
