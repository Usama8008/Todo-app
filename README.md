# Introduction
The Task Management System is a web-based application that allows users to manage their tasks effectively.

# Features
Add new tasks with a description and due date.

View a list of all tasks.

Mark tasks as completed.

Edit or delete tasks.

Filter tasks by status: All, Pending, Completed.

# Steps to Install

composer install

npm install

cp .env.example .env

php artisan key:generate

# Migrate the Database:

php artisan migrate

php artisan serve
# To build UI properly:
npm run dev

# Seeding Data 

php artisan db:seed