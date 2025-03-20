<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z" clip-rule="evenodd"/>
                <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>
            </svg>
            <a href="#">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Income</h5>
            </a>
            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{ number_format($reports->sum('grand_total'), 0, ',', '.') }} IDR</p>
        </div>
    </div>
    <div class="mt-7">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Financial report</h1>
        <p class="text-gray-500 dark:text-gray-400">Welcome to the Financial Report ✨</p>

        <button onclick="printInvoice()" class="my-5 inline-flex px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">
            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
            </svg>
            <span class="ml-1">Print</span>
        </button>

        <div class="dark:bg-gray-900 dark:text-white">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border border-gray-300 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800 dark:text-white">
                        <tr>
                            <th class="px-6 py-3 cursor-pointer">Trans ID</th>
                            <th class="px-6 py-3 cursor-pointer hidden sm:table-cell">Customer</th>
                            <th class="px-6 py-3 cursor-pointer hidden sm:table-cell">Transaction Time</th>
                            <th class="px-6 py-3 hidden sm:table-cell">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr class="border-b border-gray-300 dark:border-gray-700 dark:text-white">
                                <td class="px-6 py-4">{{ $report->trans_id }}</td>
                                <td class="px-6 py-4 hidden sm:table-cell">{{ $report->customer_name }}</td>
                                <td class="px-6 py-4 hidden sm:table-cell">{{ $report->transaction_time }}</td>
                                <td class="px-6 py-4 hidden sm:table-cell">{{ number_format($report->grand_total, 0, ',', '.') }} IDR</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                    No report found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Invoice --}}
    <div id="invoiceContent" class="hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Washa</h1>
                <p class="text-gray-600">Income Report</p>
            </div>

            <div class="mb-8">
                <h2 class="tex  t-xl font-semibold text-gray-900 mb-4">Transaction Details</h2>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Trans ID</th>
                            <th class="py-2">Customer</th>
                            <th class="py-2">Transaction Time</th>
                            <th class="py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr class="border-b">
                                <td class="py-2">{{ $report->trans_id }}</td>
                                <td class="py-2">{{ $report->customer_name }}</td>
                                <td class="py-2">{{ $report->transaction_time }}</td>
                                <td class="py-2">{{ number_format($report->grand_total, 0, ',', '.') }} IDR</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-2 text-center">No items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-right">
                <p class="text-lg font-bold text-gray-900">Total: {{ number_format($reports->sum('grand_total'), 0, ',', '.') }} IDR</p>
            </div>

            <div class="mt-8 text-center text-gray-600">
                <p>Thank you for your hardwork  !</p>
            </div>
        </div>
    </div>
    <script>
        function printInvoice() {
            var invoiceContent = document.getElementById('invoiceContent').innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = invoiceContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // Untuk reload halaman setelah print
        }
    </script>
</div>
