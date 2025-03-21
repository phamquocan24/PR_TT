-- Create database products_management
DROP DATABASE IF EXISTS `products_management`;

CREATE DATABASE `products_management` CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;
    
USE products_management




-- Create table brands
DROP TABLE IF EXISTS `brands`;

CREATE TABLE brands (
    `id` INT PRIMARY KEY,
    `slug` VARCHAR(191) NOT NULL,
    `is_active` TINYINT(1),
    `createc_at` TIMESTAMP,
    `updated_at` TIMESTAMP
)AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;

-- create table categories

CREATE TABLE categories (
	`id` INT PRIMARY KEY,
	`parent_id` INT NOT NULL,
	`slug` VARCHAR(191) NOT null,
	`position` INT,
	`is_searchable` TINYINT(1),
	`is_active` TINYINT(1),
   `createc_at` TIMESTAMP,
   `updated_at` TIMESTAMP
)AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;


-- create table variations

CREATE TABLE `variations` (
	`id` INT PRIMARY KEY,
	`uid` VARCHAR(191) NOT NULL,
	`type` VARCHAR(191),
	`is_global` TINYINT(1),
	`position` INT,
	`deleted_at` TIMESTAMP,
	`created_at` TIMESTAMP,
	`updated_at` TIMESTAMP,
)AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;

-- create table variation_values

