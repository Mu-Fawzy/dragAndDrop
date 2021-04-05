<?php

namespace App\Http\Requests\Backend\Items;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $roles = [
            'name' => [
                'required',
                Rule::unique('items','name')
                ->where('admin_id',auth()->guard('admin')->id())
            ],
            'info' => 'required',
            'box_id' => 'required',
        ];

        if ($this->item != null) {
            // $roles['name'] = 'required|unique:items,name,'.$this->item->id;
            $roles['name'] = [
                'required',
                Rule::unique('items','name')
                ->ignore($this->item)
                ->where('admin_id',auth()->guard('admin')->id())
            ];
        }

        return $roles;
    }
}
