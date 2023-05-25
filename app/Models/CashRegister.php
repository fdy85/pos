<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'is_available', 'user_id', 'branch_office_id'];

    //Inverse Relationship one to many
    public function branchOffice(){
        return $this->belongsTo(BranchOffice::class);
    }

    //Inverse Relationship one to many
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relationship Many to many
    public function cashouts(){
        return $this->hasMany(Cashout::class);
    }
}
