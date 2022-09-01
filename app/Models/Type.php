<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'type'
    ];

    public function words(){
        return $this->hasMany(Word::class);
    }
}
