<form action="{{ route('search') }}" method="GET" class="flex items-center gap-2 p-2 border border-gray-300 rounded-2xl shadow-sm w-full max-w-md">
    <input
        type="text"
        name="query"
        placeholder="Search..."
        value="{{ request('query') }}"
        class="flex-grow px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800"
    >
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-xl">
        Search
    </button>
</form>
