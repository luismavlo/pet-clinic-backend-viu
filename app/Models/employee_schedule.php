<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_schedule extends Model
{
    protected $fillable=['employee_id','schedule_id'];
    use HasFactory;
}
