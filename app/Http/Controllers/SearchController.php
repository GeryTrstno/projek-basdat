<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // TODO: Customize your search logic
        // Example: $results = Model::where('name', 'like', "%{$query}%")->get();

        return view('search-results', [
            'query' => $query,
            // 'results' => $results
        ]);
    }
}
