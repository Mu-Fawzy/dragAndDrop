<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Items\StoreRequest;
use App\Models\Box;
use App\Models\Item;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends BackendController
{
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }

    public function store(StoreRequest $request)
    {
        $ModelName = $this->getModelName($this->model);
        $pluralModelName = $this->getPluralName($this->model);
        $input = $request->merge([
            'order' => ($this->model->max('order'))+1,
            'admin_id' => auth()->guard('admin')->id(),
        ]);

        $this->model->create($input->all());

        Alert::success($ModelName.' Created', $ModelName.' Created Successfully');
        return redirect()->route('admin.'.$pluralModelName.'.index');
    }

    public function update(StoreRequest $request, Item $item)
    {
        $ModelName = $this->getModelName($this->model);
        $pluralModelName = $this->getPluralName($this->model);
        $input = $request->except('_token');
        $item->update($input);

        Alert::success($ModelName.' Updated', $ModelName.' Updated Successfully');
        return redirect()->route('admin.'.$pluralModelName.'.edit',$item->id);
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
            'boxes' => Box::get()
        ];
    }
}
