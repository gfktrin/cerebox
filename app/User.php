<?php

namespace Cerebox;

use Cerebox\Address;
use Cerebox\City;
use Cerebox\Invoice;
use Cerebox\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Cerebox\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property boolean $admin
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cerebox\User whereAdmin($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nickname','phone','city_id','tickets'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //Relationships
    public function projects()
    {
        return $this->hasMany(Project::class,'author_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'user_id','id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function address()
    {
        return $this->hasOne(Address::class,'user_id','id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class,'user_id');
    }

    public function registers(){
        return $this->hasMany(Register::class,'user_id');
    }

    public function tickets(){
        return $this->belongsToMany(Product::class, 'tickets')->withPivot(['quantity']);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
