<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Boxes\StoreRequest;
use App\Models\Box;
use RealRashid\SweetAlert\Facades\Alert;

class BoxController extends BackendController
{
    public function __construct(Box $model)
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

    public function update(StoreRequest $request, Box $box)
    {
        $ModelName = $this->getModelName($this->model);
        $pluralModelName = $this->getPluralName($this->model);
        $input = $request->except('_token');
        $box->update($input);

        Alert::success($ModelName.' Updated', $ModelName.' Updated Successfully');
        return redirect()->route('admin.'.$pluralModelName.'.edit',$box->id);
    }

    public function filter($items)
    {
        return $items->where('admin_id',auth()->guard('admin')->id());
    }

    public function selectToShow()
    {
        return ['id','name','created_at'];
    }
}
