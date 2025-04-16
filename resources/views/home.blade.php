<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="bg-white rounded-2xl">
        <div class="py-8 px-4 sm:px-6 lg:px-8 mx-auto max-w-screen-xl lg:py-16">
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                @foreach($products as $product)
                    <a href="/{{ $product['slug'] }}">
                        <article
                            class="h-62 sm:h-80 p-4 sm:p-6 bg-white rounded-lg border border-gray-200 shadow-md  transition hover:shadow-lg">

                            <div class="flex justify-center mb-3">
                                <img class="w-full max-w-[140px] sm:max-w-[200px] max-h-40 object-contain"
                                     src="{{ asset('storage/' . $product['image']) }}" onerror="this.onerror=null;this.src='https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg';"
                                     alt="{{ $product['name'] }}"/>
                            </div>

                            @if ($product['amount'] <= 10)
                                <p class="text-xs font-medium tracking-tight text-red-500 mb-1">
                                    Sisa {{ $product['amount'] }}
                                </p>
                            @endif

                            <h2 class="text-sm sm:text-base font-medium tracking-tight text-gray-700 line-clamp-2">
                                {{ $product['name'] }}
                            </h2>

                            <h2 class="mt-1 text-sm sm:text-base font-bold text-gray-900">
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                            </h2>
                        </article>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
