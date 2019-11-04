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

    public function generarCHAS()
    {
        $tipo = $this->origin === 'Argentina' ? 'F' : 'I';
        $familia = str_pad(explode('.', $this->product)[0], 2, '0', STR_PAD_LEFT);
        $organismo = '000'; // w29, ira, int
        $anio = now()->format('y');
        $mes = now()->format('m');
        $codigo = str_pad($this->CHAScountByYear(now()->format('Y')) + 1, 4, '0', STR_PAD_LEFT);
        $verificador = rand(0, 9); // todo: guarda

        $this->chas = "$tipo$familia$terminal$anio$mes$codigo$verificador";
    }

    private function CHAScountByYear($year)
    {
        return $this->whereNotNull('chas')->whereYear('created_at', $year)->count();
    }

    public static function findByCHAS($chas)
    {
        return (new static)::where('chas', $chas)->first();
    }
}
