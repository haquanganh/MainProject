<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Admin_ClientCompany_Information_Request extends Request
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
            'in_Name'=> 'required|max:50',
            'in_Phone' => 'min:10|max:11|required',
            'in_Skype' => 'min:6|max:32|required',
            'in_img' => 'image|min:0|max:6144|mimes:jpg,jpeg,png',
            'in_address' => 'min:4',
        ];
    }
    public function messages(){
        return [
            'in_Name.required'=> 'Please enter the Full Name',
            'in_Name.max' => 'The Full Name must be contained equal or less than 50 characters',
            'in_Phone.required' => 'Please enter the Phone',
            'in_Phone.min' => 'Please enter the Phone is more than 10 numbers',
            'in_Phone.max' => 'Please enter the Phone is equal or less than 11 numbers',
            'in_Phone.unique' => 'The Phone already exists',
            'in_Skype.required' => 'Please enter the Skype',
            'in_Skype.min' => 'Please enter the Skype is equal or more than 6 characters',
            'in_Skype.max' => 'Please enter the Skype is equal or less than 32 characters',
            'in_img.min' => 'Please upload file with size equal or more than 0MB',
            'in_img.max' => 'Please upload a file with size equal less than 6MB',
            'in_img.image' => 'Please upload a picture',
            'in_img.mimes' => 'Please upload a picture with mimes : jpg, jpeg, png',
            'in_address.min' => 'Please enter the Address equal or more than 4 characters',
        ];
    }
}
