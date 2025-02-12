<div class="flex flex-col justify-between p-6 max-h-[450px] text-center text-gray-400 bg-gray-800 rounded-lg border border-gray-700 shadow-xl xl:p-8 dark:border-gray-600">
    <div>
        <h3 class="mb-4 text-2xl font-semibold text-white">{{ $title }}</h3>
        <p class="font-light sm:text-lg">{{ $description }}</p>
    </div>
    <div>
        <div class="flex justify-center items-baseline my-8">
            <span class="mr-2 text-5xl font-extrabold text-white">{{ $price }}</span>
            <span class="text-gray-400">/item</span>
        </div>
        <ul role="list" class="mb-8 space-y-4 text-left">
            @foreach ($features as $feature)
                <li class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $feature }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <a href="{{ $link }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-blue-900">
        Book Now
    </a>
</div>
