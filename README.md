## Student Information
- Name: Ahmad Abdullah
- Student ID: 20222022032
- Department: Software Engineering

---

# Laravel E-Commerce Project

This is a simple e-commerce web application built with Laravel MVC.

## How to Launch the Application

### Prerequisites
- PHP 8.2 or higher
- Composer
- SQL Server (or MySQL/SQLite for development)

### Installation Steps

1. **Install PHP Dependencies**
   ```bash
   composer install
   ```

2. **Configure Environment**
   - Copy `.env.example` to `.env`
   - Or use the existing `.env` file

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

4. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

5. **Start the Development Server**
   ```bash
   php artisan serve
   ```

6. **Access the Application**
   - Open your browser and go to: `http://127.0.0.1:8000`

---

## Database Setup (SQL Server)

### Prerequisites
- SQL Server installed
- SQL Server Management Studio (SSMS) installed

### Step 1: Create the Database

1. Open SQL Server Management Studio (SSMS)
2. Connect to your SQL Server instance
3. Right-click on "Databases" in Object Explorer
4. Select "New Database..."
5. Enter the database name: `laravel_ecommerce`
6. Click "OK" to create the database

### Step 2: Configure Connection

Update your `.env` file with your SQL Server connection details:

```env
DB_CONNECTION=sqlsrv
DB_HOST=localhost
DB_PORT=1433
DB_DATABASE=laravel_ecommerce
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 3: Run the Schema Script

1. Open SQL Server Management Studio (SSMS)
2. Click "File" > "Open" > "File..."
3. Navigate to: `database/sql/schema.sql`
4. Click "Open"
5. Make sure your database is selected (use dropdown or press Ctrl+U)
6. Click "Execute" (or press F5)
7. Verify all tables were created successfully

### Step 4: Run the Seed Script (Optional)

To insert sample data:

1. Click "File" > "Open" > "File..."
2. Navigate to: `database/sql/seed.sql`
3. Click "Open"
4. Make sure your database is selected
5. Click "Execute" (or press F5)
6. Verify data was inserted

---

## Sample Data

- **1 Admin User**: admin@example.com (password: password)
- **3 Customers**: john@example.com, jane@example.com, bob@example.com
- **3 Categories**: Electronics, Clothing, Books
- **10 Products**: Various products across categories
- **Sample Orders**: For demonstration

---

## Project Features

### 1. User Authentication
- **Register** - Create a new customer account
- **Login** - Sign in to your account
- **Logout** - Sign out of your account
- **Profile Management** - Update name, email, and password

### 2. Product Catalog (Public)
- **Home Page** - View all available products
- **Product Details** - Click on any product to see full details (name, description, price, image)

### 3. Shopping Cart (Customer)
- **Add to Cart** - Add products from the catalog
- **Update Quantity** - Increase or decrease item quantity
- **Remove Item** - Remove items from cart
- **View Cart** - See all items in your cart with totals

### 4. Checkout & Orders (Customer)
- **Place Order** - Convert cart items to an order
- **Order History** - View all your past orders

### 5. Category Management (Admin)
- **View Categories** - See all product categories
- **Create Category** - Add new categories
- **Edit Category** - Update category name/description
- **Delete Category** - Remove categories

### 6. Product Management (Admin)
- **View Products** - See all products
- **Create Product** - Add new products (name, description, price, image, category)
- **Edit Product** - Update product details
- **Delete Product** - Remove products

### 7. Order Management (Admin)
- **View All Orders** - See all customer orders in a table
- **Order Details** - View complete order information including items
- **Update Status** - Change order status (Pending → Processing → Completed)

---

## User Roles

### Customer (Default)
- Can browse products
- Can add items to cart
- Can place orders
- Can view own order history
- Can manage own profile

### Admin
- All customer features
- Access to Admin Panel
- Manage categories
- Manage products
- Manage orders (view all, update status)

---

## How to Create an Admin User

### Option 1: Manually via Database
1. Register a new user through the registration page
2. Access your database (phpMyAdmin or SSMS)
3. Update the user's `role` field from `customer` to `admin`

### Option 2: Using Tinker
```bash
php artisan tinker
```
Then:
```php
App\Models\User::where('email', 'your-email@example.com')->update(['role' => 'admin']);
```

---

## Routes Overview

| Route | Description | Access |
|-------|-------------|--------|
| `/` | Home page (product catalog) | Public |
| `/products/{id}` | Product details | Public |
| `/register`, `/login` | Authentication | Public |
| `/dashboard` | User dashboard | Customer |
| `/cart` | Shopping cart | Customer |
| `/checkout` | Place order | Customer |
| `/orders` | Order history | Customer |
| `/admin` | Admin dashboard | Admin |
| `/admin/orders` | Manage orders | Admin |
| `/admin/orders/{id}` | Order details | Admin |
| `/categories` | Manage categories | Admin |
| `/products` | Manage products | Admin |

---

## Technologies Used

- Laravel MVC
- Bootstrap 5
- SQL Server / MySQL / SQLite
- Eloquent ORM
- Blade Templates
- Laravel Breeze (Authentication)