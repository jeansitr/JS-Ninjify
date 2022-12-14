<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buzzword extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function words()
    {
        return $this->belongsToMany(Word::class, 'descriptives');
    }
}
