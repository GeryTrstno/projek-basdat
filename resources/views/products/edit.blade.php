<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-2xl mx-auto p-5 bg-white rounded-2xl shadow">
        <h1 class="text-xl font-semibold mb-4">Edit Produk</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block mb-1 font-medium">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                           required="">
                </div>
                <div>
                    <label for="price" class="block mb-1 font-medium">Harga</label>
                    <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                           required="">
                </div>
                <div>
                    <label for="amount" class="block mb-1 font-medium">Jumlah</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount', $product->amount) }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                           required="">
                </div>
                <div>
                    <label for="category" class="block mb-1 font-medium">Kategori</label>
                    <select name="category_id" id="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    >
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($category->id == $product->category_id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label for="description" class="block mb-1 font-medium">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                              class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    >{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label for="image" class="block mb-1 font-medium">Gambar Produk</label>
                    <input type="file" name="image" id="image"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 mt-2">
                    @endif
                </div>
            </div>
            <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Update
            </button>
        </form>
    </div>
</x-layout>
