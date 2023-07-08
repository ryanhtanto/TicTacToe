# Tic Tac Toe Game

This is a web application that allows users to play the classic game Tic Tac Toe. The game supports multiple players.

## Requirements

- PHP 7.4 or higher
- Laravel 8.x
- MySQL 5.7 or higher
- Web server (e.g., Apache, Nginx)
- Composer (dependency manager for PHP)

## Importing SQL File

1. Create a new MySQL database for the project.

2. Access your MySQL database management tool (e.g., phpMyAdmin, MySQL command-line interface).

3. Import the SQL file (tictactoe.sql) into database. You can do this in one of the following ways:

   - **phpMyAdmin**: 
     - Open phpMyAdmin in your web browser.
     - Select the newly created database from the left-hand sidebar.
     - Click on the "Import" tab at the top.
     - Choose the SQL file to import.
     - Click the "Go" or "Import" button to start the import process.

4. The SQL file will be imported into the database, creating the necessary tables and data required by the application.

5. Update the `.env` file with your database credentials if you haven't done so already:

   ```dotenv
   DB_DATABASE=tictactoe
   DB_USERNAME=root
   DB_PASSWORD=

## Run The App

1. Start the local development server:
   ```dotenv
   php artisan serve