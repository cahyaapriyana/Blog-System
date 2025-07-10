# Blog System

A modern blog system built with Laravel 12, featuring a rich text editor, user authentication, and category management.

## Features

-   **User Authentication & Authorization**

    -   User registration and login
    -   Email verification
    -   Password reset functionality
    -   Profile management with avatar upload

-   **Blog Management**

    -   Create, edit, delete, and view blog posts
    -   Rich text editor (Quill.js) for post content
    -   Category-based organization
    -   Search functionality by title, category, and author
    -   Pagination support

-   **Category System**

    -   Predefined categories with color coding
    -   Category-based post filtering
    -   Visual category badges

-   **Modern UI/UX**
    -   Responsive design with Tailwind CSS
    -   Dark mode support
    -   Clean and intuitive interface
    -   Mobile-friendly layout

## 🛠️ Tech Stack

-   **Backend**: Laravel 12
-   **Frontend**: Blade Templates, Tailwind CSS
-   **Database**: MySQL/PostgreSQL
-   **Rich Text Editor**: Quill.js
-   **Authentication**: Laravel Breeze
-   **Testing**: Pest PHP

## 📋 Requirements

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   MySQL/PostgreSQL database

## 🚀 Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd blogsystem
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

4. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Configure database**
   Edit `.env` file and set your database credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=blogsystem
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

6. **Run migrations and seeders**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

7. **Build assets**

    ```bash
    npm run build
    ```

8. **Start the development server**
    ```bash
    php artisan serve
    ```

## Database Seeding

The application comes with sample data:

-   **Default Admin User**:

    -   Email: `cahya@codemind.id`
    -   Password: `password123`
    -   Username: `cahyaapriyana`

-   **Categories**:

    -   Web Design (Red)
    -   Artificial Intelligence (Green)
    -   Web Programming (Blue)

-   **Sample Posts**: 30 posts with random content

## 📁 Project Structure
