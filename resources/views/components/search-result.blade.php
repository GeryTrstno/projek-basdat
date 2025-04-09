<x-search-bar />

@if($query)
    <p class="mt-4 text-gray-600">Showing results for: <strong>{{ $query }}</strong></p>

    {{-- Example output --}}
    {{-- @foreach($results as $result)
        <div>{{ $result->name }}</div>
    @endforeach --}}
@else
    <p class="mt-4 text-gray-600">Please enter a search term.</p>
@endif
