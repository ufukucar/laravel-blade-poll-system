@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-loose">
            Create Poll
        </h2>
    </x-slot>

    <div class="py-5 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-1 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-5 text-gray-900 dark:text-gray-100">

                    @if ( session()->has('errors') )
                        <div class=" px-7 py-5 w-full bg-gray-50  ">
                            <ul>
                                @foreach( $errors->all() as $error )
                                    <li class="text-red-600 leading-6 text-sm ">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('polls.store') }}" method="POST" class="w-full">

                        @csrf

                        <div class="bg-white px-4 py-5 sm:p-6">

                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-12">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" id="title"
                                           class="pollInput">
                                </div>

                                <div class="col-span-12   flex flex-row justify-between gap-2.5 ">

                                    <div class="w-1/2 ">
                                        <label for="started_at" class=" text-sm font-medium text-gray-700">Started At</label>
                                        <input type="datetime-local" name="started_at" id="started_at" value="{{ Carbon::now()->addMinutes(2)}}"
                                               class="pollInput" min="{{ Carbon::now() }}">
                                    </div>

                                    <div class=" w-1/2 ">

                                        <label for="finished_at" class=" text-sm font-medium text-gray-700">Finished At</label>
                                        <input type="datetime-local" name="finished_at" id="finished_at" value="{{ Carbon::now()->addDay() }}"
                                               class="pollInput" min="{{ Carbon::now() }}">
                                    </div>

                                </div>


                                <!-- QUESTIONS AND OPTIONS -->
                                <div id="questions" class="col-span-12">
                                    <div class="question">
                                        <div class="col-span-12 mb-5">
                                            <label for="question" class="block text-sm font-medium text-gray-700">Question 1</label>
                                            <input type="text" name="question[][question]" id="question"
                                                   class="pollInput" value="Q1">
                                        </div>

                                        <div class="optionGroup col-span-12 ">

                                            <div class="col-span-12 mb-5 optionDiv">
                                                <label  class="block text-sm font-medium text-gray-700">Option 1</label>
                                                <input type="text" name="options[0][][option]" class="pollInput " value="Opt 1">
                                                <span class="delete">X</span>
                                            </div>

                                            <div class="col-span-12 mb-5 optionDiv">
                                                <label  class="block text-sm font-medium text-gray-700">Option 2</label>
                                                <input type="text" name="options[0][][option]" class="pollInput " value="Opt 2">
                                                <span class="delete">X</span>
                                            </div>

                                        </div>

                                        <button type="button" class="formSubmitBtn bg-orange-700 hover:bg-orange-800 mr-2 handleAddOption" id="handleAddOption">
                                            Add Option
                                        </button>
                                    </div>
                                </div>
                                <!-- #QUESTIONS AND OPTIONS -->
                            </div>

                            <!-- SUBMIT POLL -->
                                <div class=" px-1 py-3 text-right sm:px-6">
                                    <button type="button" class="formSubmitBtn bg-orange-600 hover:bg-orange-800 mr-2" id="handleAddQuestion">
                                        Add Question
                                    </button>

                                    <button type="button" class="formSubmitBtn bg-red-900 hover:bg-red-800 mr-2" id="handleRemoveLast">
                                        Remove Last
                                    </button>

                                    <button type="submit" class="formSubmitBtn"> Save </button>
                                </div>
                            <!-- #SUBMIT POLL -->
                        </div>


                    </form>

                </div>

            </div>
        </div>
    </div>


    <script>
        $(function() {

            // Handle option.
            // Adds options to related question
            $(document).on('click','.handleAddOption', function(e) {

                let count = $(this).parent().find('.optionDiv').length;
                let questionCount = $('.question ').length;

                $(this).parent().children('.question').css("background", "red")

                let newElement = `
                                    <div class="col-span-12 mb-5 mt-3 optionDiv">
                                       <label class="block text-sm font-medium text-gray-700">Option ${count + 1}</label>
                                       <input type="text" name="options[${questionCount - 1}][][option]" class="pollInput " autofocus value="Opt ${count + 1}">
                                        <span  class="delete">X</span>
                                    </div>
                                    `;

                $(this).parent().has('.optionGroup').children('.optionGroup').append(newElement)
            })


            $('#handleAddQuestion').on('click', function(e) {

                let questionCount = $('.question ').length;

                let newElement = `
                                    <div class="question mt-7 border-t pt-7">
                                        <div class="col-span-12 mb-5">
                                            <label for="question" class="block text-sm font-medium text-gray-700" autofocus>Question ${ questionCount + 1}</label>
                                            <input type="text" name="question[][question]" id="question" class="pollInput" value=" Q ${ questionCount +1 }  ">
                                        </div>

                                        <div class="optionGroup col-span-12 ">

                                            <div class="col-span-12 mb-5 optionDiv">
                                                <label  class="block text-sm font-medium text-gray-700">Option 1</label>
                                                <input type="text" name="options[${questionCount}][][option]" class="pollInput ">
                                                <span class="delete">X</span>
                                            </div>

                                            <div class="col-span-12 mb-5 optionDiv">
                                                <label  class="block text-sm font-medium text-gray-700">Option 2</label>
                                                <input type="text" name="options[${questionCount}][][option]" class="pollInput ">
                                                <span class="delete">X</span>
                                            </div>

                                        </div>

                                        <button type="button" class="formSubmitBtn bg-orange-700 hover:bg-orange-800 mr-2 handleAddOption" id="handleAddOption">
                                            Add Option
                                        </button>
                                    </div>
                                    `;

                $('#questions').append(newElement)

            })

            $(document).on('click', '.delete', function() {

                $(this).parent().remove();

                $('.optionDiv').each(function(i) {
                    $(this).find('label').html('Option ' + (i+1))
                })
            })


            $(document).on('click', '#handleRemoveLast', function(e) {
                $('.question').last().remove();

                $('.optionDiv').each(function(i) {
                    $(this).find('label').html('Option ' + (i+1))
                })
            });

        })
    </script>

</x-app-layout>
