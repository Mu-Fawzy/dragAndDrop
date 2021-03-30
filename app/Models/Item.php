<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
        'order',
        'box_id',
        'admin_id'
    ];

    
    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id', 'id');
    }
    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->translatedFormat('d M,Y');
    }
}
