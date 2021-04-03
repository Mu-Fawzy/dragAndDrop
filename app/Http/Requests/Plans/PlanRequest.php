<?php

namespace App\Http\Requests\Plans;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'          => 'required|unique:boxes,name',
            'description'   => 'min:10',
            'box_ids'       => 'required|array',
            'box_ids.*'     => 'required|string|distinct|min:1',
        ];

        if ($this->box != null) {
            $roles['name'] = 'required|unique:plans,name,'.$this->plan->id;
        }

        return $roles;
    }
}
