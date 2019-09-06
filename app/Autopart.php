<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    protected $fillable = ['product_id', 'name', 'description', 'brand', 'model', 'origin', 'pictures'];

    protected $casts = [
        'pictures' => 'array'
    ];

    protected $appends = [
        'product_name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }
}
