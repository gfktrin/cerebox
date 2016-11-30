<?php

namespace Cerebox;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
