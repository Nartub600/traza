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

    public function traza()
    {
        return $this->belongsTo(Traza::class);
    }

    public function generarCAPE($product)
    {
        $tipo = 'C';
        $familia = str_pad($product, 2, '0', STR_PAD_LEFT);
        $terminal = '000';
        $anio = now()->format('y');
        $mes = now()->format('m');
        $codigo = str_pad($this->CAPEcountByYear(now()->format('Y')) + 1, 4, '0', STR_PAD_LEFT);
        $verificador = rand(0, 9); // todo: guarda

        $this->cape = "$tipo$familia$terminal$anio$mes$codigo$verificador";
    }

    private function CAPEcountByYear($year)
    {
        return $this->whereNotNull('cape')->whereYear('created_at', $year)->count();
    }

    public static function findByCAPE($cape)
    {
        return (new static)::where('cape', $cape)->first();
    }
}
