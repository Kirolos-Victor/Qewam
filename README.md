## How to Use

### Clone the repository

> git clone **https://github.com/Kirolos-Victor/Qewam.git**

### Install Via Composer

> composer install

### Generate Application Key

> php artisan key:generate

### Run the database migrations (Set the database connection in .env before migrating)

> **php artisan migrate**
>
> I have created seeders and factories in order to use them type in the terminal **php artisan migrate ---seed**

### Invoice Laravel Notifications

> Select the preferred mail service example: Mailtrap, Set the configuration inside the .env file.
> 
> I have created an Observer pattern for the notifications and the setup is inside Invoice model

### Testing

> I have created test cases for all the endpoints.

> run **php artisan test**

### Task

> Visit **https://www.getpostman.com/collections/cf1525243cde3829dea4** to get the Postman collection.
>
> API authentication is created as requested using Sanctum.
>
> You can download the Database Diagram from here: **https://drive.google.com/file/d/1_60Ef6OrIwwxozBeE2GU5U7beAPOtC7E/view?usp=sharing**




