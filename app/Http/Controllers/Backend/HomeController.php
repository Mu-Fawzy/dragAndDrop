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

    public function update(Request $request) {
        $input = $request->all();

        if(isset($input['teamArr']) && !empty($input['teamArr'])){
            foreach ($input['teamArr'] as $key => $value) {
                $key = $key+1;
                Box::where('id',$value)->update(['order'=>$key]);
            }
        }

        if(isset($input['userArr']) && !empty($input['userArr'])){
            $usersBox = $input['usersBox'];
            foreach ($input['userArr'] as $key => $value) {
                $key = $key+1;
                Item::where('id',$value)->update(['box_id'=> $usersBox ,'order'=>$key]);
            }
        }
        return response()->json(['status'=>'success']);
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        if (isset($input['itemName'])) {
            $itemId = $input['itemId'];
            if( $input['itemName'] == "item-id" ){
                $item = Item::where('id',$itemId)->first();
                $item->delete();
            }
            
            if(  $input['itemName'] == "box-id" ) {
                $item = Box::where('id',$itemId)->first();
                $item->delete();
            }
        }
        return response()->json(['status'=>'success']);
    }

    public function getModelName($model)
    {
        return class_basename($model);
    }

    public function getPluralName($model)
    {
        return Str::plural($this->getModelName($model));
    }
}
