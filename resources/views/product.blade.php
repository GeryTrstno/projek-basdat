<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="py-8 bg-white md:py-16  antialiased rounded-2xl">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="flex justify-center shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img
                        class="w-full block max-w-[300px] sm:max-w-[400px] h-auto object-contain"
                        src="{{ asset('storage/' . $product['image']) }}" onerror="this.onerror=null;this.src='https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg';"
                        alt="{{ $product['name'] }}"/>
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

                    @if($product['amount'] <= 10)
                        <p class="mt-6 mb-1 text-red-500">Stok: {{ $product['amount'] }}</p>
                    @else
                        <p class="mt-6 mb-1">Stok: {{ $product['amount'] }}</p>
                    @endif
                    <div class="sm:gap-4 sm:items-center sm:flex">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <button
                                type="submit"
                                class="flex items-center justify-center py-2.5 px-5 text-sm font-medium  focus:outline-none rounded-lg border  hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-700 bg-gray-800     text-gray-200     border-gray-600     hover:text-white     hover:bg-gray-700"
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
                                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"
                                    />
                                </svg>
                                Tambahkan Keranjang
                            </button>
                        </form>

                    </div>

                    <hr class="my-6 md:my-8  border-gray-800"/>

                    <p class="mb-6 text-gray-600 mr-5">
                        {{ $product['description'] }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layout>
