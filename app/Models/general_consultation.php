<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class general_consultation extends Model
{
    protected $fillable=['blood_pressure','reason','pet_id','schenduling_by','assigned_to','heart_rate','observations','status','breathing_frequency','body_temperatura','history_clinic_url','appointment_date'];
    use HasFactory;



    public function pets()
    {
        return $this->belongsTo(pet::class,'pet_id','id');
    }

    public function employes_schenduling_by()
    {
        return $this->belongsTo(employee::class,'schenduling_by','id');
    }

    public function medico()
    {
        return $this->belongsTo(employee::class,'assigned_to','id');
    }


}
