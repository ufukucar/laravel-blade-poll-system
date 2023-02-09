<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Poll;
use App\Models\Result;
use Carbon\Traits\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{


    public function index(Poll $poll, Request $request)
    {

        if ( $poll->questions()->count() < 2 )
        {
            $options = $poll->questions[0]->options->pluck('option')->map(function($data) {
                return trim($data, '"');
            });

            $results = Option::leftJoin('results', 'results.option_id', 'options.id')
                ->select(DB::raw('COUNT(results.option_id) as total_of_fills') )
                ->groupBy("options.option")
                ->where('options.question_id', $poll->questions[0]->id)
                ->orderBy('options.id', 'ASC')
                ->get();
            $returnArr = [
                'poll' => $poll,
                'options' => $options,
                "results" => $results,
            ];

            return view('results.index')->with($returnArr);

        }else {

            // Min 2 questions
            $returnArr = [
                'poll' => $poll,

            ];

            return view('results.multiple')->with($returnArr);
        }

    }

}
