<div class="">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Categories Data</h1>
    <p class="text-gray-500 dark:text-gray-400">Welcome to the Categories Data ✨</p>

    <a href="{{ route('category.create') }}"
        class="my-5 inline-flex px-3 py-2 bg-blue-700 text-white rounded hover:bg-blue-800">
        <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span class="ml-1">Category</span>
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
            <table class="w-full text-sm text-left border border-gray-300 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 dark:text-white">
                    <tr>
                        <th class="px-6 py-3 cursor-pointer">Name</th>
                        <th class="px-6 py-3 cursor-pointer hidden sm:table-cell">Photo</th>
                        <th class="px-6 py-3 cursor-pointer hidden sm:table-cell">Price</th>
                        <th class="px-6 py-3 hidden sm:table-cell">Status</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b border-gray-300 dark:border-gray-700 dark:text-white">
                            <td class="px-6 py-4">{{ $category->name }}</td>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <img src="{{ asset('storage/' . $category->photo) }}" alt="Category Image"
                                    class="w-16 h-16 rounded-lg">
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell">{{ Number::currency($category->price, 'IDR') }}</td>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <button wire:click="toggleStatus({{ $category->id }})"
                                    class="px-3 py-1 rounded text-white focus:outline-none {{ $category->status === '1' ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}">
                                    {{ $category->status === '1' ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 flex gap-3 justify-center items-center mt-4">
                                <a href="{{ route('category.show', $category->id) }}"
                                    class="text-blue-600 dark:text-blue-400">
                                    <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('category.edit', $category->id) }}"
                                    class="text-green-600 dark:text-green-400">
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
                                <button class="text-red-600 dark:text-red-400" onclick="confirmDelete({{ $category->id }})">
                                    <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 1 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @empty(!$categories)
            <div class="mt-4 text-gray-800 dark:text-gray-200">
                {{ $categories->links() }}
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
                    Swal.fire(
                        "Deleted!",
                        "The category has been deleted.",
                        "success"
                    );
                }
            });
        }
    </script>

</div>
