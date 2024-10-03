# Laravel Library Management System

This is a Laravel 11 project for managing a library, built with a clean user interface and robust backend. The application allows users to browse and manage books, categories, and authors, with different roles for regular users and admins. Additionally, it includes a complete user authentication system.

## Features

### User Roles
- **Admin**:  
  Admins have full control over the content of the library. They can:
  - Create, update, and delete books, categories, and authors.
  - Manage users and their permissions.
  
- **User**:  
  Regular users can:
  - View books, categories, and authors.
  - Register and log in to their accounts.
  - Update their profile, including changing their password.

### Authentication System
- **Registration**: Users can sign up with an email and password.
- **Email Verification**: After registration, users receive a verification email to confirm their email address.
- **Login/Logout**: Users can log in and securely log out.
- **Password Reset**: Users can reset their password via an email verification process.
- **Password Change**: Authenticated users can change their password from their profile settings.

### Library Management
- **Books**:  
  Admins can add, edit, and delete books. Each book is associated with categories and authors for better organization.
  
- **Categories**:  
  Categories help organize books into different genres or topics. Admins can manage categories by adding, updating, or deleting them.
  
- **Authors**:  
  Manage the list of authors, allowing admins to create, update, and remove author profiles.

## Technologies Used

- **Laravel 11**: A modern PHP framework for building web applications.
- **MySQL**: The relational database used to store all application data.
- **Bootstrap 4.6**: For responsive front-end design and styling.

## Database Structure

The database includes the following tables:

1. **users**: Stores user details, including their role (admin or regular user) and authentication data.
2. **books**: Contains information about the books in the library.
3. **categories**: Organizes books into different categories.
4. **authors**: Holds the details of authors.

## Installation

To install and run this project locally, follow these steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/laravel-library-project.git
2. **Navigate to the project directory:**:
   ```bash
   cd laravel-library-project
3. **Install dependencies:**:
   ```bash
   composer install
4. **Set up environment file: Copy the .env.example file to .env and configure your database and other environment variables:**:
   ```bash
   cp .env.example .env
5. **Generate the application key:**:
   ```bash
   php artisan key:generate
6. **php artisan migrate:**:
   ```bash
   php artisan migrate
7. **Start the local development server:**:
   ```bash
   php artisan serve
The application will be accessible at http://127.0.0.1:8000.

## Usage

### User Registration
- Users can sign up via the registration form and must verify their email before accessing the system.

### Admin Access
- Admin users have additional privileges to manage books, categories, and authors.

### Password Management
- Users can reset or change their passwords after logging in.


   





