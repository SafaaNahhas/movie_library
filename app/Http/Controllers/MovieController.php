<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Services\ApiResponseService;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MovieController extends Controller
{

    /**
     * @var MovieService
     */
    protected $movieService;
    /**
     * MovieController constructor.
     *
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }
// =============================================================================================================
    /**
     * Displays a list of movies with optional filtering and sorting.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $movies = $this->movieService->getMovies($request);

            if (is_string($movies)) {
                return ApiResponseService::error($movies, 404);
            }

            return ApiResponseService::paginated($movies, 'Movies fetched successfully.');
        } catch (Exception $e) {
            return ApiResponseService::error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }
// =============================================================================================================
    /**
     * Stores a new movie in the database.
     *
     * @param \App\Http\Requests\StoreMovieRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMovieRequest $request)
    {
        try {
            $movie = $this->movieService->createMovie($request->validated());
            return ApiResponseService::success($movie, 'Movie created successfully.', 201);
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to create movie: ' . $e->getMessage(), 500);
        }
    }
// =============================================================================================================
    /**
     * Displays the details of a specific movie by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
{
    try {
        $movie = Movie::find($id);

        if (!$movie) {
            return ApiResponseService::error('Movie not found.', 404);
        }

        return ApiResponseService::success($movie, 'Movie retrieved successfully.');
    } catch (Exception $e) {
        return ApiResponseService::error('An error occurred while retrieving the movie: ' . $e->getMessage(), 500);
    }
}
// =============================================================================================================
    /**
     * Updates an existing movie in the database.
     *
     * @param \App\Http\Requests\UpdateMovieRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMovieRequest $request, $id)
{
    try {
        $movie = Movie::find($id);

        if (!$movie) {
            return ApiResponseService::error('Movie not found.', 404);
        }

        $updatedMovie = $this->movieService->updateMovie($movie, $request->validated());
        return ApiResponseService::success($updatedMovie, 'Movie updated successfully.');
    } catch (Exception $e) {
        return ApiResponseService::error('An error occurred while updating the movie: ' . $e->getMessage(), 500);
    }
}
// =============================================================================================================
    /**
     * Deletes a specific movie from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
{
    try {
        $movie = Movie::find($id);
        if (!$movie) {
            return ApiResponseService::error('Movie not found.', 404);
        }
        $this->movieService->deleteMovie($movie);
        return ApiResponseService::success(null, 'Movie deleted successfully.', 200);
    } catch (Exception $e) {
        return ApiResponseService::error('An error occurred while deleting the movie: ' . $e->getMessage(), 500);
    }
}



}
