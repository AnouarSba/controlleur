<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Fchauffeur extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
    ];
}
