<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'emp_id',
 
        'date',
 
        'valide',
 
        'event_id',
 
        'nbr_jr',

 
    ];
}