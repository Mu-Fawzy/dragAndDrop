<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

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

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->translatedFormat('d M,Y');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
