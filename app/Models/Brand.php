<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    //Many to Many relationship
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    // One to Many relationship
    public function products(){
        return $this->hasMany(Product::class);
    }
}
