<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        $items = $items->orderBy('id','desc');
        if ($this->selectToShow() != null) {
            $items = $items->paginate(15,$this->selectToShow());
        }else {
            $items = $items->paginate(15);
        }

        $lowerModelName = $this->getLowerNameModel($this->model);
        $pluralModelName = $this->getPluralName($this->model);
        $ucfirtsModelName = $this->getUCFirstName($this->model);

        $title          = $ucfirtsModelName.' List';
        $slogan         = 'Here you can add, edit, delete '.$ucfirtsModelName;
        $nothingHere    = 'No '.$ucfirtsModelName.' Yet ';

        return view('backend.'.$pluralModelName.'.index',compact('items','lowerModelName','pluralModelName','title','slogan','nothingHere'));
    }

    public function create()
    {
        $pluralModelName = $this->getPluralName($this->model);
        return view('backend.'.$pluralModelName.'.create');
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        $pluralModelName = $this->getPluralName($this->model);

        return view('backend.'.$pluralModelName.'.edit', compact('item'));
    }

    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();
        $pluralModelName = $this->getPluralName($this->model);

        return redirect()->route('admin.'.$pluralModelName.'.index');
    }

    public function getModelName($model)
    {
        return class_basename($model);
    }

    public function getLowerNameModel($model)
    {
        return Str::lower($this->getModelName($model));
    }

    public function getPluralName($model)
    {
        return Str::plural($this->getLowerNameModel($model));
    }

    public function getUCFirstName($model)
    {
        return Str::ucfirst($this->getPluralName($model));
    }

    public function filter($items)
    {
        return $items;
    }
    
    public function selectToShow()
    {
        return [];
    }
}
