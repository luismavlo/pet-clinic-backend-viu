<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specie extends Model
{
    protected $fillable=['name','descripcion','photo'];
    use HasFactory;


    
    public function pets(){
        return $this->hasMany(pet::class);
         }

}
