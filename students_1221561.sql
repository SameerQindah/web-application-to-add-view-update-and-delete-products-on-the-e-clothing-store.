CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    rating DECIMAL(3, 1),
    image VARCHAR(100),
    quantity INT DEFAULT 0
);

INSERT INTO products (product_name, category, description, price, rating, image, quantity) VALUES
('Classic T-Shirt', 'T-Shirts', 'A comfortable cotton t-shirt for everyday wear', 29.99, 4.5, '1.jpeg', 100),
('Slim Fit Jeans', 'Jeans', 'Modern slim fit jeans with stretch fabric', 59.99, 4.2, '2.jpeg', 75),
('Summer Dress', 'Dresses', 'Light floral summer dress perfect for warm days', 49.99, 4.7, '3.jpeg', 50),
('Leather Jacket', 'Outerwear', 'Classic leather jacket with quilted lining', 149.99, 4.8, '4.jpeg', 25),
('Running Shoes', 'Footwear', 'Lightweight running shoes with cushioned soles', 79.99, 4.6, '5.jpeg', 60),
('Winter Coat', 'Outerwear', 'Warm winter coat with faux fur hood', 129.99, 4.3, '6.jpeg', 40),
('Casual Shorts', 'Shorts', 'Comfortable casual shorts for summer', 34.99, 4.0, '7.jpeg', 80),
('Formal Shirt', 'Shirts', 'Crisp formal shirt for business occasions', 45.99, 4.4, '8.jpeg', 65),
('Wool Sweater', 'Sweaters', 'Cozy wool sweater for cold weather', 69.99, 4.1, '9.jpeg', 55),
('Athletic Leggings', 'Activewear', 'High-performance athletic leggings', 39.99, 4.9, '10.jpeg', 70);