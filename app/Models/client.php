<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable=['user_id','phone','email','password'];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }




public function pets(){
return $this->hasMany(pet::class);
}


}
