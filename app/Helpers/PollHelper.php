<?php

namespace App\Helpers;



use App\Models\Poll;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PollHelper
{

    public function isExist (int $id)
    {

        $poll = Poll::with('questions')->where('id', $id)->first();

        if ( !$poll ) return false;

        return $poll;

    }

}
