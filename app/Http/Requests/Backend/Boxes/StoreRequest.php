<?php

namespace App\Http\Requests\Backend\Boxes;

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
                Rule::unique('boxes','name')
                ->where('admin_id',auth()->guard('admin')->id())
            ],
        ];

        if ($this->box != null) {
            $roles['name'] = [
                'required',
                Rule::unique('boxes','name')
                ->ignore($this->box)
                ->where('admin_id',auth()->guard('admin')->id())
            ];
        }

        return $roles;
    }
}
