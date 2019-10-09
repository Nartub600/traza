<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $with = ['children'];

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

    public function getIndexAttribute()
    {
        $products = $this->parent ? $this->parent->children : Product::doesntHave('parent')->get();

        $index = $products->search(function ($product) {
            return $product->id === $this->id;
        });

        return $index + 1;
    }

    public function getCategoryAttribute()
    {
        $tree = [];
        if ($parent = $this->parent) {
            array_unshift($tree, $this->index);
            while ($parent->parent) {
                array_unshift($tree, $parent->index);
                $parent = $parent->parent;
            }
            array_unshift($tree, $parent->id);
        } else {
            array_unshift($tree, $this->id);
        }
        return implode('.', $tree);
    }
}
