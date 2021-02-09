-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 25, 2020 at 06:47 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `vanilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Mexico'),
(2, 'Madagascar'),
(3, 'Tahiti'),
(4, 'Reunion');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'How can I cancel my order ?', 'To cancel your order, please send us an email at customerservice@vanilla.com'),
(2, 'How can I update quantities after I added a product to the cart ?', 'Quiet simple, just click on the cart button. Then update the quantity thanks to the form and click on \"update cart\".');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `total`, `created_at`, `user_id`) VALUES
(34, 140, '2020-11-25', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orderDetail`
--

CREATE TABLE `orderDetail` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderDetail`
--

INSERT INTO `orderDetail` (`id`, `quantity`, `total`, `order_id`, `product_id`, `user_id`, `status`) VALUES
(34, 4, 140, 34, 1, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `url`, `product_id`) VALUES
(1, 'https://i.ibb.co/mXg3FGr/1pod-e1553537927999-324x227.jpg', 1),
(2, 'https://i.ibb.co/BVZDy4F/Peter-Majdan-8-1-jpg-23-1-324x227.jpg', 2),
(3, 'https://i.ibb.co/mqZFZVT/https-i-ibb-co-QCPvh-FZ-Prova-vanilla-beans-split-styled-570x854-jpg.jpg', 3),
(4, 'https://i.ibb.co/0yQZxsz/https-i-ibb-co-qs-FDDts-b9a8593dc9b40a6d31613b005dcd9f3b-jpg.jpg', 4),
(5, 'https://i.ibb.co/yQhLqC3/Curio-Spice-Costa-Rican-Vanilla-Powder-Top-Spice-18.jpg', 5),
(6, 'https://i.ibb.co/LQrHn6m/https-i-ibb-co-3-Cd0qnv-92fbae1a9200062fa550ac7be7543bbf-jpg.jpg', 6),
(7, 'https://i.ibb.co/6yZp0DL/https-i-ibb-co-C0-K0m29-c1dc759e1d4a798691ab22563a4d95ea-jpg.jpg', 7),
(8, 'https://i.ibb.co/yVDb056/https-i-ibb-co-k8wwhjk-d6cf739c36311d99aeb1cfea81bfcf66-jpg.jpg', 8),
(9, 'https://i.ibb.co/GRtQQKX/https-i-ibb-co-b-NXSKhv-3342a0e3223e15261eb54961d81f074a-jpg.jpg', 9),
(10, 'https://i.ibb.co/Kz5KTy9/https-i-ibb-co-n-L7hw-Xt-c5ce8b92ee5c8bcf7df7f63e1efdb5b5-jpg.jpg', 10),
(11, 'https://i.ibb.co/fDJbWpQ/https-i-ibb-co-0-YFJx-G1-07a588416f1b5852e57e5329cce5babd-jpg.jpg', 11),
(12, 'https://i.ibb.co/1dDst5z/https-i-ibb-co-Bctww-NW-740a5b6e64a54732af2cce73b85631fa-jpg.jpg', 12),
(13, 'https://i.ibb.co/FBgjrQz/https-i-ibb-co-2vz3v1-D-organic-premium-vanilla-bean-specks-jpg.jpg', 13),
(14, 'https://i.ibb.co/3N4vHYP/https-i-ibb-co-b-HBp4ys-c484ac5e3606235dadf5b7b181c7fcd7-jpg.jpg', 14),
(15, 'https://i.ibb.co/R0cSGFc/https-i-ibb-co-fk-Rnq6-K-46ca9d834b421dffb58eb1492a4bc37f-jpg.jpg ', 15),
(16, 'https://i.ibb.co/5LT1rD5/https-i-ibb-co-F82-DNbv-7d3c4945d8a4315fc218561ded1f0724-jpg.jpg', 16),
(17, 'https://i.ibb.co/Gn47Zjd/https-i-ibb-co-TY1t-MDv-vanilla-vibes-jpg.jpg', 17),
(18, 'https://i.ibb.co/4JjVrW4/https-i-ibb-co-Lt-X94td-intro-1581436991-jpg.jpg', 18),
(19, 'https://i.ibb.co/WVBLJ37/https-i-ibb-co-j8-LSsm5-379dca322bb83a478a9993db4371b1bc-jpg.jpg ', 19),
(20, 'https://i.ibb.co/bNC4mbQ/Copie-de-https-i-ibb-co-mc-M8-Pr-N-11bd61cc02998813148bc787350a1d6b-jpg.jpg', 20),
(21, 'https://i.ibb.co/LSGzgL1/250-1-324x227.jpg', 21),
(22, 'https://i.ibb.co/yPrT55T/250-Icing-1-324x227.jpg', 22),
(23, 'https://i.ibb.co/LSGzgL1/250-1-324x227.jpg', 23),
(24, 'https://i.ibb.co/yPrT55T/250-Icing-1-324x227.jpg', 24);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `activated` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `quantity`, `category_id`, `size_id`, `price`, `content`, `activated`) VALUES
(1, 'Black Bourbon Vanilla Pod', 100, 1, 4, 35, '', 1),
(2, 'Black Bourbon Vanilla Pod', 100, 3, 4, 30, '', 1),
(3, 'Black Bourbon Vanilla Pod', 100, 4, 4, 25, '', 1),
(4, 'Black Bourbon Vanilla Pod', 100, 2, 4, 20, '', 1),
(5, 'Vanilla powder', 100, 1, 2, 55, '', 1),
(6, 'Vanilla powder', 100, 2, 2, 50, '', 1),
(7, 'Vanilla Powder', 100, 3, 4, 45, '', 1),
(8, 'Vanilla Powder', 100, 4, 4, 40, '', 1),
(9, 'Vanilla Extract', 100, 1, 6, 20, '', 1),
(10, 'Vanilla Extract', 100, 2, 6, 20, '', 1),
(11, 'Vanilla Extract', 100, 3, 6, 25, '', 1),
(12, 'Vanilla Extract', 100, 4, 6, 25, '', 1),
(13, 'Bundle Black Bourbon Vanilla Pod', 100, 1, 5, 280, '', 1),
(14, 'Bundle Black Bourbon Vanilla Pod', 100, 2, 5, 270, '', 1),
(15, 'Bundle Black Bourbon Vanilla Pod', 100, 3, 5, 265, '', 1),
(16, 'Bundle Black Bourbon Vanilla Pod', 100, 4, 5, 275, '', 1),
(17, 'Individual Black Bourbon Vanilla Pod', 100, 1, 4, 10, '', 1),
(18, 'Individual Black Bourbon Vanilla Pod', 100, 2, 5, 10, '', 1),
(19, 'Individual Black Bourbon Vanilla Pod', 100, 3, 4, 15, '', 1),
(20, 'Individual Black Bourbon Vanilla Pod', 100, 4, 5, 15, '', 1),
(21, 'Vanilla Sugar', 100, 1, 3, 20, '', 1),
(22, 'Vanilla Sugar', 100, 2, 3, 20, '', 1),
(23, 'Vanilla Sugar', 100, 3, 3, 15, '', 1),
(24, 'Vanilla Sugar', 100, 4, 3, 15, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `number`) VALUES
(1, '50gr'),
(2, '100gr'),
(3, '500gr'),
(4, '6inch'),
(5, '7inch'),
(6, '25ml'),
(7, '50ml'),
(8, '100ml');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `pwd`, `street`, `city`, `email`, `role_id`, `firstname`, `lastname`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', '287 Camden High St, Camden Town', 'London NW1 7BX', 'admin@gmail.com', 1, 'Admin firstname', 'Admin Lastname'),
(13, 'ab4f63f9ac65152575886860dde480a1', 'Palace of Buckingham', 'London SW1A 1AA', 'queenie.e@gmail.com', 2, 'Elisabeth', 'Queen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orderDetail`
--
ALTER TABLE `orderDetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);


ALTER TABLE `category` ADD COLUMN `img` VARCHAR(255) NOT NULL; 

INSERT INTO `category` (`img`) VALUES (`img`)