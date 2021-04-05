<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Plans\PlanRequest;
use App\Models\Box;
use App\Models\Plan;
use App\Models\Item;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PlanController extends BackendController
{
    public function __construct(Plan $model)
    {
        parent::__construct($model);
    }

    public function show($id)
    {
        $admin = auth()->guard('admin')->id();
        $boxes = Box::whereHas('plans', function($q) use($id){
            return $q->where('plan_id', $id);
        })->with(['admin','items'=>function($q) use($admin){
            return $q->with('admin')->select('id','name','info','order','box_id','admin_id','completed')->where('admin_id',$admin)->orderBy('order','asc');
        }])->where('admin_id',$admin)->orderBy('order','asc')->get(['id','name','order','completed']);

        return view('backend.plans.show', compact('boxes'));
    }
    
    public function store(PlanRequest $request)
    {
        $pluralModelName = $this->getPluralName($this->model);
        $input = $request->merge([
            'admin_id' => auth()->guard('admin')->id(),
        ]);

        $this->model->name          = $request->name;
        $this->model->description   = $request->description;

        $this->model->save();

        $box_ids          = $request->box_ids;

        $this->model->boxes()->sync($box_ids);
        Alert::success('انشاء '.trans_choice('drag.'.$pluralModelName, 1), 'تم انشاء '.trans_choice('drag.'.$pluralModelName, 1).' ينجاح')->showConfirmButton('تم','#3085d6');
        return redirect()->route('admin.'.lcfirst($pluralModelName).'.index');
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $pluralModelName = $this->getPluralName($this->model);
        $input = $request->except('_token','box_ids');
        $plan->update($input);

        $plan->boxes()->sync($request->box_ids);
        
        Alert::success('تحديث '.trans_choice('drag.'.$pluralModelName, 1), 'تم تحديث '.trans_choice('drag.'.$pluralModelName, 1).' ينجاح')->showConfirmButton('تم','#3085d6');;
        return redirect()->route('admin.'.lcfirst($pluralModelName).'.edit',$plan->id);
    }

    public function updateOrder(Request $request) {
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

    public function deleteOrder(Request $request)
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

    public function passDateToView()
    {
        return [
            'boxes' => Box::where('admin_id',auth()->guard('admin')->id())->get()
        ];
    }

}
