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
}
