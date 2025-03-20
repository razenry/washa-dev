<div class="">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Transaction</h1>
    <p class="text-gray-500 dark:text-gray-400">Looking for new transaction ✨</p>

    <a href="{{ route('transaction.create') }}"
        class="my-5 inline-flex px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">
        <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span class="ml-1">Transaction</span>
    </a>

    <div class="dark:bg-gray-900 dark:text-white">
        <div class="mb-4 flex justify-between">
            <!-- Form Search -->
            <form class="flex w-1/3">
                <input type="search" wire:model.live="search"
                    class="px-4 py-2 border rounded-lg flex-grow focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                    placeholder="Search..." />
            </form>


            <!-- Tombol Reset -->
            <button wire:click="resetSearch()"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-300 hidden lg:block">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                </svg>
            </button>
        </div>

        <div class="overflow-x-auto">

            @if (session()->has('error'))
                <div class="mb-4 text-red-500">{{ session('error') }}</div>
            @endif

            <table class="w-full text-sm text-left border border-gray-300 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 dark:text-white">
                    <tr>
                        <th class="px-6 py-3 cursor-pointer hidden sm:table-cell">ID</th>
                        <th class="px-6 py-3 cursor-pointer">Customer</th>
                        <th class="px-6 py-3 cursor-pointer hidden sm:table-cell">Date/Time</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="border-b border-gray-300 dark:border-gray-700 dark:text-white">
                            <td class="px-6 py-4 hidden sm:table-cell">{{ $transaction->id }}</td>
                            <td class="px-6 py-4 ">{{ $transaction->customer->name }}</td>
                            <td class="px-6 py-4 hidden sm:table-cell">{{ $transaction->transaction_time}}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center">
                                    @if ($transaction->status == 0)
                                        <button data-tooltip-target="status-tooltip{{ $transaction->id }}"
                                            data-modal-target="status{{ $transaction->id }}"
                                            data-modal-toggle="status{{ $transaction->id }}"
                                            class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                                            type="button">
                                            Draf
                                        </button>
                                    @elseif($transaction->status == 1)
                                        <button data-tooltip-target="status-tooltip{{ $transaction->id }}"
                                            data-modal-target="status{{ $transaction->id }}"
                                            data-modal-toggle="status{{ $transaction->id }}"
                                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            type="button">
                                            Process
                                        </button>
                                    @elseif($transaction->status == 2)
                                        <button data-tooltip-target="status-tooltip{{ $transaction->id }}"
                                            data-modal-target="status{{ $transaction->id }}"
                                            data-modal-toggle="status{{ $transaction->id }}"
                                            class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                            type="button">
                                            Done
                                        </button>
                                    @elseif($transaction->status == 3)
                                        <button data-tooltip-target="status-tooltip{{ $transaction->id }}"
                                            data-modal-target="status{{ $transaction->id }}"
                                            data-modal-toggle="status{{ $transaction->id }}"
                                            class="block text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800"
                                            type="button">
                                            Taked
                                        </button>
                                    @endif
                                </div>
                                <div id="status-tooltip{{ $transaction->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    Click to update
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>



                                <!-- Main Modal -->
                                <div id="status{{ $transaction->id }}" tabindex="-1" aria-hidden="true"
                                    class="fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 bg-black bg-opacity-50">
                                    <div class="relative w-full max-w-md">
                                        <!-- Modal Content -->
                                        <div class="bg-white rounded-lg shadow-lg dark:bg-gray-800">
                                            <!-- Modal Header -->
                                            <div
                                                class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Update Status
                                                </h3>
                                                <button type="button" data-modal-hide="status{{ $transaction->id }}"
                                                    class="text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-lg w-8 h-8 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="p-6 space-y-4">
                                                <p class="text-sm text-gray-600 dark:text-gray-300">Choose a status for this
                                                    transaction:</p>
                                                <div class="grid grid-cols-2 gap-3">
                                                    <button data-modal-hide="status{{ $transaction->id }}"
                                                        wire:click="updateStatus('{{ $transaction->id }}', '0')"
                                                        class="w-full px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-700 {{ $transaction->status != 0 ? 'hidden' : '' }}">
                                                        Draft
                                                    </button>
                                                    <button data-modal-hide="status{{ $transaction->id }}"
                                                        wire:click="updateStatus('{{ $transaction->id }}', '1')"
                                                        class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-700">
                                                        Process
                                                    </button>
                                                    <button data-modal-hide="status{{ $transaction->id }}"
                                                        wire:click="updateStatus('{{ $transaction->id }}', '2')"
                                                        class="w-full px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-700">
                                                        Done
                                                    </button>
                                                    <button data-modal-hide="status{{ $transaction->id }}"
                                                        wire:click="updateStatus('{{ $transaction->id }}', '3')"
                                                        class="w-full px-4 py-2 text-white bg-teal-600 rounded-lg hover:bg-teal-700 focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-700">
                                                        Taked
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td class="px-6 py-4 flex gap-3 justify-center items-center mt-2">
                                <a data-tooltip-target="tooltip-detail{{ $transaction->id }}"
                                    href="{{ route('transaction.show', $transaction->id) }}"
                                    class="text-blue-600 dark:text-blue-400">
                                    <svg class="w-6 h-6 text-green-500 dark:text-green-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12.268 6A2 2 0 0 0 14 9h1v1a2 2 0 0 0 3.04 1.708l-.311 1.496a1 1 0 0 1-.979.796H8.605l.208 1H16a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L4.686 5H4a1 1 0 0 1 0-2h1.5a1 1 0 0 1 .979.796L6.939 6h5.329Z" />
                                        <path
                                            d="M18 4a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0V8h2a1 1 0 1 0 0-2h-2V4Z" />
                                    </svg>
                                </a>
                                <div id="tooltip-detail{{ $transaction->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    Detail Transaction
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <a href="{{ route('transaction.edit', "$transaction->id") }}"
                                    data-tooltip-target="tooltip-edit{{ $transaction->id }}"
                                    class="text-green-600 dark:text-green-400 {{ $transaction->payment_status == 1 ? 'hidden' : '' }}">
                                    <svg class="w-6 h-6 text-orange-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <div id="tooltip-edit{{ $transaction->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    Edit Transaction
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <button data-tooltip-target="tooltip-delete{{ $transaction->id }}"
                                    class="text-red-600 dark:text-red-400 {{ $transaction->payment_status == 1 ? 'hidden' : '' }}"
                                    onclick="confirmDelete('{{ $transaction->id }}')">
                                    <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 1 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div id="tooltip-delete{{ $transaction->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    Delete Transaction
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                No transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @empty(!$transactions)
            <div class="mt-4 text-gray-800 dark:text-gray-200">
                {{ $transactions->links() }}
            </div>
        @endempty
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('delete', { id: id });
                    // Swal.fire(
                    //     "Deleted!",
                    //     "The transaction has been deleted.",
                    //     "success"
                    // );
                }
            });
        }
    </script>



</div>
