<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MessageTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'workflow_id',
        'template',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Boot function to set created_by, updated_by, and deleted_by automatically
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-assign created_by when creating
        static::creating(function ($messageTemplate) {
            $messageTemplate->created_by = Auth::id(); // Get logged-in user ID
        });

        // Auto-assign updated_by when updating
        static::updating(function ($messageTemplate) {
            $messageTemplate->updated_by = Auth::id();
        });

        // Auto-assign deleted_by when deleting (soft delete)
        static::deleting(function ($messageTemplate) {
            $messageTemplate->deleted_by = Auth::id();
            $messageTemplate->save(); // Save before actually deleting
        });
    }
}
