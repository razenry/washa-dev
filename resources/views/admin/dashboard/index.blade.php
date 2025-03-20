<x-admin.layout.app transactionCount="{{ $transactionCount }}">

    <div class="container px-4 mx-auto lg:px-0 dark:bg-gray-900">
        <h1 class="mb-3 text-3xl font-bold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight dark:text-white">
            Hello, {{ Auth::user()->name }}! 👋</h1>
        <p class="mb-6 text-lg font-normal text-gray-500 sm:text-xl dark:text-gray-400">Welcome to the Dashboard
            ✨ Happy working, and have a great day! 🚀
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="">

                <div class="max-w-sm w-full h-auto bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $customerCount }}</h5>
                            <p class="text-base text-gray-500 dark:text-gray-400">Total Customers</p>
                        </div>
                        <div class="p-2 bg-blue-100 dark:bg-blue-700 rounded-full">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="mt-4">
                        <canvas id="userChart"></canvas>
                    </div>

                    <div class="flex space-x-2 mt-4 justify-center">
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="day">Day</button>
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="week">Week</button>
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="month">Month</button>
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="year">Year</button>
                    </div>

                </div>

                <!-- AJAX & Chart.js -->
                <script>
                    let userChartInstance;

                    function updateCustomerChart(filter = 'week') {
                        fetch(`/admin/dashboard/customer-data?filter=${filter}`)
                            .then(response => response.json())
                            .then(data => {
                                if (userChartInstance) userChartInstance.destroy();

                                const ctx = document.getElementById('userChart').getContext('2d');
                                userChartInstance = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: data.labels,
                                        datasets: [{
                                            label: 'Customers',
                                            data: data.data,
                                            backgroundColor: 'rgba(37, 99, 235, 0.7)',
                                            borderColor: '#2563eb',
                                            borderWidth: 1,
                                            borderRadius: 5,
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: { grid: { display: false } },
                                            y: { beginAtZero: true }
                                        },
                                        plugins: { legend: { display: false } }
                                    }
                                });
                            });
                    }

                    document.querySelectorAll('.filter-btn').forEach(button => {
                        button.addEventListener('click', function () {
                            updateCustomerChart(this.dataset.filter);
                        });
                    });

                    updateCustomerChart();

                </script>


            </div>
            <div class="">

                <div class="max-w-sm w-full h-auto bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $transCount }}</h5>
                            <p class="text-base text-gray-500 dark:text-gray-400">Total Transaction</p>
                        </div>
                        <div class="p-2 bg-blue-100 dark:bg-blue-700 rounded-full">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                              </svg>


                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="mt-4">
                        <canvas id="transaction"></canvas>
                    </div>

                    <div class="flex space-x-2 mt-4 justify-center">
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="day">Day</button>
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="week">Week</button>
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="month">Month</button>
                        <button class="filter-btn px-4 py-2 bg-blue-700 text-white rounded"
                            data-filter="year">Year</button>
                    </div>

                </div>

                <!-- AJAX & Chart.js -->
                <script>
                    let transactionChartInstance;

                    function updateTransactionChart(filter = 'week') {
                        fetch(`/admin/dashboard/transaction-data?filter=${filter}`)
                            .then(response => response.json())
                            .then(data => {
                                if (transactionChartInstance) transactionChartInstance.destroy();

                                const ctx = document.getElementById('transaction').getContext('2d');
                                transactionChartInstance = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: data.labels,
                                        datasets: [{
                                            label: 'Transaction Count', // Ubah label menjadi "Transaction Count"
                                            data: data.data, // Ambil jumlah transaksi dari response
                                            backgroundColor: 'rgba(37, 99, 235, 0.7)',
                                            borderColor: '#2563eb',
                                            borderWidth: 1,
                                            borderRadius: 5,
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: { grid: { display: false } },
                                            y: { beginAtZero: true }
                                        },
                                        plugins: { legend: { display: false } }
                                    }
                                });
                            });

                    }

                    document.querySelectorAll('.filter-btn').forEach(button => {
                        button.addEventListener('click', function () {
                            updateTransactionChart(this.dataset.filter);
                        });
                    });

                    updateTransactionChart();

                </script>



            </div>
            <div class="max-w-sm w-full h-auto bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h5 class="text-3xl font-bold text-gray-900 dark:text-white">Overview</h5>
                        <p class="text-base text-gray-500 dark:text-gray-400">Status transaction</p>
                    </div>
                    <div class="p-2 bg-green-100 dark:bg-blue-700 rounded-full">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/>
                          </svg>

                    </div>
                </div>

                <!-- Doughnut Chart -->
                <div class="mt-4">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <script>
                let statusChartInstance;

                function updateStatusChart() {
                    fetch('/admin/dashboard/transaction-status-data')
                        .then(response => response.json())
                        .then(data => {
                            if (statusChartInstance) statusChartInstance.destroy();

                            const ctx = document.getElementById('statusChart').getContext('2d');
                            statusChartInstance = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: data.labels,
                                    datasets: [{
                                        data: data.data,
                                        backgroundColor: ['#f87171', '#facc15', '#22c55e', '#3b82f6'],
                                        borderColor: ['#dc2626', '#eab308', '#15803d', '#1e40af'],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { position: 'bottom' }
                                    }
                                }
                            });
                        });
                }

                updateStatusChart();
            </script>


        </div>



</x-admin.layout.app>
