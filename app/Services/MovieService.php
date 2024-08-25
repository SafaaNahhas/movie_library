<?php

namespace App\Services;

use Exception;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieService
{
        /**
     * Retrieves a list of movies with optional filtering and sorting.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator|string
     */
    public function getMovies(Request $request)
{
    try {
        $movies = Movie::query()->with('ratings.user');

        // Filtering
        if ($request->has('genre')) {
            $movies->where('genre', $request->genre);
        }

        if ($request->has('director')) {
            $movies->where('director', $request->director);
        }

        // Sorting
        if ($request->has('sort_by_release_year')) {
            $sortDirection = $request->get('sort_direction', 'asc');
            $movies->orderBy('release_year', $sortDirection);
        }

        // Get the filtered and sorted movies
        $result = $movies->paginate(10);

        // Check if the result is empty
        if ($result->isEmpty()) {
            // Return a specific message if no movies are found
            return 'No movies found with the provided filters.';
        }

        return $result;

    } catch (Exception $e) {
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
    }
}
        /**
     * Creates a new movie in the database.
     *
     * @param array $data
     * @return \App\Models\Movie
     */
    public function createMovie(array $data)
    {
        return Movie::create($data);
    }

    // public function updateMovie($id, Request $request )

    /**
     * Updates an existing movie in the database.
     *
     * @param \App\Models\Movie $movie
     * @param array $data
     * @return \App\Models\Movie
     */
    public function updateMovie(Movie $movie, array $data)
    {
        $filteredData = array_filter($data, function($value) {
            return $value !== null && $value !== '';
        });
        $movie->fill($filteredData);
        $movie->save();

        return $movie;
    }
    // =============================================================================================================
        /**
     * Deletes a specific movie from the database.
     *
     * @param \App\Models\Movie $movie
     * @return void
     */
    public function deleteMovie(Movie $movie)
    {
        $movie->delete();
    }
}
