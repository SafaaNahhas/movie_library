<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Rating;
use Exception;

class RatingService
{
        /**
     * Creates a new rating for a specific movie.
     *
     * @param \App\Models\Movie $movie
     * @param array $data
     * @param int $userId
     * @return \App\Models\Rating
     */
    public function createRating(Movie $movie, array $data, $userId)
    {
        try {
            return $movie->ratings()->create(array_merge($data, ['user_id' => $userId]));
        } catch (Exception $e) {
            throw new Exception('An error occurred while creating the rating: ' . $e->getMessage());
        }
    }
    // =============================================================================================================
        /**
     * Updates an existing rating in the database.
     *
     * @param \App\Models\Rating $rating
     * @param array $data
     * @return \App\Models\Rating
     */
    public function updateRating(Rating $rating, array $data)
    {
        try {
            $rating->update($data);
            return $rating;
        } catch (Exception $e) {
            throw new Exception('An error occurred while updating the rating: ' . $e->getMessage());
        }
    }
    // =============================================================================================================
        /**
     * Deletes a specific rating from the database.
     *
     * @param \App\Models\Rating $rating
     * @return bool
     */
    public function deleteRating(Rating $rating)
    {
        try {
            $rating->delete();
            return true;
        } catch (Exception $e) {
            throw new Exception('An error occurred while deleting the rating: ' . $e->getMessage());
        }
    }
    // =============================================================================================================
        /**
     * Retrieves a specific rating by ID.
     *
     * @param \App\Models\Rating $rating
     * @return \App\Models\Rating
     */
    public function getRating(Rating $rating)
    {
        return $rating;
    }
}
