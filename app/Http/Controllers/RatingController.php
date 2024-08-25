<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRatingRequest;
use App\Services\RatingService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RatingController extends Controller
{
    /**
     * @var RatingService
     */
    protected $ratingService;

    /**
     * RatingController constructor.
     *
     * @param RatingService $ratingService
     */
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }
// =============================================================================================================
    /**
     * Displays a list of ratings for a specific movie.
     *
     * @param int $movieId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($movieId)
    {
        try {
            $movie = Movie::findOrFail($movieId);
            return response()->json($movie->ratings, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
    }
// =============================================================================================================
    /**
     * Stores a new rating for a specific movie.
     *
     * @param \App\Http\Requests\StoreRatingRequest $request
     * @param int $movieId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRatingRequest $request, $movieId)
    {
        try {
            $movie = Movie::findOrFail($movieId);

            // Check if the user has already rated this movie
            $existingRating = $movie->ratings()->where('user_id', $request->user()->id)->first();
            if ($existingRating) {
                return response()->json(['error' => 'User has already rated this movie'], 400);
            }

            $validatedData = $request->validated();
            $rating = $this->ratingService->createRating($movie, $validatedData, $request->user()->id);
            return response()->json($rating, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
// =============================================================================================================
    /**
     * Displays the details of a specific rating by ID.
     *
     * @param int $movieId
     * @param int $ratingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($movieId, $ratingId)
    {
        try {
            $movie = Movie::findOrFail($movieId);
            $rating = $movie->ratings()->findOrFail($ratingId);
            return response()->json($rating, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie or Rating not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
// =============================================================================================================
    /**
     * Updates an existing rating in the database.
     *
     * @param \App\Http\Requests\StoreRatingRequest $request
     * @param int $movieId
     * @param int $ratingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreRatingRequest $request, $movieId, $ratingId)
    {
        try {
            $movie = Movie::findOrFail($movieId);
            $rating = $movie->ratings()->findOrFail($ratingId);

            $validatedData = $request->validated();
            $rating = $this->ratingService->updateRating($rating, $validatedData);
            return response()->json($rating, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie or Rating not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
// =============================================================================================================
    /**
     * Deletes a specific rating from the database.
     *
     * @param int $movieId
     * @param int $ratingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($movieId, $ratingId)
    {
        try {
            $movie = Movie::findOrFail($movieId);
            $rating = $movie->ratings()->findOrFail($ratingId);

            $this->ratingService->deleteRating($rating);
            return response()->json(['message' => 'Rating deleted successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie or Rating not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
