<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Plans\PlanRequest;
use App\Models\Box;
use App\Models\Plan;
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

    public function passDateToView()
    {
        return [
            'boxes' => Box::where('admin_id',auth()->guard('admin')->id())->get()
        ];
    }

}
