<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $fillable=['occupation','gross_salary','email','password','phone','user_id'];
    use HasFactory;


    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


     
    
        public function consultationshedules(){
           return $this->hasMany(consultation_schedule::class);
            }

        public function generalconsultatio_schenduling_by(){
            return $this->hasMany(general_consultatio::class);
            }

        public function consultationshedules_assigned_to(){
                return $this->hasMany(general_consultatio::class);
            }




}
