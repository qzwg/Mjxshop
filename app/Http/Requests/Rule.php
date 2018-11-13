<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Rule extends FormRequest
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
            //
            'user' => 'required|min:5|max:30',
            'pwd' => 'required|confirmed|min:5',
            'password_confirmation'=>'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'user.required' => '用户名不能为空',
            'user.min'  => '用户名最小为5个字符',
            'user.max'  => '用户名最大为30个字符',
            'pwd.required'=>'密码不能为空',
            'pwd.confirmed'=>'2次密码不一致',
            'pwd.min'=>'密码最少5个字符',
            'password_confirmation'=>'密码不能为空',
            'password_confirmation'=>'最少为5个',
        ];
    }
}
