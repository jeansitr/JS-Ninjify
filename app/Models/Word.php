<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public function buzzwords()
    {
        return $this->belongsToMany(Buzzword::class, 'descriptives');
    }
}
