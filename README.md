## Vue Fullstack Developer Test

Bellow are instruction to build run the app backend and frontend;

### Backend (laravel)

    1. cd backend/
    2. composer install
    3. php artisan migrate:fresh --seed
    4. php artisan serve

### Frontend (vue)

    1. cd frontend/
    2. npm install
    3. Nom run dev

### Backend tests

To run the laravel feature tests;

    1. cd backend/
    2. php artisan test

#### Notes:

- The backend .env file is already included
- the default user details are prefilled in the login page for simplicity;
  - email: admin@projectcode.ug
  - password: P@ssw0rd
- the default password for all users / members is "P@ssw0rd"
