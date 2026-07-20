# My Project

A simple PHP web application for collecting and managing leads. The project includes a public contact form, an admin dashboard, and a small JWT-based API for retrieving leads.

## Features

- Public form to submit leads with name, email, and message
- Admin login and protected lead management pages
- Lead listing, editing, and deletion
- Simple JSON API for lead retrieval with JWT authentication
- MySQL database integration using MySQLi

## Project Structure

- `index.php` - Public landing page with the lead submission form and admin login form
- `submit.php` - Handles lead submission
- `login.php` - Web login for administrators
- `leads.php` - Protected admin dashboard for viewing leads
- `edit.php` / `update.php` / `delete.php` - Lead editing and deletion flow
- `admin.php` / `create_user.php` - Basic admin-related actions
- `db.php` - Database connection setup
- `api/` - API endpoints and JWT middleware
- `vendor/` - Composer dependencies

## Requirements

- PHP 8+
- MySQL or MariaDB
- Apache/Nginx web server
- Composer

## Setup

1. Place the project in your web server root (for example, XAMPP at `htdocs/my-project`).
2. Create a MySQL database named `test_project`.
3. Make sure the database user credentials in `db.php` match your local setup.
4. Install dependencies:

   ```bash
   composer install
   ```

5. Create the required database tables, for example:

   ```sql
   CREATE TABLE leads (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       email VARCHAR(255) NOT NULL,
       message TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       login VARCHAR(255) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       role VARCHAR(50) DEFAULT 'admin'
   );
   ```

6. Open the project in your browser:

   ```text
   http://localhost/my-project/
   ```

## Notes

- The project currently uses a simple structure and can be improved by separating business logic, views, and configuration.
- Authentication is basic and should be strengthened for production use.

## License

This project is provided as a simple example for learning and development purposes.
