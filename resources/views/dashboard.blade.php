<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">OTC Dashboard</h1>

        <!-- Summary Cards - Updated with specific metrics -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">OTC Performance Summary</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-blue-100 p-4 rounded-md">
                    <h3 class="font-semibold text-blue-700">Accredited Transport Cooperatives</h3>
                    <p class="text-xl font-bold text-gray-800">{{ $tcs->total ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-600">Accross All Regions</p>
                </div>
                <div class="bg-green-100 p-4 rounded-md">
                    <h3 class="font-semibold text-green-700">Active Applications</h3>
                    <p class="text-xl font-bold text-gray-800">{{ $tcs->total ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-600">Accreditation and CGS Renewal</p>
                </div>
            </div>
        </div>

        <!-- 1st ROW - SUMMARY (released/get from general_info table) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Total Accredited Transporation Cooperatives Per Regions -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <div class="flex justify-between items-center ">
                    <h2 class="text-lg font-semibold text-gray-700">TC per Regions</h2>
                </div>
                <div id="transactionStatusChart" class="w-full h-full"></div>
            </div>

            <!-- Total No. of CGS Renewals Per Year -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <div class="flex justify-between items-center ">
                    <h2 class="text-lg font-semibold text-gray-700">CGS Renewals Per Year</h2>
                </div>
                <div id="transactionStatusChart" class="w-full h-full"></div>
            </div>
        </div>

        {{-- 2nd ROW - APPLICATIONS (get from applications table)--}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- No. of Applications For Accreditation per Status (new/submitted, saved/pending, evaluated, approved, rejected, released) -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700">Accreditation Status</h2>
                <div id="registrationStatusChart" class="w-full h-full"></div>
            </div>

            <!-- No. of Applications For CGS Renewals per Status (new/submitted, saved/pending, evaluated, approved, rejected, released) -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <div class="flex justify-between items-center ">
                    <h2 class="text-lg font-semibold text-gray-700">CGS Renewal Status</h2>
                </div>
                <div id="transactionStatusChart" class="w-full h-full"></div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        if (typeof ApexCharts !== 'undefined') {
            // Transaction Status Chart - Now showing only current month data
            var transactionStatusChart = new ApexCharts(document.getElementById("transactionStatusChart"), {
                series: [{
                        name: 'Evaluated',
                        data: [45]
                    },
                    {
                        name: 'In Progress',
                        data: [25]
                    },
                    {
                        name: 'Completed',
                        data: [15]
                    }
                ],
                chart: {
                    type: 'bar',
                    height: '100%',
                    stacked: false,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    }
                },
                xaxis: {
                    categories: ['March'] // Current month - will be updated by filter
                },
                legend: {
                    position: 'bottom',
                    fontSize: '10px',
                    show: true,
                    offsetY: 0,
                    itemMargin: {
                        horizontal: 8,
                        vertical: 0
                    }
                },
                fill: {
                    opacity: .85
                },
                colors: ['#FFB547', '#00C3E3', '#43C46F'],
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    style: {
                        fontSize: '12px',
                        fontWeight: 'bold'
                    }
                }
            });

            // Registration Status Chart - Updated to ensure labels are visible
            var registrationStatusChart = new ApexCharts(document.getElementById("registrationStatusChart"), {
                series: [40, 25, 20, 15],
                chart: {
                    type: 'pie',
                    height: '100%'
                },
                labels: ['Accredited', 'CGS Issued', 'Renewal', 'CETOP Training'],
                colors: ['#FCDE70', '#E88D67', '#51829B', '#6AAB9C'],
                legend: {
                    position: 'bottom',
                    fontSize: '10px',
                    show: true,
                    offsetY: 0
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        return opt.w.globals.labels[opt.seriesIndex] + ': ' + val + '%';
                    },
                    style: {
                        fontSize: '10px'
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            });

            // Transportation Cooperative Status Chart - Updated to ensure labels
            var transportationStatusChart = new ApexCharts(document.getElementById("transportationStatusChart"), {
                series: [60, 40],
                chart: {
                    type: 'donut',
                    height: '100%'
                },
                labels: ['Active', 'Inactive'],
                colors: ['#347928', '#E64848'],
                legend: {
                    position: 'bottom',
                    fontSize: '10px',
                    show: true
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        return opt.w.globals.labels[opt.seriesIndex] + ': ' + val + '%';
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            });

            // Regional Bar Chart
            var regionalBarChart = new ApexCharts(document.getElementById("regionalBarChart"), {
                series: [{
                    name: 'Registered Cooperatives',
                    data: [28, 18, 15, 12, 24, 14, 10, 8, 9, 7, 6, 12, 9, 11, 13, 8, 6]
                }],
                chart: {
                    type: 'bar',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetX: 10,
                    style: {
                        fontSize: '10px'
                    }
                },
                xaxis: {
                    categories: [
                        'NCR', 'Region I', 'Region II', 'Region III', 'Region IV-A',
                        'Region IV-B', 'Region V', 'Region VI', 'Region VII',
                        'Region VIII', 'Region IX', 'Region X', 'Region XI',
                        'Region XII', 'Region XIII', 'CAR', 'BARMM'
                    ],
                    labels: {
                        style: {
                            fontSize: '10px'
                        }
                    }
                },
                colors: ['#008FFB', ]
            });

            // Philippines Map Chart
            var philippinesMapChart = new ApexCharts(document.getElementById("philippinesMapChart"), {
                series: [{
                    name: 'Cooperatives',
                    data: [{
                            x: 'NCR',
                            y: 28
                        },
                        {
                            x: 'Region IV-A',
                            y: 24
                        },
                        {
                            x: 'Region I',
                            y: 18
                        },
                        {
                            x: 'Region II',
                            y: 15
                        },
                        {
                            x: 'Region III',
                            y: 12
                        },
                        {
                            x: 'Region X',
                            y: 12
                        }
                    ]
                }],
                chart: {
                    height: '100%',
                    type: 'treemap',
                    toolbar: {
                        show: false
                    }
                },
                colors: [
                    '#3B93A5', '#F7B844', '#ADD8C7', '#EC3C65', '#CDD7B6',
                    '#C1F666', '#D43F97', '#1E5D8C', '#421243', '#7F94B0'
                ],
                title: {
                    text: 'Top Regions',
                    align: 'center',
                    style: {
                        fontSize: '14px'
                    }
                }
            });

            // Transportation Type Chart with pastel colors
            var transportationTypeChart = new ApexCharts(document.getElementById("transportationTypeChart"), {
                series: [45, 25, 15, 10, 5],
                chart: {
                    type: 'pie',
                    height: '100%'
                },
                labels: ['Jeepney', 'UV Express', 'Bus', 'Taxi', 'Others'],
                colors: ['#3498DB', '#E67E22', '#8E44AD', '#E74C3C', '#2ECC71'], // Darker, more vivid colors
                legend: {
                    position: 'bottom',
                    fontSize: '10px',
                    show: true
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        return opt.w.globals.labels[opt.seriesIndex] + ': ' + val + '%';
                    },
                    style: {
                        fontSize: '10px',
                        colors: ['#FFF'] // White text for better contrast on darker colors
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            });

            // Regional Bar Chart with darker colors
            var regionalBarChart = new ApexCharts(document.getElementById("regionalBarChart"), {
                series: [{
                    name: 'Registered Cooperatives',
                    data: [28, 18, 15, 12, 24, 14, 10, 8, 9, 7, 6, 12, 9, 11, 13, 8, 6]
                }],
                chart: {
                    type: 'bar',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetX: 10,
                    style: {
                        fontSize: '10px',
                        colors: ['#000000']
                    }
                },
                xaxis: {
                    categories: [
                        'NCR', 'Region I', 'Region II', 'Region III', 'Region IV-A',
                        'Region IV-B', 'Region V', 'Region VI', 'Region VII',
                        'Region VIII', 'Region IX', 'Region X', 'Region XI',
                        'Region XII', 'Region XIII', 'CAR', 'BARMM'
                    ],
                    labels: {
                        style: {
                            fontSize: '10px'
                        }
                    }
                },
                colors: [
                    '#3498DB', '#16A085', '#8E44AD', '#2980B9', '#E67E22',
                    '#C0392B', '#9B59B6', '#1ABC9C', '#D35400', '#7D3C98',
                    '#2874A6', '#1B9CFC', '#E74C3C', '#4A69BD', '#6C3483',
                    '#FF6B6B', '#F39C12'
                ]
            });

            // Growth Trend Chart - Redesigned for better readability
            var growthTrendChart = new ApexCharts(document.getElementById("growthTrendChart"), {
                series: [{
                    name: 'New Cooperatives',
                    data: [15, 22, 36, 30, 28, 32, 45, 55]
                }],
                chart: {
                    height: '100%',
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '60%',
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                stroke: {
                    width: 0
                },
                fill: {
                    type: 'solid',
                    opacity: 1,
                    colors: ['#2E86C1']
                },
                xaxis: {
                    categories: ['Q1 2023', 'Q2 2023', 'Q3 2023', 'Q4 2023', 'Q1 2024', 'Q2 2024', 'Q3 2024',
                        'Q4 2024'
                    ],
                    position: 'bottom',
                    labels: {
                        style: {
                            fontWeight: 'bold'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    title: {
                        text: 'Number of Cooperatives',
                        style: {
                            fontWeight: 'bold'
                        }
                    },
                    labels: {
                        show: true
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " cooperatives";
                            }
                            return y;
                        }
                    }
                },
                grid: {
                    borderColor: '#E2E8F0',
                    strokeDashArray: 4
                },
                colors: ['#2E86C1']
            });


            var regionalBarChart = new ApexCharts(document.getElementById("regionalBarChart"), {
                series: [{
                    name: 'Cooperatives',
                    data: [28, 18, 15, 12, 24, 14, 10, 8, 9, 7, 6, 12, 9, 11, 13, 8, 6]
                }],
                chart: {
                    type: 'bar',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetX: 10,
                    style: {
                        fontSize: '10px',
                        colors: ['#05444a']
                    }
                },
                xaxis: {
                    categories: [
                        'NCR', 'Region I', 'Region II', 'Region III', 'Region IV-A',
                        'Region IV-B', 'Region V', 'Region VI', 'Region VII',
                        'Region VIII', 'Region IX', 'Region X', 'Region XI',
                        'Region XII', 'Region XIII', 'CAR', 'BARMM'
                    ],
                    labels: {
                        style: {
                            fontSize: '10px'
                        }
                    }
                },

                colors: [
                    '#4F46E5', '#7C3AED', '#F59E0B', '#10B981', '#3B82F6',
                    '#EC4899', '#8B5CF6', '#06B6D4', '#EF4444', '#F97316',
                    '#14B8A6', '#6366F1', '#D946EF', '#84CC16', '#0EA5E9',
                    '#F43F5E', '#9333EA'
                ],
                title: {
                    text: '',
                    show: false
                },
                subtitle: {
                    text: '',
                    show: false
                },
                legend: {
                    show: false
                }
            });
            transactionStatusChart.render();
            registrationStatusChart.render();
            transportationStatusChart.render();
            regionalBarChart.render();
            philippinesMapChart.render();
            transportationTypeChart.render();
            growthTrendChart.render();

            // Date range picker initialization
            document.addEventListener('DOMContentLoaded', function() {
                // Set default date range (current month)
                const today = new Date();
                const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
                const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

                document.getElementById('date-from').valueAsDate = firstDay;
                document.getElementById('date-to').valueAsDate = lastDay;

                // Add filter change handler
                document.querySelector('button.bg-blue-600').addEventListener('click', function() {
                    const filterType = document.getElementById('filter-type').value;
                    const dateFrom = document.getElementById('date-from').value;
                    const dateTo = document.getElementById('date-to').value;

                    // Here you would normally fetch new data based on the date range
                    // For demo purposes, we'll just show an alert
                    alert(`Filter applied: ${filterType} view from ${dateFrom} to ${dateTo}`);

                    // In a real application, this would be replaced with an AJAX call
                    // to fetch new data and update the charts
                });
            });
        }
    </script>
</x-layout>
