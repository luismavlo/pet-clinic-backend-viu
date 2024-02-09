<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultation_schedule extends Model
{
    protected $fillable=['start_date','end_date','appointment_duration','start_hour','shift_duration','end_hour','employee_id'];
    use HasFactory;




    public function employees()
    {
        return $this->belongsTo(employee::class,'employee_id','id');
    }


}
