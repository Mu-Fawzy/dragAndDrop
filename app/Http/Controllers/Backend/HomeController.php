<?php

namespace App\Http\Controllers\Backend;

use App\Models\Box;
use App\Models\Item;
use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends BackendController
{
    public function __construct(Plan $model)
    {
        parent::__construct($model);
    }

    
}
