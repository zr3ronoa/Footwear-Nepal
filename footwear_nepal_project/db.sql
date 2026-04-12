-- Database: footwear_nepal

CREATE DATABASE footwear_nepal;

USE footwear_nepal;

-- Table: Navigation Links
CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL, -- Menu item name
    link VARCHAR(20) NOT NULL  -- URL for the menu item
);

-- Table: Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(50) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(50) NOT NULL
);
-- Table: Featured Content
CREATE TABLE slide_container (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subtitle VARCHAR(100) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT, 
    image_url VARCHAR(100),
    link VARCHAR(100)
);
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
);

-- Table: Products
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    original_price DECIMAL(10, 2) NOT NULL,
    rating DECIMAL(2, 1) NOT NULL,
    image_url VARCHAR(100) NOT NULL
);

CREATE TABLE featured_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    original_price DECIMAL(10, 2) NOT NULL,
    rating DECIMAL(2, 1) NOT NULL,
    small_images JSON NOT NULL,
    big_image VARCHAR(100) NOT NULL
);

-- Table: Reviews
CREATE TABLE customer_reviews (
    user_id INT NOT NULL, 
    customer_name VARCHAR(100) NOT NULL,
    review_text TEXT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (customer_name) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100) NOT NULL,
    image_url VARCHAR(100) NOT NULL
);

CREATE TABLE outlets (
     id INT AUTO_INCREMENT PRIMARY KEY, 
     name VARCHAR(255) NOT NULL, 
     url TEXT NOT NULL
);

CREATE TABLE contacts ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
     type ENUM('email', 'phone') NOT NULL, 
     value VARCHAR(255) NOT NULL
);

CREATE TABLE links ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100) NOT NULL,
     url VARCHAR(255) NOT NULL 
);
CREATE TABLE social_media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    platform VARCHAR(50) NOT NULL,
    url TEXT NOT NULL
);
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- Links to the user's ID
    product_name VARCHAR(100) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    product_image VARCHAR(100),
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


INSERT INTO menu_items (name, link) VALUES 
('Home', '#home'),
('Products', '#product'),
('Featured', '#featured'),
('Blog', '#blog'),
('Review', '#review');


-- Updated INSERT statements for featured content
INSERT INTO slide_container (subtitle,title, description, image_url, link) VALUES
('Nike Red Shoes','nike metcon shoes', 'Mostly preferred by customers. Can be used for trekking, hiking, and daily use. *Top-notch quality*', 'images/home-shoe-1.png', 'products.php'),
('Nike Blue Shoes', 'nike metcon shoes','Mostly preferred by customers. Can be used for trekking, hiking, and daily use. *Top-notch quality*', 'images/home-shoe-2.png', 'products.php'),
('Nike Yellow Shoes','nike metcon shoes', 'Mostly preferred by customers. Can be used for trekking, hiking, and daily use. *Top-notch quality*', 'images/home-shoe-3.png', 'products.php');
-- Create the table
-- Insert data into the table
INSERT INTO services (icon, title, description) VALUES
('fas fa-shipping-fast', 'Fast Delivery', 'Fast and Safe Delivery available all over Nepal'),
('fas fa-undo', '7 days replacements', 'If any issues with the product, it can be replaced or refund within interval of 7 Days.'),
('fas fa-headset', '24 x 7 support', 'Any Queries?... Don''t worry! We are there for you anytime needed.');

-- Insert data

