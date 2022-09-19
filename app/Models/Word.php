<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'type_id',
        'word',
        'definition',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
