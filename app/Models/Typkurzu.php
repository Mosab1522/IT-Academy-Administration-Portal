<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typkurzu extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function akademia()
    {
        return $this->belongsTo(Akademie::class, 'akademies_id');
    }
}
