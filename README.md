# Venue Booking API Documentation

### Setup
- Laravel: 11.21.0
- PHP: 8.2.19
- Composer: 2.7
- Database: sqlite

1. Clone this repository
2. run `php artisan migrate --seed`
2. start dev server `php artisan serve`
- Use postman collect for testing (located in root directory)

### Base URL

`/api/v1/`

## Endpoints

### 1. Create Venue Booking

- **Endpoint:** `/book-venue`
- **Method:** `POST`
- **Request Body:**

  ```json
  {
    "user_id":1,
    "venue_id":1,
    "reservation_date":"2024-09-11",
    "slot":"6AM-8AM",
    "team_size":12
  }
  ```

- **Response:**
    - Success (201 Created):
        ```json
        {
            "message": "Venue booking created successfully",
            "data": {
                "id": "integer",
                "user_id": "integer",
                "venue_id": "integer",
                "reservation_date": "YYYY-MM-DD",
                "slot": "string",
                "team_size": "integer"
            }
        }
        ```
    - Validation Error (422 Unprocessable Entity):
        ```json
        {
            "message": "Validation failed",
            "errors": {
                "user_id": [
                    "The selected user id is invalid."
                ]
            }
        }
        ```
    - Conflict Error (409 Conflict):
        ```json
        {
            "message": "The venue has already booked in the selected date and time slot"
        }
        ```
    - Internal Server Error (500 Internal Server Error):
        ```json
        {
            "message": "Failed to create venue booking"
        }
        ```

   

### 2. List Venues

- **Endpoint:** `/list-venues`
- **Method:** `GET`

- **Response:**
    ```json
    {
        "data": [
            {
                "id": 10,
                "venue_name": "Adrian Key",
                "game": "badminton",
                "working_hours": [
                    "6AM-8AM",
                    "9AM-11AM",
                    "12PM-2PM",
                    "3PM-5PM",
                    "6PM-8PM"
                ],
                "created_at": "2024-08-24T09:56:45.000000Z",
                "updated_at": "2024-08-24T09:56:45.000000Z",
                "venue_bookings_count": 14
            },
            ......more
        ],
        "highlights": {
            "highest": {
                "id": 10,
                "venue_name": "Adrian Key",
                "game": "badminton",
                "working_hours": [
                    "6AM-8AM",
                    "9AM-11AM",
                    "12PM-2PM",
                    "3PM-5PM",
                    "6PM-8PM"
                ],
                "created_at": "2024-08-24T09:56:45.000000Z",
                "updated_at": "2024-08-24T09:56:45.000000Z",
                "venue_bookings_count": 14
            },
            "lowest": {
                "id": 8,
                "venue_name": "Heaney Course",
                "game": "badminton",
                "working_hours": [
                    "6AM-8AM",
                    "9AM-11AM",
                    "12PM-2PM",
                    "3PM-5PM",
                    "6PM-8PM"
                ],
                "created_at": "2024-08-24T09:56:45.000000Z",
                "updated_at": "2024-08-24T09:56:45.000000Z",
                "venue_bookings_count": 2
            }
        }
    }
    ```
### 3. Venues Performance

- **Endpoint:** `/venues-performance?date_from=2024-08-24&date_to=2024-09-20`
- **Method:** `GET`
- **Request Body/Query:**

  ```json
  {
    "date_from":"2024-08-24",
    "date_to":"2024-09-20",
  }
  ```

- **Response:**
    ```json
    {
        "data": [
            {
                "id": 1,
                "venue_name": "Samantha Squares",
                "game": "badminton",
                "working_hours": [
                    "6AM-8AM",
                    "9AM-11AM",
                    "12PM-2PM",
                    "3PM-5PM",
                    "6PM-8PM"
                ],
                "created_at": "2024-08-24 09:56:44",
                "updated_at": "2024-08-24 09:56:44",
                "venue_bookings_count": 1,
                "rank": 1,
                "category": "D"
            }
        ]
    }
    ```


   







<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
