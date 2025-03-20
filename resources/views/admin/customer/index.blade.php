<x-admin.layout.app title="Customer" transactionCount="{{ $transactionCount }}">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Customer Data</h1>
    <p class="text-gray-500 dark:text-gray-400">Welcome to the Customer Data ✨</p>

    <a href="{{ route('customer.create') }}" class="my-5 inline-flex px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">
        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
          </svg>
          <span class="ml-1">Customer</span>
    </a>

    <livewire:customer.customer-table/>

</x-admin.layout.app>
