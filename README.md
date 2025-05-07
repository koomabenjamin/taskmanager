## Vue Fullstack Developer Test

Bellow are instruction to build run the app backend and frontend;

#### Notes:

- The branch does not have the full commit history of the test because i begun working on the test using https://github.com/rutatiina/project-code-test and creating a pull request was a challenge. So for the full commit history, please refer to https://github.com/rutatiina/project-code-test
- The backend .env file is already included
- the default user details are prefilled in the login page for simplicity;
  - email: admin@projectcode.ug
  - password: P@ssw0rd
- the default password for all users / members is "P@ssw0rd"

### Backend tests

To run the laravel feature tests;

    1. cd backend/
    2. composer install
    3. php artisan migrate:fresh --seed
    4. php artisan test

### Backend (laravel)

    1. cd backend/
    2. php artisan migrate:fresh --seed
    3. php artisan serve

### Frontend (vue)

    1. cd frontend/
    2. npm install
    3. Nom run dev
