<?php

namespace App\Models;

use App\Traits\FormatDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory, FormatDates;

    protected $fillable = [
        'name',
        'description',
    ];

    public function boxes()
    {
        return $this->belongsToMany(Box::class);
    }
}