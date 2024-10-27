<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'address',
        'city',
        'country',
        'postal',
        'about'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function get_status($date)
    {
        $pointage=Pointage::where('date',$date)->where('emp_id', $this->id)->first();
        if ($pointage) {
            return $pointage->emp_status_id;
        } else {
            return null;
        }
        
    }
    public function get_status_admin($date)
    {
        $pointage=admin_pointage::where('date',$date)->where('emp_id', $this->id)->first();
        if ($pointage) {
            return $pointage->emp_status_id;
        } else {
            return null;
        }
        
    }

    public function get_status_maint($date)
    {
        $pointage=maint_pointage::where('date',$date)->where('emp_id', $this->id)->first();
        if ($pointage) {
            return $pointage->emp_status_id;
        } else {
            return null;
        }
        
    }

    public function avances()
    {
        return $this->hasMany(Avance::class, 'emp_id', 'id');
    }
}
