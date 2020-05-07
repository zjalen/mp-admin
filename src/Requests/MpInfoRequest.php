<?php

namespace Jalen\MpAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MpInfoRequest extends FormRequest
{
    public function rules()
    {
        switch($this->method())
        {
            // store
            case 'POST':
                return [
                    'name' => ['required','unique:mpa_mp_info'],
                    'sign' => ['required','unique:mpa_mp_info'],
                    'app_id' => ['required','unique:mpa_mp_info'],
                    'app_secret' => ['required'],
                    'token' => ['required'],
                    'aes_key' => [''],
                    'qr_code' => [''],
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [];
                break;
            case 'DELETE':
                break;
        }
        return [];
    }

    public function messages()
    {
        return [
            'name.required'=>'名称必填',
            'sign.required'=>'标识必填',
            'app_id.required'=>'app_id 必填',
            'app_secret.required'=>'app_secret 必填',
            'token.required'=>'token 必填',
            'name.unique'=>'名称已存在',
            'sign.unique'=>'标识已存在',
            'app_id.unique'=>'app_id 已存在',
        ];
    }
}
