<?php

namespace App\View\Components\Poll;

use App\Models\Poll;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

use App;

class FillOutPollMultiple extends Component
{

    public Poll $poll;
    public $questionNumber;

    public function __construct( $poll,  $questionNumber)
    {
        $this->poll = $poll;
        $this->questionNumber = $questionNumber;



    }

    public function render()
    {

        return view('components.poll.fill-out-poll-single', [
            'poll' => $this->poll,
            'question_number' => $this->questionNumber
        ]);
    }
}
