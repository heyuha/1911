<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginPost extends FormRequest
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
            'name'=>'required',
            'pwd'=>'required',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'账号不可为空',
            'pwd.required'=>'密码不可为空',
        ];
    }
}
