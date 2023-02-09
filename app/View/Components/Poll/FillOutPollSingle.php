<?php

namespace App\View\Components\Poll;

use App\Models\Poll;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class FillOutPollSingle extends Component
{

    public Poll $poll;
    public $question_number = 0;

    public function __construct( $poll )
    {
        $this->poll = $poll;


    }


    public function render()
    {

        return view('components.poll.fill-out-poll-single', [
            'poll' => $this->poll,
            'question_number' => $this->question_number
        ]);
    }
}
