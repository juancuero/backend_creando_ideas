<?php

namespace App\Http\Requests\V1\Company;

use  App\Http\Requests\BaseFormRequest;

class CompanyCreateRequest extends BaseFormRequest
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
            'name' => ['required', 'unique:companies', 'string'],
        ];
    }
}
