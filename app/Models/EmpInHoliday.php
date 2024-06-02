<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpInHoliday extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'emps',
        'date',
        'holiday_id',
 
    ];
    protected $casts = [
        'emps' => 'array',
    ];
}