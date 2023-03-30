<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademie extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function typkurzov()
    {
        return $this->hasMany(Typkurzu::class,'akademies_id');
    }
}
