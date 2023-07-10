#Laravel Vue App
This is a Laravel Vue app that allows the admin to create websites and posts, and the client to subscribe to websites and receive notifications via email.

Getting Started
To run this app on your local machine, follow these steps:

Clone the Git repository to your local machine using the command git clone <repository-url>.
Navigate to the root directory of the project.
Run composer install to install the required dependencies.
Copy the .env.example file to .env and update the database configuration.
Run php artisan key:generate to generate an application key.
Run php artisan migrate to create the database tables.
Run npm install to install the required Node.js dependencies.
Run npm run watch to compile the assets and start watching for changes.
Usage
The admin creates websites using the Websitelist page.
The client opens the website pages and subscribes to them.
The data is created in the database.


RUn php artisan migrate --seed, php artisan passport:install, and you are ok.
The admin creates a post with a selection of any website.
The notification is sent back to the client/subscribers email.
You can view the subscribers via the Subscribers page.
