<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required',
            'started_at' => 'required|date|after_or_equal:now',
            'finished_at' => 'required|date|after:started_at',
            'question' => new QuestionRequest(),
            'options' => new OptionRequest(),

        ];
    }
}
