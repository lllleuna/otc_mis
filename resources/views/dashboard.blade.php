<x-layout>
    <x-slot:vite>@vite(['resources/css/app.css', 'resources/js/app.js'])</x-slot:vite>
    <x-slot:title>OTC Analytics Dashboard</x-slot:title>

    <div class="bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    <span class="text-blue-600">OTC</span> Dashboard
                </h1>
                
                <div class="flex items-center space-x-4">
                    <div class="bg-white rounded-lg shadow-sm px-4 py-2 flex items-center">
                        <label for="yearFilter" class="text-gray-700 font-medium mr-3">Year:</label>
                        <select id="yearFilter" class="border-0 focus:ring-2 focus:ring-blue-500 rounded px-2 py-1 bg-gray-50 text-gray-800">
                            @for ($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <button id="refreshBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>
            
            <!-- KPI Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Training Centers</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="totalTC">--</h3>
                        </div>
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600 flex items-center">
                        <span id="tcGrowth" class="text-green-500 font-medium mr-1">+5.2%</span>
                        <span>from previous year</span>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active CGS</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="activeCGS">--</h3>
                        </div>
                        <div class="p-2 bg-green-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600 flex items-center">
                        <span id="cgsRate" class="text-green-500 font-medium mr-1">78.3%</span>
                        <span>renewal rate</span>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Accredited Centers</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="accreditedCenters">--</h3>
                        </div>
                        <div class="p-2 bg-purple-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600 flex items-center">
                        <span id="accreditedPercentage" class="text-purple-500 font-medium mr-1">92.1%</span>
                        <span>of total centers</span>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-amber-500 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Renewals</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="pendingRenewals">--</h3>
                        </div>
                        <div class="p-2 bg-amber-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600 flex items-center">
                        <span id="pendingChange" class="text-amber-500 font-medium mr-1">15</span>
                        <span>due within 30 days</span>
                    </div>
                </div>
            </div>

            <!-- Charts - First Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">TC per Regions</h2>
                        <div class="text-xs font-medium px-2 py-1 bg-blue-50 text-blue-600 rounded-full">Regional Distribution</div>
                    </div>
                    <div id="regionsChart" class="w-full" style="height: 300px;"></div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">CGS Renewals Per Year</h2>
                        <div class="text-xs font-medium px-2 py-1 bg-green-50 text-green-600 rounded-full">Yearly Trend</div>
                    </div>
                    <div id="cgsChart" class="w-full" style="height: 300px;"></div>
                </div>
            </div>

            <!-- Charts - Second Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">Accreditation Status</h2>
                        <div class="text-xs font-medium px-2 py-1 bg-purple-50 text-purple-600 rounded-full">Status Overview</div>
                    </div>
                    <div id="accreditationChart" class="w-full" style="height: 300px;"></div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">CGS Renewal Status</h2>
                        <div class="text-xs font-medium px-2 py-1 bg-amber-50 text-amber-600 rounded-full">Current Status</div>
                    </div>
                    <div id="renewalChart" class="w-full" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Default chart colors
        const chartColors = ['#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EF4444', '#6366F1', '#EC4899', '#14B8A6'];
        const chartOptions = {
            chart: {
                fontFamily: 'Inter, sans-serif',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            colors: chartColors,
            dataLabels: {
                enabled: false
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        // Update KPI values based on data
        function updateKPIs(data) {
            document.getElementById('totalTC').textContent = data.totalTC || '--';
            document.getElementById('activeCGS').textContent = data.activeCGS || '--';
            document.getElementById('accreditedCenters').textContent = data.accreditedCenters || '--';
            document.getElementById('pendingRenewals').textContent = data.pendingRenewals || '--';
        }

        function fetchChartData(year) {
            // Show loading state
            document.querySelectorAll('[id$="Chart"]').forEach(el => {
                el.innerHTML = '<div class="flex justify-center items-center h-full"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div></div>';
            });
            
            // Reset KPI values
            document.getElementById('totalTC').textContent = '--';
            document.getElementById('activeCGS').textContent = '--';
            document.getElementById('accreditedCenters').textContent = '--';
            document.getElementById('pendingRenewals').textContent = '--';
            
            fetch(`/dashboard/charts?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    // Update KPI values
                    updateKPIs({
                        totalTC: data.regions.reduce((sum, r) => sum + r.total, 0),
                        activeCGS: data.cgs.reduce((sum, c) => sum + c.total, 0),
                        accreditedCenters: data.accreditation.find(a => a.status === 'Accredited')?.total || 0,
                        pendingRenewals: data.renewal.find(r => r.status === 'Pending')?.total || 0
                    });
                    
                    renderBarChart('regionsChart', data.regions.map(r => r.region), data.regions.map(r => r.total));
                    renderLineChart('cgsChart', data.cgs.map(c => c.year), data.cgs.map(c => c.total));
                    renderPieChart('accreditationChart', data.accreditation);
                    renderDonutChart('renewalChart', data.renewal);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.querySelectorAll('[id$="Chart"]').forEach(el => {
                        el.innerHTML = '<div class="flex justify-center items-center h-full text-red-500">Error loading data</div>';
                    });
                });
        }

        function renderBarChart(id, categories, series) {
            const options = {
                ...chartOptions,
                chart: {
                    ...chartOptions.chart,
                    type: 'bar',
                    height: 300
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '65%',
                        distributed: true
                    }
                },
                xaxis: {
                    categories: categories,
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
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
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: (val) => `${val} centers`
                    }
                },
                legend: {
                    show: false
                },
                series: [{
                    name: 'Training Centers',
                    data: series
                }]
            };
            
            new ApexCharts(document.querySelector(`#${id}`), options).render();
        }

        function renderLineChart(id, categories, series) {
            const options = {
                ...chartOptions,
                chart: {
                    ...chartOptions.chart,
                    type: 'line',
                    height: 300
                },
                stroke: {
                    curve: 'smooth',
                    width: 4
                },
                markers: {
                    size: 5,
                    hover: {
                        size: 7
                    }
                },
                xaxis: {
                    categories: categories,
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: (val) => `${val} renewals`
                    }
                },
                series: [{
                    name: 'CGS Renewals',
                    data: series
                }]
            };
            
            new ApexCharts(document.querySelector(`#${id}`), options).render();
        }

        function renderPieChart(id, data) {
            const options = {
                ...chartOptions,
                chart: {
                    ...chartOptions.chart,
                    type: 'pie',
                    height: 300
                },
                labels: data.map(d => d.status),
                series: data.map(d => d.total),
                legend: {
                    position: 'bottom',
                    fontSize: '14px',
                    fontWeight: 500,
                    labels: {
                        colors: '#64748b'
                    },
                    markers: {
                        width: 12,
                        height: 12,
                        radius: 12
                    }
                },
                stroke: {
                    width: 0
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '0%'
                        },
                        expandOnClick: false
                    }
                },
                tooltip: {
                    y: {
                        formatter: (val) => `${val} centers`
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '12px'
                        }
                    }
                }]
            };
            
            new ApexCharts(document.querySelector(`#${id}`), options).render();
        }

        function renderDonutChart(id, data) {
            const options = {
                ...chartOptions,
                chart: {
                    ...chartOptions.chart,
                    type: 'donut',
                    height: 300
                },
                labels: data.map(d => d.status),
                series: data.map(d => d.total),
                legend: {
                    position: 'bottom',
                    fontSize: '14px',
                    fontWeight: 500,
                    labels: {
                        colors: '#64748b'
                    },
                    markers: {
                        width: 12,
                        height: 12,
                        radius: 12
                    }
                },
                stroke: {
                    width: 0
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '55%',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '22px',
                                    fontWeight: 600,
                                    color: '#334155'
                                },
                                value: {
                                    show: true,
                                    fontSize: '16px',
                                    fontWeight: 400,
                                    color: '#64748b'
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '16px',
                                    fontWeight: 600,
                                    color: '#334155'
                                }
                            }
                        },
                        expandOnClick: false
                    }
                },
                tooltip: {
                    y: {
                        formatter: (val) => `${val} renewals`
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '12px'
                        }
                    }
                }]
            };
            
            new ApexCharts(document.querySelector(`#${id}`), options).render();
        }

        document.getElementById('yearFilter').addEventListener('change', function() {
            fetchChartData(this.value);
        });

        document.getElementById('refreshBtn').addEventListener('click', function() {
            fetchChartData(document.getElementById('yearFilter').value);
        });

        // Initialize dashboard
        fetchChartData(new Date().getFullYear());
    </script>
</x-layout>