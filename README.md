# Backend API – Laravel

This is the backend API for rollective, built with **Laravel 11** and using **SQLite** for the database.  
Authentication is handled via **Laravel Sanctum**.  
The `fileinfo` PHP extension is required and must be enabled.

## Requirements

- **PHP 8.4.3** or newer
- **Composer** (dependency manager for PHP)
- **SQLite** (version 3 or newer)
- **PHP extension:** `fileinfo` (must be enabled in `php.ini`)

## Setup Instructions

1. **Install dependencies**

   Open a terminal inside the project folder and run:

   ```bash
   composer install
   ```

2. **Enable the fileinfo extension**

   Make sure the following line is present and **not commented out** in your `php.ini`:

   ```
   extension=fileinfo
   ```

   Check if it's enabled:

   ```bash
   php -m
   ```

   You should see `fileinfo` in the output.

3. **Database setup**

   - This project uses **SQLite** as its database.
   - The SQLite file will be created automatically when you run the migration and seed commands.
   - No additional `.env` configuration is required for the backend.

4. **Run migrations and seeders**

   Create the database schema and populate it with initial data:

   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Start the development server**

   Start the server with:

   ```bash
   php artisan serve
   ```

   The server will be available at [http://localhost:8000](http://localhost:8000).

## API Authentication

- Uses **Laravel Sanctum** for authentication.
- For protected endpoints, include your Bearer token in the `Authorization` header.

## Project Structure

- **Routes:** `routes/api.php`
- **Controllers:** `app/Controllers/`
- **Models:** `app/Models/`
- **Migrations & Seeders:** `database/migrations/`, `database/seeders/`

## API Endpoints

Below is a list of all available API endpoints, grouped by access level.

### Public (Guest) Endpoints

| Method | Endpoint    | Description       |
| ------ | ----------- | ----------------- |
| POST   | /auth/login | User login        |
| POST   | /user       | Register new user |

### Protected Endpoints (Require Authentication)

All endpoints below require authentication using Laravel Sanctum.  
Include your Bearer token in the `Authorization` header.

#### Authentication

| Method | Endpoint     | Description |
| ------ | ------------ | ----------- |
| POST   | /auth/logout | User logout |

#### User Management

| Method | Endpoint | Description         |
| ------ | -------- | ------------------- |
| GET    | /user    | Get user profile    |
| PATCH  | /user    | Update user profile |
| DELETE | /user    | Delete user account |

#### Frames (Posts)

| Method | Endpoint | Description  |
| ------ | -------- | ------------ |
| GET    | /frames  | List frames  |
| POST   | /frames  | Create frame |
| PATCH  | /frames  | Update frame |
| DELETE | /frames  | Delete frame |

#### Comments

| Method | Endpoint  | Description    |
| ------ | --------- | -------------- |
| GET    | /comments | List comments  |
| POST   | /comments | Create comment |
| PATCH  | /comments | Update comment |
| DELETE | /comments | Delete comment |

#### Rolls (Categories)

| Method | Endpoint      | Description                      |
| ------ | ------------- | -------------------------------- |
| GET    | /rolls        | List rolls (categories)          |
| PUT    | /rolls/assign | Assign rolls to a frame (by IDs) |

#### Image Uploads

| Method | Endpoint | Description  |
| ------ | -------- | ------------ |
| POST   | /uploads | Upload image |
| DELETE | /uploads | Delete image |

---
