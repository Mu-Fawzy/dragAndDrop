<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $boxes = Box::whereHas('items')->with('items',function($q){
            return $q->select('id','name','info','order','box_id')->orderBy('order','asc');
        })->orderBy('order','asc')->get(['id','name','order']);

        return view('backend.home', compact('boxes'));
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
}
