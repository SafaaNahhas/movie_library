## Introduction

This project is a RESTful API for managing a Movie Library built using Laravel. It supports basic CRUD operations for movies and includes features such as pagination, filtering, and sorting. The API follows RESTful best practices, including data validation, exception handling, and proper use of HTTP status codes.

## Prerequisites

- [PHP](https://www.php.net/) >= 8.0
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/) >= 9.0
- [MySQL](https://www.mysql.com/) or any other database supported by Laravel
- [Postman](https://www.postman.com/) for testing API endpoints

## Setup

1. **Clone the project:**

   ```bash
   git clone https://github.com/SafaaNahhas/movie_libraryc.git
   cd movie-library
## Install backend dependencies:
composer install
Create the .env file:
Copy the .env.example file to .env:
cp .env.example .env
## modify the .env file to set up your database connection:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
## Generate the application key:
php artisan key:generate
## Run migrations:
php artisan migrate
## Start the local server:
php artisan serve
You can now access the project at http://localhost:8000.

## Project Structure

- `MovieController.php`: Handles the API requests related to movies, such as creating, updating, deleting, and retrieving movies.
- `MovieService.php`: Contains the business logic for managing movies, such as interacting with the database and performing operations on movie data.
- `Movie.php`: The Eloquent model representing the movies in the database, providing an interface to interact with the movies table.
- `RatingController.php`: Handles the API requests related to movie ratings, such as adding, updating, and retrieving ratings.
- `RatingService.php`: Contains the business logic for managing movie ratings, including operations like saving and retrieving ratings data.
- `Rating.php`: The Eloquent model representing the ratings of the movies, providing an interface to interact with the ratings table.
- `api.php`: Contains the route definitions representing the API endpoints, mapping HTTP requests to the appropriate controllers.
- `AuthController.php`: Handles the API requests related to user authentication, including registration, login, and token management.
- `AuthService.php`: Contains the business logic for managing user authentication, such as validating user credentials and generating JWT tokens.
- `ApiResponseService.php`: A service class responsible for formatting and returning standardized API responses.
- `StoreMovieRequest.php`: A Form Request class that handles validation rules for creating  movies.
- `UpdateMovieRequest.php`: A Form Request class that handles validation rules for  updating movies.
- `StoreRatingRequest.php`: A Form Request class that handles validation rules for creating and updating ratings.
- `RegisterRequest.php`: A Form Request class that handles validation rules for user registration.
- `LoginRequest.php`: A Form Request class that handles validation rules for user login.

## Advanced Features
1. Pagination
Movies can be paginated using the page and per_page query parameters.

2. Filtering
You can filter movies by genre or director using query parameters.

3. Sorting
Movies can be sorted by release_year using the sort_by query parameter.

4. Postman Collection
A Postman collection is provided to easily test the API endpoints. You can import it into your Postman application and run the requests.

## Postman Documentation
https://documenter.getpostman.com/view/34501481/2sAXjF9aKU



