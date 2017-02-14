<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCreate extends FormRequest
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
    public function messages()
    {

        return [
           'title.required'=>'标题不能为空',
            'title.min'=>'标题最小长度为6',
            'title.max'=>'标题最大长度为20',
            'body.required'=>'正文不能为空',
            'body.min'=>'正文最小为10',
            'topics.required'=>'话题不能为空'
        ];
    }

    public function rules()
    {
        return [
            'title'=>"required|min:10|max:20",
            'body'=>"required|min:10",
            'topics'=>'required'

        ];
    }
}
