## Student Information
- Name: Ahmad Abdullah
- Student ID: 20222022032
- Department: Software Engineering

---

# Laravel E-Commerce Project

This is a simple e-commerce web application built with Laravel MVC.

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

### Sample Data Included

- **1 Admin User**: admin@example.com (password: password)
- **3 Customers**: john@example.com, jane@example.com, bob@example.com
- **3 Categories**: Electronics, Clothing, Books
- **10 Products**: Various products across categories
- **Sample Orders**: For demonstration

## Project Features

- User authentication (login/register)
- Admin dashboard
- Product browsing
- Shopping cart
- Order placement

## Technologies Used

- Laravel MVC
- Bootstrap 5
- SQL Server
- Eloquent ORM
- Blade Templates