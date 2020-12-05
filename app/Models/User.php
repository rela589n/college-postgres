<?php

namespace App\Models;

use App\Casts\AddressCast;
use App\Casts\NameCast;
use App\Models\Translations\HasObjectTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
//    use HandlesValueObjectTranslations;
    use HasObjectTranslations;
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
//        'name',
//        'email',
//        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name'              => NameCast::class.':name,name_translations',
        'address'           => AddressCast::class.':name,address_translations',
    ];
}
