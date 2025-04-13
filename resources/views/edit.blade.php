<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-2xl mx-auto p-5 bg-white rounded-2xl shadow">
        <h1 class="text-xl font-semibold mb-4">Edit Produk</h1>
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block mb-1 font-medium">Nama</label>
                    <input type="text" name="name" id="name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required="">
                </div>
                <div>
                    <label for="brand" class="block mb-1 font-medium">Harga</label>
                    <input type="text" name="brand" id="brand"
                           class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required="">
                </div>
                <div>
                    <label for="price" class="block mb-1 font-medium">Jumlah</label>
                    <input type="number" name="price" id="price"
                           class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required="">
                </div>
                <div>
                    <label for="category" class="block mb-1 font-medium">Kategori</label>
                    <select name="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option value=Elektronik">Elektronik</option>
                        <option value="Furnitur">Furnitur</option>
                        <option value="Aksesoris">Aksesoris</option>
                        <option value="Fashion">Fashion</option>
                        <option value="Hobi">Hobi</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label for="description" class="block mb-1 font-medium">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    ></textarea>
                </div>

                <div>
                    <label for="image" class="block mb-1 font-medium">Gambar Produk</label>
                    <input type="file" name="image" id="image"
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
            </div>
            <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                Update
            </button>
        </form>
    </div>
</x-layout>
