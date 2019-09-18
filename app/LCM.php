<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LCM extends Model
{
    use SoftDeletes;

    protected $table = 'lcms';

    protected $fillable = ['gde', 'special', 'reference', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
