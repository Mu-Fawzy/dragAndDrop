<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Boxes\StoreRequest;
use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $boxes = Box::where('admin_id',auth()->guard('admin')->id())->paginate(2,['id','name','created_at']);
        return view('backend.boxes.index',compact('boxes'));
    }

    public function create()
    {
        return view('backend.boxes.create');
    }

    public function store(StoreRequest $request)
    {
        $box = new Box();
        $input = $request->merge([
            'order' => ($box->max('order'))+1,
            'admin_id' => auth()->guard('admin')->id(),
        ]);

        $box->create($input->all());
        return redirect()->route('admin.boxes.index');
    }

    public function edit(Box $box)
    {
        return view('backend.boxes.edit', compact('box'));
    }

    public function update(StoreRequest $request, Box $box)
    {
        $input = $request->except('_token');
        $box->update($input);
        return redirect()->route('admin.boxes.edit',$box->id);
    }

    public function destroy(Box $box)
    {
        $box->delete();
        return redirect()->route('admin.boxes.index');
    }
}
