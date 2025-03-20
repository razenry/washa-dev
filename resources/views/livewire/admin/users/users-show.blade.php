<div class="mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">User Details</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Name:</span>
            <span>{{ $user->name }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Email:</span>
            <span>{{ $user->email }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Status:</span>
            <span class="px-3 py-1 text-sm font-medium rounded-lg w-fit
                {{ $user->status == 1 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                {{ $user->status == 1 ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Role:</span>
            <span class=" font-medium ">
                {{ $user->role  }}
            </span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Created At:</span>
            <span>{{ $user->created_at->format('d M Y H:i') }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Updated At:</span>
            <span>{{ $user->updated_at->format('d M Y H:i') }}</span>
        </div>

        <div class="flex flex-col">
            <span class="font-semibold text-gray-900 dark:text-white">Photo:</span>
            <img src="{{ asset('storage/' . $user->photo) }}" alt="user Image"
            class="w-16 h-16 rounded-lg">
        </div>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-start">
        <a href="{{ route('user.index') }}"
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
