<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 style="font-size:24px;">Simplify the process for tracking interactions with potential & existing customers in four easy steps.</h1>
                    <br>
                    1. Create a new prospect to store customer contact information, including the customers status in their willingness to purchase. <br>
                    2. Create a note when you have made contact with a specific customer to capture details and update status.<br>
                    3. Automatically create a new sales pitch with our AI sales pitch generator and then attach the pitch when it is used in a note. <br>
                    4. Review your dashboard charts to view the effectiveness of your sales pitches.


                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Pitch ID & Description', 'Effectiveness'],
                                @foreach($stats as $stat)
                                    ['ID:{{ $stat->ai_response_id }} {{ Str::limit(ltrim($stat->aiResponse->response, '"'), 15) }}', {{ $stat->total_count > 0 ? number_format(($stat->total_status / ($stat->total_count * 4)) * 100, 1) : 0 }}],
                                // ['Pitch 2', 23],
                                // ['Pitch 3', 72],
                                // ['Pitch 4', 88]
                                @endforeach
                            ]);

                            var options = {
                                chart: {
                                    title: 'Pitch Performance',
                                    subtitle: 'Effectiveness of a pitch when used on a prospect(note).',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <br><br>
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
