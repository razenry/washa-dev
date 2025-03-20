<div class="mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">Category Details</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Category Name:</span>
            <span>{{ $category->name }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Price:</span>
            <span>{{ Number::currency($category->price, 'IDR') }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Photo:</span>
            <img src="{{ asset('storage/' . $category->photo) }}" alt="Category Image"
            class="w-16 h-16 rounded-lg">
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Status:</span>
            <span class="px-3 py-1 text-sm font-medium rounded-lg w-fit
                {{ $category->status == 1 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                {{ $category->status == 1 ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Type:</span>
            <span class=" font-medium ">
                {{ $category->type == 1 ? 'Per Unit' : 'Kilo' }}
            </span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Created At:</span>
            <span>{{ $category->created_at->format('d M Y H:i') }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Updated At:</span>
            <span>{{ $category->updated_at->format('d M Y H:i') }}</span>
        </div>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-start">
        <a href="{{ route('category.index') }}"
            class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring focus:ring-blue-300 dark:focus:ring-blue-600 text-center">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
            <span class="ml-1">Back</span>
        </a>
    </div>
</div>
