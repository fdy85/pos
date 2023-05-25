<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashout extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'cash_start', 'total', 'comments', 'status', 
                            'reviewed_by', 'user_id', 'cash_register_id', 'branch_office_id'];

    //Inverse Relacion Uno a Muchos Inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Inverse Relacion Uno a Muchos Inversa
    public function cashRegister(){
        return $this->belongsTo(CashRegister::class);
    }

    //Relacion Uno a Muchos Inversa
    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
