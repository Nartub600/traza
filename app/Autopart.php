<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

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
        $producto = str_pad(explode('.', $this->product)[0], 2, '0', STR_PAD_LEFT);
        switch ($tipo) {
            case 'F':
                $userGroups = $autopart->certificate->user->groups->map->name;
                if ($userGroups->contains('IRAM')) {
                    $organismo = 'IRA';
                }
                if ($userGroups->contains('INTI')) {
                    $organismo = 'INT';
                }
            break;
            case 'I':
                $organismo = 'W29';
            break;
        }
        $anio = now()->format('y');
        $mes = now()->format('m');
        $codigo = str_pad($this->CHAScountByYear(now()->format('Y')) + 1, 4, '0', STR_PAD_LEFT);
        $verificador = rand(0, 9); // todo: guarda

        $this->chas = "$tipo$producto$organismo$anio$mes$codigo$verificador";
    }

    private function CHAScountByYear($year)
    {
        return $this->whereNotNull('chas')->whereYear('created_at', $year)->count();
    }

    public static function findByCHAS($chas)
    {
        return (new static)::where('chas', $chas)->first();
    }

    public function getQrAttribute()
    {
        return QrCode::format('png')->size(200)->generate(url($this->chas));
    }
}
