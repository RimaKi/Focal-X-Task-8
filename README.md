# Focal-X-Task-8


# project details
A simple daily task management system that allows users to add, edit, and delete tasks through a Blade-built UI, as well as an automated function to send a daily email with pending tasks using a Cron Job.


## Packages
    - Laravel Breeze: for auth operation using with blades.


## Response
    - The response will be a view with some data.

## Exception
    - Handle errors appropriately to ensure a good user experience. Use LOG to ensure errors can be reviewed.

## Request
    - All requests are processed within Form Request to verify their validity, organize them, and benefit from all its features as needed.

## Models
    - User :  (default model)
       neme - email - password
    - Tasks:
        title - description - due_date - status - user_id
        

## Services
    - Services were used when needed, i.e. when there was complexity in the operations, they were moved from the
      controller to the service.


## Validations
    - Use simple and important expressions and rules in the validation process like: required , string ,
      date ,.......

## Blades
    - blades were created for basic task operations.
    - The idea of extends , layouts and components is exploited.
    - Dealing with php and laravel directives within blade.

## Cron job
    - Use cron job to send daily emails with details of user's incomplete tasks.
    - Scheduling a cron job using schedule in Laravel.
    - Using Mailer for sends emails in laravel.
    - Use queue to coordinate schedule operations.

 
# run
- npm run dev
- php artisan serve
- php artisan queue:work
- php artisan schedule:work 