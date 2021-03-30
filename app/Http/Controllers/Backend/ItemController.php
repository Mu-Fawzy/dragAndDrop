<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends BackendController
{
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }


}
