<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['qty', 'subtotal', 'iva', 'total', 'cash', 'change', 'status', 
                            'user_id', 'client_id', 'cashout_id'];

    //One to one relationship
    public function saledetails(){
        return $this->hasMany(SaleDetail::class);
    }

    //Inverse relation one to many
    public function client(){
        return $this->belongsTo(Client::class);
    }

    //Inverse relation one to many
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Inverse relation one to many
    public function cashout(){
        return $this->belongsTo(Cashout::class);
    }
}
