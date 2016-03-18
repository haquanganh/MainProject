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
        // 'in_skype' => 'min:6|max:50|required',
        'in_phone' => 'min:10|max:11|required',
        'in_address' => 'required|min:4',
        'in_img' => 'image|mimes:jpg,jpeg,png|max:6144',
        ];
        if($this->request->get('in_Skype') == true){
             $rules['in_Skype'] = 'min:6|max:32|required';
        }
        return $rules;
    }
    public function messages(){
        $messages= [
        // 'in_skype.required' => 'Please enter the Skype',
        'in_phone.required' => 'Please enter the Phone',
        'in_phone.min' => 'Please enter the Phone equal or more than 10 numbers',
        'in_phone.max' => 'Please enter the Phone equal or less than 11 numbers',
        'in_address.min' => 'Please enter the Address equal or more than 4 characters',
        'in_img.max' => 'Please upload an image less than 6MB',
        'in_img.image' => 'Please upload an picture',
        'in_img.mimes' => 'Please upload an picture with mimes : jpg, jpeg, png',
        ];
        if($this->request->get('in_Skype') == true){
            $messages['in_Skype.min'] = 'Please enter the Skype address equal or more than 6 characters';
            $messages['in_Skype.max'] = 'Please enter the Skype address equal or less than 32 characters';
        }
        return $messages;
    }
}
