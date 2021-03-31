<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Items\StoreRequest;
use App\Models\Box;
use App\Models\Item;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends BackendController
{
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }

    public function store(StoreRequest $request)
    {
        $pluralModelName = $this->getPluralName($this->model);
        $input = $request->merge([
            'order' => ($this->model->max('order'))+1,
            'admin_id' => auth()->guard('admin')->id(),
            'completed' => false,
        ]);

        $this->model->create($input->all());

        Alert::success('انشاء '.trans_choice('drag.'.$pluralModelName, 1), 'تم انشاء '.trans_choice('drag.'.$pluralModelName, 1).' ينجاح')->showConfirmButton('تم','#3085d6');
        return redirect()->route('admin.'.lcfirst($pluralModelName).'.index');
    }

    public function update(StoreRequest $request, Item $item)
    {
        $pluralModelName = $this->getPluralName($this->model);
        $input = $request->except('_token');
        $item->update($input);

        Alert::success('تحديث '.trans_choice('drag.'.$pluralModelName, 1), 'تم تحديث '.trans_choice('drag.'.$pluralModelName, 1).' ينجاح')->showConfirmButton('تم','#3085d6');;
        return redirect()->route('admin.'.lcfirst($pluralModelName).'.edit',$item->id);
    }

    public function itemCompleted(Request $request)
    {
        $input = $request->all();
        $itemCompletedId = $input['itemCompletedId'];
        $itemCompletedValue = $input['itemCompletedValue'];
        
        Item::where('id',$itemCompletedId)->update(['completed'=>$itemCompletedValue]);
        return response()->json([
            'status'=>'success',
            'itemCompletedValue'=> $itemCompletedValue,
            'itemCompletedId'=> $itemCompletedId,
        ]);
    }

    public function filter($items)
    {
        return $items->where('admin_id',auth()->guard('admin')->id());
    }

    public function selectToShow()
    {
        return ['id','name','info','box_id','created_at'];
    }

    public function with()
    {
        return ['box'];
    }

    public function passDateToView()
    {
        return [
            'boxes' => Box::where('admin_id',auth()->guard('admin')->id())->get()
        ];
    }
}
