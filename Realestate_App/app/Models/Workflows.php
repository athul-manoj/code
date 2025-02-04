<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflows extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'status', 
        'phase_id',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}
