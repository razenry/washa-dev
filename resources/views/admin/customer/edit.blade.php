<x-admin.layout.app title="Create Customer">
    <h1 class=" text-3xl font-bold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight dark:text-white">
        Edit Customer</h1>
    <a href="{{ route('customer.index') }}"
        class="mb-10 mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Back</a>
   <livewire:customer.customer-form-edit>
</x-admin.layout.app>
