<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="py-8 bg-white md:py-16 dark:bg-gray-200 antialiased rounded-2xl">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="flex justify-center shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img
                        class="w-full hidden dark:block max-w-[300px] sm:max-w-[400px] h-auto object-contain"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt=""/>
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1
                        class="text-xl font-semibold text-gray-900 sm:text-2xl "
                    >
                        {{ $product['name'] }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p
                            class="text-2xl font-extrabold text-gray-900 sm:text-3xl "
                        >
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <a
                            href="#"
                            title=""
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            role="button"
                        >
                            <svg
                                class="w-5 h-5 -ms-2 me-2"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"
                                />
                            </svg>
                            Tambahkan Keranjang
                        </a>
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800"/>

                    <p class="mb-6 text-gray-500 dark:text-gray-600">
                        {{ $product['description'] }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layout>
