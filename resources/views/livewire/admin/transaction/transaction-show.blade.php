<div class="">
    <section class="bg-white p-6 antialiased dark:bg-gray-900 ">
        <div class="mx-auto p-6 px-4 2xl:px-0">
            <div class="mx-auto ">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Transaction ID:
                    {{ $transaction->id }}
                </h2>
                <div class="mt-6 space-y-4 border-b border-t border-gray-200 py-8 dark:border-gray-700 sm:mt-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Order & Services</h4>

                    <dl>
                        <dt class="text-base font-medium text-gray-900 dark:text-white">Customer</dt>
                        <dd class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400">
                            {{ $transaction->customer->name }} - {{ $transaction->customer->email }} -
                            {{ $transaction->customer->telp }}, {{ $transaction->customer->address }}
                        </dd>
                    </dl>

                    <button type="button" data-modal-target="billingInformationModal"
                        data-modal-toggle="billingInformationModal"
                        class="mb-10 mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 {{ $transaction->payment_status == 1 ? 'hidden' : '' }}">
                        <svg class="w-6 h-6 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg> Service
                    </button>
                </div>

                <div class="mt-6 sm:mt-8">
                    <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                        <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                            <thead class="">
                                <tr>
                                    <th class="p-4 text-base">Service</th>
                                    <th class="p-4 text-base">Price</th>
                                    <th class="p-4 text-base">QTY</th>
                                    <th class="p-4 text-right text-base">Total</th>
                                    <th
                                        class="p-4 text-center text-base {{ $transaction->payment_status == 1 ? 'hidden' : '' }}">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                @forelse ($detail_transaction as $item)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 md:w-[384px]">
                                            <div class="flex items-center gap-4">
                                                <a href="#" class="flex items-center aspect-square w-10 h-10 shrink-0">
                                                    <img class="h-auto w-full max-h-full dark:hidden"
                                                        src="{{ asset('storage/' . $item->category->photo) }}"
                                                        alt="imac image" />
                                                    <img class="hidden h-auto w-full max-h-full dark:block"
                                                        src="{{ asset('storage/' . $item->category->photo) }}"
                                                        alt="imac image" />
                                                </a>
                                                <a href="#" class="hover:underline">{{ $item->category->name }}</a>
                                            </div>
                                        </td>
                                        <td class="p-4 text-base font-normal text-gray-900 dark:text-white">
                                            {{ number_format($item->price, 0, ',', '.') . ' IDR' }}
                                        </td>

                                        <td class="p-4 text-base font-normal text-gray-900 dark:text-white">
                                            {{ $item->total_qty }}
                                            <span>{{ $item->category->type == 1 ? 'Unit' : 'Kg' }}</span>
                                        </td>

                                        <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">
                                            {{ number_format($item->total_amount, 0, ',', '.') . ' IDR' }}
                                        </td>
                                        <td
                                            class="p-4 text-base font-bold text-gray-900 dark:text-white flex gap-1 justify-center {{ $transaction->payment_status == 1 ? 'hidden' : '' }}">
                                            <button onclick="confirmDelete({{ $item->category_id }})"
                                                class="text-red-600 dark:text-red-400">
                                                <svg class="w-6 h-6 text-red-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse


                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 space-y-6">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</h4>
                        <div class="space-y-4">
                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ number_format($total_price, 0, ',', '.') . ' IDR' }}
                                </dd>
                            </dl>
                        </div>

                        <div class="gap-2 sm:flex sm:items-center text-center">
                            <a href="{{ route('transaction.index') }}"
                                class="rounded-lg  border border-gray-200 bg-white px-5  py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 shadow">Back</a>

                            @if (!$detail_transaction->isEmpty())
                                @if ($transaction->payment_status == 0)
                                    <button type="button" data-modal-target="paymentModal" data-modal-toggle="paymentModal"
                                        class="ml-2 md:ml-0 rounded-lg  border border-gray-200 bg-blue-700 px-5  py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-blue-700 dark:text-white dark:hover:bg-blue-800 dark:focus:ring-gray-700 shadow">Payment</button>
                                @elseif($transaction->payment_status == 1)
                                    <button type="submit" onclick="printInvoice()"
                                        class="ml-2 md:ml-0 rounded-lg  border border-gray-200 bg-gray-700 px-5  py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:ring-gray-700 shadow">Print
                                        invoice</button>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Tambah Services --}}
    <div id="billingInformationModal" tabindex="-1" aria-hidden="true"
        class="antialiased fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-auto w-full max-h-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0">
        <div class="relative max-h-auto w-full max-h-full max-w-lg p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add services</h3>
                    <button type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="billingInformationModal">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" wire:submit.prevent="add">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-5">

                        <div class="sm:col-span-2">
                            <div class="mb-2 flex items-center gap-1">
                                <label for="saved-address-modal"
                                    class="block text-sm font-medium text-gray-900 dark:text-white"> Services
                                </label>
                                <svg data-tooltip-target="saved-address-modal-desc-2" data-tooltip-trigger="hover"
                                    class="h-4 w-4 text-gray-400 hover:text-gray-900 dark:text-gray-500 dark:hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <select id="saved-address-modal" wire:model="category_id" required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                <option selected>Choose one service</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }} |
                                        {{ number_format($category->price, 0, ',', '.') . ' IDR' }} / {{ $category->type == 1 ? 'Unit' : 'Kg' }}
                                    </option>
                                @empty
                                    <option selected>Services not found.</option>
                                @endforelse
                            </select>
                            <div id="saved-address-modal-desc-2" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Choose service
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="qty" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Quantity<span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="qty" wire:model="qty" required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="Enter quantity" />
                        </div>


                    </div>
                    <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                        <button type="button" data-modal-toggle="billingInformationModal"
                            class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
                        <button type="submit" wire:click.prevent="add"
                            class="me-2 inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span wire:loading.remove wire:target="add">Add</span>
                            <span wire:loading wire:target="add" class="hidden">Processing...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Payment --}}
    <div id="paymentModal" tabindex="-1" aria-hidden="true"
        class="antialiased fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-auto w-full max-h-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0">
        <div class="relative max-h-auto w-full max-h-full max-w-lg p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Payment</h3>
                    <button type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="paymentModal">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" wire:submit.prevent="payment">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-5">

                        <div class="sm:col-span-2">
                            <div class="mb-2 flex items-center gap-1">
                                <label for="saved-address-modal"
                                    class="block text-sm font-medium text-gray-900 dark:text-white"> Total
                                </label>

                            </div>
                            <input type="text" readonly value=" {{ number_format($total_price, 0, ',', '.') . ' IDR' }}"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="pay" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Pay<span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="pay" wire:model="pay" required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="Enter IDR" />
                        </div>


                    </div>
                    <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                        <button type="button" data-modal-toggle="paymentModal"
                            class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
                        <button ype="button" data-modal-toggle="paymentModal" wire:click.prevent="payment"
                            class="me-2 inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <span wire:loading.remove wire:target="payment">Pay</span>
                            <span wire:loading wire:target="payment" class="hidden">Processing...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Invoice --}}
    <div id="invoiceContent" class="hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Washa</h1>
                <p class="text-gray-600">Transaction ID: {{ $transaction->id }}</p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Customer Information</h2>
                <div class="text-gray-700">
                    <p><span class="font-medium">Name:</span> {{ $transaction->customer->name }}</p>
                    <p><span class="font-medium">Email:</span> {{ $transaction->customer->email }}</p>
                    <p><span class="font-medium">Phone:</span> {{ $transaction->customer->telp }}</p>
                    <p><span class="font-medium">Address:</span> {{ $transaction->customer->address }}</p>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Service</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">QTY</th>
                            <th class="py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($detail_transaction as $item)
                            <tr class="border-b">
                                <td class="py-2">{{ $item->category->name }}</td>
                                <td class="py-2">{{ number_format($item->price, 0, ',', '.') . ' IDR' }}</td>
                                <td class="py-2">x{{ $item->total_qty }}</td>
                                <td class="py-2 text-right">{{ number_format($item->total_amount, 0, ',', '.') . ' IDR' }}
                                </td>
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
                <p class="text-lg font-bold text-gray-900">Total:
                    {{ number_format($total_price, 0, ',', '.') . ' IDR' }}
                </p>
            </div>

            <div class="mt-8 text-center text-gray-600">
                <p>Thank you for your purchase!</p>
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
                Livewire.dispatch('delete', { id: id  });
                Swal.fire(
                    "Deleted!",
                    "The services has been deleted.",
                    "success"
                );
            }
        });
    }
</script>
