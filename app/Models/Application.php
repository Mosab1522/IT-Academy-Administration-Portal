<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded=[
        // 'id',
        // 'verified',
        // 'created_at',
        // 'updated_at'
    ];
}