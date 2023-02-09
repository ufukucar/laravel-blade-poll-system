<?php

namespace App\Http\Controllers\Poll;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LatestPollController extends Controller
{

    /**
     * Gets latest polls created
     *
     */
    public function __invoke(Request $request)
    {


        $returnArr = [
            'latestPolls' => $latest = Poll::where('finished_at', '>=', Carbon::now())->orderBy('started_at', 'DESC')->get(),
        ];

        return view('polls.latest')->with($returnArr);
    }
}
