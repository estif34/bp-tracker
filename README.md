# Bp-tracker: A Blood Pressure and vitals tracking web application
[Bp-Tracker](https://blood-pressure-tracker-main-6jl9pj.laravel.cloud/)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
## Description
Bp-Tracker is a blood pressure and other vitals tracking web application developed using Laravel. It has features such as a dashboard to view last readings, charts to view trends of the readings, export option.

## Prerequisites
- PHP (>= 8.2)
- Composer
- Laravel (>= 9.0)
- A database (e.g., MySQL)
- Node.js 

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/estif34/bp-tracker.git
   cd patakazi
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install
   npm run dev
   ```
3. Set up the environment:
   ```bash
   copy .env.example .env
   ```
   - Configure the .env file with your database and application settings.

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```
7. Access the application at http://127.0.0.1:8000
