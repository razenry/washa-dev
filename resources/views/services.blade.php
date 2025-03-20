<x-layout.app title="Services">
    <section class="bg-gray-900 md:min-h-screen mt-20" data-aos="fade-up" data-aos-duration="500">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 text-2xl md:text-4xl tracking-tight font-extrabold text-white">
                    Premium Laundry Services, Tailored for You
                </h2>
                <p class="mb-5 font-light sm:text-xl text-gray-400">
                    Enjoy superior cleaning with industry-leading technology and expert care.
                </p>
            </div>
            <div class="grid gap-8 lg:grid-cols-3 sm:grid-cols-2">
                <x-layout.ui.card-services title="Standard Laundry"
                    description="Everyday wear, washed and folded with care." price="IDR 20K"
                    :features="['Eco-friendly detergents', 'Fast turnaround time']" link="#"
                    data-aos="zoom-in" data-aos-duration="500" data-aos-delay="100" />

                <x-layout.ui.card-services title="Deluxe Care"
                    description="Premium fabric treatment for special garments." price="IDR 35K"
                    :features="['Delicate wash', 'Hand-finished pressing']" link="#"
                    data-aos="zoom-in" data-aos-duration="500" data-aos-delay="200" />

                <x-layout.ui.card-services title="Express Service"
                    description="Same-day laundry for urgent needs." price="IDR 50K"
                    :features="['Super-fast processing', 'Priority handling']" link="#"
                    data-aos="zoom-in" data-aos-duration="500" data-aos-delay="300" />
            </div>
        </div>
    </section>
</x-layout.app>
