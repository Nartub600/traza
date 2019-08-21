<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    protected $fillable = ['product_id', 'name', 'description', 'brand', 'model', 'origin', 'picture'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
