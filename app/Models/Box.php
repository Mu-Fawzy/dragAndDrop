<?php

namespace App\Models;

use App\Traits\FormatDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory, FormatDates;

    protected $fillable = [
        'name',
        'order',
        'completed',
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

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
