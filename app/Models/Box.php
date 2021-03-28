<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
    ];

    
    public function items()
    {
        return $this->hasMany(Item::class, 'box_id', 'id');
    }
    
}
