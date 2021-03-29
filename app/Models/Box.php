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
        'admin_id',
    ];

    
    public function items()
    {
        return $this->hasMany(Item::class, 'box_id', 'id');
    }
    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

}
