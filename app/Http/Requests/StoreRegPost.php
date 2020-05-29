<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegPost extends FormRequest
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
            'name'=>'required|unique:member',
            'code'=>'required',
            'pwd'=>'required',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'账号不可为空',
            'name.unique'=>'账号已存在',
            'code.required'=>'验证码不可为空',
            'pwd.required'=>'密码不可为空',
        ];
    }
}
