<x-app-layout>
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
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 w-full">
                            <div>
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>

                    </div>
                    <div class="bg-gray-100 mt-8  text  flex justify-center align-content-center ">
                        <div class="w-full">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @push('scripts')

        <!-- Chart JS -->
        <script type="text/javascript" src="{{ asset('/assets/libs/jquery.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');
            const ctx2 = document.getElementById('myChart2');
            const ctx3 = document.getElementById('myChart3');

            let datas = [];
            let labels = []
            let backgroundColor = [
                "#fd7f6f", "#7eb0d5", "#b2e061", "#bd7ebe", "#ffb55a", "#ffee65", "#beb9db", "#fdcce5", "#8bd3c7",
                "#b30000", "#7c1158", "#4421af", "#1a53ff", "#0d88e6", "#00b7c7", "#5ad45a", "#8be04e", "#ebdc78",
                "#e60049", "#0bb4ff", "#50e991", "#e6d800", "#9b19f5", "#ffa300", "#dc0ab4", "#b3d4ff", "#00bfa0",
                "#ea5545", "#f46a9b", "#ef9b20", "#edbf33", "#ede15b", "#bdcf32", "#87bc45", "#27aeef", "#b33dc6",
            ]

            @foreach( $options as $option)
                labels.push("{{ $option }}")
            @endforeach

            @foreach($results as $result )
             datas.push({{ $result->total_of_fills }})
            @endforeach

            console.log(datas)

            const data = {
                labels: labels,
                datasets: [{
                    label: '{{ $poll->title }}',
                    data: datas,
                    backgroundColor: backgroundColor.slice(0, {{ $options->count() }}),
                    hoverOffset: 0
                }]
            };
            new Chart(ctx, {
                type: 'pie',
                data: data,
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
            new Chart(ctx2, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },

                },

            });
            new Chart(ctx3, {
                type: 'doughnut',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },

                },

            });
        </script>
    @endpush

</x-app-layout>

