# Project Setup
laravel new \
composer require laravel/jetstream

## Database Seeding
To populate the database with the necessary roles and permissions, run the following command: \
composer install && php artisan migrate && php artisan db:seed --class=RolePermissionSeeder && php artisan storage:link 

## Default Users:
### Admin User 
admin@example.com \
password

### Public User 
user@example.com (no access to users) \
password

## Custom Roles
1.Admin User \
2.Public User

## Custom Permissions:
user_access

# Application Overview

## 1. Homepage
    - all items list
    - search input field for suggested items

## 2. Dashboard
### 2.1 Items
    - Crud system (Add/Edit/Delete)
          - name
          - image

### 2.2 Users
    - Crud system (Add/Edit/Delete)
          - name
          - email
          - password
          - role

## Cart
    - add/delete items in cart

# Main Routes:

1. Homepage - /
2. Dashboard - /dashboard
