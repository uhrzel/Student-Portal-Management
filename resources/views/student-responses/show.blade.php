<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <header class="mb-6">
                    <h2 class="text-2xl font-bold">
                        {{ $evaluation->title }}
                    </h2>
                    <div class="mt-2 text-gray-600">
                        <span class="mr-4">Teacher: {{ $teacher->name }}</span>
                        <span class="mr-4">Total Responses: {{ $responses->count() }}</span>
                    </div>
                </header>

                <div class="space-y-8">
                    @foreach($phases as $phase)
                    <section class="border-t pt-6">
                        <h3 class="text-xl font-semibold mb-4">{{ $phase->title }}</h3>
                        <div class="space-y-6">
                            @foreach($phase->questions as $question)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-medium text-gray-800 mb-4">{{ $question->question }}</p>

                                @php
                                $ratings = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0], $question->aggregatedResponses);
                                @endphp

                                <div class="h-64">
                                    <div id="chart{{ $question->id }}"></div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var options = {
                                            series: [{
                                                name: 'Number of Ratings',
                                                data: Object.values(@json($ratings))
                                            }],
                                            chart: {
                                                type: 'bar',
                                                height: 256
                                            },
                                            plotOptions: {
                                                bar: {
                                                    borderRadius: 4,
                                                    dataLabels: {
                                                        position: 'top',
                                                    },
                                                }
                                            },
                                            xaxis: {
                                                categories: ['1', '2', '3', '4', '5'],
                                                title: {
                                                    text: 'Rating'
                                                }
                                            },
                                            yaxis: {
                                                title: {
                                                    text: 'Number of Responses'
                                                },
                                                min: 0,
                                                forceNiceScale: true,
                                                labels: {
                                                    formatter: function(val) {
                                                        return Math.floor(val);
                                                    }
                                                }
                                            }
                                        };

                                        var chart = new ApexCharts(document.querySelector("#chart{{ $question->id }}"), options);
                                        chart.render();
                                    });
                                </script>

                                <div class="mt-4">
                                    <h4 class="text-lg font-semibold text-gray-800">Summary of Ratings:</h4>

                                    @php
                                    // Find the rating with the maximum count
                                    $maxRating = array_keys($ratings, max($ratings))[0];

                                    // Define descriptive summaries based on the rating
                                    $descriptions = [
                                    1 => 'The responses indicate significant dissatisfaction or a poor experience with this question. There may be a need for immediate attention or improvements in this area.',
                                    2 => 'The responses suggest a below-average experience, pointing to areas that could use some improvement.',
                                    3 => 'The responses reflect a neutral or average experience, indicating room for growth to achieve higher satisfaction.',
                                    4 => 'The responses indicate a good experience overall, with room to further improve to reach excellence.',
                                    5 => 'The responses overwhelmingly show a high level of satisfaction or an excellent experience with this question.'
                                    ];
                                    @endphp

                                    <p class="text-gray-600">
                                        Based on the responses, the most common rating given was
                                        <strong>{{ $maxRating }}</strong>. {{ $descriptions[$maxRating] }}
                                    </p>
                                    <p class="text-gray-600 mt-4">
                                        The responses reveal a clear pattern in how participants perceive this question. A significant number of participants expressed highly positive feedback, while others shared a more moderate or critical perspective. This distribution highlights the varying sentiments and suggests areas where improvements or reinforcements may be necessary to address diverse opinions.
                                    </p>

                                </div>


                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>