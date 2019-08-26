<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{
    use LogsActivity, SoftDeletes;

    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];

    protected $fillable = ['name', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
