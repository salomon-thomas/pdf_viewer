Machine Test
This is a machine test project done using Laravel 8 PHP framework.

Project Scope
Register The visitor can register himself here, by leaving the following information:
Name
Email
Password (at least 6 characters)
Confrim Password (at least 6 characters)

After clicking on submit

The system has to check if the username doesn't exist. If it does the visitor needs to get a warning and had to choose another username.
All data must be stored in a database.

Login On the website is a login page. Users can login with their Username(Email) and Password, submitted during registration.

Detail page  This page Displayes the list of PDFs uploaded and avalable in the system. The user can view his/her documents and upload new documents. The uploaded documents can be deleted.


About the system design and code
System is fully OOP and few design patterns are used with MVC architecture. I used Mysql database with 3 tables. (users, tokens & country) tokens table is used to store token needed to verify the account and password reset. It is related with users table with FK user_id.

I have used jquery & bootstrap to render decent frontend. Only pdf are allowed, max filesize is restricted to 2mb which can be modified in the HomeController.

You can find my code mainly on app/controllers, app/models and resources/views. I have stick to Laravel coding standards. Also I have used best practises to prevent security issues CSRF, SQL injection, XSS. Password are stored with Bcrypt, so they cannot decrypt and protect against rainbow table attacks.


Setup
Requirements PHP 7.3 - 8.0

Download this project.

1: Just copy pdf_viewer/ folder into a htdocs or html folder.
2: Copy contents from .env.example to .env file and make APP_ENV to production.
3: Add database credentials to .env and create a database.
4: Run command composer install
5: Run the following command php artisan cache:clear && php artisan route:cache && php artisan view:clear && php artisan route:cache && php artisan view:cache && php artisan config:cache
6: Run command php artisan migrate
7: To test Run command php artisan serve

I have enabled the debug mode to find errors easily.

run follwing composer command: composer install

Now project should be able to up and running on your web server.

Feel free to contact me anytime if you need any assistance salomonthomas123@gmail.com