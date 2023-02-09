@php use App\Models\Result;use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-loose">
            All Polls
        </h2>
    </x-slot>

    <div class="py-5 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-1 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900 dark:text-gray-100">
                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                        <x-errors.default-error/>
                        <x-success.default-success/>


                        <table id="example" class=" hover striped cursor-pointer"
                               style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                            <thead>
                            <tr class="text-left">
                                <th data-priority="1">Id</th>
                                <th data-priority="1">Title</th>
                                <th data-priority="2" class="text-center">Number Of Questions</th>
                                <th data-priority="3">Started At</th>
                                <th data-priority="4">Finished At</th>
                                <th data-priority="5" class="text-center">Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($polls as $poll)

                                <tr class="
                                    {{ Carbon::now()->gt(Carbon::parse($poll->finished_at)->toDateTime()) ? 'passed' : ''}}"
                                    {{ Carbon::now()->gt(Carbon::parse($poll->finished_at)->toDateTime()) ? 'disabled' : '' }}>

                                    <td>{{ $poll->id }}</td>
                                    <td>{{ $poll->title }}</td>
                                    <td class="text-center">{{ $poll->questions_count }}</td>
                                    <td>{{ $poll->started_at }}</td>
                                    <td>{{ $poll->finished_at }}</td>
                                    <td class="text-center">

                                        <a href="{{ route('polls.result', $poll) }}" class="text-black underline ml-1 mr-1">Results</a>

                                        @if ( !( Carbon::now()->gt(Carbon::parse($poll->finished_at)->toDateTime()) ))

                                            <a href="{{ route('polls.show', $poll) }}"
                                               class="text-black underline ml-1 mr-1">Edit</a>

                                            @if ( !Result::where('poll_id', $poll->id)->where('user_id', auth()->user()->id)->first() )
                                                <a href="{{ route('polls.fill_out', ['id' => $poll->id]) }}"
                                                   class="text-black underline ml-1 mr-1">Fill Out</a>
                                            @endif

                                            @if ( auth()->user()->id == $poll->user_id  )
                                                <form action="{{ route('polls.destroy', $poll) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                                            class="text-black underline ml-1 mr-1">Delete
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            var table = $('#example').DataTable({
                responsive: true,
                "order": [],
            })
                .columns.adjust()
                .responsive.recalc();
        });

        $(document).ready(function () {

            $('.success').slideUp(1750)
        });

    </script>
</x-app-layout>
