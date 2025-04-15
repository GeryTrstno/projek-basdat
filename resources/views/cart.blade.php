<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="bg-white py-8 antialiased   :bg-gray-200 rounded-2xl">
        <div class="py-6 px-4 sm:px-6 lg:px-8 mx-auto max-w-screen-xl lg:py-8">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Keranjang Belanja</h2>
            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-1 lg:max-w-2xl xl:max-w-4xl">
                    @foreach($carts as $cart)
                        <div class="space-y-6 mb-6">
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm  md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a href="#" class="w-20 shrink-0 md:order-1">
                                        <img class="block h-20 w-20   :block"
                                             src="{{ asset('storage/' . $cart->product['image']) }}" onerror="this.onerror=null;this.src='https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg';"
                                             alt="imac image"/>
                                    </a>

                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <form action="{{ route('cart.decrement', $cart->id) }}" method="POST">
                                                @csrf
                                                @method("PATCH")
                                                <button type="submit" id="decrement-button-5"
                                                        data-input-counter-decrement="counter-input-5"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100   :border-gray-600   :bg-gray-700   :hover:bg-gray-600   :focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900   :text-white"
                                                         aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            <input type="text" id="counter-input-5" data-input-counter
                                                   class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 "
                                                   placeholder="" value={{ $cart->quantity }} required/>
                                            <form action="{{ route('cart.increment', $cart->id) }}" method="POST">
                                                @csrf
                                                @method("PATCH")
                                                <button type="submit" id="increment-button-5"
                                                        data-input-counter-increment="counter-input-5"
                                                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100   :border-gray-600   :bg-gray-700   :hover:bg-gray-600   :focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900   :text-white"
                                                         aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M9 1v16M1 9h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class=" font-bold text-gray-900  text-sm">
                                                Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="/{{ $cart->product->slug }}"
                                           class="text-base font-medium text-gray-900 hover:underline ">{{ $cart->product->name }}</a>

                                        <div class="flex items-center gap-4">
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus item ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center text-sm font-medium text-red-600 hover:underline   :text-red-500">
                                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         fill="none"
                                                         viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M6 18 17.94 6M18 18 6.06 6"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="mx-auto mt-6 max-w-md flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm  sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 ">Ringkasan Belanja</p>

                        <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                            <p class="text-xl font-semibold text-gray-900 ">Ringkasan Belanja</p>

                            @php
                                $total = 0;
                                foreach ($carts as $cart) {
                                    $total += $cart->product->price * $cart->quantity;
                                }
                            @endphp

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="text-base font-normal text-gray-500 ">Total Harga
                                        </dt>
                                        <dd class="text-base font-medium text-gray-900 ">
                                            Rp {{ number_format($total, 0, ',', '.') }}</dd>
                                    </dl>
                                </div>

                                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2   :border-gray-700">
                                    <dt class="text-base font-bold text-gray-900 ">Total</dt>
                                    <dd class="text-base font-bold text-gray-900 ">
                                        Rp {{ number_format($total, 0, ',', '.') }}</dd>
                                </dl>
                            </div>

                            <div class="flex justify-center">
                                <button
                                    type="submit"
                                    class="py-2.5 px-5 text-sm font-medium  focus:outline-none  rounded-lg border  hover:text-primary-700 focus:z-10 focus:ring-4    focus:ring-gray-700   bg-gray-800   text-gray-200   border-gray-600   hover:text-white   hover:bg-gray-700"
                                >
                                    Lanjut Pembayaran
                                </button>
                            </div>


                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500  "> atau </span>
                                <a href="/home" title=""
                                   class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline   :text-primary-500">
                                    Lanjut Belanja
                                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</x-layout>
