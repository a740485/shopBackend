-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shop`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `create_at`) VALUES
('1', '5', '2020-10-08 06:34:49'),
('1', '6', '2020-10-23 05:35:28'),
('1', '7', '2020-10-08 06:22:04');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(5) DEFAULT NULL,
  `amount` int(5) DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `user_id`, `title`, `img`, `price`, `amount`, `update_time`) VALUES
(5, 1, 'MINI液晶行動電源 10000mAh 迷你行動電源 方便攜帶 智能晶片 大容量小體積 LED數據 【蝦皮團購】', 'https://cf.shopee.tw/file/4e93e07490f24b76d625a15d830a8992_tn', 100, 10, '2020-10-18 07:28:26'),
(6, 1, '【買到戀愛】韓系文青ins純色V領外搭針織背心【M8121】', 'https://cf.shopee.tw/file/1b5295ed91100c4c29d629af25186b24_tn', 50, 40, '2020-10-18 07:26:18'),
(7, 1, '7-11 海底撈 台灣製 懶人火鍋 自煮火鍋 火鍋 自熱火鍋 火鍋控 麻辣鍋 麻辣火鍋 火鍋湯底 小火鍋 懶人鍋', 'https://cf.shopee.tw/file/87ba50b5c6a67f524b6ee1609138f46b_tn', 150, 50, '2020-10-18 07:27:16'),
(8, 2, '【全賣場最低 附發票】簡約地毯 客廳 沙發 茶几毯 卧室 家用 地毯 床邊毯 毛地毯 地毯 地墊 北歐風地毯 墊子', 'https://cf.shopee.tw/file/8260fa55d1f4770dfd52126fc6e5d711_tn', 300, 2, '2020-10-18 07:31:15'),
(9, 1, '7-11 海底撈 台灣製', 'https://cf.shopee.tw/file/8260fa55d1f4770dfd52126fc6e5d711_tn', 499, 100, '2020-10-23 05:09:06');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `phone`, `email`, `address`, `create_at`, `update_at`) VALUES
(1, '1', '1', '', '', '', '2020-10-01 02:52:18', '2020-10-01 02:52:18');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
