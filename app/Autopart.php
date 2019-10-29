<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    protected $fillable = [
        'product_id',
        'ncm_id',
        'description',
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
        'product_string',
        'ncm_string'
    ];

    protected $casts = [
        'certified_at' => 'date|Y-m-d'
    ];

    public function traza()
    {
        return $this->belongsTo(Traza::class);
    }

    public function ncm()
    {
        return $this->belongsTo(NCM::class, 'ncm_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductStringAttribute()
    {
        return $this->product->human;
    }

    public function getNcmStringAttribute()
    {
        return $this->ncm->human;
    }
}
