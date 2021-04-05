<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BackendController extends Controller
{
    public $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $items = $this->model;
        $items = $this->filter($items);
        if($this->with() != null){
            $items = $items->with($this->with());
        }
        $items = $items->orderBy('id','desc');
        if ($this->selectToShow() != null) {
            $items = $items->paginate(10,$this->selectToShow());
        }else {
            $items = $items->paginate(10);
        }

        $pluralModelName = $this->getPluralName($this->model);

        $title          = 'قائمة '.trans_choice('drag.'.$pluralModelName, 2); 
        $slogan         = 'هنا يمكنك اضافة, تعديل, حدف '.trans_choice('drag.'.$pluralModelName, 1);
        $nothingHere    = 'لايوجد '.trans_choice('drag.'.$pluralModelName, 1).' بعد ';

        return view('backend.'.lcfirst($pluralModelName).'.index',compact('items','pluralModelName','title','slogan','nothingHere'));
    }

    public function create()
    {
        $pluralModelName = $this->getPluralName($this->model);
        $title          = 'انشاء - '.trans_choice('drag.'.$pluralModelName, 1); 
        $slogan         = 'هنا يمكنك اضافة '.trans_choice('drag.'.$pluralModelName, 1);
        $passDateToView = $this->passDateToView();

        return view('backend.'.lcfirst($pluralModelName).'.create', compact('pluralModelName','title','slogan'))->with($passDateToView);
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        $pluralModelName = $this->getPluralName($this->model);
        $title          = 'تعديل - '.trans_choice('drag.'.$pluralModelName, 1); 
        $slogan         = 'هنا يمكنك تعديل '.trans_choice('drag.'.$pluralModelName, 1); 
        $passDateToView = $this->passDateToView();

        return view('backend.'.lcfirst($pluralModelName).'.edit', compact('item','pluralModelName','title','slogan'))->with($passDateToView);
    }

    public function destroy($id)
    {
        $ModelName = $this->getModelName($this->model);
        $item = $this->model::findOrFail($id);
        $item->delete();
        $pluralModelName = $this->getPluralName($this->model);

        return redirect()->route('admin.'.lcfirst($pluralModelName).'.index');
    }

    public function getModelName($model)
    {
        return class_basename($model);
    }

    public function getPluralName($model)
    {
        return Str::plural($this->getModelName($model));
    }

    public function filter($items)
    {
        return $items;
    }
    
    public function with()
    {
        return [];
    }

    public function selectToShow()
    {
        return [];
    }

    public function passDateToView()
    {
        return [];
    }
}
