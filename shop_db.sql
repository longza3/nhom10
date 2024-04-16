-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2023 at 06:55 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', 'e57a14bb5a3ccdc260d173d989d187d86d4aabfa'),
(6, 'player', '356a192b7913b04c54574d18c28d46e6395428ab'),
(7, 'nv', 'f97e5ab36598587bc1b8a033b04fcba1a5a4dcd6'),
(8, 'nvv', 'f97e5ab36598587bc1b8a033b04fcba1a5a4dcd6');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `sp` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `key_word_sp` varchar(100) NOT NULL,
  `import_price` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `sp`, `name`, `key_word_sp`, `import_price`, `price`, `total`, `quantity`, `image`) VALUES
(213, 1, 37, 'Laptop Acer Aspire 3 A315 57 379K i3 1005G1/4GB/256GB/Win11 (NX.KAGSV.001)', 'laptop', 7500000, 7990000, 7990000, 2, 'acer-aspire-3-a315-57-379k-i3-nxkagsv001-ab-1-1.jpg'),
(232, 14, 38, 'Điện thoại Samsung Galaxy A24 6GB', 'dtdd', 5380000, 5890000, 0, 1, 'samsung-galaxy-a24-den-1.jpg'),
(233, 14, 24, 'Laptop Apple MacBook Pro 13 inch M1 2020 8-core CPU/16GB/512GB/8-core GPU (Z11C)', 'laptop', 33000000, 34990000, 0, 1, 'space-1-org.jpg'),
(234, 14, 31, 'Laptop Asus Gaming TUF Dash F15 FX517ZE i5 12450H/8GB/512GB/4GB RTX3050Ti/144Hz/Win11 (HN045W)', 'laptop', 20500000, 21990000, 0, 1, 'asus-tuf-gaming-fx517ze-i5-hn045w-2-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `details_order`
--

CREATE TABLE `details_order` (
  `id` int(100) NOT NULL,
  `cart_id` int(100) NOT NULL,
  `products_id` int(100) NOT NULL,
  `key_word` varchar(200) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` int(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `details_order`
--

INSERT INTO `details_order` (`id`, `cart_id`, `products_id`, `key_word`, `user_id`, `user_name`, `address`, `phone_number`, `date`, `quantity`, `price`, `total`) VALUES
(32, 214, 22, 'loa_bluetooth', 3, 'trung kiên', '123, vĩnh tường , Vĩnh Phúc', 335190000, '2023-07-21 14:05:59', 1, 560000, 560000),
(33, 0, 35, 'chuot', 3, 'trung kiên', '123, vĩnh tường , Vĩnh Phúc', 335190000, '2023-07-21 17:36:52', 1, 600000, 600000),
(34, 0, 30, 'chuot', 3, 'trung kiên', '123, vĩnh tường , Vĩnh Phúc', 335190000, '2023-07-21 17:44:09', 1, 2240000, 2240000),
(35, 217, 57, 'cap-dien-thoai', 3, 'trung kiên', '123, vĩnh tường , Vĩnh Phúc', 335190000, '2023-07-21 18:04:57', 1, 490000, 490000),
(38, 220, 19, 'laptop', 3, 'trung kiên', '123, vĩnh tường , Vĩnh Phúc', 335190000, '2023-07-22 09:37:59', 2, 15990000, 31980000),
(39, 221, 58, 'sac-dien-thoai', 3, 'trung kiên', '123, vĩnh tường , Vĩnh Phúc', 335190000, '2023-07-22 09:43:41', 3, 520000, 1560000),
(40, 0, 38, 'dtdd', 14, 'nnnn', 'fff, xxxxxx , Huyện Lục Yên', 787676766, '2023-08-15 16:05:38', 1, 5890000, 5890000),
(41, 0, 25, 'dtdd', 14, 'nnnn', 'fff, xxxxxx , Huyện Lục Yên', 787676766, '2023-08-15 16:05:54', 1, 4590000, 4590000),
(42, 0, 25, 'dtdd', 14, 'nnnn', 'fff, xxxxxx , Huyện Lục Yên', 787676766, '2023-08-15 16:06:43', 1, 4590000, 4590000),
(43, 0, 32, 'dtdd', 14, 'nnnn', 'fff, xxxxxx , Huyện Lục Yên', 787676766, '2023-08-15 16:07:04', 1, 24890000, 24890000),
(44, 0, 36, 'laptop', 14, 'nnnn', 'fff, xxxxxx , Huyện Lục Yên', 787676766, '2023-08-17 00:20:59', 1, 34490000, 34490000),
(45, 227, 55, 'banphim', 15, 'xxxxxx', '4565, hcm , Tỉnh Vĩnh Phúc', 364877525, '2023-08-17 00:32:14', 1, 1490000, 1490000),
(46, 0, 25, 'dtdd', 15, 'xxxxxx', '4565, hcm , Tỉnh Vĩnh Phúc', 364877525, '2023-08-17 00:32:22', 1, 4590000, 4590000),
(47, 0, 36, 'laptop', 15, 'xxxxxx', '4565, hcm , Tỉnh Vĩnh Phúc', 364877525, '2023-08-17 00:32:31', 1, 34490000, 34490000),
(48, 0, 22, 'loa_bluetooth', 15, 'xxxxxx', '4565, hcm , Tỉnh Vĩnh Phúc', 364877525, '2023-08-17 00:32:48', 1, 560000, 560000),
(49, 0, 37, 'laptop', 15, 'xxxxxx', '4565, hcm , Tỉnh Vĩnh Phúc', 364877525, '2023-08-17 00:33:40', 1, 7990000, 7990000),
(50, 0, 38, 'dtdd', 14, '', '', 0, '2023-08-17 11:49:49', 1, 5890000, 5890000),
(51, 0, 24, 'laptop', 14, '', '', 0, '2023-08-17 11:49:53', 1, 34990000, 34990000),
(52, 0, 31, 'laptop', 14, '', '', 0, '2023-08-17 11:49:56', 1, 21990000, 21990000);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`, `date_time`) VALUES
(5, 1, 'Hữu Huy', 'nguyenhuuhuy28122002@gmail.com', '0335196106', 'hi', '2023-07-16 15:08:57'),
(6, 1, 'Hữu Huy', 'nguyenhuuhuy28122002@gmail.com', '0335196106', 'hihi', '2023-07-16 15:09:34'),
(8, 14, 'tẻ', 're@gmail.com', '087', 'hg', '2023-08-17 00:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_import_price` int(200) NOT NULL,
  `total_price` int(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_import_price`, `total_price`, `payment_status`, `date`) VALUES
(54, 3, 'trung kiên', '335190000', 'nhhcutehihi@gmail.com', 'thanh toán khi giao hàng', '123, vĩnh tường , Vĩnh Phúc,  bắc, việt nam - 111111', 'Loa Bluetooth JBL Go Essential  (560000 x 1) = 560000đ ----- ', 450000, 560000, '', '2023-07-21 14:06:21'),
(55, 3, 'trung kiên', '335190000', 'nhhcutehihi@gmail.com', 'thanh toán khi giao hàng', '123, vĩnh tường , Vĩnh Phúc,  bắc, việt nam - 111111', 'Chuột Bluetooth Microsoft Ocean Plastic  (600000 x 1) = 600000đ ----- ', 550000, 600000, '', '2023-07-21 17:37:43'),
(57, 3, 'trung kiên', '335190000', 'nhhcutehihi@gmail.com', 'thanh toán khi giao hàng', '123, vĩnh tường , Vĩnh Phúc,  bắc, việt nam - 111111', 'Cáp Type C - Lightning 1m Apple MM0A3  (490000 x 1) = 490000đ ----- ', 460000, 490000, '', '2023-07-22 09:26:43'),
(58, 3, 'trung kiên', '335190000', 'nhhcutehihi@gmail.com', 'thanh toán khi giao hàng', '123, vĩnh tường , Vĩnh Phúc,  bắc, việt nam - 111111', 'Laptop Acer Aspire 7 Gaming A715 76G 5132 i5 12450H/8GB/512GB/4GB GTX1650/144Hz/Win11 (NH.QMESV.002) (15990000 x 2) = 31980000đ ----- ', 29900000, 31980000, '', '2023-07-22 09:38:07'),
(59, 3, 'trung kiên', '335190000', 'nhhcutehihi@gmail.com', 'thanh toán khi giao hàng', '123, vĩnh tường , Vĩnh Phúc,  bắc, việt nam - 111111', 'Adapter Sạc Type C 20W dùng cho iPhone/iPad Apple MHJE3 (520000 x 3) = 1560000đ ----- ', 1500000, 1560000, 'chưa giải quyết', '2023-07-22 09:43:51'),
(61, 14, 'nnnn', '787676766', 'xxxx@gmail.com', 'momo', 'fff, xxxxxx , Huyện Lục Yên,  bắc, việt nam - 70000', 'Điện thoại Samsung Galaxy A14 6GB (4590000 x 1) = 4590000đ ----- ', 4500000, 4590000, 'chưa giải quyết', '2023-08-15 16:06:52'),
(62, 14, 'nnnn', '787676766', 'xxxx@gmail.com', 'paypal', 'fff, xxxxxx , Huyện Lục Yên,  bắc, việt nam - 70000', 'Điện thoại iPhone 14 Pro 128GB (24890000 x 1) = 24890000đ ----- ', 23890000, 24890000, 'hoàn thành', '2023-08-15 16:07:14'),
(63, 14, 'nnnn', '787676766', 'xxxx@gmail.com', 'thanh toán khi giao hàng', 'fff, xxxxxx , Huyện Lục Yên,  bắc, việt nam - 70000', 'Laptop Apple MacBook Pro 13 inch M2 2022 8-core CPU/8GB/512GB/10-core GPU (MNEJ3SA/A)  (34490000 x 1) = 34490000đ ----- ', 33900000, 34490000, 'hoàn thành', '2023-08-17 00:21:10'),
(64, 15, 'ưer', '364877525', 'admin@gmail.com', 'thanh toán khi giao hàng', '4565, hcm , Tỉnh Vĩnh Phúc,  trung, việt nam - 7000', 'Bàn Phím Cơ Bluetooth Rapoo V700 - 8A (1490000 x 1) = 1490000đ ----- Điện thoại Samsung Galaxy A14 6GB (4590000 x 1) = 4590000đ ----- Laptop Apple MacBook Pro 13 inch M2 2022 8-core CPU/8GB/512GB/10-core GPU (MNEJ3SA/A)  (34490000 x 1) = 34490000đ ----- ', 39600000, 40570000, 'hoàn thành', '2023-08-17 00:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `key_word` varchar(200) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `quantity_sp` int(200) NOT NULL,
  `details` varchar(2000) NOT NULL,
  `details1` varchar(2000) NOT NULL,
  `details2` varchar(2000) NOT NULL,
  `details3` varchar(2000) NOT NULL,
  `details4` varchar(2000) NOT NULL,
  `details5` varchar(2000) NOT NULL,
  `import_price` int(200) NOT NULL,
  `price` int(200) NOT NULL,
  `discount` int(200) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `details_1` varchar(200) NOT NULL,
  `details_2` varchar(200) NOT NULL,
  `details_3` varchar(200) NOT NULL,
  `details_4` varchar(200) NOT NULL,
  `details_5` varchar(200) NOT NULL,
  `details_6` varchar(200) NOT NULL,
  `details_7` varchar(200) NOT NULL,
  `details_8` varchar(200) NOT NULL,
  `details_9` varchar(200) NOT NULL,
  `details_10` varchar(200) NOT NULL,
  `details_11` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `key_word`, `brand`, `quantity_sp`, `details`, `details1`, `details2`, `details3`, `details4`, `details5`, `import_price`, `price`, `discount`, `image_01`, `image_02`, `image_03`, `details_1`, `details_2`, `details_3`, `details_4`, `details_5`, `details_6`, `details_7`, `details_8`, `details_9`, `details_10`, `details_11`, `date`) VALUES
(14, 'điện thoại realme 9i xanh', 'dtdd', 'realme', 0, 'chụp max nét', '', '', '', '', '', 4950000, 5500000, 5005000, 'realme-9i-xanh-1.jpg', 'realme-9i-xanh-2.jpg', 'realme-9i-xanh-12.jpg', '-', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(15, 'Chuột Có dây Gaming Asus TUF M3', 'chuot', ' Asus', 0, 'bền', '', '', '', '', '', 355000, 555000, 490000, 'chuot-gaming-asus-tuf-m3-den-2-org.jpg', 'chuot-gaming-asus-tuf-m3-den-6-org.jpg', 'chuot-gaming-asus-tuf-m3-den-8-org.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(16, 'Chuột Bluetooth Microsoft Arc', 'chuot', 'Microsoft', 7, 'công nghệ cao lại còn giá rẻ', '', '', '', '', '', 2120000, 2620000, 1885000, 'chuot-bluetooth-microsoft-arc-xanh-xam-1-org.jpg', 'chuot-bluetooth-microsoft-arc-xanh-xam-2-org.jpg', 'chuot-bluetooth-microsoft-arc-xanh-xam-11-org.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(17, 'Điện thoại Samsung Galaxy S23+ 5G 512GB ', 'dtdd', 'Samsung', 13, 'Là sản phẩm có kích thước nằm giữa trong bộ ba sản phẩm mới nhà Samsung, Galaxy S23+ 5G 512GB được xem là thiết bị rất đáng quan tâm khi được trang bị một màn hình kích thước lớn, thiết kế bóng bẩy và cấu hình mạnh mẽ. Sản phẩm được đi kèm nhiều tính năng “xịn sò” hứa hẹn đem lại cho người dùng trải nghiệm vô cùng trọn vẹn.\r\nThiết kế sang trọng, mặt lưng tối giản', '', '', '', '', '', 22000000, 29990000, 19990000, 'samsung-galaxy-s23-plus-den-1.jpg', 'man-hinh-s23-plus-1020x570.jpg', 'tong-quan-s23-plus-1020x570.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(18, 'Laptop Apple MacBook Air 13 inch M1 2020 8-core CPU/8GB/256GB/7-core GPU (MGN63SA/A)', 'laptop', 'Apple', 24, 'Laptop Apple MacBook Air M1 2020 thuộc dòng laptop cao cấp sang trọng có cấu hình mạnh mẽ, chinh phục được các tính năng văn phòng lẫn đồ hoạ mà bạn mong muốn, thời lượng pin dài, thiết kế mỏng nhẹ sẽ đáp ứng tốt các nhu cầu làm việc của bạn.\r\nChip Apple M1 tốc độ xử lý nhanh gấp 3.5 lần thế hệ trước', '', '', '', '', '', 20000000, 22000000, 18390000, 'grey-1-org.jpg', 'grey-2-org.jpg', 'grey-5-org.jpg', 'Apple M1', '8 GB', '256 GB SSD', '13.3 inch, Retina (2560 x 1600)', 'Card tích hợp, 7 nhân GPU', 'Jack tai nghe 3.5 mm, 2 x Thunderbolt 3 (USB-C)', 'Mac OS', 'Vỏ kim loại nguyên khối', 'Dài 304.1 mm - Rộng 212.4 mm - Dày 4.1 mm đến 16.1 mm - Nặng 1.29 kg', '2020', '', '2023-07-19 17:27:40'),
(19, 'Laptop Acer Aspire 7 Gaming A715 76G 5132 i5 12450H/8GB/512GB/4GB GTX1650/144Hz/Win11 (NH.QMESV.002)', 'laptop', 'Acer', 15, 'Một dòng laptop Gaming được cải tiến hoàn toàn mới đến từ nhà Acer, Acer Aspire 7 Gaming 2023 mang ngoại hình tối giản, đẹp mắt cùng những thông số cấu hình mạnh mẽ, vừa đáp ứng được việc chiến game, vừa xử lý hiệu quả mọi tác vụ thường ngày. Laptop Acer Aspire 7 Gaming A715 76G 5132 i5 12450H (NH.QMESV.002) chắc chắn sẽ là sự lựa chọn hoàn hảo dành cho bạn.\r\n\r\n', '• So với thế hệ trước, Acer Aspire 2023 sở hữu phiên bản nâng cấp hơn với chip Intel thế hệ 12 tân tiến Intel Core i5 12450H kết hợp card đồ họa NVIDIA GeForce GTX 1650 4 GB, bạn có thể chiến dễ dàng các tựa game phổ biến, xử lý được các phần mềm chỉnh sửa, thiết kế 2D, 3D cơ bản hay làm việc, giải trí trơn tru hơn.', '• Bộ nhớ RAM 8 GB với khả năng nâng cấp tối đa 32 GB cùng tốc độ Bus cao lên đến 3200 MHz giúp các trải nghiệm chiến game thêm mượt mà hạn chế được hiện tượng giật lag hay gián đoạn.', '• Ổ cứng 512 GB SSD NVMe PCIe cho phép bạn truy xuất hay khởi động phần mềm, game nhanh chóng. Bên cạnh đó, với phiên bản Acer Aspire 7 Gaming lần này còn hỗ trợ cho bạn dễ dàng tháo lắp để nâng cấp và 1 khe cắm SSD M.2 PCIe mở rộng để tăng dung lượng lưu trữ lên tối đa tận 2 TB.', '• Hệ thống tản nhiệt gồm 3 ống đồng và 2 quạt giúp duy trì nhiệt độ máy ở mức thấp, đảm bảo hiệu suất chơi game hay làm việc ổn định.', '• Laptop Acer Aspire 2023 được hoàn thiện với các chi tiết tinh giản, góc cạnh, logo máy nhỏ được đặt gọn phía bên trên nắp lưng cùng thiết kế bản lề chìm tạo nên vẻ đẹp cuốn hút hơn rất nhiều so với', 14950000, 18990000, 15990000, 'acer-aspire-7-gaming-a715-76g-5132-i5-nhqmesv002-glr-1.jpg', 'acer-aspire-7-gaming-a715-76g-5132-i5-nhqmesv002-glr-2.jpg', 'acer-aspire-7-gaming-a715-76g-5132-i5-nhqmesv002-glr-4.jpg', 'i5, 12450H, 2GHz', '8 GB, DDR4 2 khe (1 khe 8 GB + 1 khe rời), 3200 MHz', '512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 2 TB), Hỗ trợ thêm 1 khe cắm SSD M.2 PCI', '15.6 inch, Full HD (1920 x 1080), 144Hz', 'Card rời, GTX 1650 4GB', 'HDMI, LAN (RJ45), 3 x USB 3.2, Jack tai nghe 3.5 mm, 1 x USB Type-C (hỗ trợ USB, DisplayPort, Thunde', 'Windows 11 Home SL', 'Vỏ nhựa - nắp lưng bằng kim loại', 'Dài 362.3 mm - Rộng 237.4 mm - Dày 19.9 mm - Nặng 2.1 kg', ' 2023', '', '2023-07-19 17:27:40'),
(20, 'Loa Bluetooth JBL Go 3 ', 'loa_bluetooth', 'JBL', 18, 'Sang trọng, hiện đại, kích thước nhỏ gọn dễ mang theo.\r\nKết nối nhanh chóng, ổn định, mượt mà với Bluetooth 5.1.\r\nCông suất 4.2 W với công nghệ JBL Pro Sound cho âm thanh mạnh mẽ, sống động.\r\nKháng bụi, chống nước chuẩn IP67.\r\nSạc đầy pin trong 2.5 giờ, sử dụng lên đến 5 giờ.', '', '', '', '', '', 850000, 1090000, 890000, 'bluetooth-jbl-go-3-xanh-hong-1.jpg', 'bluetooth-jbl-go-3-xanh-hong-6.jpg', 'bluetooth-jbl-go-3-xanh-hong-5.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(21, 'Loa Bluetooth Mozard E7 ', 'loa_bluetooth', 'Mozard', 79, 'Thiết kế với kiểu dáng hình trụ bo tròn đẹp mắt.\r\n\r\n\r\n', '', 'Công nghệ Bluetooth 4.2 kết nối mượt mà trong khoảng cách 10 m.', 'Công suất 5 W cho âm thanh phát ra lớn và sống động.\r\n', 'Trang bị chức năng TWS kết nối 2 loa với nhau (chỉ tương thích loa Mozard E7).', 'Dung lượng pin 1500 mAh cho thời gian sử dụng khoảng khoảng 5 giờ (âm lượng 80%), khoảng 3 giờ (âm lượng 100%), thời gian sạc cho loa khoảng 4 giờ.', 500000, 700000, 560000, 'loa-bluetooth-mozard-e7-den-1-org.jpg', 'loa-bluetooth-mozard-e7-den-8-org.jpg', 'loa-bluetooth-mozard-e7-den-7-org.jpg', '5 W', 'Pin', 'Dùng khoảng 4 - 5 tiếng, Sạc khoảng 4 tiếng', 'Bluetooth 4.2', 'Thẻ nhớ Micro SD, Jack 3.5mm', 'Có micro đàm thoại, Kết nối không dây nhiều loa cùng lúc', 'Nút nguồn, Tăng/giảm âm lượng, Phát/dừng chơi nhạc', 'H2VP', 'Mozard.', '', '', '2023-07-19 17:27:40'),
(22, 'Loa Bluetooth JBL Go Essential ', 'loa_bluetooth', 'JBL', 44, 'Thiết kế vuông vức cùng màu sắc thời thượng, tạo cảm giác sang trọng cho loa.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '', 'Linh động mang theo với khối lượng chỉ 180 g, kích thước nhỏ nhắn, bỏ vừa lòng bàn tay.', 'Công suất 3.1 W cùng màng loa 44 mm cho âm thanh to rõ, đáp ứng tốt nhu cầu sử dụng cá nhân.', 'Loa JBL này được trang bị công nghệ Bluetooth 4.2, ổn định kết nối trong bán kính 10 m.', 'Nhận năng lượng bằng cách cắm điện trực tiếp hoặc dùng pin.', 450000, 790000, 560000, 'loa-bluetooth-jbl-go-essential-1-1.jpg', 'loa-bluetooth-jbl-go-essential-7.jpg', 'loa-bluetooth-jbl-go-essential-8.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(24, 'Laptop Apple MacBook Pro 13 inch M1 2020 8-core CPU/16GB/512GB/8-core GPU (Z11C)', 'laptop', 'Apple', 7, 'Chip Apple M1 là một bộ vi xử lý mạnh mẽ, được ra mắt lần đầu tiên trên máy Mac. Đây là con chip sản xuất trên tiến trình 5 nm, tích hợp CPU 8 lõi với 4 lõi CPU tốc độ và và 4 lõi tiết kiệm năng lượng. Nhờ vậy, thời lượng pin của laptop được kéo dài đến tận 10 tiếng đồng hồ, giúp cho bạn thoải mái làm việc với một hiệu suất cực kỳ cao.\r\n\r\n\r\n\r\n\r\n\r\n', 'Laptop SSD 512 GB giúp bạn tăng tốc toàn diện máy tính với tốc độ khởi động, mở ứng dụng, truyền dữ liệu nhanh vượt trội so với ổ cứng HDD truyền thống. Bên cạnh đó, RAM 16 GB của laptop giúp nâng cao khả năng đa nhiệm, dễ dàng mở những tập tin lớn, nặng hay mở nhiều trình duyệt cùng lúc nhưng không xảy ra tình trạng giật lag.', 'chiếc laptop phiên bản thời thượng với vỏ kim loại nguyên khối cực kỳ sang trọng, nhỏ gọn và thời trang. Bạn cũng có thể dễ dàng cho Macbook Pro 2020 vào cặp xách hay balo, cầm trên tay nhẹ nhàng để di chuyển bất cứ nơi đâu chỉ với khối lượng 1.4 kg và mỏng 15.6 mm.', 'Được trang bị cổng kết nối USB Type-C hỗ trợ kết nối 2 chiều cực kỳ tiện lợi với 2 cổng Thunderbolt 3, đem đến tốc độ nhanh hơn nhiều so với các cổng kết nối trước đây. Ngoài ra, MacBook bạn còn có các cổng kết nối không dây khác như Wi-Fi 6 802.11ax, Bluetooth 5.0 giữ cho đường truyền luôn ổn định để phục vụ tốt cho những công việc của bạn.', 'Với độ phân giải 2560 x 1600 vô cùng sắc nét, màn hình Retina 13.3 inch hiển thị lý tưởng mọi nội dung bạn cần theo dõi, từ trang web, văn bản rõ ràng cho đến những đoạn phim sống động.', 'Ấn tượng hơn nữa, với độ sáng màn hình lên đến 500 nits, bạn sẽ có được một trải nghiệm ánh sáng tuyệt vời trên một màn hình hiển thị hình ảnh cực kỳ sống động và chân thật. Bên cạnh đó, với tấm nền IPS, bạn sẽ đắm chìm vào một thế giới màu sắc vô cùng rực rỡ và có được một góc nhìn rộng hơn.', 33000000, 42690000, 34990000, 'space-1-org.jpg', 'space-2-org.jpg', 'apple-macbook-pro-2020-z11c-30.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(25, 'Điện thoại Samsung Galaxy A14 6GB', 'dtdd', 'Samsung', 56, 'Samsung Galaxy A14 4G được thiết kế với sự thừa hưởng vẻ đẹp tinh tế đến từ dòng sản phẩm cao cấp Galaxy S23 series. Với vẻ đẹp hiện đại, màu sắc thanh lịch và góc cạnh bo tròn tinh tế, những điều này đem đến cho máy một cái nhìn cao cấp hơn về thiết kế để giúp bất kỳ ai khi cầm nắm đều trở nên sang trọng.\r\n\r\n\r\n\r\n\r\n\r\n', 'Bởi vì máy thuộc phân khúc giá rẻ nên tấm nền mà hãng sử dụng cho Galaxy A14 4G cũng chỉ nằm ở mức PLS LCD, nhưng đổi lại thì hãng cũng sẽ hỗ trợ cho điện thoại độ phân giải đạt mức Full HD+ thay vì HD+ như trên một vài đối thủ trong phân khúc, nhờ đó mà hình ảnh được tái hiện sắc nét hơn giúp mọi nội dung đều trở nên chân thực.', 'Samsung Galaxy A14 4G không chỉ gây ấn tượng bởi hiệu năng ổn định, thiết kế mới lạ mà còn nằm ở hệ thống camera sắc nét, bao gồm cảm biến chính 50 MP đi kèm ống kính siêu rộng 5 MP và camera macro 2 MP, mặt trước thì sẽ là camera selfie độ phân giải 13 MP.', 'Ảnh chụp mà Samsung Galaxy A14 4G cho ra ở điều kiện đủ sáng có chất lượng hình ảnh rõ ràng, khả năng tái tạo màu sắc ổn, vì vậy người dùng hoàn toàn có thể tự tin lưu giữ lại trọn vẹn vẻ đẹp của từng khoảnh khắc. Với mức giá không quá cao nhưng lại sở hữu bộ camera tốt như vậy thì đây quả thực là sản phẩm giá rẻ đáng cân nhắc dành cho những bạn đam mê chụp ảnh.', 'Chuyển sang về mặt hiệu năng, Samsung Galaxy A14 4G được trang bị chip Exynos 850, đây là một gương mặt mà rất nhiều nhà sản xuất điện thoại Android lựa chọn cho các sản phẩm giá rẻ - tầm trung của mình bởi sức mạnh mà vi xử lý mang lại cùng mức giá phải chăng.', 'Samsung Galaxy A14 4G có dung lượng pin khủng đến 5000 mAh và hỗ trợ sạc có công suất 15 W. Đặc biệt khi bật chế độ siêu tiết kiệm pin, thiết bị vẫn có thể đá', 4500000, 5000000, 4590000, 'samsung-galaxy-a14-4g-den-1-1.jpg', 'samsung-galaxy-a14-4g-tem-20-1.jpg', 'samsung-galaxy-a14-4g-den-9.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(26, 'Laptop Asus TUF Gaming F15 FX506LHB i5 10300H/8GB/512GB/4GB GTX1650/144Hz/Win11 (HN188W)', 'laptop', 'Asus', 14, 'CPU Intel Core i5 10300H thế hệ thứ 10 với 4 nhân và 8 luồng, tốc độ xung nhịp cơ bản 2.50 GHz và tần số tăng tốc tối đa lên đến 4.5 GHz. Một bộ vi xử lý mạnh mẽ có thể đáp ứng được nhiều nhu cầu như chơi game, làm việc văn phòng, làm đồ họa và xử lý video. CPU cũng hỗ trợ các công nghệ tiên tiến như Intel Turbo Boost và Intel Hyper Threading để tăng hiệu suất cũng như tăng cường khả năng xử lý đa nhiệm.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '', 'Laptop Asus được trang bị RAM 8 GB DDR4, đủ để xử lý hầu hết các tác vụ và trò chơi không quá nặng. Nếu có nhu cầu cao hơn bạn có thể nâng cấp RAM lên tối đa 32 GB để giúp cho việc xử lý đa nhiệm trên máy tính trở nên trơn tru hơn, đồng thời cũng khiến cho các ứng dụng và trò chơi hoạt động nhanh và mượt mà hơn. Dung lượng RAM cao cũng giúp tránh hiện tượng giật hoặc lag khi sử dụng nhiều ứng dụng cùng lúc.', 'Với ổ cứng SSD dung lượng lưu trữ 512 GB không chỉ có tốc độ truy xuất dữ liệu cao, giúp tối ưu tốc độ khởi động máy mà còn cho phép người dùng lưu trữ nhiều ứng dụng và dữ liệu. Nếu cần thêm không gian lưu trữ, bạn cũng có thể tháo ra ổ SSD trong máy ra lắp ổ khác tối đa 1 TB.', 'Card đồ họa NVIDIA GeForce GTX 1650 với bộ nhớ VRAM 4 GB đủ mạnh để chơi được hầu hết các game phổ biến hiện nay như: PUBG, Valorant, GTA V, Assassin\'s Creed, The Witcher 3,... Tuy nhiên, để chơi các game nặng hơn như Cyberpunk 2077, Call of Duty: Warzone, bạn nên cân nhắc giảm độ phân giải hoặc chỉnh mức cấu hình thấp hơn để đảm bảo tốc độ khung hình cũng như chơi với độ mượt mà và ổn định hơn.\r\n', 'Hệ thống tản nhiệt của Asus TUF Gaming F15 được thiết kế khá đặc biệt để đảm bảo khả năng làm mát tốt cho các linh kiện bên trong máy. Thiết bị có 2 quạt làm mát và 2 ống dẫn nhiệt chuyên dụng để tản nhiệt cho bộ vi xử lý và card đồ họa. Khe thông gió được bố trí ở cạnh mặt trên của máy, giúp lưu thông không khí một cách hiệu quả.', 15000000, 20990000, 15490000, 'vi-vn-asus-tuf-gaming-fx506lhb-i5-hn188w-1.jpg', 'asus-tuf-gaming-fx506lhb-i5-hn188w-10-1020x570.jpg', 'vi-vn-asus-tuf-gaming-fx506lhb-i5-hn188w-3.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(30, 'Chuột Bluetooth Apple MK2E3', 'chuot', 'Apple', 14, 'Công nghệ Multi-Touch, cổng sạc Lightning.\r\n\r\n\r\n', 'Tương thích máy Mac hỗ trợ Bluetooth với hệ điều hành MacOS.', 'Sản phẩm chính hãng Apple.', 'Thiết kế siêu nhẹ và tính ứng dụng cao hơn.', 'Sản phẩm nhỏ gọn, trọng lượng chỉ khoảng 80 g, bề mặt đa cảm ứng giúp cho bạn sử dụng nhanh nhạy đa điểm hơn.', '\r\n\r\nLưu ý: Thanh toán trước khi mở seal.', 2133000, 2490000, 2240000, 'chuot-bluetooth-apple-mk2e3-trang-1.jpg', 'chuot-bluetooth-apple-mk2e3-trang-2.jpg', 'chuot-bluetooth-apple-mk2e3-trang-3.jpg', '', '', '', '', '', '', '', '', '', '', '', '2023-07-19 17:27:40'),
(31, 'Laptop Asus Gaming TUF Dash F15 FX517ZE i5 12450H/8GB/512GB/4GB RTX3050Ti/144Hz/Win11 (HN045W)', 'laptop', 'Asus', 15, 'Laptop Asus TUF Gaming mang trong mình hiệu năng vượt trội đến từ bộ vi xử lý Intel Core i5 12450H, đạt số điểm ấn tượng 10817 điểm đa nhân và 1688 điểm đơn nhân khi mình đo hiệu năng bằng công cụ Cinebench R23, sẵn sàng cân mọi tác vụ học tập, văn phòng từ nhẹ đến nặng. Bên cạnh đó, card rời GeForce RTX 3050 Ti 4 GB với điểm số 3DMark mình đo đạc được tổng 5856 điểm GPU cũng cho phép mình làm chủ mọi chiến trường ảo hay xử lý trơn tru các tác vụ thiết kế, đồ họa. \r\n\r\n', '', '', '', '', '', 20500000, 29990000, 21990000, 'asus-tuf-gaming-fx517ze-i5-hn045w-2-1.jpg', 'asus-tuf-gaming-fx517ze-i5-hn045w-3-1.jpg', 'asus-tuf-gaming-fx517ze-i5-hn045w-1-1.jpg', 'i5, 12450H, 2GHz', '8 GB, DDR5 2 khe (1 khe 8 GB + 1 khe trống), 4800 MHz', '512 GB SSD NVMe PCIe, Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng', '15.6 inch, Full HD (1920 x 1080), 144Hz', 'Card rời, RTX 3050Ti 4GB', 'USB Type-C, Thunderbolt 4, HDMI, LAN (RJ45), Jack tai nghe 3.5 mm, 2 x USB 3.2', 'Windows 11 Home SL', ' Vỏ nhựa - nắp lưng bằng kim loại', 'Dài 354 mm - Rộng 251 mm - Dày 20.7 mm - Nặng 2 kg', '2022', '', '2023-07-19 17:27:40'),
(32, 'Điện thoại iPhone 14 Pro 128GB', 'dtdd', 'Apple', 22, 'iPhone 14 Pro 128GB - Mẫu smartphone đến từ nhà Apple được mong đợi nhất năm 2022, lần này nhà Táo mang đến cho chúng ta một phiên bản với kiểu thiết kế hình notch mới, cấu hình mạnh mẽ nhờ con chip Apple A16 Bionic và cụm camera có độ phân giải được nâng cấp lên đến 48 MP.', '', '', '', '', '', 23890000, 27990000, 24890000, 'iphone14-pro-1.jpg', 'iphone14-pro-9.jpg', 'iphone14-pro-8.jpg', 'OLED, 6.1 inch, Super Retina XDR', 'iOS 16', ' Chính 48 MP & Phụ 12 MP, 12 MP', '12 MP', 'Apple A16 Bionic', '6 GB', '128 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '3200 mAh, 20 W', ' 09/2022', '', '2023-07-19 17:27:40'),
(33, 'Laptop Asus Vivobook X415EA i3 1115G4/8GB/256GB/Win11 (EK2034W)', 'laptop', 'Asus', 13, '• Laptop Asus Vivobook với bộ vi xử lý Intel Core i3 1115G4 thế hệ thứ 11 và tốc độ xung nhịp lên đến 4.1 GHz đảm bảo sức mạnh và hiệu suất cao, đủ tốt để xử lý các tác vụ học tập, làm việc văn phòng trên Word, Excel, PowerPoint,... \r\n\r\n\r\n\r\n\r\n\r\n• Màn hình kích thước 14 inch với độ phân giải Full HD (1920 x 1080) cung cấp hình ảnh sắc nét, đáp ứng nhu cầu xem video, làm việc thường ngày. Công nghệ chống chói Anti Glare giảm thiểu ánh sáng phản chiếu và lóa mắt khi sử dụng trong môi trường ánh sáng mạnh.\r\n\r\n• Công nghệ SonicMaster audio được tối ưu hóa để tăng cường độ rõ nét, độ sâu và âm lượng của âm thanh, từ đó mang đến trải nghiệm giải trí thêm phần tuyệt vời hơn.\r\n\r\n• Với thiết kế mỏng nhẹ, khối lượng chỉ 1.55 kg, bạn có thể dễ dàng mang theo Asus Vivobook X415EA khi di chuyển. Vỏ máy được làm bằng nhựa cao cấp, bề mặt phủ màu bạc sang trọng, tạo nên một thiết kế đơn giản nhưng hiện đại.\r\n\r\n• Laptop cũng được trang bị đầy đủ các cổng giao tiếp như: USB Type-A, USB Type-C, HDMI và Jack tai nghe 3.5 mm, giúp bạn kết nối với các thiết bị khác một cách dễ dàng.', '• Laptop Asus cũng được trang bị card đồ họa Intel UHD Graphics có khả năng xử lý đồ họa và chơi game đơn giản, giúp đáp ứng nhu cầu giải trí và làm việc đồ họa 2D cơ bản của người dùng.', '• Bộ nhớ RAM 8 GB DDR4 cho phép bạn làm việc đa nhiệm mượt mà, mờ cùng lúc nhiều ứng dụng văn phòng mà không lo giật lag, cùng với ổ cứng SSD 256 GB giúp nâng cao tốc độ khởi động và load các ứng dụng nhanh chóng.', '', '', '', 9000000, 11490000, 9790000, 'asus-vivobook-x415ea-i3-ek2034w-abc-glr-12.jpg', 'asus-vivobook-x415ea-i3-ek2034w-abc-glr-3.jpg', 'asus-vivobook-x415ea-i3-ek2034w-abc-glr-11.jpg', 'i3, 1115G4, 3GHz', '8 GB, DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống), 3200 MHz', '256 GB SSD NVMe PCIe, Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng', '14 inch, Full HD (1920 x 1080)', 'Card tích hợp, Intel UHD', 'USB Type-C, 2 x USB 2.0, HDMI ,Jack tai nghe 3.5 mm, 1 x USB 3.2', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 325.4 mm - Rộng 216 mm - Dày 19.9 mm - Nặng 1.55 kg', '2022', '', '2023-07-19 17:27:40'),
(35, 'Chuột Bluetooth Microsoft Ocean Plastic ', 'chuot', 'Microsoft', 120, 'Tông màu trắng sữa phối vân hạt muối tiêu màu xám kết hợp bi lăn chuột xanh tinh tế, đẹp mắt.\r\n\r\n• Chuột Microsoft được thiết kế không dây kết nối qua Bluetooth.\r\n\r\n• Khoảng cách kết nối ổn định đến 10 m trong khu vực mở, tối đa 5 m ở không gian văn phòng.\r\n\r\n• Chuột Bluetooth có độ phân giải 400 - 1800 DPI sử dụng phù hợp cho nhiều nhu cầu.\r\n\r\n• Chuột không dây sử dụng 1 viên pin AA, thời gian sử dụng đến 12 tháng.\r\n\r\n• Tương thích tốt với máy tính chạy hệ điều hành Windows, thiết bị hỗ trợ Bluetooth 4.0 trở lên.', '', '', '', '', '', 550000, 750000, 600000, 'chuot-bluetooth-microsoft-ocean-plastic-xam-trang-2-1.jpg', 'chuot-bluetooth-microsoft-ocean-plastic-xam-trang-9.jpg', 'chuot-bluetooth-microsoft-ocean-plastic-xam-trang-6.jpg', 'macOS (MacBook, iMac), Windows', '400 - 1800 DPI', 'Bluetooth', '10 m', '1 viên pin AA', ' 84 g', 'Mỹ', 'Trung Quốc', 'Microsoft.', '', '', '2023-07-19 17:27:40'),
(36, 'Laptop Apple MacBook Pro 13 inch M2 2022 8-core CPU/8GB/512GB/10-core GPU (MNEJ3SA/A) ', 'laptop', 'Apple', 40, 'Không chỉ đẳng cấp ở phong cách thiết kế, chiếc MacBook Pro M2 512 GB còn thống trị về sức mạnh hiệu năng với sự xuất hiện của con chip Apple M2, hứa hẹn sẽ đồng hành trọn vẹn trên mọi trải nghiệm của bạn từ học tập, làm việc, giải trí cho đến thiết kế đồ họa chuyên sâu.', '', '', '', '', '', 33900000, 41990000, 34490000, 'apple-macbook-pro-m2-2022-1.jpg', 'apple-macbook-pro-m2-2022-2.jpg', 'apple-macbook-pro-m2-2022-4.jpg', 'Apple M2, 100GB/s', '8 GB', '512 GB SSD', '13.3 inch, Retina (2560 x 1600)', 'Card tích hợp, 10 nhân GPU', 'Jack tai nghe 3.5 mm, 2 x Thunderbolt 3', 'Mac OS', 'Vỏ kim loại', 'Dài 304.1 mm - Rộng 212.4 mm - Dày 15.6 mm - Nặng 1.4 kg', '6/2022', '', '2023-07-19 17:27:40'),
(37, 'Laptop Acer Aspire 3 A315 57 379K i3 1005G1/4GB/256GB/Win11 (NX.KAGSV.001)', 'laptop', 'Acer', 16, '• Laptop Acer Aspire có lối thiết kế thanh lịch với lớp vỏ được chế tác từ chất liệu nhựa cứng sơn màu đen lịch lãm, khối lượng 1.7 kg cùng độ dày 19.9 mm lý tưởng để bạn bỏ gọn trong một chiếc balo đem theo mọi nơi để phục vụ công việc.\r\n\r\n• Bộ vi xử lý Intel Core i3 1005G1 hỗ trợ bạn xử lý mượt mà các tác vụ cơ bản thường ngày liên quan đến công việc văn phòng như Word, Excel, PowerPoint,... cũng như giải trí, lướt web hay thiết kế đơn giản trên ứng dụng Photoshop, Canva,... nhờ card đồ họa tích hợp Intel UHD.\r\n\r\n• Laptop RAM 4 GB vẫn có thể đáp ứng tốt nhu cầu chạy song song nhiều ứng dụng nhẹ, bạn có thể vừa mở Chrome để nghe nhạc vừa soạn thảo trên Word cũng đều thoải mái, máy hỗ trợ lắp thêm một thanh RAM khác với tổng bộ nhớ lên đến 12 GB tha hồ đa nhiệm mà không lo giật lag.\r\n\r\n• Ổ cứng SSD 256 GB mang đến một không gian lưu trữ đủ rộng để bạn lưu lại các tài liệu học tập cũng như các tệp tài liệu văn phòng, đồng thời tối ưu tốc độ mở máy và ứng dụng đều nhanh chỉ trong vỏn vẹn vài giây.\r\n\r\n• Laptop Acer sở hữu màn hình 15.6 inch độ phân giải Full HD (1920 x 1080) có khả năng hiển thị hình ảnh với độ sắc nét cao, kích thước lớn mở rộng không gian để bạn làm việc thêm thoải mái. Công nghệ Acer ComfyView đảm bảo màu sắc luôn được thể hiện chân thật, sống động.\r\n\r\n• Công nghệ âm thanh Stereo speakers khuếch đại mang đến âm thanh to rõ, mạnh mẽ để bạn chìm vào không gian âm nhạc hay phim ảnh đầy thư giãn sau những giờ học tập, làm việc mệt mỏi.\r\n\r\n• Laptop có thiết kế bản lề mở 180 độ để bạn dễ dàng điều chỉnh góc nhìn cũng như chia sẻ nội dung với người đối diện mà không cần xoay toàn bộ máy rườm rà mà còn mất thời gian.\r\n\r\n• Đa dạng các cổng kết nối như: USB 2.0, Jack tai nghe 3.5 mm, HDMI và USB 3.1 để bạn liên kết với các thiết bị ngoại vi như chuột, bàn phím, máy chiếu,... một cách đơn giản nhất, phục vụ tối đa cho nhu cầu học tập và làm việc của bạn.', '', '', '', '', '', 7500000, 8490000, 7990000, 'acer-aspire-3-a315-57-379k-i3-nxkagsv001-ab-1-1.jpg', 'acer-aspire-3-a315-57-379k-i3-nxkagsv001-ab-3.jpg', 'acer-aspire-3-a315-57-379k-i3-nxkagsv001-ab-4.jpg', 'i3, 1005G1, 1.2GHz', '4 GB, DDR4 (Onboard 4 GB +1 khe rời), Từ 2400 MHz (Hãng công bố)', '256 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)Hỗ trợ khe cắm HDD SATA 2.5 inch mở', '15.6 inch, Full HD (1920 x 1080)', 'Card tích hợp, Intel UHD', '2 x USB 3.1, HDMI, LAN (RJ45), Jack tai nghe 3.5 mm, 1 x USB 2.0', 'Windows 11 Home SL', ' Vỏ nhựa', 'Dài 363.4 mm - Rộng 250.5 mm - Dày 19.9 mm - Nặng 1.7 kg', ' 2021', '', '2023-07-19 17:27:40'),
(38, 'Điện thoại Samsung Galaxy A24 6GB', 'dtdd', 'Samsung', 45, 'Samsung Galaxy A24 6GB tiếp tục là mẫu điện thoại tầm trung được nhà Samsung giới thiệu đến thị trường Việt Nam vào tháng 04/2023, máy nổi bật với giá thành rẻ, màn hình Super AMOLED cùng camera 50 MP chụp ảnh sắc nét.', '', '', '', '', '', 5380000, 6490000, 5890000, 'samsung-galaxy-a24-den-1.jpg', 'samsung-galaxy-a24-den-7.jpg', 'samsung-galaxy-a24-den-8.jpg', 'Super AMOLED, 6.5 inch, Full HD+', 'Android 13', 'Chính 50 MP & Phụ 5 MP, 2 MP', '13 MP', 'MediaTek Helio G99', '6 GB', ' 128 GB', '2 Nano SIM, Hỗ trợ 4G', '5000 mAh, 25 W', '', '', '2023-07-19 17:27:40'),
(39, 'Laptop Acer Aspire 3 A314 35 C3KS N5100/4GB/256GB/Win11 (NX.A7SSV.009)', 'laptop', 'Acer', 15, 'Laptop Acer Aspire 3 A314 35 C3KS N5100 (NX.A7SSV.009) với thiết kế mỏng nhẹ, hiệu năng ổn định đi cùng mức giá hợp lý, chắc chắn sẽ đáp ứng được các nhu cầu làm việc và giải trí của người dùng.\r\n• Bộ vi xử lý Intel Celeron N5100 cùng card tích hợp Intel UHD Graphics cho phép người dùng có thể thoải mái soạn thảo văn bản trên Word, thao tác chuẩn bị slide trên PowerPoint,... hay giải trí, xem phim và nghe nhạc đều mượt mà.\r\n\r\n• Bộ nhớ RAM 4 GB DDR4 có khả năng nâng cấp tối đa 16 GB giúp bạn thao tác hay xử lý công việc với các tab Chrome và ứng dụng mà hạn chế gặp hiện tượng đơ hay lag máy.\r\n\r\n• Ổ cứng 256 GB SSD NVMe PCIe được trang bị trên laptop Acer cho khả năng truy xuất và khởi động các ứng dụng nhanh chóng, đồng thời cung cấp một không gian lưu trữ ổn định và đầy đủ. Hơn nữa, máy cũng trang bị thêm khe cắm HDD để bạn có thể nâng cấp nhằm mở rộng không gian lưu trữ.\r\n\r\n• Màn hình 14 inch cùng độ phân giải HD (1366 x 768) cho trải nghiệm xem tốt, hình ảnh được xuất rõ ràng và chi tiết. Hơn nữa, công nghệ Acer ComfyView còn giúp hạn chế hắt sáng cũng như bảo vệ mắt khi sử dụng trong thời gian dài.\r\n\r\n• Với VGA Webcam, chiếc laptop học tập - văn phòng này có thể hỗ trợ các bạn tham gia học online trên Zoom, Meet,... mà không cần kết nối thêm với thiết bị bên ngoài.\r\n\r\n• Laptop Acer Aspire được hoàn thiện với vỏ nhựa cùng tông màu bạc đẹp mắt. Khối lượng chỉ 1.45 kg cho người dùng có thể linh động mang theo bên mình khi di chuyển.\r\n\r\n• Laptop cũng có đầy đủ các cổng kết nối như: HDMI, USB 2.0, Jack tai nghe 3.5 mm, USB 3.2 và LAN (RJ45) hỗ trợ cho các công việc ghép nối với các thiết bị ngoại vi. ', '', '', '', '', '', 5000000, 6990000, 5990000, 'acer-aspire-3-a314-35-c3ks-n5100-nxa7ssv009-14-1.jpg', 'acer-aspire-3-a314-35-c3ks-n5100-nxa7ssv009-3-1.jpg', 'acer-aspire-3-a314-35-c3ks-n5100-nxa7ssv009-4-1.jpg', 'Celeron, N5100, 1.1GHz', '4 GB,DDR4 2 khe (1 khe 4 GB + 1 khe rời), Từ 2400 MHz (Hãng công bố)', '256 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB), Hỗ trợ khe cắm HDD SATA', '14 inch, HD (1366 x 768)', 'Card tích hợp, Intel UHD', 'HDMI, LAN (RJ45), Jack tai nghe 3.5 mm, 1 x USB 2.0, 2 x USB 3.2', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 328 mm - Rộng 236 mm - Dày 19.9 mm - Nặng 1.45 kg', '2021', '', '2023-07-19 17:27:40'),
(40, 'Laptop Lenovo Ideapad 3 14ABA7 R5 5625U/8GB/256GB/Win11 (82RM003WVN)', 'laptop', 'Lenovo', 29, 'Laptop Lenovo Ideapad 3 14ABA7 R5 (82RM003WVN) được trang bị hệ thống bảo mật an toàn như bảo mật vân tay, công tắc khóa camera,... cùng bộ vi xử lý AMD Ryzen 5 hiệu năng cao, phục vụ tốt mọi tác vụ từ công việc cho đến giải trí, với hiệu suất vượt trội cùng chất lượng hình ảnh rõ nét.\r\nNgoại hình tối giản nhưng không kém phần sang trọng\r\nLaptop Lenovo Ideapad sở hữu ngoại hình thanh lịch và thiết kế tinh tế với độ mỏng 19.9 mm và khối lượng chỉ 1.43 kg, do đó mình có thể dễ dàng mang đi khi di chuyển mà vẫn đảm bảo trải nghiệm giải trí và làm việc thoải mái ở mọi nơi, từ quán cà phê cho đến thư viện trong trường học.\r\n\r\nTổng thể, Lenovo Ideapad 3 14ABA7 R5 (82RM003WVN) có ngoại hình tinh tế, hiệu suất mạnh mẽ từ bộ vi xử lý AMD Ryzen 5 và card đồ họa tích hợp AMD Radeon Graphics, khả năng nâng cấp RAM và ổ cứng SSD linh hoạt đi cùng màn hình 14 inch chống chói và âm thanh Dolby Audio sống động, tất cả đều cung cấp cho mình một trải nghiệm tuyệt vời cho các tác vụ học tập, giải trí hàng ngày.', '', '', '', '', '', 10000000, 14890000, 10490000, 'lenovo-ideapad-3-14aba7-r5-82rm003wvn-glr-16.jpg', 'lenovo-ideapad-3-14aba7-r5-82rm003wvn-glr-3.jpg', 'lenovo-ideapad-3-14aba7-r5-82rm003wvn-glr-4.jpg', 'Ryzen 5, 5625U, 2.30 GHz', '8 GB, DDR4 2 khe (1 khe 8 GB onboard + 1 khe trống), 3200 MHz', '256 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)', '14 inch, Full HD (1920 x 1080)', 'Card tích hợp, Radeon', 'HDMI, Jack tai nghe 3.5 mm, 1 x USB 2.01 x USB 3.2, USB Type-C (hỗ trợ truyền dữ liệu, Power Deliver', 'Windows 11 Home SL', ' Vỏ nhựa', 'Dài 324.2 mm - Rộng 215.7 mm - Dày 19.9 mm - Nặng 1.43 kg', ' 2022', '', '2023-07-19 17:27:40'),
(41, 'Laptop Asus VivoBook X515MA N4020/4GB/256GB/Win11 (BR480W) ', 'laptop', 'Asus', 19, 'Chiếc laptop học tập - văn phòng trong phân khúc dưới 10 triệu đồng với thiết kế thanh lịch, hiệu năng ổn định phục vụ tốt cho nhu cầu làm việc văn phòng hằng ngày dành cho học sinh, sinh viên, đó là laptop Asus VivoBook X515MA N4020 (BR480W) sẵn sàng đồng hành cùng bạn trên một hành trình mới.\r\nThiết kế linh hoạt, sang trọng tinh tế\r\nChiếc máy với khối lượng 1.8 kg cùng độ dày 19.9 mm khoác lên mình một màu xám tinh tế, mang lại cho mình cảm giác cầm nắm chắc tay và mát. Laptop Asus có độ hoàn thiện cao nên phần kê tay của máy cứng cáp, không bị biến dạng khi mình tác động lực lên máy. Đặc tính bám vân tay thường thấy trên chiếc máy được làm bằng nhựa nên mình khuyến khích bạn nên vệ sinh thường xuyên để máy có tình trạng đẹp nhất.', '', '', '', '', '', 7000000, 7890000, 7490000, 'asus-vivobook-x515ma-n4020-br480w-13.jpg', 'asus-vivobook-x515ma-n4020-br480w-4-1.jpg', 'asus-vivobook-x515ma-n4020-br480w-3-1.jpg', 'Celeron, N4020, 1.1GHz', '4 GB, DDR4 (1 khe), 2400 MHz', 'Hỗ trợ khe cắm HDD SATA (nâng cấp tối đa 2 TB), 256 GB SSD NVMe PCIe', '15.6 inch, HD (1366 x 768)', 'Card tích hợp, Intel UHD 600', 'USB Type-C, 2 x USB 2.0, HDMI, Jack tai nghe 3.5 mm, 1 x USB 3.2', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 360.2 mm - Rộng 234.9 mm - Dày 19.9 mm - Nặng 1.8 kg', ' 2021', '', '2023-07-19 17:27:40'),
(42, 'Laptop MSI Modern 14 C11M i3 1115G4/8GB/512GB/Win11 (011VN) ', 'laptop', 'MSI', 19, '• Laptop MSI được trang bị bộ vi xử lý Intel Core i3 1115G4 cùng với card đồ họa tích hợp Intel UHD Graphics, giúp máy xử lý nhanh chóng và hiệu quả các tác vụ không quá nặng như làm việc trên Word, Excel, PowerPoint,... hay chỉnh sửa hình ảnh 2D cơ bản trên các ứng dụng nhà Adobe.\r\n\r\n• Máy được trang bị một thanh RAM 8 GB hỗ trợ tốt khả năng đa nhiệm. Bên cạnh đó, MSI Modern 14 còn sở hữu ổ cứng SSD dung lượng lớn 512 GB giúp khởi động và truy cập dữ liệu nhanh chóng.\r\n\r\n• Màn hình 14 inch với độ phân giải Full HD có khả năng tái tạo hình ảnh sắc nét, màu sắc hài hòa và bắt mắt. Tấm nền IPS giúp hiển thị màu sắc chính xác và góc nhìn rộng hơn. Công nghệ Anti Glare giảm bớt lượng ánh sáng phản chiếu, giúp màn hình trông sáng hơn và tạo cảm giác thoải mái khi sử dụng máy trong môi trường có ánh sáng cao.\r\n\r\n• Công nghệ Realtek High Definition Audio trên laptop mang lại chất lượng âm thanh rõ ràng và sống động, tăng trải nghiệm giải trí như xem phim, nghe nhạc và chơi game.\r\n\r\n• Với thiết kế vỏ nhựa và khối lượng chỉ 1.4 kg đúng chuẩn một chiếc laptop học tập - văn phòng, bạn có thể dễ dàng mang theo MSI Modern 14 khi cần di chuyển. Máy có đèn nền bàn phím, đáp ứng nhu cầu làm việc hoặc chơi game trong môi trường thiếu sáng.\r\n\r\n•  Laptop MSI Modern được trang bị các cổng giao tiếp: USB, USB-C, HDMI và Micro SD, cho phép bạn kết nối với nhiều thiết bị khác nhau như màn hình, máy chiếu, ổ cứng di động và thẻ nhớ.', '', '', '', '', '', 9500000, 11990000, 10990000, 'msi-modern-14-c11m-i3-011vn-abc-glr-4.jpg', 'msi-modern-14-c11m-i3-011vn-abc-glr-3.jpg', 'msi-modern-14-c11m-i3-011vn-abc-glr-1.jpg', ' i3, 1115G, 43GHz', ' 8 GB, DDR4 (Onboard), 3200 MHz', ' 512 GB SSD NVMe PCIe', ' 14 inch, Full HD (1920 x 1080)', 'Card tích hợp, Intel UHD', '2 x USB 2.0, HDMI, Jack tai nghe 3.5 mm, 1 x USB 3.2, 1 x USB Type-C 3.2 (hỗ trợ Power Delivery)', 'Windows 11 Home SL', ' Vỏ nhựa', 'Dài 319.9 mm - Rộng 223 mm - Dày 19.35 mm - Nặng 1.4 kg', '2022', '', '2023-07-19 17:27:40'),
(43, 'Laptop Dell Vostro 3520 i3 1215U/8GB/256GB/OfficeHS/Win11 (V5I3614W1)', 'laptop', 'Dell', 45, '• Bộ vi xử lý Intel Core i3 1215U với 6 nhân và 8 luồng, tốc độ xung nhịp lên đến 4.40 GHz, kết hợp cùng card tích hợp Intel UHD Graphics có thể vận hành hoàn hảo các tác vụ đơn giản như xem video, lướt web, chơi game cơ bản hay thực hiện các công việc văn phòng như xử lý văn bản và bảng tính một cách trơn tru.\r\n\r\n• Laptop được trang bị RAM 8 GB với khả năng nâng cấp lên đến tối đa 16 GB, hỗ trợ việc chạy các ứng dụng đòi hỏi nhiều tài nguyên bộ nhớ và đa nhiệm hiệu quả. Ổ cứng SSD 256 GB cung cấp không gian lưu trữ đủ cho nhiều tệp tin và ứng dụng, rút ngắn thời gian khởi động thiết bị.\r\n\r\n• Màn hình 15.6 inch với độ phân giải Full HD (1920 x 1080) có khả năng hiển thị hình ảnh chi tiết và sắc nét. Tấm nền IPS cung cấp góc nhìn rộng, công nghệ chống chói Anti Glare giúp giảm thiểu các ánh sáng phản chiếu và mờ hình ảnh. Tần số quét 120 Hz giảm thiểu hiện tượng giật hình và cải thiện trải nghiệm chơi game.\r\n\r\n• Laptop Dell được tích hợp công nghệ âm thanh Realtek Audio hỗ trợ âm thanh 3D, âm thanh vòm, cân bằng âm thanh, cài đặt EQ và nhiều tính năng khác để người dùng có thể tùy chỉnh âm thanh theo ý muốn của mình.\r\n\r\n• Laptop Dell Vostro được cài đặt hệ điều hành mới nhất của Microsoft - Windows 11, phù hợp để làm việc văn phòng, soạn thảo văn bản, tính toán và quản lý tài liệu. Bộ Office Home & Student cung cấp các ứng dụng như Word, Excel và PowerPoint để giúp người dùng tạo và chỉnh sửa tài liệu thêm dễ dàng hơn.\r\n\r\n• Dell Vostro 3520 được hoàn thiện với lớp vỏ màu xám thanh lịch, khối lượng 1.83 kg không quá nặng để người dùng có thể mang theo bên mình. Ngoài ra máy còn được thiết kế với bàn phím chống tràn nước giúp tăng tính bền bỉ trong quá trình sử dụng.\r\n\r\n• Máy được trang bị đa dạng các cổng kết nối: HDMI, USB 2.0, Jack tai nghe 3.5 mm, USB 3.2 và LAN (RJ45).', '', '', '', '', '', 11000000, 13990000, 12490000, 'dell-vostro-3520-i3-v5i3614w1-abc-13.jpg', 'dell-vostro-3520-i3-v5i3614w1-abc-3.jpg', 'dell-vostro-3520-i3-v5i3614w1-abc-4.jpg', ' i3, 1215U, 1.2GHz', '8 GB, DDR4 2 khe (1 khe 8 GB + 1 khe rời), 2666 MHz', '256 GB SSD NVMe PCIe, Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng (nâng cấp tối đa 2 TB)', ' 15.6 inch, Full HD (1920 x 1080), 120Hz', ' Card tích hợp, Intel UHD', ' HDMI, LAN (RJ45), Jack tai nghe 3.5 mm, 1 x USB 2.0, 2 x USB 3.2', 'Windows 11 Home SL + Office Home & Student vĩnh viễn', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 235.56 mm - Dày 18.99 mm - Nặng 1.83 kg', '2022', '', '2023-07-19 17:27:40'),
(44, 'Laptop Gigabyte Gaming G5 i5 12500H/8GB/512GB/4GB RTX3050/144Hz/Win11 (GE-51VN263SH)', 'laptop', 'Gigabyte', 18, ' Bộ vi xử lý Intel Core i5 12500H cho ép xung tối đa lên đến 4.5 GHz kết hợp cùng card rời NVIDIA GeForce RTX 3050 4 GB cho hiệu năng xử lý nâng cao mọi tác vụ từ học tập, làm việc hay giải trí. Với cấu hình trên, người dùng có thể dễ dàng dùng chiếc laptop RTX 30 series này để chiến các tựa game thịnh hành hiện nay cũng như thực hiện các tác vụ đồ họa, thiết kế hay chỉnh sửa video.\r\n\r\n• Laptop Gigabyte Gaming với bộ nhớ RAM 8 GB DDR4 cho phép khả năng thực hiện mượt mà các tác vụ đồ họa phức tạp, hay xử lý công việc trên cùng lúc nhiều tab Chrome mà không lo bị đơ máy. Ngoài ra, bạn hoàn toàn có thể nâng cấp RAM lên tối đa 64 GB để đáp ứng được hiệu suất chơi game cao hơn.\r\n\r\n• Ổ cứng SSD 512 GB NVMe PCIe Gen 4.0 vừa cung cấp một không gian lưu trữ đáng kể cho các trò chơi hay ứng dụng của người dùng, vừa giúp truy xuất, đọc ghi dữ liệu nhanh hơn. Hơn nữa, laptop có hỗ trợ thêm khe cắm SSD M.2 PCIe mở rộng để bạn thoải mái tải các tệp tin mà không lo về dung lượng.\r\n\r\n• Công nghệ làm mát WINDFORCE với 5 ống dẫn nhiệt và 2 quạt 59 cánh hỗ trợ bạn làm việc hay chơi game với hiệu suất ổn định và duy trì được lâu dài, không lo gặp những hiện tượng giật lag do máy quá nóng khi đang chiến game.\r\n\r\n• Màn hình 15.6 inch được trang bị tấm nền IPS có độ phân giải Full HD (1920 x 1080) mang đến một không gian giải trí rộng lớn, hình ảnh hiển thị rõ nét cho bạn thoải mái tận hưởng những trận game. Bên cạnh đó, tần số quét 144 Hz còn giúp màn hình hạn chế hiện tượng trễ ảnh hay xé hình, cho trải nghiệm chơi game, giải trí hay làm việc đều mượt mà và chính xác.\r\n\r\n• Công nghệ DTS X:Ultra Audio cho xuất một chất âm có âm Bass chuẩn, tần số cao khiến âm thanh to rõ và sống động y như thật. Cho phép bạn đắm chìm vào những bản nhạc du dương hay những trận game đầy thú vị.\r\n\r\n• Laptop Gigabyte được hoàn thiện với vỏ nhựa màu đen cuốn hút, những đường gân chìm cùng logo to làm máy càng nổi bật, có nét nam tính và hầm hố đậm chất Gaming.\r\n\r\n• Bàn phím được trang bị đèn nền với 15 chế đ', '', '', '', '', '', 18900000, 22890000, 19990000, 'gigabyte-gaming-g5-i5-ge-51vn263sh-glr-13.jpg', 'gigabyte-gaming-g5-i5-ge-51vn263sh-glr-3-2.jpg', 'gigabyte-gaming-g5-i5-ge-51vn263sh-glr-4-2.jpg', ' i5, 12500H, 2.5GHz', '8 GB, DDR4 2 khe (1 khe 8 GB + 1 khe rời), 3200 MHz', 'Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng, 512 GB SSD NVMe PCIe Gen 4.0', '15.6 icnh, Full HD (1920 x 1080), 144Hz', ' Card rời, RTX 3050 4GB', 'Mini DisplayPort, HDMI, LAN (RJ45), 1 x USB 2.0, 1 x USB 3.2, 1 x 2-in-1 Audio Jack (Headphone / Microphone), 2 x USB Type-C 3.2 Gen 2, 1 x Microphone jack', ' Windows 11 Home SL', 'Vỏ nhựa', 'Dài 360 mm - Rộng 238 mm - Dày 22.7 mm - Nặng 1.9 kg', '2022', '', '2023-07-19 17:27:40'),
(45, 'Điện thoại OPPO Find N2 Flip 5G ', 'dtdd', 'OPPO', 98, 'Là mẫu điện thoại gập dọc đầu tiên của OPPO, vì thế Find N2 Flip mang đến cho mình khá nhiều sự tò mò cũng như cảm hứng về phần thiết kế, điều này giúp quá trình sử dụng trở nên thú vị hơn so với đại đa số những mẫu máy thông thường khác.\r\n\r\nTổng quan về cái nhìn, theo mình máy trong khá dài và thon, khi mở hoàn toàn thì Find N2 Flip có kích thước lên tới 166.2 mm nhưng sau khi gập thì máy chỉ còn 85.5 mm. Lúc này điện thoại trở nên nhỏ gọn hơn, cầm nắm cũng chắc tay hơn. \r\nMột điểm rất tiện lợi trên những chiếc điện thoại như này là về khả năng gấp gọn thu nhỏ kích thước, mình hoàn toàn có thể bỏ máy vào túi trước trên quần jean mà không hề bị cấn mỗi khi ngồi lái xe hay làm việc. \r\n\r\nFind N2 Flip có một mặt lưng được làm từ kính cường lực và hoàn thiện theo kiểu nhám (đối với phiên bản màu đen) trông rất đẹp mắt, cảm giác sờ cũng khá thích và hơn hết là khả năng chống bám dấu vân tay, hạn chế để lại mồ hôi cực kỳ hiệu quả, nó giúp máy khó bị bám bẩn nên mình cũng không mất nhiều thời gian để lau chùi hay vệ sinh.\r\nCòn về bộ khung bao quanh máy thì OPPO sử dụng một loại hợp kim cao cấp, được làm theo kiểu nhẵn bóng nên phần này làm cho Find N2 Flip trở nên nổi bật hơn, sang trọng hơn song cũng mang lại khả năng chống va đập tốt hơn.\r\n\r\nTiếp đến là phần bản lề của điện thoại, theo mình thấy thì OPPO gia công phần này khá tốt khi mang đến cảm giác chắc chắn mà không hề lỏng lẻo hay ọp ẹp một tí nào cả, thao tác gập mở cũng rất dễ dàng và nhanh chóng.\r\nTuy nhiên có một điểm hạn chế là khung máy khá trơn, nó khiến việc mở máy bằng một tay làm cho mình chưa được an tâm cho lắm, nhất là những lúc ra mồ hôi tay hay khi tay đang ẩm ướt, vậy nên cách mở này cũng không được mình thực hiện thường xuyên.\r\n\r\nHơn hết, việc mở máy bằng một tay trong thời gian dài cũng sẽ khiến cho phần bản lề tổn hại đi đôi chút, bởi lúc này lực tác động lên trục của bản lề chỉ xuất phát từ một phía và gây mất cân bằng, về lâu về dài sẽ làm cho bản lề trở nên lỏng lẻo và giảm đi độ cứng cáp.\r\nỞ t', '', '', '', '', '', 18900000, 24000000, 19990000, 'oppo-n2-flip-den-1.jpg', 'oppo-n2-flip-den-2.jpg', 'oppo-n2-flip-den-13.jpg', 'AMOLED, Chính 6.8 inch & Phụ 3.26 inch, Full HD+', 'Android 13', ' Chính 50 MP & Phụ 8 MP', ' 32 MP', 'MediaTek Dimensity 9000+ 8 nhân', ' 8 GB', '256 GB', ' 2 Nano SIM, Hỗ trợ 5G', ' 4300 mAh, 44 W', '', '', '2023-07-19 17:27:40'),
(46, 'Điện thoại iPhone 11 64GB ', 'dtdd', 'Apple', 46, 'Năm nay với iPhone 11 thì Apple đã nâng cấp khá nhiều về camera nếu so sánh với chiếc iPhone Xr 128GB năm ngoái.\r\nChúng ta đã có bộ đôi camera kép thay vì camera đơn như trên thế hệ cũ và với một camera góc siêu rộng thì bạn cũng có nhiều hơn những lựa chọn khi chụp hình.\r\n\r\n\r\n\r\n\r\n', 'Trước đây để lấy được hết kiến trúc của một tòa nhà, để ghi lại hết sự hùng vĩ của một ngọn núi thì không còn cách nào khác là bạn phải di chuyển ra khá xa để chụp.', 'Nhưng với góc siêu rộng trên iPhone 11 thì có thể cho bạn những bức ảnh với hiệu ứng góc rộng rất ấn tượng và thích mắt.\r\nBên cạnh đó là tính năng Deep Fusion được quảng cáo là cơ chế chụp hình mới, đem lại hình ảnh với độ chi tiết cao, dải tần nhạy sáng rộng và rất ít bị nhiễu.\r\n', 'Cụ thể, khi người dùng bấm nút chụp, thiết bị sẽ thực hiện tổng cộng 9 bức hình cùng lúc, gồm một tấm chính và tám tấm phụ, sau đó chọn ra các điểm ảnh tốt nhất để đưa vào tấm ảnh cuối cùng nhằm cải thiện chi tiết và khử nhiễu.', 'Và điều được người dùng mong chờ nhất chính là tính năng chụp đêm cũng xuất hiện trên chiếc iPhone mới này với tên gọi Night Mode.', '\r\nMàu sắc mới trên chiếc iPhone này hứa hẹn cũng sẽ khiến người dùng phải mê mệt và muốn bỏ tiền ra sở hữu ngay và luôn một chiếc.', 11000000, 13990000, 12490000, 'iphone-11-trang-1-org.jpg', 'iphone-11-128gb-trang-12-org.jpg', 'iphone-11-128gb-note.jpg', ' IPS LCD, 6.1 inch, Liquid Retina', ' iOS 15', ' 2 camera 12 MP', '12 MP', ' Apple A13 Bionic', '4 GB', ' 128 GB', ' 1 Nano SIM & 1 eSIM, Hỗ trợ 4G', '3110 mAh, 18 W', ' 11/2019', '', '2023-07-19 17:27:40'),
(47, 'Điện thoại Samsung Galaxy A04 (3GB/32GB)', 'dtdd', 'Samsung', 150, 'Điện thoại Samsung Galaxy A04 (3GB/32GB) sở hữu tấm nền IPS LCD, độ phân giải HD+ cùng kích thước 6.5 inch mang đến không gian giải trí thoải mái, phù hợp với các nhu cầu giải trí của đại đa số người dùng.\r\n\r\n\r\n\r\n\r\n\r\n', '', 'Cũng như các điện thoại Samsung Galaxy A thì máy được trang bị công nghệ âm thanh Dolby Atmos*, giờ đây bạn sẽ được trải nghiệm những thanh âm quyến rũ và chân thật nhất.', '*Dolby Atmos chỉ hỗ trợ tai nghe hoặc loa âm thanh nổi.', 'Tuy là mẫu điện thoại giá rẻ nhưng Samsung đã trang bị tính năng nhận diện khuôn mặt hiện đại với tốc độ nhanh chóng, giúp bạn tiết kiệm được thời gian và tăng độ bảo mật hơn cho dế yêu của mình.', 'Điện thoại Samsung Galaxy A04 sẽ là một lựa chọn tuyệt vời khi so với các sản phẩm trong cùng phân khúc, khi máy sở hữu cho mình một màn hình hiển thị chi tiết, camera chụp ảnh đẹp và viên pin lớn, đây chắc chắn là mẫu điện thoại sẽ khuấy đảo thị trường công nghệ những tháng cuối năm.', 2500000, 2990000, 2490000, 'samsung-galaxy-a04-den-1-1.jpg', 'samsung-galaxy-04-den-2.jpg', 'samsung-galaxy-04-den-3.jpg', ' IPS LCD, 6.5 inch, HD+', 'Android 12', ' Chính 50 MP & Phụ 2 MP', ' 5 MP', 'MediaTek Helio P35', '3 GB', '32 GB', '2 Nano SIM, Hỗ trợ 4G', '5000 mAh, 15 W', '', '', '2023-07-19 17:27:40'),
(48, 'Điện thoại Nokia G22 ', 'dtdd', 'Nokia', 67, 'Nokia G22 là mẫu điện thoại giá rẻ được ra mắt chính thức vào tháng 03/2023 tại thị trường Việt Nam. Máy nổi bật với màn hình lớn, camera có độ phân giải 50 MP cùng một viên pin trâu cho thời gian sử dụng vô cùng ấn tượng.\r\n', '', '', '', 'Mặt trước của điện thoại Nokia được trang bị tấm nền LCD có kích thước 6.52 inch, độ phân giải HD+ (720 x 1600 Pixels) cùng độ sáng 500 nits, cung cấp khả năng tương phản khá, độ chi tiết đạt mức ổn so với mức giá, phù hợp dùng để lướt web thông thường hay xem phim với chất lượng vừa phải, do khả năng tái hiện màu sắc chưa thực sự tốt cho lắm.\r\n', 'Sở hữu thông số cấu hình ổn định, camera có độ phân giải cao cùng thời lượng pin siêu ấn tượng, Nokia G22 là một lựa chọn lý tưởng cho người dùng với mức giá dễ tiếp cận, nhưng vẫn đáp ứng tốt các nhu cầu sử dụng cơ bản hằng ngày.', 3400000, 3990000, 3690000, 'nokia-g22-xam-1-1.jpg', 'nokia-g22-xam-11.jpg', 'nokia-g22-note.jpg', ' LCD, 6.52 inch, HD+', 'Android 12', 'Chính 50 MP & Phụ 2 MP, 2 MP', ' 8 MP', 'Unisoc T606', '4 GB', ' 128 GB', '2 Nano SIM, Hỗ trợ 4G', '5050 mAh, 20 W', '', '', '2023-07-19 17:27:40'),
(49, 'Điện thoại OPPO Reno8 T 5G 128GB', 'dtdd', 'OPPO', 50, 'OPPO Reno8 T 5G 128GB là mẫu điện thoại đầu tiên trong năm 2023 mà OPPO kinh doanh tại Việt Nam. Máy nhận được khá nhiều sự quan tâm đến từ cộng đồng công nghệ về thông số kỹ thuật hết sức ấn tượng như: Camera 108 MP, chipset nhà Qualcomm và màn hình AMOLED.\r\nReno8 T 5G sở hữu một mặt lưng làm từ thủy tinh hữu cơ đi kèm với đó sẽ là kiểu phối màu gradient cực kỳ bắt mắt và sang trọng. Cả hai điều này sẽ mang đến cho thiết bị một cái nhìn cao cấp hơn, giúp bạn có thể tự tin cầm nắm sử dụng ở bất kỳ nơi đâu hay đây cũng được xem là món phụ kiện thời trang đẹp mắt và cũng vô cùng thú vị.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'Ngoài ra, OPPO sẽ sử dụng tấm nền AMOLED dành cho Reno8 T 5G, vì thế nội dung hiển thị sẽ có màu sắc bắt mắt, hình ảnh có chiều sâu cùng với khả năng tối ưu điện năng cực tốt để cho ra thời gian sử dụng lâu dài. Kèm với đó là màn hình có tần số quét 120 Hz, độ sáng tối đa 800 nits mang lại khả năng vuốt chạm mượt mà và hiển thị nội dung rõ ràng kể cả ở ngoài trời.', 'Mỗi đời điện thoại OPPO Reno từ trước đến nay thì camera chắc hẳn là phần được quan tâm nhiều nhất không chỉ bởi chất lượng mà còn về cả số lượng, số lượng ở đây có thể coi là độ phân giải trên camera bởi hãng không ngừng nâng cấp và cho ra sản phẩm có con số này ngày càng cao.', 'Đối với với chiếc Reno8 T 5G thì máy sẽ được trang bị bộ 3 ống kính trong đó cảm biến chính sở hữu độ phân giải lên tới 108 MP, nhờ đó mà mỗi bức ảnh chụp từ điện thoại OPPO sẽ cho ra chất lượng tốt hơn bởi độ phân giải lúc này là cực kỳ cao, màu sắc thì cũng sẽ trở nên chân thực hơn nhờ nhiều thuật toán xử lý thông minh đi kèm.', 'Đối với với chiếc Reno8 T 5G thì máy sẽ được trang bị bộ 3 ống kính trong đó cảm biến chính sở hữu độ phân giải lên tới 108 MP, nhờ đó mà mỗi bức ảnh chụp từ điện thoại OPPO sẽ cho ra chất lượng tốt hơn bởi độ phân giải lúc này là cực kỳ cao, màu sắc thì cũng sẽ trở nên chân thực hơn nhờ nhiều thuật toán xử lý thông minh đi kèm.', 'Reno8 T 5G sẽ sở hữu một màn hình lớn với kích thước 6.7 inch cùng kiểu thiết kế dạng nốt ruồi hiện đại, điều này sẽ đem đến một không gian lớn giúp bạn có thể tận hưởng trọn vẹn mọi loại nội dung, phù hợp cho việc xem phim, lướt web và kể cả chơi những tựa game đòi hỏi tầm quan sát rộng lớn như PUBG Mobile.\r\nTổng kết lại về mặt thông số thì đây được xem là một mẫu điện thoại Android hết sức nổi bật .', 8990000, 9990000, 9490000, 'oppo-reno8-t-vang-5g-1.jpg', 'oppo-reno8t-5g-note-1.jpg', 'oppo-reno8-t-vang-5g-12.jpg', 'AMOLED, 6.7 inch, Full HD+', 'Android 13', ' Chính 108 MP & Phụ 2 MP, 2 MP', '32 MP', ' Snapdragon 695 5G', '8 GB', '128 GB', '2 Nano SIM (SIM 2 chung khe thẻ nhớ)Hỗ trợ 5G', ' 4800 mAh, 67 W', '01/2023', '', '2023-07-19 17:27:40'),
(50, 'Điện thoại Samsung Galaxy S23 Ultra 5G 512GB ', 'dtdd', 'Samsung', 16, 'Với những ai là tín đồ công nghệ thì Samsung Galaxy S23 Ultra 5G 512GB chắc hẳn không còn là cái tên quá xa lạ tại thời điểm này nữa, mới đây thì máy cũng đã chính thức được giới thiệu với hàng loạt các tính năng cũng như công nghệ nổi bật, có thể thấy thì đây được xem là một trong những sản phẩm đột phá về mọi mặt đến từ nhà Samsung trong năm 2023 nhằm hướng đến vị trí thương hiệu hàng đầu trong ngành.\r\nThiết kế sang trọng cùng những đường nét tinh xảo\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '\r\nThiết kế cụm camera sau trên Galaxy S23 Ultra được làm đơn giản nhưng tinh tế, tạo cảm giác không rối mắt cho người dùng nhưng vẫn toát lên vẻ quyến rũ và sang trọng.', 'Điểm nổi bật là bút S Pen thế hệ mới trên Galaxy S23 Ultra được cải tiến giúp người dùng thao tác nhanh hơn, nhạy hơn so với các thế hệ trước trong các tác vụ thường ngày như: Ghi chú nhanh, nút bấm hỗ trợ chụp ảnh, hỗ trợ thuyết trình, vẽ,...', 'Màn hình chất lượng hiển thị rõ nét và chân thật\r\nGalaxy S23 Ultra sẽ được sử dụng lối thiết kế bo cong ở mặt lưng cùng kiểu màn hình vô cực ở hai bên, thân máy thì sẽ được làm chủ yếu từ vật liệu cao cấp như mặt lưng kính phủ nhám vì, thế Galaxy S23 Ultra trông mạnh mẽ, cá tính hơn đồng thời mang đến khả năng chống xước, chống bám vân tay, hạn chế bám bụi tốt.\r\n', 'Màn hình của điện thoại có thước 6.8 inch cùng với tấm nền Dynamic AMOLED 2X có khả năng hiển thị hình ảnh một cách chân thật và rực rỡ, mang đến cho người dùng không gian màn ảnh rộng chỉ trong tầm tay - thỏa sức trải nghiệm.', 'Màn hình trên Galaxy S23 Ultra được đánh giá là xuất sắc, rõ nét với độ phân giải 2K+, hỗ trợ tần số quét 120 Hz cho người dùng trải nghiệm xem phim, hay chơi game và lướt web,... vô cùng mượt mà.Mẫu flagship trong năm 2023 - Galaxy S23 Ultra 5G là một thiết bị mà người dùng không nên bỏ qua, đặc biệt là tín đồ đam mê chụp ảnh và chơi game. Thiết bị không chỉ sở hữu cấu hình mạnh mẽ mà còn khoác lên mình bộ cánh sang trọng quyến rũ, nhờ đó mà bạn có thể tự tin cầm nắm trong các buổi họp hay tối ưu công việc của bạn thông qu', 28990000, 36990000, 27990000, 'samsung-galaxy-s23-ultra-xanh-1.jpg', 'samsung-galaxy-s23-ultra-note.jpg', 'samsung-galaxy-s23-ultra-xanh-12.jpg', ' Dynamic AMOLED 2X, 6.8 inch, Quad HD+ (2K+)', 'Android 13', 'Chính 200 MP & Phụ 12 MP, 10 MP, 10 MP', ' 12 MP', 'Snapdragon 8 Gen 2 8 nhân', '12 GB', '512 GB', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM, Hỗ trợ 5G', '5000 mAh, 45 W', ' 02/2023', '', '2023-07-19 17:27:40');
INSERT INTO `products` (`id`, `name`, `key_word`, `brand`, `quantity_sp`, `details`, `details1`, `details2`, `details3`, `details4`, `details5`, `import_price`, `price`, `discount`, `image_01`, `image_02`, `image_03`, `details_1`, `details_2`, `details_3`, `details_4`, `details_5`, `details_6`, `details_7`, `details_8`, `details_9`, `details_10`, `details_11`, `date`) VALUES
(51, 'Điện thoại Vivo Y36', 'dtdd', 'Vivo', 47, 'Vivo Y36 chiếc điện thoại Vivo Y mới nhất được nhà Vivo tung ra thị trường Việt Nam vào tháng 06/2023. Máy sở hữu vẻ ngoài hiện đại trẻ trung, màn hình hiển thị sắc nét cùng một hiệu năng ổn định với các tác vụ hằng ngày.\r\nVẻ ngoài đơn giản tạo nên sức hút\r\n\r\n\r\n\r\n', 'Khác với những mẫu điện thoại Vivo Y trước đây, mặt trước của Y36 được thay bằng kiểu thiết kế nốt ruồi thời thượng so với màn hình giọt nước trước đó. Chính sự thay đổi này làm cho màn hình trở nên rộng hơn và các cạnh viền được làm mỏng cho cảm giác vuốt chạm tốt.\r\n', 'Mặt trước của điện thoại Vivo sẽ là tấm nền IPS LCD có kích thước 6.64 inch, độ phân giải của máy đạt mức Full HD+ (1080 x 2388 Pixels) cho mọi nội dung trên màn hình được tái hiện tương đối sắc nét, giúp bạn chiêm ngưỡng những bộ phim, chơi game được tốt hơn.', 'Điện thoại được trang bị công nghệ sạc siêu nhanh, cho phép sạc với công suất 44 W, kèm theo viên pin dung lượng 5000 mAh cho phép người dùng sử dụng thoải mái cả một ngày dài với nhiều tác vụ như chơi game, xem phim liên tục', 'Ngoài ra, thiết bị còn hỗ trợ nhiều phương thức kết nối như 4G, Wi-Fi, Bluetooth 5.0, GPS, cổng sạc Type-C, tạo điều kiện thuận lợi cho người dùng trong quá trình sử dụng thiết bị.\r\n', 'Vivo Y36 được xem là sản phẩm rất lý tưởng dành cho ai đang có nhu cầu tìm mua cho mình một chiếc điện thoại có thiết kế đẹp mắt, hiệu năng ổn định cùng mức giá thành phải chăng. Đây hứa hẹn sẽ là sản phẩm nhận được nhiều sự chú ý từ người tiêu dùng.', 6000000, 7800000, 6990000, 'vivo-y36-den-1-2.jpg', 'vivo-y36-note.jpg', 'vivo-y36-den-11-1.jpg', 'IPS LCD, 6.64 inch, Full HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP', ' 16 MP', ' Snapdragon 680', ' 8 GB', ' 256 GB', '2 Nano SIM, Hỗ trợ 4G', ' 5000 mAh, 44 W', ' 06/2023', '', '2023-07-19 17:27:40'),
(52, 'Laptop Acer Nitro 5 Gaming AN515 57 5669 i5 11400H/8GB/512GB/144Hz/4GB GTX1650/Win11 (NH.QEHSV.001)', 'laptop', 'Acer', 45, 'Laptop Acer Nitro 5 Gaming AN515 57 5669 i5 (NH.QEHSV.001) khơi nguồn mọi cảm hứng game thủ với phong cách thiết kế đậm chất gaming cùng những chuyển động mượt mà với card đồ họa NVIDIA GeForce GTX, mang lại chiến thắng tuyệt đối cho người dùng trên mọi chiến trường ảo.\r\n\r\n\r\n', '', 'Được chế tác từ lớp vỏ nhựa bền chắc với gam màu đen chủ đạo, Acer Nitro đã bật lên hẳn phong thái gaming mạnh mẽ với hai đường cắt cực ngầu như tia chớp trên mặt lưng máy, đánh bật mọi đối thủ xuất hiện xung quanh nó. Máy còn sở hữu thân hình khá gọn so với dòng laptop gaming khi có bề dày 23.9 mm và trọng lượng 2.2 kg, cho phép bạn luôn trong tư thế chiến đấu mọi lúc mọi nơi mà không sợ cồng kềnh, nặng nhọc.', 'Đáp ứng tối ưu mọi nhu cầu từ làm việc đến giải trí khi sở hữu bộ bàn phím Fullsize bao gồm vùng phím số giúp các thao tác nhập liệu được diễn ra suôn sẻ với tốc độ nhanh chóng hơn, hành trình sâu và độ nảy cao còn mang lại cảm giác gõ máy êm tay, thoải mái. ', 'Laptop Acer được trang bị hệ thống đèn bàn phím chuyển màu RGB nổi bật kích thích sự hứng khởi của các game thủ bằng cách dễ dàng xác định vị trí của từng phím dù chơi ở môi trường tối.', 'Acer Nitro 5 Gaming AN515 57 5669 i5 (NH.QEHSV.001) xứng đáng trở thành người trợ thủ đắc lực luôn sẵn sàng đồng hành cùng bạn trên mọi chiến trường. Phong cách thiết kế trẻ trung, thời trang cùng những thông số kỹ thuật đáng gờm còn đáp ứng đa dạng nhu cầu từ học tập, văn phòng cơ bản đến đồ họa - kỹ thuật chuyên sâu.', 17500000, 23790000, 17990000, 'acer-nitro-5-gaming-an515-57-5669-i5-nhqehsv001-1.jpg', 'acer-nitro-5-gaming-an515-57-5669-i5-nhqehsv001-30.jpg', 'acer-nitro-5-gaming-an515-57-5669-i5-nhqehsv001-note-.jpg', 'i5, 11400H, 2.7GHz', '8 GB, DDR4 2 khe (1 khe 8 GB + 1 khe rời), 3200 MHz', '512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB), Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng (nâng cấp tối đa 1 TB), Hỗ trợ khe cắm HDD SATA (nâng cấp tối đa 2 TB)', '15.6 inch, Full HD (1920 x 1080), 144Hz', 'Card rời, GTX 1650 4GB', 'USB Type-C, HDMI, LAN (RJ45), 3 x USB 3.2, Jack tai nghe 3.5 mm', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 363.4 mm - Rộng 255 mm - Dày 23.9 mm - Nặng 2.2 kg', '2021', '', '2023-07-19 17:27:40'),
(53, 'Laptop Acer Nitro 5 Tiger AN515 58 52SP i5 12500H/8GB/512GB/4GB RTX3050/144Hz/Win11 (NH.QFHSV.001)', 'laptop', 'Acer', 34, 'Một bước tiến cấu hình vượt bật được Acer ưu ái trên chiếc laptop Acer Nitro 5 Tiger AN515 58 52SP i5 (NH.QFHSV.001) khi trang bị bộ vi xử lý Intel Gen 12 đầy mạnh mẽ cùng phong cách thiết kế đậm chất “mãnh hổ”, khơi nguồn sức mạnh tiềm ẩn bên trong mỗi game thủ trên mọi chiến trường ảo. \r\nBùng nổ sức mạnh với con chip Intel Gen 12 mạnh mẽ\r\n\r\n\r\n\r\n\r\n', 'Mình đã rất kinh ngạc khi Nitro 5 Tiger không chỉ đặc biệt với cái tên trùng với con giáp Mãnh Hổ của năm 2022 mà còn là một trong những nhân vật đại diện đầu tiên của nhà Acer tân trang con chip Intel thế hệ 12 đầy mạnh mẽ. Để giải đáp sự tò mò về sức mạnh vượt bật của bộ vi xử lý Intel Core i5 Alder Lake 12500H này, mình sẽ sử dụng phần mềm Cinebench R20 để kiểm chứng khả năng của em nó đến đâu nhé!\r\n', 'Sau những phút chờ đợi “vất vả” thì mình đo được 4723 điểm với đa nhân và 642 điểm với đơn nhân, cho khả năng xử lý mọi tác vụ trên cả tuyệt vời, bên cạnh đó cũng “ăn” cao nhất 87W điện cho CPU và tiêu tốn 93 độ khi chưa bật Nitro Sense.\r\n', 'Sẵn đang đề cập đến Nitro Sense thì mình cho ngay chiếc laptop này 10 điểm cộng với tốc độ quạt được cải tiến hơn 7000 vòng trên phút, trong khi những thế hệ cũ chỉ nằm đâu đó khoảng 5000 - 6000 vòng, từ đó giúp cải thiện rất nhiều cho khả năng tản nhiệt của máy mỗi khi chiến các tựa game đình đám. \r\n', 'Sự xuất hiện của hệ thống khe hút gió và các cổng kết nối như Thunderbolt 4 USB-C, HDMI, cổng sạc ngay phía dưới cạnh mặt sau của laptop Acer đã ghi điểm cộng đối với mình bởi sự thuận tiện của nó, cho các thao tác đi dây được gọn gàng hơn hẳn. Nhưng đừng nghĩ là chỉ có nhiêu đó thôi nhé, ở hai bên cạnh trái phải của máy cũng được trang bị đầy đủ các cổng bao gồm 3 cổng USB 3.2, LAN và Jack tai nghe 3.5 mm hỗ trợ rất nhiều trong việc truyền tải dữ liệu đến các thiết bị ngoại vi khác. ', 'Một trong những “linh hồn” làm nên chiếc laptop gaming thì không thể thiếu được bàn phím, và tương tự như các dòng sản phẩm tiền nhiệm, Nitro 5 Tiger vẫn sở hữu layout bàn phím fullsize với hành trình sâu và độ nả', 21000000, 27990000, 22990000, 'acer-nitro-5-tiger-an515-58-52sp-i5-nhqfhsv001-abc-1.jpg', 'acer-nitro-5-tiger-an515-58-52sp-i5-nhqfhsv001-note.jpg', 'acer-nitro-5-tiger-an515-58-52sp-i5-nhqfhsv001-30.jpg', 'i5, 12500H, 2.5GHz', '8 GB, DDR4 2 khe (1 khe 8 GB + 1 khe rời), 3200 MHz', '512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB), Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng (nâng cấp tối đa 1 TB), Hỗ trợ thêm 1 khe cắm HDD SATA (nâng cấp tối đa 1 TB)', '15.6 inch, Full HD (1920 x 1080), 144Hz', 'Card rời, RTX 3050 4GB', 'HDMI, LAN (RJ45), 3 x USB 3.2, Jack tai nghe 3.5 mm, Thunderbolt 4 USB-C', 'Windows 11 Home SL', ' Vỏ nhựa', 'Dài 360.4 mm - Rộng 271.09 mm - Dày 25.9 mm - Nặng 2.5 kg', ' 2022', '', '2023-07-19 17:27:40'),
(54, 'Bàn Phím Cơ Có Dây Gaming Razer BlackWidow V3', 'banphim', 'Razer', 89, 'Thiết kế hiện đại, có giá đỡ chống mỏi cổ tay, chơi game lâu như bạn muốn. \r\nBàn phím có 104 phím, vùng phím số tách riêng.\r\n\r\n\r\n\r\n', 'Có bánh xe lăn và phím đa năng dễ dàng tùy chọn âm lượng, độ sáng, tạm dừng,... \r\nĐộ bền cứng cao với keycap ABS Doubleshot. \r\n', 'Tỏa sáng trong bóng tối với đèn LED RGB Chroma 16.8 triệu màu.', 'Kiểu dáng hình chữ nhật, các phím được sắp xếp giúp tối ưu thao tác cho người sử dụng, có giá kê tay giúp giảm áp lực cho cổ tay, đảm bảo sự thoải mái ngay cả khi chơi game trong thời gian dài. Có phần khung làm từ nhôm độ bền cao, tin cậy về chất lượng. ', 'Sản phẩm đáp ứng tốt nhu cầu chơi game, tác vụ văn phòng, sử dụng hằng ngày, nhập số liệu nhanh hơn với khu vực phím số tách riêng. Điều chỉnh âm lượng, độ sáng, phát, tạm dừng,... linh hoạt khi cấu hình cho bánh xe lăn và phím đa năng được thiết kế ở góc trên bên phải bàn phím. ', 'Nhìn chung, Gaming Razer BlackWidow V3 là mẫu bàn phím cực đáng sắm cho các game thủ với thiết kế full size, có thêm bánh lăn, phím đa năng tiện dụng, keycap ABS Doubleshot siêu bền, đèn LED RGB Chroma đa màu và giá cả phải chăng, chọn ngay!', 2000000, 3640000, 2370000, 'ban-phim-co-co-day-gaming-razer-blackwidow-v3-2-1-org.jpg', 'ban-phim-co-co-day-gaming-razer-blackwidow-v3-4-1-org.jpg', 'ban-phim-co-co-day-gaming-razer-blackwidow-v3-20.jpg', 'Windows', 'Dây cắm USB', 'RGB', '104 phím', 'Mỹ', 'Razer.', '', '', '', '', '', '2023-07-19 17:27:40'),
(55, 'Bàn Phím Cơ Bluetooth Rapoo V700 - 8A', 'banphim', 'Rapoo', 16, '• Thiết kế nhỏ gọn và chắc chắn, bàn phím chỉ chiếm không gian khá nhỏ trên khu vực làm việc.\r\n\r\n• Trang bị đèn LED màu trắng với 7 hiệu ứng ánh sáng vừa hỗ trợ gõ phím dễ dàng hơn, vừa giúp tăng tính thẩm mỹ cho không gian làm việc hay giải trí, đặc biệt làm nổi bật góc phòng khi làm việc/học tập vào ban đêm hoặc những nơi thiếu sáng.\r\n\r\n• Bàn phím sở hữu các phím cơ kiểu máy đánh chữ, khi sử dụng bạn sẽ nghe những âm thanh lách cách phát ra từng bàn phím rất vui tai.\r\n\r\n• Kết nối với máy tính bàn, laptop,... nhanh chóng và ổn định trong vòng 10 m thông qua kết nối không dây: Bluetooth hoặc đầu thu USB. Ngoài ra, bạn có thể kết nối có dây qua cổng USB trên máy tính (dây sạc USB - Type C được trang bị sẵn sẽ đóng vai trò là dây nối biến bàn phím từ không dây thành có dây).\r\n\r\n• Thời gian sử dụng bàn phím Rapoo lâu dài, lên đến 225 giờ khi không dùng đèn nền, khi dùng đèn nền thời gian có thể đạt khoảng 120 tiếng, sau khi bàn phím hết pin có thể dễ dàng sạc lại.\r\n\r\n• Bàn phím Rapoo tương thích với các hệ điều hành phổ biến hiện nay, yêu cầu từ Windows 7 và macOS 10.15 trở lên.', '', '', '', '', '', 1200000, 2000000, 1490000, 'ban-phim-co-bluetooth-rapoo-v700-8a-1.jpg', 'ban-phim-co-bluetooth-rapoo-v700-8a-20.jpg', 'ban-phim-co-bluetooth-rapoo-v700-8a-6.jpg', 'Từ macOS 10.15 trở lên, Từ Windows 7 trở lên', 'USB Receiver (đầu thu USB), Bluetooth, Dây cắm USB', 'Đèn nền màu trắng với 7 hiệu ứng ánh sáng', '84 Phím', 'Trung Quốc', 'Rapoo.', '', '', '', '', '', '2023-07-19 17:27:40'),
(56, 'Laptop MSI Gaming GF63 Thin 11SC i5 11400H/8GB/512GB/4GB GTX1650/144Hz/Win11 (664VN)', 'laptop', 'MSI', 11, '• Bộ vi xử lý Intel Core i5 11400H kết hợp cùng card đồ họa NVIDIA GeForce GTX 1650 4 GB cho phép bạn chiến các tựa game đình đám như Liên Minh Huyền Thoại, CS:GO, PUBG,... ở mức cấu hình cao, đồng thời có khả năng xử lý đồ họa với hiệu suất cao.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '• Màn hình 15.6 inch rộng rãi phù hợp để chơi game, làm việc văn phòng, tấm nền IPS hỗ trợ độ phân giải Full HD có khả năng tái tạo hình ảnh với góc nhìn rộng, có độ chi tiết cao, mang đến cho bạn trải nghiệm khung hình sắc nét và sống động hơn.', '\r\n• RAM 8 GB với khả năng nâng cấp lên đến tối đa 64 GB cho khả năng xử lý đa nhiệm tốt, chạy nhiều ứng dụng cùng một lúc mà không gặp phải giật lag gây khó chịu. Ổ SSD 512 GB NVMe PCIe có thể lưu trữ nhiều tệp tin lớn, cải thiện hiệu suất khi chơi game và xử lý đồ họa.', '• Công nghệ âm thanh Realtek High Definition Audio cho phép người dùng tùy chỉnh âm lượng, cân bằng âm để bạn có những giây phút giải trí tuyệt vời.', '• Laptop MSI sở hữu lớp vỏ ngoài được hoàn thiện từ chất liệu kim loại vừa đảm bảo độ bền bỉ vừa tạo cảm giác sang trọng, khối lượng 1.86 kg không quá nặng đối với một chiếc laptop gaming.\r\n', '• Đèn bàn phím màu đỏ hỗ trợ bạn điều khiển nhân vật trong game dễ dàng hơn về đêm. Laptop còn được trang bị nhiều cổng kết nối như: HDMI, USB 3.2, USB Type-C, LAN.', 14900000, 16490000, 15190000, 'msi-gaming-gf63-thin-11sc-i5-664vn-123-glr-1-2.jpg', 'msi-gaming-gf63-thin-11sc-i5-664vn-123-glr-2.jpg', 'msi-gaming-gf63-thin-11sc-i5-664vn-30.jpg', 'i5, 11400H, 2.7GHz', '8 GB, DDR4 2 khe (1 khe 8 GB + 1 khe rời), 3200 MHz', '512 GB SSD NVMe PCIe, Hỗ trợ khe cắm SATA 2.5 inch mở rộng (nâng cấp SSD hoặc HDD đều được)', '15.6 inch, Full HD (1920 x 1080), 144Hz', 'Card rời, GTX 1650 4GB', 'USB Type-C, HDMI, LAN (RJ45), 3 x USB 3.2, Jack tai nghe 3.5 mm', 'Windows 11 Home SL', 'Vỏ kim loại', 'Dài 359 mm - Rộng 254 mm - Dày 21.7 mm - Nặng 1.86 kg', '2022', '', '2023-07-19 17:27:40'),
(57, 'Cáp Type C - Lightning 1m Apple MM0A3 ', 'cap-dien-thoai', 'Apple', 123, 'Cáp sạc màu trắng sang trọng, có chiều dài 1 m, phù hợp dùng tại nhà, công ty.\r\n\r\n\r\n\r\n', 'Sạc pin mạnh mẽ với mức công suất lên đến 87 W. \r\nĐồng bộ hóa dữ liệu hiệu quả giữa điện thoại và laptop. ', 'Thiết kế tinh giản, chiều dài lý tưởng 1 m\r\n“Sang - xịn - mịn” là ba từ chính xác nhất để mình miêu tả vẻ ngoài của cáp Type C - Lightning 1 m Apple MM0A3. Không thể phủ nhận một điều rằng Apple rất chỉn chu trong từng sản phẩm ngay từ vỏ hộp cho đến sản phẩm bên trong. Cảm giác của mình khi đập hộp sợi dây cáp này phải gọi là đã, tổng thể của dây cáp được hoàn thiện tỉ mỉ với sắc màu trắng quen thuộc. ', 'Đầu vào Type-C và đầu ra Lightning sử dụng với các thiết bị Apple, adapter sạc, sạc dự phòng.\r\nMẫu dây cáp Apple MM0A3 giống Apple MX0K2, chỉ khác mã lô.', 'Cáp Type C - Lightning 1m Apple MM0A3 Trắng sở hữu thiết kế đơn giản, độ dài 1 m cùng khả năng sạc nhanh lên đến 87 W chính là sự lựa chọn tuyệt vời cho các iFans chân chính.', 'Hàng chính hãng Apple, nguyên seal 100%.\r\n', 460000, 590000, 490000, 'cap-type-c-lightning-1m-apple-mm0a3-trang-1-1.jpg', 'cap-type-c-lightning-1m-apple-mm0a3-trang-2.jpeg', 'cap-type-c-lightning-1m-apple-mm0a3-trang-3-1.jpg', 'Truyền dữ liệu, Sạc', 'Type-C, Lightning', 'USB Type-C', 'Lightning', '87 W', 'Hỗ trợ sạc nhanh', '1 m', 'Mỹ', 'Việt Nam/Trung Quốc (tùy lô hàng)', 'Apple.', '', '2023-07-19 17:27:40'),
(58, 'Adapter Sạc Type C 20W dùng cho iPhone/iPad Apple MHJE3', 'sac-dien-thoai', 'Apple', 15, 'Adapter sạc nhanh Type C dành cho iPhone, iPad.\r\n\r\n\r\n\r\n\r\n\r\n', 'Cổng ra Type-C, kết nối thêm dây cáp để sạc cho điện thoại, máy tính bảng.\r\nSản phẩm chính hãng Apple, nguyên seal 100%.', 'Thiết kế nhỏ gọn, chuôi 2 chấu phổ biến.', 'Công suất 20 W cho tốc độ sạc nhanh chóng.', 'Ấn tượng đầu tiên khi cầm củ sạc Apple này trên tay, kiểu dáng nhỏ gọn, chiều ngang chỉ khoảng 2/3 thẻ căn cước công dân và chiều dài cũng chỉ gần bằng thẻ này. Đặc biệt, mình có thể cầm trọn trong lòng bàn tay, điều này cũng tương đương với việc củ sạc không chiếm nhiều diện tích trên ổ cắm và trong các ngăn balo, túi xách,... \r\n', 'Chất liệu nhựa màu trắng cứng cáp, các khớp được liên kết với nhau liền mạch cùng các viền được bo tròn, khi mình cầm củ sạc trên tay mang lại cảm giác đằm tay, chắc chắn và cũng khá thoải mái.', 500000, 690000, 520000, 'adapter-sac-type-c-20w-cho-iphone-ipad-apple-mhje3-1-org.jpg', 'adapter-sac-type-c-20w-cho-iphone-ipad-apple-mhje3-6.jpg', 'adapter-sac-type-c-20w-cho-iphone-ipad-apple-mhje3-3-org.jpg', 'MHJE3', 'Sạc', 'Hãng không công bố', 'Type C: 20W', ' Type-C', ' 20 W', ' Hãng không công bố', 'Power Delivery', 'Việt Nam / Trung Quốc (tùy lô hàng)', ' Mỹ', 'Apple.', '2023-07-19 17:27:40'),
(59, 'Laptop Acer Aspire 3 A3KS N5100/4GB/256GB/Win11 (NX.A7SSV.009)', 'laptop', 'Acer', 12, 'assss', '', '', '', '', '', 12000000, 2111111, 11111111, 'msi-gaming-gf63-thin-11sc-i5-664vn-123-glr-2.jpg', 'adapter-sac-type-c-20w-cho-iphone-ipad-apple-mhje3-1-org.jpg', 'msi-gaming-gf63-thin-11sc-i5-664vn-123-glr-1-2.jpg', 'i5, 12450H, 2GHz', 'á', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '', '2023-07-19 17:27:40'),
(60, 'demo them xxxx', 'laptop', 'abc', 8, '45th', '', '', '', '', '', 99999999, 99999, 2, 'acer-aspire-3-a314-35-c3ks-n5100-nxa7ssv009-3-1.jpg', 'acer-aspire-7-gaming-a715-76g-5132-i5-nhqmesv002-glr-1.jpg', '7GzRRsSbEe6jW3wL3NmM.jpeg', '45', '54', '54', '5', '45', '45', '45', '45', '54', '45', '', '2023-08-17 00:26:09'),
(61, 'them sp new', 'dtdd', 'abc', 88, 'ggggg', '', '', '', '', '', 999999, 99999, 5, 'acer-aspire-3-a315-57-379k-i3-nxkagsv001-ab-3.jpg', 'acer-aspire-7-gaming-a715-76g-5132-i5-nhqmesv002-glr-1.jpg', 'acer-aspire-3-a315-57-379k-i3-nxkagsv001-ab-3.jpg', '45', '54', '54', '5', '45', '45', '45', '45', 'jjjj', '', '', '2023-08-17 00:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` varchar(200) NOT NULL,
  `post_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `rating` varchar(1) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image_rv` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `post_id`, `user_id`, `rating`, `title`, `description`, `image_rv`, `date`) VALUES
('1n7IvmyjocYkhsE2xLVX', 33, 2, '5', '1', '1', 'F0ASBMOTdpPHDNxbjKoq.jpg', '2023-07-19 16:12:58'),
('3lTdFeXe4T17s5e7aKVk', 33, 1, '4', 'hay', 'nên mua', '', '2023-06-22 00:00:00'),
('3sGVAwSqTVhhZqRVwO9E', 36, 14, '4', 'tuyet voi', 'cccccvvvvvvvvvvfdfdfđf', 'adapter-sac-type-c-20w-cho-iphone-ipad-apple-mhje3-1-org.jpg', '2023-08-17 00:38:56'),
('4XBpeC3wdhPxjh4Ct8a8', 52, 2, '2', '1', '1', 'BhBrdbhCJc1Z65sgikHo.jpg', '2023-07-19 18:23:46'),
('7Ry5cjhz9NUYX970HzVU', 23, 2, '5', 'tốt', 'hàng dùng bền \r\ngiao hàng nhanh thanh toán tiện lợi\r\nlại còn giá hạt giẻ\r\nmãi iu shop', '', '2023-06-21 00:00:00'),
('AhsbdJuAklJFDIpcek3R', 32, 1, '5', 'hihi', 'xịn', '', '2023-06-22 00:00:00'),
('bs0VVl0G6Jz8yd9QhEOO', 32, 14, '5', 'xxx', 'raart moke la', 'acer-aspire-3-a314-35-c3ks-n5100-nxa7ssv009-3-1.jpg', '2023-08-17 00:28:26'),
('c8xM41Y21a4dfC1TGgRO', 46, 1, '5', 'tốt', 'dùng mãi không hỏng', 'iphone-11-128gb-trang-12-org.jpg', '2023-07-16 15:12:48'),
('cYGNpFCfN6Bd2dO2TU0s', 19, 1, '5', 'hmk', 'iuiu', '', '2023-06-21 00:00:00'),
('dqhPqqo3pACkDM8VgF4k', 20, 1, '4', 'hiho', 'nghe được ổn', '', '2023-06-21 00:00:00'),
('ij06gJtFRKPrCTSyp2Ui', 14, 2, '3', 'huhu', '111', '', '2023-06-18 00:00:00'),
('iJokKAYRsmzmAsfNy814', 25, 1, '3', 'hi', 'hi', '', '2023-07-15 00:00:00'),
('jtdoqmnIga7BgNiXbbta', 24, 1, '4', 'hihi', '111', '', '2023-07-18 21:22:30'),
('QPrYbDGQcf3kgJT4lefA', 51, 1, '5', 'tốt', 'Đã dùng thử và rất ổn', 'X7dRUmh1ZBJ2j8KA6OEb.jpg', '2023-07-15 00:00:00'),
('RhpCFFmqDfkYHuh0F8vu', 16, 2, '5', 'xịn', 'rẻ', '', '2023-06-16 00:00:00'),
('RPtKbU8YLn86RCjcm8Tq', 38, 1, '5', 'đc', 'dùng ổn', '', '2023-06-24 00:00:00'),
('sicrgd4cIaLulIs3Vvti', 31, 1, '5', 'hihi', 'đáng tiền', '', '2023-06-21 00:00:00'),
('T2KgyuldHgqX1uiujn0J', 19, 3, '2', 'te', 'deu', '', '2023-06-23 00:00:00'),
('t5hlxXF2ktNXMiWle8yh', 42, 3, '5', 'xịn', 'đáng tiền', '', '2023-06-23 00:00:00'),
('TjygMSwgD7jQjguCpy5J', 34, 1, '5', 'rẻ', 'ngon bổ rẻ', '', '2023-06-22 00:00:00'),
('ueQYjaUFA7ENByfCvLe0', 14, 1, '1', '1', '1', '', '2023-07-15 00:00:00'),
('uhLJbhAPSZ5Hi2XnsTop', 52, 6, '5', 'tốt', 'giá hạt rẻ', '', '2023-06-24 00:00:00'),
('Uqdu73aT7xtjwQP5WjQe', 21, 4, '5', 'hihi', 'hi', '', '2023-06-22 00:00:00'),
('xHhmiyRIqhLOUUIOzBTL', 17, 3, '2', 'kiên hihi', 'ủa tường iphone nên mua hóa ra là samsung', '', '2023-06-17 00:00:00'),
('XUjChJmfKqKwSn8IppHG', 18, 2, '4', 'tốt', 'không có gì để chê', '', '2023-06-21 00:00:00'),
('y03BR1EUTQOH3qvlgLqt', 17, 1, '4', 'hmm', 'tốt', '1jFSsXZBj9pS0ojKUWNS.jpg', '2023-07-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_number` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `flat` varchar(200) NOT NULL,
  `street` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `pin_code` varchar(200) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `email`, `password`, `image`, `flat`, `street`, `city`, `pin_code`, `date_time`) VALUES
(1, 'Hữu Huy', 76867688, 'nguyenhuuhuy@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'fbgZ3hwd1FQvp82YCzHZ.png', '121', 'alu', 'ch', '111111', '2023-07-19 21:22:43'),
(2, 'Quang Huy', 999999999, 'nguyenhuy2@icloud.com', '356a192b7913b04c54574d18c28d46e6395428ab', '80fNzhroGDKSApWwYFKk.png', '11', 'Vĩnh tường', 'Vĩnh Phúc', '111111', '2023-07-19 21:22:43'),
(3, 'trung kiên', 335190000, 'nhhcutehihi@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'cxf408iiEj5wPO1k0r83.jpg', '123', 'vĩnh tường', 'Vĩnh Phúc', '111111', '2023-07-19 21:22:43'),
(4, 'việt trung', 0, 'nguyenhuy@icloud.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'wdxLu6TifNfqC1yakPrA.png', '', '', '', '', '2023-07-19 21:22:43'),
(6, 'cậu bé hay khóc', 0, 'hihihuhu@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'In4TfNPCHoJmKg3CxORI.jpg', '', '', '', '', '2023-07-19 21:22:43'),
(9, 'admin', 0, 'nhhcutehihi111@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '', '', '', '', '', '2023-07-19 21:22:43'),
(14, 'nnnn', 787676766, 'xxxx@gmail.com', 'e57a14bb5a3ccdc260d173d989d187d86d4aabfa', '', 'fff', 'xxxxxx', 'Huyện Lục Yên', '70000', '2023-08-15 16:05:17'),
(15, 'xxxxxx', 364877525, 'xxxxxx@gmail.com', 'c9118e242cbd5a4b50c291d63d71f191ae894bfe', 'iIonpp4WFreRmv2qtY6o.jpg', '4565', 'hcm', 'Tỉnh Vĩnh Phúc', '7000', '2023-08-17 00:31:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details_order`
--
ALTER TABLE `details_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `details_order`
--
ALTER TABLE `details_order`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
