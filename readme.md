## Curcol

Curcol is a simple twitter-like app based on laravel 4. Explore it for educational purposes.

## How to use  

Just enter `composer update` in your console to download dependencies, edit `app\config\local\database` for database connection, and change local value in `app\bootstrap\start.php` to your computer name. Don't forget to run `php artisan migrate` to create tables and `php artisan db:seed` to initialize couple of data. Run it by entering `php artisan serve` and open `http://localhost:8000` on your browser. 

