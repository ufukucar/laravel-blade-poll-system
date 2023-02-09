<?php

namespace App\Http\Controllers\Poll;

use App\Helpers\PollHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PollFillOutRequest;
use App\Models\Poll;
use App\Models\Result;
use App\Services\PollService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FillOutController extends Controller
{

    public function getPoll(Request $req)
    {
        $id = intval($req->id);

        $poll = (new PollHelper())->isExist($id);
        abort_if(!$poll, 404);

        /*** If filled out before, forbidden */
        $result = Result::where('question_id', $poll->questions[0]->id)
            ->where('user_id', Auth::user()->id)->where('poll_id', $poll->id)->count();
        abort_if($result, 403);

        $returnArr = [
            "poll" => $poll,
            "question_number" => 0,
        ];

        return view('polls.fill_out')->with($returnArr);
    }


    public function postPollSingle(Poll $poll, PollFillOutRequest $request, PollService $pollService)
    {

        $validatedData = $request->validated();

        $result = $pollService->pollFillOut($poll, $validatedData["answer_id"]);


        if ( $result["error"]) {
            return redirect()->back()->with([
                'error' => 'Something wrong :('
            ]);
        }

        if ( $result["continue"] ) {
           return $this->getPollForMultiple($poll, $result["question_number"]);
        }

        $returnArr = [
            'success' => true,
            'message' => 'Thanks for your interest!'
        ];

        return to_route('polls.latest')->with($returnArr);
    }


    private function getPollForMultiple(Poll $poll, int $question_number)
    {
        /*** If filled out before, forbidden */
        $result = Result::where('question_id', $poll->questions[$question_number]->id)
            ->where('user_id', Auth::user()->id)->where('poll_id', $poll->id)->count();
        abort_if($result, 403);

        $id = intval($poll->id);

        $returnArr = [
            "poll" => $poll,
            "question_number" => $question_number
        ];

        return view('polls.fill_out')->with($returnArr);
    }

}
