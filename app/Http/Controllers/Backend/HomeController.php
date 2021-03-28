<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Box;
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

        foreach ($input['teamArr'] as $key => $value) {
            $key = $key+1;
            Box::where('id',$value)->update(['order'=>$key]);
        }

        return response()->json(['status'=>'success']);
    }
}
