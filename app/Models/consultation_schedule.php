<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultation_schedule extends Model
{
    protected $fillable=['day_of_week','start_time','end_time','appointment_duration','month','year','status'];
    use HasFactory;
}
