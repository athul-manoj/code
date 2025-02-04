<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use SoftDeletes;
    protected $table = 'phase';
    protected $fillable = [
        'name',
        'status',   
    ];
}


