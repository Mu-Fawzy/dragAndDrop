<?php

namespace App\Http\Requests\Plans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
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
            'name'          => [
                'required',
                Rule::unique('plans','name')
                ->where('admin_id',auth()->guard('admin')->id())
            ],
            'description'   => 'min:10',
            'box_ids'       => 'required|array',
            'box_ids.*'     => 'required|string|distinct|min:1',
        ];

        if ($this->plan != null) {
            $roles['name'] = [
                'required',
                Rule::unique('plans','name')
                ->ignore($this->plan)
                ->where('admin_id',auth()->guard('admin')->id())
            ];
        }

        return $roles;
    }
}
