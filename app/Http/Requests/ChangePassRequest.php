<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePassRequest extends Request
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
            // 'old_pass' => 'required',
            // 'new_pass' => 'required|min:6|max:16',
            // 'renew_pass' => 'required|same:new_pass'
        ];
    }
    public function messages(){
        return [
            // 'old_pass.required' => 'Old password invalid!',
            // 'new_pass.required' => 'Password is from 6 to 15 characters!',
            // 'renew_pass.required' => 'Re-password invalid!'
            ];
    }
}
