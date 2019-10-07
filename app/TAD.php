<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TAD extends Model
{
    use SoftDeletes;

    protected $table = 'tads';

    protected $casts = [
        'documents' => 'collection',
        'autoparts' => 'collection'
    ];
}
