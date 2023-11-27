<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'plan',
        'status',
        'contact',
        'email',
        'renewalDate',
        'path',
        'data',
    ];

    protected $casts = [
        'renewalDate' => 'datetime',
        'data' => 'json',
    ];
}
