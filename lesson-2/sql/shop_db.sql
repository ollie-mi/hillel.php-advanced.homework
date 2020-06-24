--
-- Create DB `hillel_shop`
--

CREATE DATABASE IF NOT EXISTS `hillel_shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

--
-- Create table `vendor`
--
CREATE TABLE IF NOT EXISTS `hillel_shop`.`vendor` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `tittle` VARCHAR(255) NOT NULL,
    `description` LONGTEXT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_title` (`tittle`)
) ENGINE = InnoDB;

--
-- Create table `category`
--
CREATE TABLE IF NOT EXISTS `hillel_shop`.`category` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

--
-- Create table `product`
--
CREATE TABLE IF NOT EXISTS `hillel_shop`.`product` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` LONGTEXT NULL,
    `price` FLOAT UNSIGNED NOT NULL,
    `vendor_id` INT UNSIGNED NOT NULL,
    `category_id` INT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_product_vendor_idx` (`vendor_id`),
    INDEX `fk_product_category_idx` (`category_id`),
    CONSTRAINT `fk_product_vendor`
        FOREIGN KEY (`vendor_id`)
            REFERENCES `hillel_shop`.`vendor` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT,
    CONSTRAINT `fk_product_category`
        FOREIGN KEY (`category_id`)
            REFERENCES `hillel_shop`.`category` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
) ENGINE = InnoDB;

--
-- Create table `user`
--
CREATE TABLE IF NOT EXISTS `hillel_shop`.`user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `status` ENUM('ON', 'OFF') NOT NULL DEFAULT 'ON',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_login_psw` (`login`, `password`)
) ENGINE = InnoDB;

--
-- Create table `order`
--
CREATE TABLE IF NOT EXISTS `hillel_shop`.`order` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `order_price` FLOAT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_order_user_idx` (`user_id`),
    CONSTRAINT `fk_order_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `hillel_shop`.`user` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
) ENGINE = InnoDB;

--
-- Create table `user_profile`
--
CREATE TABLE IF NOT EXISTS `hillel_shop`.`user_profile` (
    `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100) NULL,
    `last_name` VARCHAR(100) NULL,
    `phone` BIGINT NULL,
    `birthday` DATE NULL,
    PRIMARY KEY (`user_id`),
    CONSTRAINT `fk_user_profile_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `hillel_shop`.`user` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
) ENGINE = InnoDB;

--
-- Create table `order_product`
--
CREATE TABLE IF NOT EXISTS `hillel_shop`.`order_product` (
    `order_id` INT UNSIGNED NOT NULL,
    `product_id` INT UNSIGNED NOT NULL,
    `quantity` INT UNSIGNED NOT NULL,
    INDEX `fk_order_has_product_product_idx` (`product_id`),
    INDEX `fk_order_has_product_order_idx` (`order_id`),
    CONSTRAINT `fk_order_product_order`
        FOREIGN KEY (`order_id`)
            REFERENCES `hillel_shop`.`order` (`id`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE,
    CONSTRAINT `fk_order_product_product`
        FOREIGN KEY (`product_id`)
            REFERENCES `hillel_shop`.`product` (`id`)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
) ENGINE = InnoDB;
