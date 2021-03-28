<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
        'order',
        'box_id'
    ];

    
    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id', 'id');
    }
    
}
