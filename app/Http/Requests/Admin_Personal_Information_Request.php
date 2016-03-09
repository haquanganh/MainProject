<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Admin_Personal_Information_Request extends Request
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
            'in_Email' =>'required',
            'in_eName' => 'required',
            'in_FullName'=> 'required',
            'in_Address' => 'required',
            'in_Phone' => 'required',
            'in_Skype' => 'required',
            'Role' => 'required',
            'in_CostHour' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'in_Email.required' =>'Please enter the Email',
            'in_eName.required' => 'Please enter the English Name',
            'in_FullName.required'=> 'Please enter the Full Name',
            'in_Address.required' => 'Please enter the Address',
            'in_Phone.required' => 'Please enter the Phone',
            'in_Skype.required' => 'Please enter the Skype',
            'Role.required' => 'Please enter the Role',
            'in_CostHour.required' => 'Please enter the CostHour'
        ];
    }
}
