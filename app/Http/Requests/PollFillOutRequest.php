<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollFillOutRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'answer_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'answer_id.required' => "Please select your choice",
            'answer_id.integer'  => "You did something wrong!",
        ];
    }
}
