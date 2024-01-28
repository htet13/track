# Sale Management System

This is Sale Management System built with Laravel 8 and PHP 7.4. 

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 7.4 or higher installed.
- Composer installed.
- MySQL or another supported database system installed.
- Laravel 8 installed.

## Installation

Follow these steps to install and set up the Sale Management System:

1. Clone the repository:

   ```bash
   git clone https://github.com/Htet-Lin-Aung/pos.git

2. Navigate to the project directory:

    ```bash
    cd pos

3. Install the project dependencies using Composer:

    ```bash
    composer install

4. Create a .env file by copying the example:

    ```bash
    cp .env.example .env //for linux
    scp .env.example .env //for windows

5. Generate a new application key:

    ```bash
    php artisan key:generate

6. Configure your database connection in the .env file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=your-database-host
    DB_PORT=3306
    DB_DATABASE=your-database-name
    DB_USERNAME=your-database-username
    DB_PASSWORD=your-database-password

7. Run database migrations and seed the database:

    ```bash
    php artisan migrate --seed

8. Start the development server:

    ```bash
    php artisan serve

9. Access the application in your web browser at http://localhost:8000.

10. You can now log in to the application using the default administrator account:

    Email: admin@gmail.com
    Password: @dm!nU$er

## Usage

### Web Interface

- Log in to the application using your administrator credentials.
- Manage as needed.

## Credits

This application was created by Htet Lin Aung.