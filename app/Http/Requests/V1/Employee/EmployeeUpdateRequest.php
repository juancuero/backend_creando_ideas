<?php

namespace App\Http\Requests\V1\Employee;

use  App\Http\Requests\BaseFormRequest;

class EmployeeUpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
         return [
            'name' => ['required', 'unique:employees,name,' . $this->employee->id, 'string'],
            'email' => ['email'],
        ];
    }
}
