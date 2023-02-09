<?php

namespace App\Services;



use App\Models\Option;
use App\Models\Poll;
use App\Models\Result;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PollService
{

    public function create(array $pollData)
    {

        try {

            $pollData["user_id"] = Auth::user()->id;
            $options = $pollData["options"];

            $poll = Poll::create($pollData);
            $questions = $poll->questions()->createMany($pollData["question"]);
            foreach ($questions as $key => $question)
            {
                $option =  $question->options()->createMany($options[$key]);
            }

        }catch (\Exception $exception) {
           Log::error($exception->getMessage());
           return false;
        }

        return $poll;
    }

    public function update(array $pollData, Poll $poll): bool
    {
        try {

            $options = $pollData["options"];
            $poll_update = $poll->update($pollData);
            $questions =  $pollData["question"];

            $poll->questions()->delete();
            $questions = $poll->questions()->createMany($pollData["question"]);

            foreach ($questions as $key => $question)
            {
                $option =  $question->options()->delete();
                $option =  $question->options()->createMany($options[$key]);
            }
        }catch (\Exception $exception) {
           Log::error($exception->getMessage());
           return false;
        }

        return true;

    }

    public function delete(Poll $poll)
    {
        try {
            $poll->delete();
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return false;
        }

        return true;
    }

    public function pollFillOut(Poll $poll, int $answer_id)
    {
        // For multiple questions, to step up next
        $continue = false;

        $option = Option::where('id', $answer_id)->first();
        if ( !$option ) return false;

        $question = $option->question;
        $poll_id = $question->poll_id;

        try {

            Result::create([
                'user_id' => Auth::user()->id,
                'poll_id' => $poll_id,
                'question_id' => $question->id,
                'option_id' => $option->id
            ]);

            $totalAnswersForThisPoll = Result::where('user_id', Auth::user()->id)->where('poll_id', $poll_id)->get();

            $questionNumber = $poll->questions()->count() -  $totalAnswersForThisPoll->count();

            if ( $questionNumber > 0 )
                $continue = true;


        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return [
                'error' => true,
                'continue' => false,
            ];
        }


        if ( !$continue ) {

            return [
                'error' => false,
                'continue' => false,
            ];
        }

       return  [
           'error' => false,
           'continue' => $continue,
           'question_number' => $totalAnswersForThisPoll->count(),
       ];


    }

}
