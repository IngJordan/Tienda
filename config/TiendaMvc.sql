-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 11, 2020 at 07:42 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TiendaMvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORIES`
--

CREATE TABLE `CATEGORIES` (
  `id_categorie` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `url_page` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CATEGORIES`
--

INSERT INTO `CATEGORIES` (`id_categorie`, `name`, `description`, `url_page`, `parent_id`) VALUES
(1, 'joyas', 'variados', 'index.php', NULL),
(2, 'mujer', 'ropa para mujer', 'index.php', NULL),
(3, 'hombre', 'ropa para hombres', 'index.php', NULL),
(4, 'accesorios', 'variados', 'index.php', NULL),
(5, 'perfumes', '2323', 'index.php', 4),
(6, 'tesoro', '232332', 'index.php', 1),
(7, 'blusas', '23232', 'index.php', 2),
(8, 'zapatos', '121', 'index.php', 3),
(9, 'wekends', '0', '0', 7);

-- --------------------------------------------------------

--
-- Table structure for table `COLORS`
--

CREATE TABLE `COLORS` (
  `id_color` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `count` int(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `fk_id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `COLORS`
--

INSERT INTO `COLORS` (`id_color`, `name`, `count`, `codigo`, `fk_id_product`) VALUES
(1, 'verde', -2, '0', 1),
(2, 'rojo', -2, '0', 2),
(3, 'azul', -2, '0', 3),
(4, 'amarillo', -71, '#F3F70E', 5),
(5, 'violeta', -31, '#781188', 5),
(6, 'cafe', -2, '#804000', 6);

-- --------------------------------------------------------

--
-- Table structure for table `IMAGES`
--

CREATE TABLE `IMAGES` (
  `id_image` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `route` varchar(45) NOT NULL,
  `fk_id_categorie` int(11) DEFAULT NULL,
  `fk_id_product` int(11) DEFAULT NULL,
  `fk_id_brand` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `IMAGES`
--

INSERT INTO `IMAGES` (`id_image`, `name`, `route`, `fk_id_categorie`, `fk_id_product`, `fk_id_brand`) VALUES
(1, 'principal', 'products/product-01.jpg', NULL, 1, NULL),
(2, 'principal', 'products/product-02.jpg', NULL, 2, NULL),
(3, 'principal', 'products/product-03.jpg', NULL, 3, NULL),
(4, 'principal', 'products/product-04.jpg', NULL, 4, NULL),
(5, 'principal', 'products/product-05.jpg', NULL, 5, NULL),
(6, 'principal', 'banners/banner-01.jpg', 4, NULL, NULL),
(7, 'principal', 'banners/banner-02.jpg', 3, NULL, NULL),
(8, 'principal', 'banners/banner-03.jpg', 2, NULL, NULL),
(9, 'principal', 'banners/banner-04.jpg', 1, NULL, NULL),
(10, 'secundaria', 'products/product-01.jpg', NULL, 5, NULL),
(11, 'secundaria', 'products/product-01.jpg', NULL, 5, NULL),
(12, 'secundaria', 'products/product-01.jpg', NULL, 5, NULL),
(13, 'principal', 'products/product-03.jpg', NULL, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `PAYMENTS`
--

CREATE TABLE `PAYMENTS` (
  `id_payment` int(11) NOT NULL,
  `fk_id_status` int(11) NOT NULL,
  `fk_id_sale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS`
--

CREATE TABLE `PRODUCTS` (
  `id_product` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `inventorie` int(45) NOT NULL,
  `discount` int(45) NOT NULL,
  `fk_id_categorie` int(11) DEFAULT NULL,
  `fk_id_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PRODUCTS`
--

INSERT INTO `PRODUCTS` (`id_product`, `name`, `description`, `price`, `inventorie`, `discount`, `fk_id_categorie`, `fk_id_status`) VALUES
(1, 'Herschel supply', 'loremloremloremloremloremloremloremlorem', 1000, 6, 0, 3, 3),
(2, 'Herschel supply', 'loremloremloremloremlorem', 31, 9, 50, 3, 2),
(3, 'Herschel supply12', 'loremloremloremloremloremloremloremlorem', 32, 99, 0, 2, 1),
(4, 'Herschel supply', 'loremloremloremloremlorem', 33, 9, 50, 2, 2),
(5, 'Herschel supply1', 'loremloremloremloremloremloremloremlorem', 20, 8, 0, 4, 1),
(6, 'Herschel supply', 'loremloremloremloremlorem', 34, 7, 0, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS-SOLD`
--

CREATE TABLE `PRODUCTS-SOLD` (
  `id_sold` int(11) NOT NULL,
  `count` int(45) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `characteristic` varchar(45) NOT NULL,
  `fk_id_product` int(11) NOT NULL,
  `fk_id_sale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SALES`
--

CREATE TABLE `SALES` (
  `id_sale` int(11) NOT NULL,
  `total` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SENDS`
--

CREATE TABLE `SENDS` (
  `id_send` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cp` int(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `municipality` varchar(45) NOT NULL,
  `colony` varchar(45) NOT NULL,
  `street` varchar(45) NOT NULL,
  `exterior` varchar(45) NOT NULL,
  `interior` varchar(45) DEFAULT NULL,
  `street1` varchar(45) NOT NULL,
  `street2` varchar(45) NOT NULL,
  `options` varchar(45) NOT NULL,
  `telephone` int(45) NOT NULL,
  `referencias` varchar(45) NOT NULL,
  `fk_id_sale` int(11) NOT NULL,
  `fk_id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SIZES`
--

CREATE TABLE `SIZES` (
  `id_size` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `count` int(45) NOT NULL,
  `fk_id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SIZES`
--

INSERT INTO `SIZES` (`id_size`, `name`, `count`, `fk_id_product`) VALUES
(1, 'g', -36, 5),
(2, 'm', -30, 5),
(3, 'ch', 4, 5),
(4, 'g', 5, 2),
(5, 'm', 0, 3),
(6, 'ch', 0, 4),
(7, 'xl', -30, 5),
(8, 'xl', -2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `STATUS`
--

CREATE TABLE `STATUS` (
  `id_statu` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `STATUS`
--

INSERT INTO `STATUS` (`id_statu`, `name`, `description`, `valor`) VALUES
(1, 'disponible', '0', 0),
(2, 'oferta', 'block2-labelsale', 0),
(3, 'nueva', 'block2-labelnew', 0),
(4, 'procesando', '0', 0),
(5, 'pagado', '0', 0),
(6, 'pago_pendiente', 'autorizar por el banco', 0);

-- --------------------------------------------------------

--
-- Table structure for table `TRADEMARKS`
--

CREATE TABLE `TRADEMARKS` (
  `id_brand` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `valor` int(11) NOT NULL,
  `fk_id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TRADEMARKS`
--

INSERT INTO `TRADEMARKS` (`id_brand`, `name`, `description`, `valor`, `fk_id_product`) VALUES
(1, 'calvin klein', '0', 0, 1),
(2, 'calvin klein', '0', 0, 2),
(3, 'calvin klein', '0', 0, 3),
(4, 'calvin klein', '0', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surnames` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `telephone` int(45) NOT NULL,
  ` date_of_birth` date NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `profile` varchar(45) NOT NULL,
  `date_hours` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  ADD PRIMARY KEY (`id_categorie`),
  ADD KEY `id_parent` (`parent_id`);

--
-- Indexes for table `COLORS`
--
ALTER TABLE `COLORS`
  ADD PRIMARY KEY (`id_color`),
  ADD KEY `fk_id_producttt` (`fk_id_product`);

--
-- Indexes for table `IMAGES`
--
ALTER TABLE `IMAGES`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `fk_id_categorie` (`fk_id_categorie`),
  ADD KEY `fk_id_product` (`fk_id_product`),
  ADD KEY `fk_id_brand` (`fk_id_brand`);

--
-- Indexes for table `PAYMENTS`
--
ALTER TABLE `PAYMENTS`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `fk_id_status` (`fk_id_status`),
  ADD KEY `fk_id_sale` (`fk_id_sale`) USING BTREE;

--
-- Indexes for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_id_categoriee` (`fk_id_categorie`),
  ADD KEY `fk_id_statuu` (`fk_id_status`);

--
-- Indexes for table `PRODUCTS-SOLD`
--
ALTER TABLE `PRODUCTS-SOLD`
  ADD PRIMARY KEY (`id_sold`),
  ADD KEY `fk_id_product` (`fk_id_product`) USING BTREE,
  ADD KEY `fk_id_sales` (`fk_id_sale`);

--
-- Indexes for table `SALES`
--
ALTER TABLE `SALES`
  ADD PRIMARY KEY (`id_sale`),
  ADD KEY `fk_id_user` (`fk_id_user`);

--
-- Indexes for table `SENDS`
--
ALTER TABLE `SENDS`
  ADD PRIMARY KEY (`id_send`),
  ADD KEY `fk_id_saless` (`fk_id_sale`),
  ADD KEY `fk_id_statusss` (`fk_id_status`);

--
-- Indexes for table `SIZES`
--
ALTER TABLE `SIZES`
  ADD PRIMARY KEY (`id_size`),
  ADD KEY `fk_id_productt` (`fk_id_product`);

--
-- Indexes for table `STATUS`
--
ALTER TABLE `STATUS`
  ADD PRIMARY KEY (`id_statu`);

--
-- Indexes for table `TRADEMARKS`
--
ALTER TABLE `TRADEMARKS`
  ADD PRIMARY KEY (`id_brand`),
  ADD KEY `fk_id_productttt` (`fk_id_product`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `COLORS`
--
ALTER TABLE `COLORS`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `IMAGES`
--
ALTER TABLE `IMAGES`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `PAYMENTS`
--
ALTER TABLE `PAYMENTS`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `PRODUCTS-SOLD`
--
ALTER TABLE `PRODUCTS-SOLD`
  MODIFY `id_sold` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SALES`
--
ALTER TABLE `SALES`
  MODIFY `id_sale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `SENDS`
--
ALTER TABLE `SENDS`
  MODIFY `id_send` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SIZES`
--
ALTER TABLE `SIZES`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `STATUS`
--
ALTER TABLE `STATUS`
  MODIFY `id_statu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `TRADEMARKS`
--
ALTER TABLE `TRADEMARKS`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  ADD CONSTRAINT `id_parent` FOREIGN KEY (`parent_id`) REFERENCES `CATEGORIES` (`id_categorie`);

--
-- Constraints for table `COLORS`
--
ALTER TABLE `COLORS`
  ADD CONSTRAINT `fk_id_producttt` FOREIGN KEY (`fk_id_product`) REFERENCES `PRODUCTS` (`id_product`);

--
-- Constraints for table `IMAGES`
--
ALTER TABLE `IMAGES`
  ADD CONSTRAINT `fk_id_brand` FOREIGN KEY (`fk_id_brand`) REFERENCES `TRADEMARKS` (`id_brand`),
  ADD CONSTRAINT `fk_id_categorie` FOREIGN KEY (`fk_id_categorie`) REFERENCES `CATEGORIES` (`id_categorie`),
  ADD CONSTRAINT `fk_id_product` FOREIGN KEY (`fk_id_product`) REFERENCES `PRODUCTS` (`id_product`);

--
-- Constraints for table `PAYMENTS`
--
ALTER TABLE `PAYMENTS`
  ADD CONSTRAINT `fk_id_sale` FOREIGN KEY (`fk_id_sale`) REFERENCES `SALES` (`id_sale`),
  ADD CONSTRAINT `fk_id_status` FOREIGN KEY (`fk_id_status`) REFERENCES `STATUS` (`id_statu`);

--
-- Constraints for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD CONSTRAINT `fk_id_categoriee` FOREIGN KEY (`fk_id_categorie`) REFERENCES `CATEGORIES` (`id_categorie`),
  ADD CONSTRAINT `fk_id_statuu` FOREIGN KEY (`fk_id_status`) REFERENCES `STATUS` (`id_statu`);

--
-- Constraints for table `PRODUCTS-SOLD`
--
ALTER TABLE `PRODUCTS-SOLD`
  ADD CONSTRAINT `fk_id_sales` FOREIGN KEY (`fk_id_sale`) REFERENCES `SALES` (`id_sale`);

--
-- Constraints for table `SALES`
--
ALTER TABLE `SALES`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`fk_id_user`) REFERENCES `USERS` (`id_user`);

--
-- Constraints for table `SENDS`
--
ALTER TABLE `SENDS`
  ADD CONSTRAINT `fk_id_saless` FOREIGN KEY (`fk_id_sale`) REFERENCES `SALES` (`id_sale`),
  ADD CONSTRAINT `fk_id_statusss` FOREIGN KEY (`fk_id_status`) REFERENCES `STATUS` (`id_statu`);

--
-- Constraints for table `SIZES`
--
ALTER TABLE `SIZES`
  ADD CONSTRAINT `fk_id_productt` FOREIGN KEY (`fk_id_product`) REFERENCES `PRODUCTS` (`id_product`);

--
-- Constraints for table `TRADEMARKS`
--
ALTER TABLE `TRADEMARKS`
  ADD CONSTRAINT `fk_id_productttt` FOREIGN KEY (`fk_id_product`) REFERENCES `PRODUCTS` (`id_product`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
