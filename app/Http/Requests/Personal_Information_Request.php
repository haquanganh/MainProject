<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Personal_Information_Request extends Request
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
        'in_skype' => 'min:6|required',
        'in_phone' => 'min:10|max:11|required',
        'in_address' => 'required',
        'in_img' => 'min:0|max:6144|image|mimes:jpg,jpeg,png',
        ];
        return $rules;
    }
    public function messages(){
        $messages= [
        'in_skype.required' => 'Please enter the Skype',
        'in_phone.required' => 'Please enther the Phone',
        'in_Phone.min' => 'Please enter the Phone is more than 10 numbers',
        'in_Phone.max' => 'Please enter the Phone is equal or less than 11 numbers',
        'in_address.required' => 'Please enter the Address',
        'in_skype.min' => 'Please enter skype address is more than 6 characters',
        'in_img.min' => 'Please upload file with size is more than 0MB',
        'in_img.max' => 'Please upload a file with size is less than 6MB',
        'in_img.image' => 'Please upload a picture',
        'in_img.mimes' => 'Please upload a picture with mimes : jpg, jpeg, png',
        ];
        return $messages;
    }
}
