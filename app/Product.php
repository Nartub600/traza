<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->category = $product->resolveCategory();
        });
    }

    use SoftDeletes;

    protected $fillable = ['name', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $with = ['children'];

    public static function findByCategory($category)
    {
        return (new static)::where('category', $category)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function resolveCategory()
    {
        $tree = [];

        if ($parent = $this->parent) {
            array_unshift($tree, $this->subindex);
            while ($parent->parent) {
                array_unshift($tree, $parent->subindex);
                $parent = $parent->parent;
            }
            array_unshift($tree, $parent->id);
        } else {
            $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
            $nextId = $statement[0]->Auto_increment;
            array_unshift($tree, $this->id ?? $nextId);
        }

        return implode('.', $tree);
    }
}
