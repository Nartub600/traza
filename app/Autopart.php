<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'pictures',
    ];

    protected $appends = [
        'product_string',
        'ncm_string'
    ];

    protected $casts = [
        'certified_at' => 'date|Y-m-d',
        'pictures' => 'array'
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

    public function generarCHAS($chas)
    {
        switch ($chas) {
            case 'nac':
                $tipo = 'F';
            break;
            case 'ext':
                $tipo = 'I';
            break;
        }

        $producto = str_pad(explode('.', $this->product->category)[0], 2, '0', STR_PAD_LEFT);

        $organismo = ''; // todo: sacar esto
        switch ($tipo) {
            case 'F':
                $user = $this->certificate ? $this->certificate->user : Auth::user();
                $userGroups = $user->groups->map->name;
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

    public function getPhysicalPicturesAttribute()
    {
        return collect($this->pictures)->map(function ($picture) {
            return $this->traza->files[collect($this->traza->files)->search(function ($file) use ($picture) {
                return $file['name'] === $picture;
            })];
        });
    }

    public function hasCHAS()
    {
        return !is_null($this->chas);
    }
}
