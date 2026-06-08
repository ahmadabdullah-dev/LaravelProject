-- ============================================
-- Sample Data for Laravel E-Commerce
-- SQL Server Version
-- ============================================

-- ============================================
-- Insert Users (1 Admin + 3 Customers)
-- ============================================

-- Admin user (password: admin123)
INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Customer 1
INSERT INTO users (name, email, password, role)
VALUES ('John Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer');

-- Customer 2
INSERT INTO users (name, email, password, role)
VALUES ('Jane Smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer');

-- Customer 3
INSERT INTO users (name, email, password, role)
VALUES ('Bob Wilson', 'bob@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer');

-- ============================================
-- Insert Categories (3 Categories)
-- ============================================

INSERT INTO categories (name, description)
VALUES ('Electronics', 'Electronic devices and gadgets');

INSERT INTO categories (name, description)
VALUES ('Clothing', 'Fashion and apparel');

INSERT INTO categories (name, description)
VALUES ('Books', 'Books and publications');

-- ============================================
-- Insert Products (10 Products)
-- ============================================

-- Electronics (3 products)
INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (1, 'Laptop', 'High-performance laptop for work and gaming', 999.99, 50, 'laptop.jpg');

INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (1, 'Smartphone', 'Latest smartphone with amazing camera', 699.99, 100, 'smartphone.jpg');

INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (1, 'Headphones', 'Wireless noise-cancelling headphones', 199.99, 75, 'headphones.jpg');

-- Clothing (4 products)
INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (2, 'T-Shirt', 'Comfortable cotton t-shirt', 29.99, 200, 'tshirt.jpg');

INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (2, 'Jeans', 'Classic denim jeans', 59.99, 150, 'jeans.jpg');

INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (2, 'Jacket', 'Warm winter jacket', 89.99, 80, 'jacket.jpg');

INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (2, 'Sneakers', 'Running shoes', 79.99, 120, 'sneakers.jpg');

-- Books (3 products)
INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (3, 'Programming Guide', 'Learn programming from scratch', 49.99, 60, 'book1.jpg');

INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (3, 'Web Development', 'Modern web development techniques', 39.99, 45, 'book2.jpg');

INSERT INTO products (category_id, name, description, price, stock, image)
VALUES (3, 'Database Design', 'Database design best practices', 44.99, 40, 'book3.jpg');

-- ============================================
-- Insert Sample Carts (Optional - for demo)
-- ============================================

INSERT INTO carts (user_id)
VALUES (2);  -- Cart for John Doe

-- ============================================
-- Insert Sample Orders (Optional - for demo)
-- ============================================

INSERT INTO orders (user_id, total_amount, status, shipping_address, payment_method)
VALUES (2, 729.98, 'completed', '123 Main St, City, Country', 'credit_card');

INSERT INTO orders (user_id, total_amount, status, shipping_address, payment_method)
VALUES (3, 179.97, 'processing', '456 Oak Ave, Town, Country', 'paypal');

-- ============================================
-- Insert Sample Order Items (Optional - for demo)
-- ============================================

-- Order 1 items
INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal)
VALUES (1, 1, 1, 999.99, 999.99);

INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal)
VALUES (1, 4, 2, 29.99, 59.98);

INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal)
VALUES (1, 8, 1, 49.99, 49.99);

-- Order 2 items
INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal)
VALUES (2, 3, 1, 199.99, 199.99);

INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal)
VALUES (2, 7, 1, 79.99, 79.99);

INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal)
VALUES (2, 9, 1, 39.99, 39.99);