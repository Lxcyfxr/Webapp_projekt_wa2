-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Jun 2025 um 16:11
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webapp_project`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buy_history`
--

CREATE TABLE `buy_history` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `buy_history`
--

INSERT INTO `buy_history` (`order_id`, `user_id`, `date`, `price`) VALUES
(1, 5, '0000-00-00', 47),
(2, 5, '0000-00-00', 100),
(3, 3, '2025-06-10', 50);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `size` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `amount`, `user_id`, `size`) VALUES
(1, 22, 1, 1, 'M'),
(3, 400, 2, 1, 'S');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `info_contacts`
--

CREATE TABLE `info_contacts` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `problem` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `info_contacts`
--

INSERT INTO `info_contacts` (`id`, `email`, `problem`, `submitted_at`) VALUES
(1, 'ka@ka.ka', 'halo ich bin dumm\r\n', '2025-05-21 13:06:07');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `testproducts`
--

CREATE TABLE `testproducts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `size` longtext DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `testproducts`
--

INSERT INTO `testproducts` (`id`, `name`, `description`, `picture`, `price`, `gender`, `size`, `brand`) VALUES
(1, 'Sinsheim T-Shirt', 'Der Klassiker aus dem ersten Semester!', '/../products/product1.png', 19.99, 'NULL', '[\"S\",\"M\",\"L\",\"XL\"]', 'Stylung'),
(2, '\"Foalsch!\" - Cap', 'Du hast einen Drang, den bayrischen Dialekt zu verspotten? Dann ist die \"Foalsch!\"-Cap genau das richtige Piece für dich. Simpel und doch vielsagend!', '/../products/product2.jpg', 9.95, 'NULL', '[\"S\",\"M\",\"L\"]', 'Stylung'),
(3, 'Stylung Patreon Shirt', 'Du möchtest uns unterstützen? Mit dem Patreon Shirt kannst du deine Unterstützung nach Außen zeigen. Hergestellt unter den schlechtesten Bedingungen von Kindern in Uganda, bereichern wir uns maximal.', '/../products/product3.png', 49.90, 'NULL', '[\"XS\",\"S\",\"M\",\"L\",\"XL\"]', 'Stylung'),
(4, 'Tack Tack Tack T-Shirt', 'Peng aus MickeyMaus, kommt schon Leute!', '/../products/product4.png', 9.99, 'NULL', '[\"S\",\"M\"]', 'Stylung'),
(5, 'Auto Product 5', 'Auto-generated product for image 0002T-74X-001-1-790760.jpg', '/../products/0002T-74X-001-1-790760.jpg', 33.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(6, 'Auto Product 6', 'Auto-generated product for image 000BS-MLC-001-1-872384_1 (1).jpg', '/../products/product6.jpeg', 34.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(7, 'Auto Product 7', 'Auto-generated product for image 000CC-39X-001-1-871620_1 (1).jpg', '/../products/000CC-39X-001-1-871620_1 (1).jpg', 35.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(8, 'Auto Product 8', 'Auto-generated product for image 000CH-99X-050-1-930214_1 (1).jpg', '/../products/000CH-99X-050-1-930214_1 (1).jpg', 36.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(9, 'Auto Product 9', 'Auto-generated product for image 000CR-00X-001-1-916435 (1).jpg', '/../products/000CR-00X-001-1-916435 (1).jpg', 36.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(10, 'Auto Product 10', 'Auto-generated product for image 001BZ-70X-001-1-905264_3 (1).jpg', '/../products/001BZ-70X-001-1-905264_3 (1).jpg', 37.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(11, 'Auto Product 11', 'Auto-generated product for image 001CC-01X-001-1-904593 (1).jpg', '/../products/001CC-01X-001-1-904593 (1).jpg', 38.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(12, 'Auto Product 12', 'Auto-generated product for image 001CR-03X-001-1-916082 (1).jpg', '/../products/001CR-03X-001-1-916082 (1).jpg', 39.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(13, 'Auto Product 13', 'Auto-generated product for image 002AK-59X-003-1-859621.jpg', '/../products/002AK-59X-003-1-859621.jpg', 39.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(14, 'Auto Product 14', 'Auto-generated product for image 002BZ-59X-050-1-903504_1 (1).jpg', '/../products/002BZ-59X-050-1-903504_1 (1).jpg', 40.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(15, 'Auto Product 15', 'Auto-generated product for image 002CH-00X-050-1-930968.jpg', '/../products/002CH-00X-050-1-930968.jpg', 41.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(16, 'Auto Product 16', 'Auto-generated product for image 002CR-00X-001-1-916157 (1).jpg', '/../products/002CR-00X-001-1-916157 (1).jpg', 42.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(17, 'Auto Product 17', 'Auto-generated product for image 003CA-39X-001-1-864222.jpg', '/../products/003CA-39X-001-1-864222.jpg', 42.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(18, 'Auto Product 18', 'Auto-generated product for image 003CC-03X-001-1-918693 (1).jpg', '/../products/003CC-03X-001-1-918693 (1).jpg', 43.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(19, 'Auto Product 19', 'Auto-generated product for image 003CR-15X-001-1-916127 (1).jpg', '/../products/003CR-15X-001-1-916127 (1).jpg', 44.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(20, 'Auto Product 20', 'Auto-generated product for image 003DE-08X-010-1-911987 (1).jpg', '/../products/003DE-08X-010-1-911987 (1).jpg', 45.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(21, 'Auto Product 21', 'Auto-generated product for image 004BS-MLC-010-1-879799 (1).jpg', '/../products/product21.jpeg', 45.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(22, 'Auto Product 22', 'Auto-generated product for image 004BZ-09M-004-1-836354.jpg', '/../products/004BZ-09M-004-1-836354.jpg', 46.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(23, 'Auto Product 23', 'Auto-generated product for image 004CA-39X-001-1-864224.jpg', '/../products/004CA-39X-001-1-864224.jpg', 47.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(24, 'Auto Product 24', 'Auto-generated product for image 004CH-MLC-050-1-930944_1 (1).jpg', '/../products/004CH-MLC-050-1-930944_1 (1).jpg', 48.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(25, 'Auto Product 25', 'Auto-generated product for image 004DG-11X-001-1-921893_1.jpg', '/../products/004DG-11X-001-1-921893_1.jpg', 48.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(26, 'Auto Product 26', 'Auto-generated product for image 005CH-08X-050-1-917588_2 (1).jpg', '/../products/005CH-08X-050-1-917588_2 (1).jpg', 49.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(27, 'Auto Product 27', 'Auto-generated product for image 005CR-01X-001-1-916128 (1).jpg', '/../products/005CR-01X-001-1-916128 (1).jpg', 50.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(28, 'Auto Product 28', 'Auto-generated product for image 006BZ-02X-001-1-910655 (1).jpg', '/../products/006BZ-02X-001-1-910655 (1).jpg', 51.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(29, 'Auto Product 29', 'Auto-generated product for image 006CC-05X-001-1-910617 (1).jpg', '/../products/006CC-05X-001-1-910617 (1).jpg', 51.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(30, 'Auto Product 30', 'Auto-generated product for image 006CR-52X-001-1-916129_1 (1).jpg', '/../products/006CR-52X-001-1-916129_1 (1).jpg', 52.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(31, 'Auto Product 31', 'Auto-generated product for image 006DG-01X-001-1-917494.jpg', '/../products/006DG-01X-001-1-917494.jpg', 53.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(32, 'Auto Product 32', 'Auto-generated product for image 007BZ-51X-001-1-836336.jpg', '/../products/007BZ-51X-001-1-836336.jpg', 54.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(33, 'Auto Product 33', 'Auto-generated product for image 007CC-01X-001-1-912149 (1).jpg', '/../products/007CC-01X-001-1-912149 (1).jpg', 54.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(34, 'Auto Product 34', 'Auto-generated product for image 007CR-98X-001-1-915684 (1).jpg', '/../products/007CR-98X-001-1-915684 (1).jpg', 55.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(35, 'Auto Product 35', 'Auto-generated product for image 007DE-55X-010-1-903484.jpg', '/../products/007DE-55X-010-1-903484.jpg', 56.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(36, 'Auto Product 36', 'Auto-generated product for image 008CF-86X-001-1-917495_1 (2).jpg', '/../products/008CF-86X-001-1-917495_1 (2).jpg', 57.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(37, 'Auto Product 37', 'Auto-generated product for image 008CR-05X-001-1-919021.jpg', '/../products/008CR-05X-001-1-919021.jpg', 57.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(38, 'Auto Product 38', 'Auto-generated product for image 008DE-00X-010-1-904744 (1).jpg', '/../products/008DE-00X-010-1-904744 (1).jpg', 58.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(39, 'Auto Product 39', 'Auto-generated product for image 009CC-03X-001-1-910755 (1).jpg', '/../products/009CC-03X-001-1-910755 (1).jpg', 59.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(40, 'Auto Product 40', 'Auto-generated product for image 009CL-99X-050-1-927094 (1).jpg', '/../products/009CL-99X-050-1-927094 (1).jpg', 60.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(41, 'Auto Product 41', 'Auto-generated product for image 009CR-01X-001-1-925258 (1).jpg', '/../products/009CR-01X-001-1-925258 (1).jpg', 60.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(42, 'Auto Product 42', 'Auto-generated product for image 009DG-09X-001-1-917497 (1).jpg', '/../products/009DG-09X-001-1-917497 (1).jpg', 61.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(43, 'Auto Product 43', 'Auto-generated product for image 010CF-01X-001-1-917496_1 (1).jpg', '/../products/010CF-01X-001-1-917496_1 (1).jpg', 62.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(44, 'Auto Product 44', 'Auto-generated product for image 010CG-01X-090-1-942974 (1).jpg', '/../products/010CG-01X-090-1-942974 (1).jpg', 63.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(45, 'Auto Product 45', 'Auto-generated product for image 010CH-08X-050-1-908748 (1).jpg', '/../products/010CH-08X-050-1-908748 (1).jpg', 63.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(46, 'Auto Product 46', 'Auto-generated product for image 011BB-MLC-001-1-828329 (1).jpg', '/../products/011BB-MLC-001-1-828329 (1).jpg', 64.50, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(47, 'Auto Product 47', 'Auto-generated product for image 011BZ-08X-001-1-884297.jpg', '/../products/011BZ-08X-001-1-884297.jpg', 65.25, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(48, 'Auto Product 48', 'Auto-generated product for image 011CC-03X-001-1-908190_1 (1).jpg', '/../products/011CC-03X-001-1-908190_1 (1).jpg', 66.00, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(49, 'Auto Product 49', 'Auto-generated product for image 011CF-01X-001-1-917599_1 (1).jpg', '/../products/011CF-01X-001-1-917599_1 (1).jpg', 66.75, 'MALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(50, 'Auto Product 50', 'Auto-generated product for image 011CF-50X-050-1-917600.jpg', '/../products/011CF-50X-050-1-917600.jpg', 67.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(51, 'Auto Product 51', 'Auto-generated product for image 011CR-01X-001-1-922108 (1).jpg', '/../products/011CR-01X-001-1-922108 (1).jpg', 68.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(52, 'Auto Product 52', 'Auto-generated product for image 011DE-MLC-010-1-903485 (1).jpg', '/../products/011DE-MLC-010-1-903485 (1).jpg', 69.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(53, 'Auto Product 53', 'Auto-generated product for image 012CH-50X-050-1-903965_2.jpg', '/../products/012CH-50X-050-1-903965_2.jpg', 69.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(54, 'Auto Product 54', 'Auto-generated product for image 012CR-30X-001-1-912740 (1).jpg', '/../products/012CR-30X-001-1-912740 (1).jpg', 70.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(55, 'Auto Product 55', 'Auto-generated product for image 012DK-00X-001-1-918694 (2).jpg', '/../products/012DK-00X-001-1-918694 (2).jpg', 71.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(56, 'Auto Product 56', 'Auto-generated product for image 013BZ-01X-001-1-882650.jpg', '/../products/013BZ-01X-001-1-882650.jpg', 72.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(57, 'Auto Product 57', 'Auto-generated product for image 013CC-59X-001-1-904594_1 (1).jpg', '/../products/013CC-59X-001-1-904594_1 (1).jpg', 72.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(58, 'Auto Product 58', 'Auto-generated product for image 013CR-38X-001-1-914799.jpg', '/../products/013CR-38X-001-1-914799.jpg', 73.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(59, 'Auto Product 59', 'Auto-generated product for image 014AU-MLC-010-1-855786 (1).jpg', '/../products/014AU-MLC-010-1-855786 (1).jpg', 74.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(60, 'Auto Product 60', 'Auto-generated product for image 014CC-03X-001-1-910756 (1).jpg', '/../products/014CC-03X-001-1-910756 (1).jpg', 75.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(61, 'Auto Product 61', 'Auto-generated product for image 014CH-55X-050-1-938662.jpg', '/../products/014CH-55X-050-1-938662.jpg', 75.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(62, 'Auto Product 62', 'Auto-generated product for image 014CR-01X-001-1-913602.jpg', '/../products/product62.jpeg', 76.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(63, 'Auto Product 63', 'Auto-generated product for image 015BA-34X-001-1-940454.jpg', '/../products/015BA-34X-001-1-940454.jpg', 77.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(64, 'Auto Product 64', 'Auto-generated product for image 015BZ-86X-050-1-894747_2.jpg', '/../products/015BZ-86X-050-1-894747_2.jpg', 78.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(65, 'Auto Product 65', 'Auto-generated product for image 016BB-03X-001-1-893561 (1).jpg', '/../products/016BB-03X-001-1-893561 (1).jpg', 78.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(66, 'Auto Product 66', 'Auto-generated product for image 016CA-90X-001-1-874936_1 (1).jpg', '/../products/016CA-90X-001-1-874936_1 (1).jpg', 79.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(67, 'Auto Product 67', 'Auto-generated product for image 016CC-MLC-001-1-925261.jpg', '/../products/016CC-MLC-001-1-925261.jpg', 80.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(68, 'Auto Product 68', 'Auto-generated product for image 016CR-03X-001-1-912741.jpg', '/../products/016CR-03X-001-1-912741.jpg', 81.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(69, 'Auto Product 69', 'Auto-generated product for image 017BR-08X-001-1-847147_2.jpg', '/../products/017BR-08X-001-1-847147_2.jpg', 81.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(70, 'Auto Product 70', 'Auto-generated product for image 017CC-01X-001-1-904595 (1).jpg', '/../products/017CC-01X-001-1-904595 (1).jpg', 82.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(71, 'Auto Product 71', 'Auto-generated product for image 017CH-55X-001-1-920196_1.jpg', '/../products/017CH-55X-001-1-920196_1.jpg', 83.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(72, 'Auto Product 72', 'Auto-generated product for image 017CR-03X-001-1-916436 (1).jpg', '/../products/product72.jpeg', 84.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(73, 'Auto Product 73', 'Auto-generated product for image 018BB-33X-001-1-906670_2 (1).jpg', '/../products/018BB-33X-001-1-906670_2 (1).jpg', 84.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(74, 'Auto Product 74', 'Auto-generated product for image 018CC-39X-001-1-917498 (1).jpg', '/../products/018CC-39X-001-1-917498 (1).jpg', 85.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(75, 'Auto Product 75', 'Auto-generated product for image 018CR-00X-001-1-912742 (1).jpg', '/../products/018CR-00X-001-1-912742 (1).jpg', 86.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(76, 'Auto Product 76', 'Auto-generated product for image 019AN-01X-001-1-818630 (1).jpg', '/../products/019AN-01X-001-1-818630 (1).jpg', 87.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(77, 'Auto Product 77', 'Auto-generated product for image 019BB-99X-001-1-906673_2 (1).jpg', '/../products/019BB-99X-001-1-906673_2 (1).jpg', 87.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(78, 'Auto Product 78', 'Auto-generated product for image 019BZ-55X-001-1-904596_1 (1).jpg', '/../products/019BZ-55X-001-1-904596_1 (1).jpg', 88.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(79, 'Auto Product 79', 'Auto-generated product for image 019CR-01X-001-1-916084 (1).jpg', '/../products/019CR-01X-001-1-916084 (1).jpg', 89.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(80, 'Auto Product 80', 'Auto-generated product for image 020AN-01X-001-1-908675 (1).jpg', '/../products/020AN-01X-001-1-908675 (1).jpg', 90.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(81, 'Auto Product 81', 'Auto-generated product for image 020BZ-50X-001-1-910654_1 (1).jpg', '/../products/020BZ-50X-001-1-910654_1 (1).jpg', 90.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(82, 'Auto Product 82', 'Auto-generated product for image 020CA-MLC-001-1-852054.jpg', '/../products/020CA-MLC-001-1-852054.jpg', 91.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(83, 'Auto Product 83', 'Auto-generated product for image 020CH-20X-001-1-912989_5 (1).jpg', '/../products/020CH-20X-001-1-912989_5 (1).jpg', 92.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(84, 'Auto Product 84', 'Auto-generated product for image 020CH-20X-001-1-912989_5.jpg', '/../products/020CH-20X-001-1-912989_5.jpg', 93.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(85, 'Auto Product 85', 'Auto-generated product for image 020CR-00X-001-1-919022_4.jpg', '/../products/020CR-00X-001-1-919022_4.jpg', 93.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(86, 'Auto Product 86', 'Auto-generated product for image 021AN-03X-001-1-910653 (1).jpg', '/../products/021AN-03X-001-1-910653 (1).jpg', 94.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(87, 'Auto Product 87', 'Auto-generated product for image 021BZ-01X-001-1-911372_1 (1).jpg', '/../products/021BZ-01X-001-1-911372_1 (1).jpg', 95.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(88, 'Auto Product 88', 'Auto-generated product for image 021CA-MLC-001-1-845109 (2).jpg', '/../products/021CA-MLC-001-1-845109 (2).jpg', 96.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(89, 'Auto Product 89', 'Auto-generated product for image 021CC-99X-001-1-905983 (1).jpg', '/../products/021CC-99X-001-1-905983 (1).jpg', 96.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(90, 'Auto Product 90', 'Auto-generated product for image 021CR-01X-001-1-919023 (1).jpg', '/../products/021CR-01X-001-1-919023 (1).jpg', 97.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(91, 'Auto Product 91', 'Auto-generated product for image 022AN-02X-001-1-910657 (1).jpg', '/../products/022AN-02X-001-1-910657 (1).jpg', 98.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(92, 'Auto Product 92', 'Auto-generated product for image 022BZ-50X-001-1-908192_5 (1).jpg', '/../products/022BZ-50X-001-1-908192_5 (1).jpg', 99.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(93, 'Auto Product 93', 'Auto-generated product for image 022CA-MLC-001-1-852416_1 (1).jpg', '/../products/022CA-MLC-001-1-852416_1 (1).jpg', 99.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(94, 'Auto Product 94', 'Auto-generated product for image 022CA-MLC-001-1-852416_1 (2).jpg', '/../products/022CA-MLC-001-1-852416_1 (2).jpg', 100.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(95, 'Auto Product 95', 'Auto-generated product for image 1.jpg', '/../products/product95.jpeg', 101.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(96, 'Auto Product 96', 'Auto-generated product for image 11_2.jpg', '/../products/11_2.jpg', 102.00, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(97, 'Auto Product 97', 'Auto-generated product for image 19.jpg', '/../products/19.jpg', 102.75, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(98, 'Auto Product 98', 'Auto-generated product for image 2.jpg', '/../products/product98.jpeg', 103.50, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(99, 'Auto Product 99', 'Auto-generated product for image 21_1.jpg', '/../products/21_1.jpg', 104.25, 'FEMALE', '[\"S\",\"M\",\"L\",\"XL\"]', 'AutoBrand'),
(100, 'T-Shirt \"n-Dimensionaler Hypercube\"', 'Wenn du deinen Freunden schon immer mal den Quantencomputer erklären wolltest, hast du hiermit genau das richtige Stück gefunden.', '/../products/product100.png', 42.42, 'NULL', '[\"XS\",\"S\",\"M\",\"L\",\"XL\"]', 'Stylung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `address` text NOT NULL,
  `role` text NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstName`, `lastName`, `address`, `role`) VALUES
