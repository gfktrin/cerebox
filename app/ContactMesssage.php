<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;

/**
 * Cerebox\ContactMesssageMail
 *
 * @mixin \Eloquent
 * @property string $name
 * @property string $email
 * @property string $message

 */
class ContactMesssage extends Model
{
    public $fillable = [
        'name',
        'email',
        'message'
    ];
}
