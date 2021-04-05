<?php

namespace App\Models;

use App\Traits\FormatDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, FormatDates;

    protected $fillable = [
        'name',
        'info',
        'order',
        'completed',
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

}
