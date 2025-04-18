<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold dark-gold-font dark:text-white">Dashboard</h1>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 style="font-size:24px;">Simplify the process for tracking interactions with potential & existing customers in four easy steps.</h1>
                    <br>
                    1. Create a new contact to save customer contact information, including the customers status in their willingness to purchase. <br>
                    2. Create a note when you have made contact with a specific customer to capture details and update status.<br>
                    3. Automatically create a new sales pitch with our AI sales pitch generator and then attach the pitch when it is used in a note. <br>
                    4. Review your statistics to view the effectiveness of your sales pitches.
                    <br><br>
                    <p class="text-lg">You currently have <a class="font-bold text-custom-gold" href="/prospects">{{ $contacts }} contacts</a>,
                        <a class="font-bold text-custom-gold" href="/notes">{{ $notes }} notes</a> and
                        <a class="font-bold text-custom-gold" href="/pitches">{{ $pitches }} pitches</a>.</p>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['corechart']}); // Changed to corechart
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Pitch ID & Description', 'Effectiveness', { role: 'style' }],
                                    @php
                                        $colors = ['#CC9933', '#FFCC00', '#ffe680'];
                                        $colorIndex = 0;
                                    @endphp
                                    @foreach($stats as $stat)
                                    @php
                                        $color = $colors[$colorIndex % 3];
                                        $colorIndex++;
                                    @endphp
                                ['ID:{{ $stat->ai_response_id }} {{ Str::limit(ltrim($stat->aiResponse->response, '"'), 35) }}', {{ $stat->total_count > 0 ? number_format(($stat->total_status / ($stat->total_count * 4)) * 100, 1) : 0 }}, 'color: {{ $color }}'],
                                @endforeach
                            ]);

                            var options = {
                                chart: {
                                    title: 'Pitch Performance',
                                    subtitle: 'Effectiveness of a pitch when used on a prospect(note).',
                                },
                                colors: ['#CC9933']
                            };

                            var chart = new google.visualization.BarChart(document.getElementById('columnchart_material')); // Changed to BarChart

                            chart.draw(data, options);
                        }
                    </script>

                    <br><br>
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Crafted with <span style="color:darkred; text-decoration:underline;">❤</span> by <a
            href="https://mikestratton.net" target="_blank"><span style="color:darkred; text-decoration:underline;">mikestratton.net</span></a>
    </footer>
</x-app-layout>
