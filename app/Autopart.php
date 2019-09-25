<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    protected $fillable = [
        'family_id',
        'product_id',
        'description',
        'ncm_category',
        'manufacturer',
        'importer',
        'business_name',
        'part_number',
        'brand',
        'model',
        'origin',
        'size',
        'formulation',
        'application',
        'license',
        'certified_at',
    ];

    protected $appends = [
        'product_name',
        'family_name',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function family()
    {
        return $this->belongsTo(Product::class, 'family_id');
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function getFamilyNameAttribute()
    {
        return $this->family->name;
    }
}
