@php use App\Models\Option; @endphp
<x-app-layout>

    @foreach($poll->questions as $question)

        <x-slot name="header">
            <h2 class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-loose">
                Results of {{ $poll->title }}
            </h2>
        </x-slot>

        <div class="py-5 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-1 ">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 text-gray-900 dark:text-gray-100">

                        <div class="sm:flex sm:flex-row flex-column gap-6 justify-between align-content-center ">
                            <div class="mr-2   w-full">
                                <div>
                                    <canvas id="myChart_{{ $question->id }}_{{ $loop->index }}"></canvas>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 w-full">
                                <div>
                                    <canvas id="myChart3_{{ $question->id }}_{{ $loop->index }}"></canvas>
                                </div>
                            </div>

                        </div>
                        <div class="bg-gray-100 mt-8  text  flex justify-center align-content-center ">
                            <div class="w-full">
                                <canvas id="myChart2_{{ $question->id }}_{{ $loop->index }}"></canvas>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    @endforeach

    @push('scripts')

        <!-- Chart JS -->
        <script type="text/javascript" src="{{ asset('/assets/libs/jquery.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            let backgroundColor = [
                "#fd7f6f", "#7eb0d5", "#b2e061", "#bd7ebe", "#ffb55a", "#ffee65", "#beb9db", "#fdcce5", "#8bd3c7",
                "#b30000", "#7c1158", "#4421af", "#1a53ff", "#0d88e6", "#00b7c7", "#5ad45a", "#8be04e", "#ebdc78",
                "#e60049", "#0bb4ff", "#50e991", "#e6d800", "#9b19f5", "#ffa300", "#dc0ab4", "#b3d4ff", "#00bfa0",
                "#ea5545", "#f46a9b", "#ef9b20", "#edbf33", "#ede15b", "#bdcf32", "#87bc45", "#27aeef", "#b33dc6",
            ]

            @foreach($poll->questions as $question)
                <?php  //echo  ("Loop index: ".$loop->index."<br>");

                 ?>


                const ctx_{{ $question->id }}_{{ $loop->index }} = document.getElementById('myChart_{{ $question->id }}_{{ $loop->index }}');
                const ctx2_{{ $question->id }}_{{ $loop->index }} = document.getElementById('myChart2_{{ $question->id }}_{{ $loop->index }}');
                const ctx3_{{ $question->id }}_{{ $loop->index }} = document.getElementById('myChart3_{{ $question->id }}_{{ $loop->index }}');

                let datas_{{ $question->id }}_{{ $loop->index }} = [];
                let labels_{{ $question->id }}_{{ $loop->index }} = [];

                const data_{{ $question->id }}_{{ $loop->index }} = {
                    labels: labels_{{ $question->id }}_{{ $loop->index }},
                    datasets: [{
                        label: '{{ $question->question }}',
                        data: datas_{{ $question->id }}_{{ $loop->index }},
                        backgroundColor: backgroundColor.slice(0, {{ $question->options->count() }}),
                        hoverOffset: 0
                    }]
                };


                @foreach( $question->options as $option)
                    labels_{{ $question->id }}_{{ $loop->parent->index }}.push("{{ $option->option }}")
                @endforeach


                @php
                    //\DB::enableQueryLog(); // Enable query log

                                        $results = Option::leftJoin('results', 'results.option_id', 'options.id')
                                                           ->select(DB::raw('COUNT(results.option_id) as total_of_fills') )
                                                           ->groupBy("options.option")
                                                           ->where('options.question_id', $question->id)
                                                           ->orderBy('options.id', 'ASC')
                                                           ->get();
                    //dd(\DB::getQueryLog(), $question->id); // Show results of log



                @endphp

                @foreach($results as $result )

                    datas_{{ $question->id }}_{{ $loop->parent->index }}.push({{ $result["total_of_fills"] }})
                @endforeach


                new Chart(ctx_{{ $question->id }}_{{ $loop->index }}, {
                        type: 'pie',
                        data: data_{{ $question->id }}_{{ $loop->index }},
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font:{
                                            size: 12,
                                            weight: "600",
                                        },

                                    }
                                }
                            },
                            layout: {
                                padding: 5,
                            }
                        },

                    });
                new Chart(ctx2_{{ $question->id }}_{{ $loop->index }}, {
                    type: 'bar',
                    data: data_{{ $question->id }}_{{ $loop->index }},
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },

                    },

                });
                new Chart(ctx3_{{ $question->id }}_{{ $loop->index }}, {
                    type: 'doughnut',
                    data: data_{{ $question->id }}_{{ $loop->index }},
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },

                    },

                });
            @endforeach


        </script>
    @endpush

</x-app-layout>

