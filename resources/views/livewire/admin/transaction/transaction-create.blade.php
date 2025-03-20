<div>

    <h1 class=" text-3xl font-bold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight dark:text-white">
        Create Transaction</h1>
    <a href="{{ route('transaction.index') }}"
        class="mb-10 mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Back</a>

    @if (session()->has('message'))
        <div class="mb-4 text-green-500">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 text-red-500">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="add">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-5">
                <label for="customer_id"
                    class="block text-sm font-medium text-gray-900 dark:text-white">Customer</label>

                <input type="search"
                    class="mb-3 shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model.live="search" placeholder="Search customer">

                <select id="customer_id" name="customer_id" wire:model="customer_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a customer</option>
                    @forelse ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }} | {{ $customer->email }}</option>
                    @empty
                        <option value="">No users found.</option>
                    @endforelse
                </select>
                @error('customer_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>



        </div>

        <button type="submit" wire:target="add"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <span wire:loading.remove wire:target="add">Add</span>
            <span wire:loading wire:target="add" class="hidden">Processing...</span>
        </button>
    </form>
</div>
