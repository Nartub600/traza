<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LCM extends Model
{
    use SoftDeletes;

    protected $table = 'lcms';

    protected $fillable = ['type', 'defeats', 'number', 'issued_at', 'business_name', 'address', 'cuit', 'country', 'manufacturing_place', 'commercial_name', 'brand', 'model', 'category', 'version'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
