

## Gift Browsing App - Acme Software Company


#Installation
To run this program is necessary to follow this steps ( This are console Instructions for linux / unix systems)
1. Download the code from the repository ( If you get the code from the repository )
2. Verify that you have the code in a folder.

3. Create a new database to work with your project. This project was developed using MariaDb
3. Edit or create a .env file with all your configuration, this project only use the database configuration, then
put in that file your database configuration.

You can copy the .env.example to a .env if you want to start as soon as possible with default config
`cp .env.example .env`

4. Run the following commands in your terminal:

* `composer install`
* `php artisan migrate`
* `php artisan passport:install`
* `php artisan key:generate`



After all this steps, if anything went wrong,  you should have a properly installation.
Congratulations!

# Run the program
To run the program in localhost use the following command:
`php artisan serve`

## License
* The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
* This project also is licensed under [MIT license](https://opensource.org/licenses/MIT).
