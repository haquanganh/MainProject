<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Admin_EditProject_Request extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'in_PName' => 'required|max:150',
        ];
    }
    public function messages(){
        return [
            'in_PName.required' => 'Please enter the Project Name',
            'in_PName.max' => 'Project Name can not be more than 150 characters',
        ];
    }
}