CREATE TABLE `variation_values` (
	`id` INT PRIMARY KEY,
	`variation_id` INT NOT NULL,
	`uid` VARCHAR(191),
	`value` VARCHAR(191),
	`position` INT,
	`createc_at` TIMESTAMP,
   `updated_at` TIMESTAMP,
   CONSTRAINT FK_variation_id FOREIGN KEY (`variation_id`) REFERENCES variations (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
)AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;

-- create table products

CREATE TABLE `products` (
	`id` INT PRIMARY KEY,
	`brand_id` INT NOT NULL,
	`tax_class_id` INT,
	`slug` VARCHAR(191),
	`price` DECIMAL(18,4),
	`special_price` DECIMAL(18,4),
	`special_price_type` VARCHAR(191),
	`special_price_start` DATE,
	`special_price_end` DATE,
	`selling_price` DECIMAL(18,4),
	`sku` VARCHAR(191),
	`manage_stock` TINYINT(1),
	`qty` INT,
	`in_stock` TINYINT(1),
	`viewed` INT,
	`is_active` TINYINT(1),
	`new_from` DATETIME,
	`new_to` DATETIME,
	`position` INT,
	`deleted_at` TIMESTAMP,
	`is_virtual` TINYINT(1),
	`createc_at` TIMESTAMP,
   `updated_at` TIMESTAMP,
    CONSTRAINT FK_brand_id FOREIGN KEY (`brand_id`) REFERENCES brands (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
)AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;

-- create table product_variants

CREATE TABLE `product_variants` (
	`id` INT PRIMARY KEY,
	`uid` VARCHAR(191),
	`uids` TEXT,
	`product_id` INT NOT NULL,
	`name` VARCHAR(191),
	`price` DECIMAL(18,4),
	`special_price` DECIMAL(18,4),
	`special_price_type` VARCHAR(191),
	`special_price_start` DATE,
	`special_price_end` DATE,
	`selling_price` DECIMAL(18,4),
	`sku` VARCHAR(191),
	`manage_stock` TINYINT(1),
	`qty` INT,
	`in_stock` TINYINT(1),
	`is-default` TINYINT(1),
	`is_active` TINYINT(1),
	`position` INT,
	`deleted_at` TIMESTAMP,
	`createc_at` TIMESTAMP,
   `updated_at` TIMESTAMP,
    CONSTRAINT FK_product_id FOREIGN KEY (`product_id`) REFERENCES products (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
)AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;
	`

-- create table `product_variations`

CREATE TABLE `product_variations` (
	`product_id` INT NOT NULL,
	`variation_id` INT NOT NULL,
	CONSTRAINT PK_product_variations_variation_id_product_id PRIMARY KEY (`product_id`, `variation_id`),
	CONSTRAINT FK_variation_id FOREIGN KEY (`variation_id`) REFERENCES options (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT FK_product_id FOREIGN KEY (`product_id`) REFERENCES products (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;

	
	
-- create table product_categories

CREATE TABLE product_categories (
	`category_id` INT NOT NULL,
	`product_id` INT NOT NULL,
	CONSTRAINT PK_product_categories_category_id_product_id PRIMARY KEY (`order_id`, `product_id`),
	CONSTRAINT FK_category_id FOREIGN KEY (`category_id`) REFERENCES categories (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT FK_product_id FOREIGN KEY (`product_id`) REFERENCES products (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = UTF8MB4_UNICODE_CI;



-- ================= TRIGGER ==============


DELIMITER //

CREATE TRIGGER before_insert_products
BEFORE INSERT ON products
FOR EACH ROW
BEGIN
    IF NEW.special_price IS NOT NULL 
        AND NEW.special_price_start <= CURDATE() 
        AND NEW.special_price_end >= CURDATE() THEN
        IF NEW.special_price_type = 'fixed' THEN
            SET NEW.selling_price = NEW.price - NEW.special_price;
        ELSEIF NEW.special_price_type = 'percent' THEN
            SET NEW.selling_price = NEW.price - (NEW.special_price * NEW.price / 100);
        ELSE
            SET NEW.selling_price = NEW.price;
        END IF;
    ELSE
        SET NEW.selling_price = NEW.price;
    END IF;
END;
//

DELIMITER ;

DELIMITER //

CREATE TRIGGER before_update_products
BEFORE UPDATE ON products
FOR EACH ROW
BEGIN
    IF NEW.special_price IS NOT NULL 
        AND NEW.special_price_start <= CURDATE() 
        AND NEW.special_price_end >= CURDATE() THEN
        IF NEW.special_price_type = 'fixed' THEN
            SET NEW.selling_price = NEW.price - NEW.special_price;
        ELSEIF NEW.special_price_type = 'percent' THEN
            SET NEW.selling_price = NEW.price - (NEW.special_price * NEW.price / 100);
        ELSE
            SET NEW.selling_price = NEW.price;
        END IF;
    ELSE
        SET NEW.selling_price = NEW.price;
    END IF;
END;
//

DELIMITER ;




-- ============================== INSERT ==============================

INSERT INTO brands (id, slug, is_active, created_at, updated_at)
VALUES
(1, 'brand-1', 1, NOW(), NOW()),
(2, 'brand-2', 1, NOW(), NOW()),
(3, 'brand-3', 0, NOW(), NOW());

SELECT * FROM products

INSERT INTO products (id, brand_id, name, tax_class_id, slug, price, special_price, special_price_type, special_price_start, special_price_end, sku, manage_stock, qty, in_stock, viewed, is_active, new_from, new_to, deleted_at, created_at, updated_at)
VALUES
-- Trường hợp 1: Giảm giá cố định (fixed) và đang trong thời gian giảm
(1, 1, 'Product 1', NULL, 'product-1', 200.00, 20.00, 'fixed', '2025-03-17', '2025-03-23', 'P1001', 1, 50, 1, 0, 1, NULL, NULL, NULL, NOW(), NOW()),

-- Trường hợp 2: Giảm giá phần trăm (percent) và đang trong thời gian giảm
(2, 1, 'Product 2', NULL, 'product-2', 300.00, 10, 'percent', '2025-03-15', '2025-03-25', 'P1002', 1, 30, 1, 0, 1, NULL, NULL, NULL, NOW(), NOW()),

-- Trường hợp 3: Hết hạn giảm giá (phải giữ nguyên giá gốc)
(3, 2, 'Product 3', NULL, 'product-3', 150.00, 15.00, 'fixed', '2025-03-10', '2025-03-15', 'P1003', 1, 20, 1, 0, 1, NULL, NULL, NULL, NOW(), NOW()),

-- Trường hợp 4: Không có giảm giá
(4, 3, 'Product 4', NULL, 'product-4', 500.00, NULL, NULL, NULL, NULL, 'P1004', 1, 10, 1, 0, 1, NULL, NULL, NULL, NOW(), NOW()),

-- Trường hợp 5: Giảm giá phần trăm nhưng chưa đến ngày bắt đầu
(5, 2, 'Product 5', NULL, 'product-5', 250.00, 20, 'percent', '2025-03-25', '2025-03-30', 'P1005', 1, 15, 1, 0, 1, NULL, NULL, NULL, NOW(), NOW());


INSERT INTO categories (id, parent_id, slug, position, is_searchable, is_active, created_at, updated_at) 
VALUES
(1, NULL, 'electronics', 1, 1, 1, NOW(), NOW()),
(2, NULL, 'fashion', 2, 1, 1, NOW(), NOW()),
(3, NULL, 'home-appliances', 3, 1, 1, NOW(), NOW()),
(4, 1, 'laptops', 4, 1, 1, NOW(), NOW()),
(5, 1, 'smartphones', 5, 1, 1, NOW(), NOW()),
(6, 2, 'clothing', 6, 1, 1, NOW(), NOW()),
(7, 2, 'shoes', 7, 1, 1, NOW(), NOW());


INSERT INTO product_categories (category_id, product_id) 
VALUES
(4, 1), -- Product 1 thuộc danh mục laptops
(5, 2), -- Product 2 thuộc danh mục smartphones
(6, 3), -- Product 3 thuộc danh mục clothing
(7, 4), -- Product 4 thuộc danh mục shoes
(4, 5); -- Product 5 thuộc danh mục laptops


INSERT INTO variations (uid, type, is_global, position, created_at, updated_at)
VALUES
('var-1', 'text', 1, 1, NOW(), NOW()),
('var-2', 'color', 1, 2, NOW(), NOW()),
('var-3', 'image', 1, 3, NOW(), NOW()),
('var-4', 'size', 1, 4, NOW(), NOW()),
('var-5', 'material', 1, 5, NOW(), NOW());

