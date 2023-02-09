@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-loose">
            {{ $poll->title }} Has <b>{{ $poll->questions_count }}</b> Question(s).
        </h2>
    </x-slot>

    <div class="py-5 ">
        <div class="max-w-7xl mx-auto   ">
            <div class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-2 text-gray-900 dark:text-gray-100">
                    <div id='recipients' class=" lg:mt-0 rounded shadow bg-grey-50">

                        <x-errors.default-error />
                        <x-success.default-success />

                        @if ( $poll->questions_count >= 2 )

                            <x-poll.fill-out-poll-multiple :poll="$poll" questionNumber="{{ $question_number }}"></x-poll.fill-out-poll-multiple>
                        @else
                            <x-poll.fill-out-poll-single :poll="$poll"></x-poll.fill-out-poll-single>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('.answers-span').on('click', function() {
                let id = $(this).data('id');
                $('.answers-span').removeClass('active')
                $(this).addClass('active')
                $('input#answer_id').val(id)
            })
        })
    </script>
    <script>
        $(document).ready(function() {

           $('.success').slideUp(1750)
        });
    </script>
</x-app-layout>
