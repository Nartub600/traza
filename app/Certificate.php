<?php

namespace App;

use App\Autopart;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('fromOwnGroups', function (Builder $builder) {
            $builder->when(!request()->user()->hasRole('administrador'), function ($query) {
                $user_ids = request()->user()->groups->flatMap->users->pluck('id');
                return $query->whereIn('user_id', $user_ids);
            });
        });
    }

    use SoftDeletes;

    protected $fillable = ['number', 'cuit'];

    protected $casts = [
        'files' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function autoparts()
    {
        return $this->hasMany(Autopart::class);
    }
}
