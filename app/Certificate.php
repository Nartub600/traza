<?php

namespace App;

use App\Autopart;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['number', 'cuit'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function autoparts()
    {
        return $this->hasMany(Autopart::class);
    }
}
