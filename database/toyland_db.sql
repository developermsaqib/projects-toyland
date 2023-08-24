-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 12:15 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toyland_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins_table`
--

CREATE TABLE `admins_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_user_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_mobile` varchar(255) NOT NULL,
  `admin_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins_table`
--

INSERT INTO `admins_table` (`admin_id`, `admin_name`, `admin_user_name`, `admin_email`, `admin_password`, `admin_image`, `admin_mobile`, `admin_address`) VALUES
(1, 'Muhammad Saqib', 'msaqib', 'muhammadsaqib@gmail.com', '$2y$10$2XSlX/ydveMcPlxO9AeaLuohTtQBCwWnhsPdl8QOgkDnIzC/C0boO', 'saqib.jpg', '123', 'abc'),
(4, 'Muhammad', 'saqib', 'muhammadsaqib1@gmail.com', '$2y$10$bIn9AlEMw/ddwUv1WCmZuOWvPICUeRvwEynown.20xmh6dPEZlpZe', 'saqib.jpg', '03178306873', 'village Kalabar');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`product_id`, `ip_address`, `user_name`, `quantity`) VALUES
(2, '::1', '', 2),
(3, '::1', 'msaqib', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(2, '3D Puzzles'),
(9, 'Baby Blocks Toys'),
(6, 'Baby Crib Toys'),
(7, 'Baby Push Toys'),
(8, 'Baby Rattles'),
(4, 'Baby Teethers'),
(3, 'Learning Toys'),
(5, 'Musical Toys'),
(10, 'Stuffed Toys');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_zip_code` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shipped_date` timestamp NULL DEFAULT NULL,
  `delivered_date` timestamp NULL DEFAULT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `unit_price`, `total_amount`, `user_id`, `user_address`, `user_mobile`, `user_city`, `user_zip_code`, `product_id`, `product_quantity`, `invoice_number`, `payment_method`, `order_date`, `shipped_date`, `delivered_date`, `order_status`) VALUES
(1, 8400, 8499, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 2, 1, 1853055936, 'Cash On Delivery', '2022-06-28 19:58:08', NULL, NULL, 'Pending'),
(2, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 1827379267, 'Cash On Delivery', '2022-06-28 19:58:08', NULL, NULL, 'Pending'),
(3, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 813420514, 'Cash On Delivery', '2022-06-28 20:38:47', NULL, NULL, 'Pending'),
(4, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 1492937731, 'Cash On Delivery', '2022-06-28 20:39:25', NULL, NULL, 'Pending'),
(5, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 843170023, 'Cash On Delivery', '2022-06-28 20:41:34', NULL, NULL, 'Pending'),
(6, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 460630041, 'Cash On Delivery', '2022-06-28 20:42:06', NULL, NULL, 'Pending'),
(7, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 105518620, 'Cash On Delivery', '2022-06-28 20:43:29', NULL, NULL, 'Pending'),
(8, 1200, 4929, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 4, 540638028, 'Cash On Delivery', '2022-06-28 20:46:02', NULL, NULL, 'Pending'),
(9, 1200, 3729, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 3, 1973585198, 'Cash On Delivery', '2022-06-28 20:47:30', NULL, NULL, 'Pending'),
(10, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 1138498800, 'Cash On Delivery', '2022-06-28 20:50:26', NULL, NULL, 'Pending'),
(11, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 1909000771, 'Cash On Delivery', '2022-06-28 20:51:01', NULL, NULL, 'Pending'),
(12, 1200, 1329, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 1, 1095117297, 'Cash On Delivery', '2022-06-28 20:52:09', NULL, NULL, 'Pending'),
(13, 1200, 3729, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 4, 3, 1369656454, 'Cash On Delivery', '2022-06-28 20:52:38', NULL, NULL, 'Pending'),
(14, 8400, 25299, 3, 'village and post office kalabat teh topi distt swabi', '03178306873', 'swabi', '23520', 2, 3, 534665470, 'Cash On Delivery', '2022-08-30 16:21:27', '2022-08-30 13:21:06', '2022-08-30 13:21:27', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_video` varchar(255) DEFAULT NULL,
  `product_price` int(255) NOT NULL,
  `shipping_price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `category_title`, `product_description`, `product_keywords`, `product_quantity`, `age`, `product_image1`, `product_image2`, `product_image3`, `product_video`, `product_price`, `shipping_price`, `date`, `status`) VALUES
(2, ' Children Mini Microscope | Mini Portable Handheld Micro With Removable Base - Educational Mini Pocket Handheld Microscope With LED Light As Outdoor Children Stem Toy', ' Learning Toys', ' Learnig Toys, learning toy, Microscope,Mini Microscope,Children Mini Microscope,Mini Portable Handheld Microscope,stem toy,', ' Learnig Toys, learning toy, Microscope,Mini Microscope,Children Mini Microscope,Mini Portable Handheld Microscope,stem toy,', 147, 10, 'STEM learning toy1.jpg', 'STEM learning toy 2.jpg', 'STEM learning toy 3.jpg', 'First Microscope by Educational Insights.mp4', 8400, 99, '2022-08-30 16:18:26', 0),
(3, 'VTech-Zoo-Jamz-Piano', 'Musical Toys', ' Now kids can be rock stars as they sing, play and rock out with the Zoo Jamz Piano by VTech. This 4-in-1 instrument lets them choose what they want to play (piano, violin, xylophone or saxophone) with more than 20 songs and melodies. The zebra piano has ', ' music, musical toys, musical, zebra piano, VTech-Zoo-Jamz-Piano, Piano, Jamz-Piano,Zoo-Jamz-Piano,VTech,VTech-Zoo, VTech-Zoo-Jamz, VTech Zoo, VTech Zoo Jamz, VTech Zoo Jamz Piano', 1, 18, 'VTech-Zoo-Jamz-Piano.jpg', 'VTech-Zoo-Jamz-Piano1.jpg', 'VTech-Zoo-Jamz-Piano - 2.jpg', 'VTech Infant & Toddler_ Zoo Jamz Guitar, Piano and Microphone Features.mp4', 500, 130, '2022-06-28 20:38:51', 1),
(4, 'Comotomo Silicone Baby Teether, Orange', 'Baby Teethers', ' Perfectly Baby Finger Sized - Babies love to chew on their little fingers (and probably yours too). So we thought, why not copy? Comotomo teethers are designed to mimic baby fingers. Intuitive Design - Thoughtfully made to make it easy for your little on', ' Comotomo Silicone Baby Teether, Orange, Baby teethers, teethers, baby products biting fingers', 2, 4, 'Comotomo Silicone Baby Teether, Orange 1.jpg', 'Comotomo Silicone Baby Teether, Orange 2.jpg', 'Comotomo Silicone Baby Teether, Orange 3.jpg', 'Comotomo _ Best. Teether. Ever.mp4', 1200, 129, '2022-06-28 21:05:19', 0),
(5, ' Mini Plush Batman Soft Toys For Babys', 'Stuffed Toys', ' Product details of Mini Plush Batman Soft Toys For Babys Item Type: Dolls Warning: None Age Range: > 3 years old Features: cartoon Features: Mini Features: SOFT Features: Stuffed & Plush Gender: Boys Material: Plush Battery: None Theme: Occupations Model', ' Dolls Prams, ,Kids Toys ,Childrens Toys ,Childrens Scooters ,Peppa Pig Toys ,Eco Friendly Wooden Toys, Sustainable Baby Gifts, Best Presents For 2 Year Olds, Eco Friendly Christmas Presents For Kids, Best Climbing Triangle UK Made, Cute Stuffed Animals, ', 100, 5, 'Mini Plush Batman Soft Toys For Babys 1.jpg', 'Mini Plush Batman Soft Toys For Babys 2.jpg', 'Mini Plush Batman Soft Toys For Babys 3.jpg', '', 660, 109, '2022-08-31 09:43:54', 0),
(6, 'Reversible Octopus Plush Toy Octoplushie Pillow Toys for Kids and Adults', 'Stuffed Toys', ' These super soft toys are perfect for playing, collecting, and cuddling. They make the perfect gift for holidays, birthdays, baby showers', ' Reversible Octopus Plush Toy Octoplushie Pillow Toys for Kids and Adults, stuffed toys, stuffed toy, toys, baby toys,', 150, 4, 'Reversible Octopus Plush Toy Octoplushie Pillow Toys for Kids and Adults 1.jpg', 'Reversible Octopus Plush Toy Octoplushie Pillow Toys for Kids and Adults 2.jpg', 'Reversible Octopus Plush Toy Octoplushie Pillow Toys for Kids and Adults 3.jpg', 'Reversible Octopus Plush.mp4', 495, 105, '2022-08-31 10:01:13', 0),
(7, 'Pop It bracelets -Decopmression Bracelete Style Band for Kids and Adults', 'Baby Push Toys', ' Pop It Fidget Decopmression Bracelete Dimension:23*3*0.5 colour:Multi Best Gift for Kids and Adults Pop it fidget toy watch bracelet', ' Pop It bracelets -Decopmression Bracelete Style Band for Kids and Adults, baby push toys, push toys, pull toys, toys', 138, 9, 'Pop It bracelets -Decompression Bracelet Style Band for Kids and Adults1.jpg', 'Pop It bracelets -Decompression Bracelet Style Band for Kids and Adults2.jpg', 'Pop It bracelets -Decompression Bracelet Style Band for Kids and Adults3.jpg', 'pop it bracelets or watches.mp4', 109, 39, '2022-08-31 10:09:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_mobile` varchar(255) NOT NULL,
  `user_zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `user_name`, `user_email`, `user_password`, `user_ip`, `user_address`, `user_image`, `user_city`, `user_mobile`, `user_zip_code`) VALUES
(1, 'saqib', 'contact.msaqib@gmail.com', '$2y$10$etBctc4fUx6juHc8SViuyeu5xE57xc607/LjHurQ1cJ3z/Bggfpa2', '::1', 'village and post office kalabat teh topi distt swabi', 'saqib.jpg', 'swabi', '03178306873', 0),
(2, 'Saqib1', 'saqib@gmail.com', '$2y$10$etBctc4fUx6juHc8SViuyeu5xE57xc607/LjHurQ1cJ3z/Bggfpa2', '::1', 'village and post office kalabat teh topi distt swabi', 'saqib.jpg', 'swabi', '03178306873', 0),
(3, 'msaqib', 'msaqib@gmail.com', '$2y$10$etBctc4fUx6juHc8SViuyeu5xE57xc607/LjHurQ1cJ3z/Bggfpa2', '::1', 'village and post office kalabat teh topi distt swabi', '1787302232saqib.jpg', 'swabi', '03178306873', 23520);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins_table`
--
ALTER TABLE `admins_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_title` (`category_title`),
  ADD UNIQUE KEY `category_title_2` (`category_title`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_table`
--
ALTER TABLE `admins_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
