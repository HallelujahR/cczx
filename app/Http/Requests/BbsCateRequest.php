<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BbsCateRequest extends FormRequest
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
            'cate' => 'unique:bbs_cates',
        ];
    }

    public function messages(){
        return [
            'cate.unique' => '此分类名重复，请重新填写',
        ];
    }
}
