<?php

namespace App\Http\Controllers\Poll;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPolllController extends Controller
{
    /**
     * Gets latest polls created
     *
     */
    public function __invoke(Request $request)
    {

        $returnArr = [
            'myPolls' => $latest = Poll::withCount('questions')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get(),
        ];

        return view('polls.mypolls')->with($returnArr);
    }
}