-- Updated INSERT statements for products
INSERT INTO products (name, description, price, original_price, rating, image_url)VALUES
('Nike Shoes-1', 'Comfortable Nike shoes.', 5799, 7999, 4.0, 'images/product-1.png'),
('Nike Shoes-2', 'Durable and stylish.', 6799, 9799, 4.0, 'images/product-2.png'),
('Nike Shoes-3', 'Perfect for running.', 3999, 5999, 4.0, 'images/product-3.png'),
('Nike Shoes-4', 'Lightweight design.', 6999, 9999, 4.0, 'images/product-4.png'),
('Nike Shoes-5', 'Premium quality.', 8999, 11999, 4.0, 'images/product-5.png'),
('Nike Shoes-6', 'Ultimate comfort.', 7999, 10799, 4.0, 'images/product-6.png'),
('Nike Shoes-7', 'Comfortable Nike shoes.', 7999, 9999, 4.0, 'images/product-7.png'),
('Nike Shoes-8', 'Durable and stylish.', 6799, 9799, 4.0, 'images/product-8.png'),
('Nike Shoes-9', 'Perfect for running.', 3999, 5999, 4.0, 'images/product-9.png'),
('Nike Shoes-10', 'Lightweight design.', 6999, 9999, 4.0, 'images/product-10.png'),
('Nike Shoes-11', 'Premium quality.', 8999, 11999, 4.0, 'images/product-11.png'),
('Nike Shoes-12', 'Ultimate comfort.', 7999, 10799, 4.0, 'images/product-12.png'),
('Nike Shoes-13', 'Comfortable Nike shoes.', 5799, 7999, 4.0, 'images/product-13.png'),
('Nike Shoes-14', 'Durable and stylish.', 6799, 9799, 4.0, 'images/product-14.png'),
('Nike Shoes-15', 'Perfect for running.', 3999, 5999, 4.0, 'images/product-15.png'),
('Nike Shoes-16', 'Lightweight design.', 6999, 9999, 4.0, 'images/product-16.png'),
('Nike Shoes-17', 'Premium quality.', 8999, 11999, 4.0, 'images/product-17.png'),
('Nike Shoes-18', 'Ultimate comfort.', 7999, 10799, 4.0, 'images/product-18.png'),
('Nike Shoes-19', 'Comfortable Nike shoes.', 7999, 9999, 4.0, 'images/product-19.png'),
('Nike Shoes-20', 'Durable and stylish.', 6799, 9799, 4.0, 'images/product-20.png'),
('Nike Shoes-21', 'Perfect for running.', 3999, 5999, 4.0, 'images/product-21.png'),
('Nike Shoes-22', 'Lightweight design.', 6999, 9999, 4.0, 'images/product-22.png'),
('Nike Shoes-23', 'Premium quality.', 8999, 11999, 4.0, 'images/product-23.png'),
('Nike Shoes-24', 'Premium quality.', 8999, 11999, 4.0, 'images/product-24.png'),
('Nike Shoes-25', 'Premium quality.', 8999, 11999, 4.0, 'images/product-25.png');

INSERT INTO featured_products (name, description, price, original_price, rating, small_images, big_image)
VALUES
('new nike airmax shoes-1', 'Very comfortable and easy to wear. Specialized for even old people to wear.', 4999, 7999, 4.0, '["images/f-img-1.1.png", "images/f-img-1.2.png", "images/f-img-1.3.png", "images/f-img-1.4.png"]', 'images/f-img-1.1.png'),
('new nike airmax shoes-2', 'Very comfortable and easy to wear. Specialized for even old people to wear.', 4999, 7999, 4.5, '["images/f-img-2.1.png", "images/f-img-2.2.png", "images/f-img-2.3.png", "images/f-img-2.4.png"]', 'images/f-img-2.1.png'),
('new nike airmax shoes-3', 'Very comfortable and easy to wear. Specialized for even old people to wear.', 5500, 8999, 5.0, '["images/f-img-3.1.png", "images/f-img-3.2.png", "images/f-img-3.3.png", "images/f-img-3.4.png"]', 'images/f-img-3.1.png');


INSERT INTO team_members (name, role, image_url) VALUES
('Gagan Banepali', 'Designing, Developer', 'images/gagan.jpg'),
('John Prajapati', 'Developer', 'images/john.jpg'),
('Nirajan Tamang', 'Tester', 'images/nirajan.jpg'),
('Dilisha Manandhar', 'Useless', 'images/deelisha1.jpg');

INSERT INTO outlets (name, url) VALUES
('Kumaripati- Lalitpur', 'https://www.google.com/maps/place/Kumaripati,+Lalitpur/...'),
('New Road_ Kathmandu', 'https://www.google.com/maps/place/NEW+ROAD+MALL/...');

INSERT INTO contacts (type, value) 
VALUES 
('email', 'footwearnepal2024@gmail.com'),
('phone', '+977 9849689455'),
('phone', '+977 9865544480');
 INSERT INTO links (name, url) 
VALUES 
('home', '#home'),
('products', '#products'),
('featured', '#featured'),
('About Us', '#blog');
INSERT INTO social_media (platform, url) 
VALUES 
('facebook', 'https://www.facebook.com/profile.php?id=61568682245968&mibextid=ZbWKwL'),
('twitter', 'https://x.com/Footwear_Nepal?t=l4TJckjzUz3wqBpfKBqo9A&s=09'),
('instagram', 'https://www.instagram.com/footwearnepal2024/profilecard/?igsh=ZHB3OXRia2Zsbmd6'),
('linkedin', 'https://www.linkedin.com/in/footwear-nepal-196480339/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app');
