--Last Change:    
--Reason:         

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Apr 2025 um 15:59
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
-- Tabellenstruktur für Tabelle `testproducts`
--

CREATE TABLE `testproducts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `testproducts`
--

INSERT INTO `testproducts` (`id`, `name`, `description`, `picture`, `price`, `gender`, `size`, `brand`) VALUES
(1, 'Sleek Mirror Finish Phone Case', 'Enhance your smartphone\'s look with this ultra-sleek mirror finish phone case. Designed to offer style with protection, the case features a reflective surface that adds a touch of elegance while keeping your device safe from scratches and impacts. Perfect for those who love a minimalist and modern aesthetic.', 'https://i.imgur.com/yb9UQKL.jpeg', 27.00, NULL, NULL, NULL),
(2, 'Mid-Century Modern Wooden Dining Table', 'Elevate your dining room with this sleek Mid-Century Modern dining table, featuring an elegant walnut finish and tapered legs for a timeless aesthetic. Its sturdy wood construction and minimalist design make it a versatile piece that fits with a variety of decor styles. Perfect for intimate dinners or as a stylish spot for your morning coffee.', 'https://i.imgur.com/DMQHGA0.jpeg', 24.00, NULL, NULL, NULL),
(3, 'Modern Elegance Teal Armchair', 'Elevate your living space with this beautifully crafted armchair, featuring a sleek wooden frame that complements its vibrant teal upholstery. Ideal for adding a pop of color and contemporary style to any room, this chair provides both superb comfort and sophisticated design. Perfect for reading, relaxing, or creating a cozy conversation nook.', 'https://i.imgur.com/6wkyyIN.jpeg', 25.00, NULL, NULL, NULL),
(4, 'Elegant Solid Wood Dining Table', 'Enhance your dining space with this sleek, contemporary dining table, crafted from high-quality solid wood with a warm finish. Its sturdy construction and minimalist design make it a perfect addition for any home looking for a touch of elegance. Accommodates up to six guests comfortably and includes a striking fruit bowl centerpiece. The overhead lighting is not included.', 'https://i.imgur.com/4lTaHfF.jpeg', 67.00, NULL, NULL, NULL),
(5, 'Modern Minimalist Workstation Setup', 'Elevate your home office with our Modern Minimalist Workstation Setup, featuring a sleek wooden desk topped with an elegant computer, stylish adjustable wooden desk lamp, and complimentary accessories for a clean, productive workspace. This setup is perfect for professionals seeking a contemporary look that combines functionality with design.', 'https://i.imgur.com/3oXNBst.jpeg', 49.00, NULL, NULL, NULL),
(6, 'Modern Ergonomic Office Chair', 'Elevate your office space with this sleek and comfortable Modern Ergonomic Office Chair. Designed to provide optimal support throughout the workday, it features an adjustable height mechanism, smooth-rolling casters for easy mobility, and a cushioned seat for extended comfort. The clean lines and minimalist white design make it a versatile addition to any contemporary workspace.', 'https://i.imgur.com/3dU0m72.jpeg', 71.00, NULL, NULL, NULL),
(7, 'Futuristic Holographic Soccer Cleats', 'Step onto the field and stand out from the crowd with these eye-catching holographic soccer cleats. Designed for the modern player, these cleats feature a sleek silhouette, lightweight construction for maximum agility, and durable studs for optimal traction. The shimmering holographic finish reflects a rainbow of colors as you move, ensuring that you\'ll be noticed for both your skills and style. Perfect for the fashion-forward athlete who wants to make a statement.', 'https://i.imgur.com/qNOjJje.jpeg', 39.00, NULL, NULL, NULL),
(8, 'Chic Summer Denim Espadrille Sandals', 'Step into summer with style in our denim espadrille sandals. Featuring a braided jute sole for a classic touch and adjustable denim straps for a snug fit, these sandals offer both comfort and a fashionable edge. The easy slip-on design ensures convenience for beach days or casual outings.', 'https://i.imgur.com/9qrmE1b.jpeg', 33.00, NULL, NULL, NULL),
(9, 'Vibrant Runners: Bold Orange & Blue Sneakers', 'Step into style with these eye-catching sneakers featuring a striking combination of orange and blue hues. Designed for both comfort and fashion, these shoes come with flexible soles and cushioned insoles, perfect for active individuals who don\'t compromise on style. The reflective silver accents add a touch of modernity, making them a standout accessory for your workout or casual wear.', 'https://i.imgur.com/hKcMNJs.jpeg', 27.00, NULL, NULL, NULL),
(10, 'Vibrant Pink Classic Sneakers', 'Step into style with our Vibrant Pink Classic Sneakers! These eye-catching shoes feature a bold pink hue with iconic white detailing, offering a sleek, timeless design. Constructed with durable materials and a comfortable fit, they are perfect for those seeking a pop of color in their everyday footwear. Grab a pair today and add some vibrancy to your step!', 'https://i.imgur.com/mcW42Gi.jpeg', 84.00, NULL, NULL, NULL),
(11, 'Futuristic Silver and Gold High-Top Sneaker', 'Step into the future with this eye-catching high-top sneaker, designed for those who dare to stand out. The sneaker features a sleek silver body with striking gold accents, offering a modern twist on classic footwear. Its high-top design provides support and style, making it the perfect addition to any avant-garde fashion collection. Grab a pair today and elevate your shoe game!', 'https://i.imgur.com/npLfCGq.jpeg', 68.00, NULL, NULL, NULL),
(12, 'Futuristic Chic High-Heel Boots', 'Elevate your style with our cutting-edge high-heel boots that blend bold design with avant-garde aesthetics. These boots feature a unique color-block heel, a sleek silhouette, and a versatile light grey finish that pairs easily with any cutting-edge outfit. Crafted for the fashion-forward individual, these boots are sure to make a statement.', 'https://i.imgur.com/HqYqLnW.jpeg', 36.00, NULL, NULL, NULL),
(13, 'Elegant Patent Leather Peep-Toe Pumps with Gold-Tone Heel', 'Step into sophistication with these chic peep-toe pumps, showcasing a lustrous patent leather finish and an eye-catching gold-tone block heel. The ornate buckle detail adds a touch of glamour, perfect for elevating your evening attire or complementing a polished daytime look.', 'https://i.imgur.com/AzAY4Ed.jpeg', 53.00, NULL, NULL, NULL),
(14, 'Elegant Purple Leather Loafers', 'Step into sophistication with our Elegant Purple Leather Loafers, perfect for making a bold statement. Crafted from high-quality leather with a vibrant purple finish, these shoes feature a classic loafer silhouette that\'s been updated with a contemporary twist. The comfortable slip-on design and durable soles ensure both style and functionality for the modern man.', 'https://i.imgur.com/Au8J9sX.jpeg', 17.00, NULL, NULL, NULL),
(15, 'Classic Blue Suede Casual Shoes', 'Step into comfort with our Classic Blue Suede Casual Shoes, perfect for everyday wear. These shoes feature a stylish blue suede upper, durable rubber soles for superior traction, and classic lace-up fronts for a snug fit. The sleek design pairs well with both jeans and chinos, making them a versatile addition to any wardrobe.', 'https://i.imgur.com/sC0ztOB.jpeg', 39.00, NULL, NULL, NULL),
(16, 'Sleek Futuristic Electric Bicycle', 'This modern electric bicycle combines style and efficiency with its unique design and top-notch performance features. Equipped with a durable frame, enhanced battery life, and integrated tech capabilities, it\'s perfect for the eco-conscious commuter looking to navigate the city with ease.', 'https://i.imgur.com/BG8J0Fj.jpg', 22.00, NULL, NULL, NULL),
(17, 'Sleek All-Terrain Go-Kart', 'Experience the thrill of outdoor adventures with our Sleek All-Terrain Go-Kart, featuring a durable frame, comfortable racing seat, and robust, large-tread tires perfect for handling a variety of terrains. Designed for fun-seekers of all ages, this go-kart is an ideal choice for backyard racing or exploring local trails.', 'https://i.imgur.com/Ex5x3IU.jpg', 37.00, NULL, NULL, NULL),
(18, 'Radiant Citrus Eau de Parfum', 'Indulge in the essence of summer with this vibrant citrus-scented Eau de Parfum. Encased in a sleek glass bottle with a bold orange cap, this fragrance embodies freshness and elegance. Perfect for daily wear, it\'s an olfactory delight that leaves a lasting, zesty impression.', 'https://i.imgur.com/xPDwUb3.jpg', 73.00, NULL, NULL, NULL),
(19, 'Sleek Olive Green Hardshell Carry-On Luggage', 'Travel in style with our durable hardshell carry-on, perfect for weekend getaways and business trips. This sleek olive green suitcase features smooth gliding wheels for easy airport navigation, a sturdy telescopic handle, and a secure zippered compartment to keep your belongings safe. Its compact size meets most airline overhead bin requirements, ensuring a hassle-free flying experience.', 'https://i.imgur.com/jVfoZnP.jpg', 48.00, NULL, NULL, NULL),
(20, 'New Product', 'New Product', 'https://i.imgur.com/Ex5x3IU.jpg', 100.00, NULL, NULL, NULL),
(21, 'product qwerty', 'qwerrtytut sdfhksdf sdfkj', 'https://placeimg.com/640/480/any', 131.00, NULL, NULL, NULL),
(22, 'Jacket 1744723632', 'Null', 'https://placehold.co/600x400', 10.00, NULL, NULL, NULL),
(23, 'Тестовий гаджет 1744722096', 'Новий гаджет для тесту', 'https://placehold.co/600x400', 49.00, NULL, NULL, NULL),
(24, 'shies', 'shoes', 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1744704279~exp=1744707879~hmac=f18ea6b688bda38a79e5107880221640cbe2be3cb5eeeefac6bf8cb59124ab9b&w=740', 25.00, NULL, NULL, NULL),
(25, 'New furniture 2', 'This is updated furniture in our shop', 'https://placehold.co/600x400', 200.00, NULL, NULL, NULL),
(26, 'LOTR I', 'The Fellowship', 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_light_color_272x92dp.png', 3.00, NULL, NULL, NULL),
(27, 'Shoes 1744723702', 'Nike the best!', 'https://placehold.co/600x400', 40.00, NULL, NULL, NULL),
(28, 'Jacket Nike 1744724217', 'Ups....', 'https://placehold.co/600x400', 44.00, NULL, NULL, NULL),
(29, 'shoes2', 'shoes2', 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1744704279~exp=1744707879~hmac=f18ea6b688bda38a79e5107880221640cbe2be3cb5eeeefac6bf8cb59124ab9b&w=740', 20.00, NULL, NULL, NULL),
(30, 'shoes3', 'shoes3', 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1744704279~exp=1744707879~hmac=f18ea6b688bda38a79e5107880221640cbe2be3cb5eeeefac6bf8cb59124ab9b&w=740', 25.00, NULL, NULL, NULL),
(31, 'computer', 'computer', 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1744704279~exp=1744707879~hmac=f18ea6b688bda38a79e5107880221640cbe2be3cb5eeeefac6bf8cb59124ab9b&w=740', 15.00, NULL, NULL, NULL),
(32, 'chair', 'chair', 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1744704279~exp=1744707879~hmac=f18ea6b688bda38a79e5107880221640cbe2be3cb5eeeefac6bf8cb59124ab9b&w=740', 75.00, NULL, NULL, NULL),
(33, 'computer2', 'computer2', 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1744704279~exp=1744707879~hmac=f18ea6b688bda38a79e5107880221640cbe2be3cb5eeeefac6bf8cb59124ab9b&w=740', 25.00, NULL, NULL, NULL),
(34, 'string123', 'stringstringstring', 'string.png', 110.00, 'FEMALE', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(6, 'admin', 'admin@stylung.de', '$2y$10$e4XwgysQY2BJudOVZxdVzOwTKVlHME/bkcMD0JMuhIzpVJLScTTPy');

--
-- Indizes der exportierten Tabellen
--

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
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
