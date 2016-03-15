<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'in_Email' =>'required|unique:User,Email',
            'in_EName' => 'required',
            'in_Name'=> 'required',
            'in_Phone' => 'min:10|max:11|required',
            'in_Skype' => 'min:6|required',
            'sl_Role' => 'required',
            'in_CostHour' => 'required',
            'in_Password' => 'required',
            'in_Repassword' => 'required',
            'in_id' => 'required|unique:Employee,idEmployee',
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
    public function messages(){
        $messages= [
            'in_Email.required' =>'Please enter the Email',
            'in_Email.unique' => 'The Email already exists',
            'in_EName.required' => 'Please enter the English Name',
            'in_Name.required'=> 'Please enter the Full Name',
            'in_Phone.required' => 'Please enter the Phone',
            'in_Phone.min' => 'Please enter the Phone is more than 10 numbers',
            'in_Phone.max' => 'Please enter the Phone is equal or less than 11 numbers',
            'in_Skype.required' => 'Please enter the Skype',
            'in_Skype.min' => 'Please enter the Skype address is more than 6 characters',
            'sl_Role.required' => 'Please enter the Role',
            'in_CostHour.required' => 'Please enter the CostHour',
            'in_Password.required' => 'Please enter the password',
            'in_Repassword.required' => 'Please enter repassword again',
            'in_id.required' => 'Please enter the Id of Employee',
            'in_id.unique' => 'The Id already exists',
            'in_Year.0.required' =>' Please add skill',
            'in_img.min' => 'Please upload file with size is more than 0MB',
            'in_img.max' => 'Please upload a file with size is less than 6MB',
            'in_img.image' => 'Please upload a picture',
            'in_img.required' =>'Please upload a file',
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
