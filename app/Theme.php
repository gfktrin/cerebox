<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';

    protected $guarded = [];

    public function contests()
    {
        return $this->belongsToMany(Contest::class, 'contest_theme');
    }
}
