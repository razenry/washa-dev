<nav class="bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('logo.png') }}" class="h-12" alt="Flowbite Logo">
            <span class="self-center text-2xl md:text-4xl font-semibold whitespace-nowrap text-blue-400">Washa</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get
                started</button>
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden text-gray-400 hover:bg-gray-700 focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-700 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 bg-gray-800 md:bg-gray-900">
                <li>
                    <a href="{{ url('/') }}"
                       class="block py-2 px-3 {{ Request::is('/') ? 'text-blue-700' : 'text-white hover:text-blue-700' }} rounded md:bg-transparent md:p-0 md:dark:text-blue-500">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ url('about') }}"
                       class="block py-2 px-3  {{ Request::is('about') ? 'text-blue-700' : 'text-white hover:text-blue-700' }} rounded md:bg-transparent md:p-0 md:dark:text-blue-500">
                        About
                    </a>
                </li>
                <li>
                    <a href="{{ url('services') }}"
                       class="block py-2 px-3  {{ Request::is('services*') ? 'text-blue-700' : 'text-white hover:text-blue-700' }} rounded md:bg-transparent md:p-0 md:dark:text-blue-500">
                        Services
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>
