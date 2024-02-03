<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class general_consultation extends Model
{
    protected $fillable=['blood_pressure','reason','pet_id','schenduling_by','assigned_to','hear_rate','observations','status','breathing_frequency','body_temperatura','history_clinic_url','schedule_id'];
    use HasFactory;
}
