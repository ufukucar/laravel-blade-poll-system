@dd("$question_number")

<div class="max-w-7xl mx-auto">
    <div class="container mx-auto h-full min-h-screen">
        <div class="flex w-full ">
            <div class="right w-full mx-auto bg-gray-50 p-5 border rounded-2xl">
                <form action="{{ route('polls.fill_out_post', $poll ) }}" method="post">

                    @csrf
                    <div class="question mb-3">
                        <p class=" gap-1.5 text-center text-lg py-2 px-3 pb-6 border-b font-semibold  leading-2 text-gray-900">
                            Q. {{ $poll->questions[$question_number]->question }}
                        </p>
                    </div>

                    <div class="answers relative py-2 px-3">
                        <p>Answers</p>

                        @foreach($poll->questions[$question_number]->options as $option)
                            <span class="answers-span" data-id="{{ $option->id }}">{{ $option->option }}</span>
                        @endforeach
                    </div>

                    <input type="hidden" name="answer_id" id="answer_id">
                    <div class="nextQuestion  float-right">
                        <button type="submit" class="nextBtn">SAVE</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
