<?php

namespace App\Http\Controllers\Poll;

use App\Http\Controllers\Controller;
use App\Http\Requests\PollRequest;
use App\Http\Requests\PollUpdateRequest;
use App\Models\Poll;
use App\Services\PollService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PollController extends Controller
{

    public function index()
    {
        $polls = Poll::orderBy('finished_at', 'desc')->get();

        return view('polls.all', compact('polls'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(PollRequest $request, PollService $pollService)
    {

        $pollData = $request->validated();

        $poll = $pollService->create($pollData);

        if ( !$poll ) {
            return to_route('polls.mine')->with([
                'error' => 'An error accured!'
            ]);
        }

        return to_route('polls.mine')->with([
            'message' => 'Your poll created successfully!'
        ]);

    }

    public function show(Poll $poll)
    {
        return view('polls.edit')->with(["poll" => $poll->load('questions')]);
    }

    public function edit(Poll $poll)
    {
        return view('polls.edit')->with(["poll" => $poll]);
    }

    public function update(PollUpdateRequest $request, Poll $poll, PollService $pollService)
    {
        $pollData = $request->validated();

        $poll = $pollService->update($pollData, $poll);

        if ( !$poll ) {
            return to_route('polls.index')->withErrors([
                'error' => 'Something wrong :('
            ]);
        }


        return to_route('polls.index')->with([
            'success' => 'true',
            'message' => 'Your poll updated successfully!'
        ]);

    }

    public function destroy(Poll $poll, PollService $pollService)
    {

        $pollResult = $pollService->delete($poll);

        if ( !$poll ) {
            return to_route('polls.index')->withErrors([
                'error' => 'Something wrong :('
            ]);
        }


        return to_route('polls.index')->with([
            'success' => 'true',
            'message' => 'Your poll deleted  successfully!'
        ]);
    }
}
