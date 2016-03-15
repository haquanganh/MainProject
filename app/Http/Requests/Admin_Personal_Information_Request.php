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
        $rules = [
            'in_EName' => 'required',
            'in_Name'=> 'required',
            'in_Phone' => 'min:10|max:11|required',
            'in_Skype' => 'min:6|required',
            'sl_Role' => 'required',
            'in_CostHour' => 'required',
            'in_Year.0' => 'required',
            'in_img' => 'min:0|max:6144|image|mimes:jpg,jpeg,png',
        ];

        if($this->request->get('in_Year') == true){
            foreach ($this->request->get('in_Year') as $key => $value) {
            $rules['in_Year.'.$key] = 'required';
            }
        }
        return $rules;
    }
    public function messages()
    {
        $messages= [
            'in_EName.required' => 'Please enter the English Name',
            'in_Name.required'=> 'Please enter the Full Name',
            'in_Phone.required' => 'Please enter the Phone',
            'in_Phone.min' => 'Please enter the Phone is more than 10 numbers',
            'in_Phone.max' => 'Please enter the Phone is equal or less than 11 numbers',
            'in_Skype.required' => 'Please enter the Skype',
            'sl_Role.required' => 'Please enter the Role',
            'in_CostHour.required' => 'Please enter the CostHour',
            'in_Year.0.required' =>' Please add skill',
            'in_img.min' => 'Please upload file with size is more than 0MB',
            'in_img.max' => 'Please upload a file with size is less than 6MB',
            'in_img.image' => 'Please upload a picture',
            'in_img.mimes' => 'Please upload a picture with mimes : jpg, jpeg, png',

        ];
        if($this->request->get('in_Year') == true){
            foreach ($this->request->get('in_Year') as $key => $value) {
            $messages['in_Year.'.$key.'.required'] = 'Please enter the year';
            }
        }
        return $messages;
    }
}
