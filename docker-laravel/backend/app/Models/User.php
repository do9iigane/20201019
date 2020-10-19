<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birth',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'password',
//        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
//        'email_verified_at' => 'datetime',
    ];

    public static function getAge($users_id){
        $user = self::find($users_id);
        return Carbon::parse(today())->year - Carbon::parse($user->birth)->year;
    }

    public static function getName($users_id){
        $user = self::find($users_id);
        return $user->name;
    }

    public static function getCourse($users_id){

        return self::getAge($users_id)>=35?'1日人間ドック':'基本健診';
    }

    public function consultations(){
        return $this->hasMany('App\Models\Consultation', 'users_id');
    }
}
