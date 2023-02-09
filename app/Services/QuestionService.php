<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionService
{

    public function create(array $questionData, int $poll_id): Question
    {



        try {

            $data["poll_id"] = $poll_id;
            $data["question"] = $questionData["question"];

            dd($data);
            $question = Question::create($data);


        }catch (\Exception $exception) {
           Log::error($exception->getMessage());
        }

        return $question;
    }

}
