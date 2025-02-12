<x-layout.app>



    {{-- Services --}}

    <section class="bg-gray-900 md:min-h-screen mt-20" data-aos="fade-up" data-aos-duration="500">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 text-2xl md:text-4xl tracking-tight font-extrabold text-white">
                    Tailored Laundry Services for Your Needs
                </h2>
                <p class="mb-5 font-light sm:text-xl text-gray-400">
                    Discover premium laundry solutions at affordable prices.
                </p>
            </div>
            <div class="grid gap-8 lg:grid-cols-3 sm:grid-cols-2">
                <x-layout.ui.card-services title="Shirt Laundry"
                    description="Perfect care for your formal and casual shirts." price="IDR 15K" :features="['Soft fabric handling', 'Custom stain treatment']"
                    link="#" />
                <x-layout.ui.card-services title="Shirt Laundry"
                    description="Perfect care for your formal and casual shirts." price="IDR 15K" :features="['Soft fabric handling', 'Custom stain treatment']"
                    link="#" />
                <x-layout.ui.card-services title="Shirt Laundry"
                    description="Perfect care for your formal and casual shirts." price="IDR 15K" :features="['Soft fabric handling', 'Custom stain treatment']"
                    link="#" />
            </div>
        </div>
    </section>

</x-layout.app>
