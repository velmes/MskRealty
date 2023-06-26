<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client',
        'call',
        'comment',
        'responsible',
        'status',
        'number',
        'answer',
        'user_id',
        'office_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->responsible= 'Не назначен';
            $query->status = 'Принята';
        });
    }
}
