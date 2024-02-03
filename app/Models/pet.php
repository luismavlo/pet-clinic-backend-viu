<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pet extends Model
{
    protected $fillable=['client_id','photo','name','birthdate','race','specie_id'];
    use HasFactory;
}
