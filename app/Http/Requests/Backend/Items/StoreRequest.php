<?php

namespace App\Http\Requests\Backend\Items;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|unique:items,name',
            'info' => 'required',
            'box_id' => 'required',
        ];

        if ($this->item != null) {
            $roles['name'] = 'required|unique:items,name,'.$this->item->id;
        }

        return $roles;
    }
}
