# Laravel Multi-Guard Authentication System

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A comprehensive Laravel application featuring a multi-guard authentication system with role-based access control, supporting three distinct user types: **Admins**, **Users**, and **Writers**. Each user type has specific permissions and capabilities within the system.

## 🌟 Features

### 🔐 Multi-Guard Authentication

-   **Admin Guard**: Full system administration capabilities
-   **User Guard**: Standard user authentication and self-management
-   **Writer Guard**: Content creator authentication and self-management

### 👥 User Management System

-   **Admin Dashboard**: Complete CRUD operations for all user types
-   **User Dashboard**: Self-profile management
-   **Writer Dashboard**: Self-profile management
-   **Role-based UI**: Dynamic interface based on user permissions

### 🛡️ Security Features

-   **Route Protection**: Middleware-based access control
-   **Authorization Checks**: Controller-level permission validation
-   **CSRF Protection**: Built-in Laravel security
-   **Password Hashing**: Secure password storage
-   **Session Management**: Secure session handling

### 🎨 User Interface

-   **Bootstrap 5**: Modern, responsive design
-   **Font Awesome Icons**: Professional iconography
-   **Dark Mode Support**: Theme adaptability
-   **Mobile Responsive**: Optimized for all devices

## 📋 Table of Contents

-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Usage](#usage)
-   [Authentication System](#authentication-system)
-   [API Endpoints](#api-endpoints)
-   [Database Structure](#database-structure)
-   [Security](#security)
-   [Testing](#testing)
-   [Contributing](#contributing)
-   [License](#license)

## 🚀 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   SQLite (or your preferred database)

### Step-by-Step Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/shayanahmad1999/laravel-multi-guard.git
    cd laravel-multi-guard
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

4. **Environment Configuration**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Database Setup**

    ```bash
    # Create SQLite database (or configure your preferred database)
    touch database/database.sqlite

    # Run migrations
    php artisan migrate
    ```

6. **Build Assets**

    ```bash
    npm run build
    # OR for development
    npm run dev
    ```

7. **Start the Application**
    ```bash
    php artisan serve
    ```

The application will be available at `http://localhost:8000`

## ⚙️ Configuration

### Environment Variables

Configure your `.env` file with the following key settings:

```env
APP_NAME="Laravel Multi-Guard"
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

# Or for MySQL/PostgreSQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_multi_guard
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Authentication Guards

The system uses three authentication guards defined in `config/auth.php`:

```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
    'user' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'writer' => [
        'driver' => 'session',
        'provider' => 'writers',
    ],
],
```

## 📖 Usage

### User Registration & Login

#### Admin Access

-   **Registration**: Visit `/admin/register`
-   **Login**: Visit `/admin/login`
-   **Dashboard**: `/admin/dashboard`

#### User Access

-   **Registration**: Visit `/user/register`
-   **Login**: Visit `/user/login`
-   **Dashboard**: `/user/dashboard`

#### Writer Access

-   **Registration**: Visit `/writer/register`
-   **Login**: Visit `/writer/login`
-   **Dashboard**: `/writer/dashboard`

### Dashboard Features

#### Admin Dashboard

-   **Manage Users**: Full CRUD operations for all users
-   **Manage Writers**: Full CRUD operations for all writers
-   **Manage Admins**: Full CRUD operations for all admins
-   **System Overview**: User statistics and system metrics

#### User Dashboard

-   **Profile Management**: View and edit personal profile
-   **Account Settings**: Manage account preferences
-   **Personal Dashboard**: User-specific information

#### Writer Dashboard

-   **Profile Management**: View and edit personal profile
-   **Content Management**: Access to writing tools
-   **Account Settings**: Manage account preferences

## 🔐 Authentication System

### Guard-Based Authentication

The system implements Laravel's multi-guard authentication with three distinct guards:

#### 1. Admin Guard

-   **Purpose**: System administration
-   **Capabilities**: Full access to all user types and system features
-   **Routes**: Prefixed with `/admin`
-   **Middleware**: `auth:admin`

#### 2. User Guard

-   **Purpose**: Standard user authentication
-   **Capabilities**: Self-profile management only
-   **Routes**: Prefixed with `/user`
-   **Middleware**: `auth:user,admin`

#### 3. Writer Guard

-   **Purpose**: Content creator authentication
-   **Capabilities**: Self-profile management only
-   **Routes**: Prefixed with `/writer`
-   **Middleware**: `auth:writer,admin`

### Authorization Logic

```php
// Admin can manage all users
if (auth('admin')->check()) {
    $users = User::paginate(10); // All users
} else {
    $users = User::where('id', auth('user')->id())->paginate(10); // Only own profile
}
```

## 🌐 API Endpoints

### Authentication Endpoints

#### Admin Routes

```
GET    /admin/login          - Show admin login form
POST   /admin/login          - Process admin login
GET    /admin/register       - Show admin registration form
POST   /admin/register       - Process admin registration
POST   /admin/logout         - Admin logout
GET    /admin/dashboard      - Admin dashboard
```

#### User Routes

```
GET    /user/login           - Show user login form
POST   /user/login           - Process user login
GET    /user/register        - Show user registration form
POST   /user/register        - Process user registration
POST   /user/logout          - User logout
GET    /user/dashboard       - User dashboard
```

#### Writer Routes

```
GET    /writer/login         - Show writer login form
POST   /writer/login         - Process writer login
GET    /writer/register      - Show writer registration form
POST   /writer/register      - Process writer registration
POST   /writer/logout        - Writer logout
GET    /writer/dashboard     - Writer dashboard
```

### CRUD Endpoints

#### User Management (Admin Only)

```
GET    /user/crud             - List all users (admin) / own profile (user)
POST   /user/crud             - Create new user (admin only)
GET    /user/crud/create      - Show create user form (admin only)
GET    /user/crud/{user}      - Show specific user
PUT    /user/crud/{user}      - Update user
DELETE /user/crud/{user}      - Delete user (admin only)
GET    /user/crud/{user}/edit - Show edit user form
```

#### Writer Management (Admin Only)

```
GET    /writer/crud           - List all writers (admin) / own profile (writer)
POST   /writer/crud           - Create new writer (admin only)
GET    /writer/crud/create    - Show create writer form (admin only)
GET    /writer/crud/{writer}  - Show specific writer
PUT    /writer/crud/{writer}  - Update writer
DELETE /writer/crud/{writer}  - Delete writer (admin only)
GET    /writer/crud/{writer}/edit - Show edit writer form
```

#### Admin Management (Admin Only)

```
GET    /admin/crud            - List all admins
POST   /admin/crud            - Create new admin
GET    /admin/crud/create     - Show create admin form
GET    /admin/crud/{admin}    - Show specific admin
PUT    /admin/crud/{admin}    - Update admin
DELETE /admin/crud/{admin}    - Delete admin
GET    /admin/crud/{admin}/edit - Show edit admin form
```

## 🗄️ Database Structure

### Tables

#### users

```sql
- id (primary key)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string, hashed)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

#### admins

```sql
- id (primary key)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string, hashed)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

#### writers

```sql
- id (primary key)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string, hashed)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

#### admin_sessions

```sql
- id (string, primary key)
- admin_id (foreign key to admins.id, nullable)
- ip_address (string, nullable)
- user_agent (text, nullable)
- payload (long text)
- last_activity (integer, indexed)
```

## 🛡️ Security

### Authentication Security

-   **Password Hashing**: All passwords are hashed using Laravel's `Hash::make()`
-   **CSRF Protection**: All forms include CSRF tokens
-   **Session Security**: Secure session management with regeneration
-   **Route Protection**: Middleware-based access control

### Authorization Security

-   **Role-Based Access**: Strict permission checking
-   **Guard Validation**: Multi-guard authentication system
-   **Parameter Validation**: Input sanitization and validation
-   **SQL Injection Prevention**: Eloquent ORM protection

### Data Security

-   **Mass Assignment Protection**: Fillable attributes defined
-   **Hidden Attributes**: Sensitive data excluded from JSON responses
-   **Route Model Binding**: Secure parameter resolution

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines

-   Follow PSR-12 coding standards
-   Write comprehensive tests for new features
-   Update documentation for API changes
-   Ensure all tests pass before submitting PR

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

-   [Laravel Framework](https://laravel.com) - The PHP framework used
-   [Bootstrap](https://getbootstrap.com) - CSS framework for styling
-   [Font Awesome](https://fontawesome.com) - Icon library
-   [Composer](https://getcomposer.org) - PHP dependency manager
-   [NPM](https://www.npmjs.com) - Node.js package manager

## 📞 Support

If you have any questions or need help with the Laravel Multi-Guard system, please:

1. Check the [Laravel Documentation](https://laravel.com/docs)
2. Review the [Issues](https://github.com/shayanahmad1999/laravel-multi-guard/issues) section
3. Create a new issue with detailed information about your problem

## 🔄 Version History

### v1.0.0

-   Initial release
-   Multi-guard authentication system
-   Complete CRUD operations for all user types
-   Role-based access control
-   Responsive UI with Bootstrap 5
-   Comprehensive security features

---

**Built with ❤️ using Laravel 12.x**
