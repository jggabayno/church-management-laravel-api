# Church Management API (Laravel 8)

## Overview

A **Laravel 8-based Church Management System** that helps administrators manage church-related activities such as weddings, baptisms, user roles, financial transactions, and more.

## Key Features

- **User Authentication & Security**: Secure login, registration, and password reset using Laravel Passport.
- **User & Role Management**: Assign roles to users, including administrator and church staff.
- **Weddings Management**: Track and manage wedding ceremonies.
- **Baptisms Management**: Register and manage baptisms.
- **Church Activities**: Organize, update, and remove church events.
- **Donations & Tithes**: Manage church donations and financial contributions.
- **Expense Tracking**: Monitor and update church expenses.
- **Service Fees & Payments**: Track church service fees and payment details.
- **Dashboard & Reports**: View activity logs and manage financial reports.

## API Endpoints

### Authentication
- `POST /login` - User login
- `POST /register` - User registration
- `PUT /resetpassword/{user}` - Reset user password

### User Management
- `GET /profile` - Get authenticated user profile
- `GET /users` - List all users
- `POST /users` - Create a new user
- `PUT /users/{user}` - Update user details
- `DELETE /users/{user}` - Delete a user
- `GET /usertypes` - Get available user types
- `GET /user/positions` - Get user positions

### Wedding Management
- `GET /weddings` - List all weddings
- `POST /weddings` - Add a new wedding
- `PUT /weddings/{wedding}` - Update wedding details

### Baptism Management
- `GET /baptisms` - List all baptisms
- `POST /baptisms` - Add a new baptism
- `PUT /baptisms/{baptism}` - Update baptism details

### Church Activities
- `GET /activities` - List all church activities
- `POST /activities` - Create a new activity
- `PUT /activities/{activity}` - Update activity details
- `DELETE /activities/{activity}` - Delete an activity

### Donations & Giving
- `GET /actofgivings` - List all acts of giving (donations, tithes)
- `POST /actofgivings` - Add a new act of giving
- `PUT /actofgivings/{act_of_giving}` - Update an act of giving
- `DELETE /actofgivings/{act_of_giving}` - Delete an act of giving

### Church Expenses
- `GET /expenses` - List all church expenses
- `POST /expenses` - Add a new expense
- `PUT /expenses/{expense}` - Update an expense
- `DELETE /expenses/{expense}` - Delete an expense

### Service Fees & Payments
- `GET /servicefee` - List all service fees
- `POST /servicefee` - Add a new service fee
- `PUT /servicefee/{service_fee}` - Update a service fee
- `GET /payments` - List all payments

### Dashboard & Logs
- `GET /dashboard` - View the dashboard overview
- `GET /activitylogs` - View system activity logs

## Requirements

- PHP 7.3+ or 8.0+
- Composer
- MySQL
- Node.js (for front-end assets)

## Installation

1. **Clone the Repository:**
   ```bash
   git clone using ssh or https
   cd church-management-api
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Set Up Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database:**
   Edit the `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run Migrations and Seed Data:**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Server:**
   ```bash
   php artisan serve
   ```
   The app will be accessible at `http://127.0.0.1:8000`.

## Usage

- **Admin Role**:
  - Manage users, roles, and permissions.
  - Track church activities, weddings, and baptisms.
  - Handle financial transactions and reports.

- **Church Staff Role**:
  - Register and manage weddings and baptisms.
  - View and manage church activities.

## Testing

Run all tests:
```bash
php artisan test
```

Run a specific test:
```bash
php artisan test --filter TestClassName
```

## Conclusion

This **Church Management API** provides a comprehensive solution for managing church activities, members, financial transactions, and user roles. Built with **Laravel 8**, it ensures **security, scalability, and ease of use** for church administrators and staff.