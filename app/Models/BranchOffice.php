<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'folder_name' , 'phone', 'phone2', 'status', 'modified_by', 'company_id'];

    //Relationship one to many
    public function users(){
        return $this->hasMany(User::class);
    }

    //Inverse Relationship one to many
    public function company(){
        return $this->belongsTo(Company::class);
    }

    //Relationship one to many
    public function cashRegisters(){
        return $this->hasMany(CashRegister::class);
    }
}