(1, 'admin', 'admin@stylung.de', '$2y$10$e4XwgysQY2BJudOVZxdVzOwTKVlHME/bkcMD0JMuhIzpVJLScTTPy', '', '', '', 'admin'),
(2, 'qeqweqe', 'ka@ka.ka', '$2y$10$iRlfNO1TRSlthsDubicktu4jWT6xSs..1/M/rWp2UzWvpBb/QzSG.', '', '', '', 'user'),
(3, 'les', 'les@les.les', '$2y$10$POIVT4VeQr2UTq/CzvjmLuJ.QRPjlqyL6vRgpDkeMQX/5t.oi9FiG', 'Peter', 'Dom', 'Petersdom 12', 'user'),
(4, 'username', 'email@stylung.de', '$2y$10$MjVPKYm3A9oOUEu5lXClj.2WCY5nEJrWB4KK.AO07zulSW7Jwi1Uq', 'first', 'last', 'efwfrv', 'user'),
(5, 'testaccount', 'effefww@defe.de', '$2y$10$dsVq4gitUcpa4vf3v9PCfu75NBgkB43U3A1Q.cBjO40gJKCG6HIFi', 'lorisfefe', 'testefe', 'fwefergferrgfr', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `buy_history`
--
ALTER TABLE `buy_history`
  ADD PRIMARY KEY (`order_id`);

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `info_contacts`
--
ALTER TABLE `info_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `testproducts`
--
ALTER TABLE `testproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `buy_history`
--
ALTER TABLE `buy_history`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `info_contacts`
--
ALTER TABLE `info_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `testproducts`
--
ALTER TABLE `testproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
