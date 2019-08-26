<?php

namespace App;

use App\Autopart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;

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
