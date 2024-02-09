<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pet extends Model
{
    protected $fillable=['client_id','photo','name','birthdate','race','specie_id'];
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(client::class,'client_id','id');
    }

    public function specie()
{
    return $this->belongsTo(specie::class,'specie_id','id');
}




public function generalconsultations(){
    return $this->hasMany(general_consultation::class);
     }


}
