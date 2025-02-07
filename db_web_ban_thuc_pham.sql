-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 13, 2023 lúc 10:32 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_web_ban_thuc_pham`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'lê hữu vinh', 'yeuthethao37@gmail.com', '4297f44b13955235245b2497399d7a93', '0335944671'),
(4, 'Hoàng Văn Tuấn', 'tuankhi@gmail.com', '4297f44b13955235245b2497399d7a93', '0394853875');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `admin_id`, `roles_id`) VALUES
(35, 4, 2),
(36, 4, 1),
(47, 1, 2),
(48, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `values_cart` longtext NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `values_cart`, `user_id`) VALUES
(1, '[{\"uid\":\"cbm3tubrxkjwgf06vpyae9jzqeyqfjeh\",\"product\":\"16\",\"name\":\"\\u0110\\u00f9i g\\u00e0\",\"price\":35000,\"qty\":1,\"weight\":0,\"discount\":0,\"tax\":0,\"shipping\":0,\"thumb\":\"dui-ga-dong-lanh.jpeg\",\"options\":[],\"subtotal\":\"35000.00\",\"total\":\"35000.00\",\"created_at\":\"2023-08-17T16:13:43.173530Z\",\"updated_at\":null}]', 4),
(3, '[{\"uid\":\"llgjj8oyhgboqplfyh2nv01jfymza4mg\",\"product\":\"14\",\"name\":\"C\\u00e1nh g\\u00e0\",\"price\":60000,\"qty\":1,\"weight\":0,\"discount\":0,\"tax\":0,\"shipping\":0,\"thumb\":\"canh-ga-dong-lanh.jpg\",\"options\":[],\"subtotal\":\"60000.00\",\"total\":\"60000.00\",\"created_at\":\"2022-04-03T09:34:48.495561Z\",\"updated_at\":null},{\"uid\":\"njxjpwqm2jprc6uppuvumfffsojwqeg9\",\"product\":\"5\",\"name\":\"\\u0110\\u00f9i t\\u01b0 dai\",\"price\":300000,\"qty\":1,\"weight\":0,\"discount\":0,\"tax\":0,\"shipping\":0,\"thumb\":\"dui-dai.jfif\",\"options\":[],\"subtotal\":\"300000.00\",\"total\":\"300000.00\",\"created_at\":\"2022-04-03T09:34:48.504092Z\",\"updated_at\":null},{\"uid\":\"ckiutglbdpgqmm9birsrqddlwz8vayy3\",\"product\":\"4\",\"name\":\"L\\u00f2ng tr\\u00e2u\",\"price\":150000,\"qty\":5,\"weight\":0,\"discount\":0,\"tax\":0,\"shipping\":0,\"thumb\":\"long-trau-an-do.jpg\",\"options\":[],\"subtotal\":\"750000.00\",\"total\":\"750000.00\",\"created_at\":\"2022-04-03T09:34:48.504299Z\",\"updated_at\":null}]', 1),
(4, '[{\"uid\":\"np9a5kbxqvguuhqvuo67hqpgje3guh9m\",\"product\":\"7\",\"name\":\"Ph\\u1edf\",\"price\":500000,\"qty\":3,\"weight\":0,\"discount\":0,\"tax\":0,\"shipping\":0,\"thumb\":\"bfoe.jpg\",\"options\":[],\"subtotal\":\"1500000.00\",\"total\":\"1500000.00\",\"created_at\":\"2023-08-17T11:46:19.616819Z\",\"updated_at\":null}]', 3),
(5, '[]', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `slug`, `created_at`) VALUES
(1, 'Thịt gà đông lạnh', 1, 'thit-ga-dong-lanh', '2022-03-08'),
(2, 'Thịt gà tươi sạch', 1, 'thit-ga-tuoi-sach', '2022-03-08'),
(3, 'Thịt bò Úc Mỹ ngon', 1, 'thit-bo-uc-my', '2022-03-08'),
(4, 'Thịt lợn', 1, 'thit-lon', '2022-03-08'),
(5, 'Thịt trâu Ấn Độ', 1, 'thit-trau-an-do', '2022-03-08'),
(6, 'Hải sản', 1, 'hai-san', '2022-03-08'),
(7, 'Gạo sạch cao cấp', 1, 'gao-sach-cao-cap', '2022-03-08'),
(8, 'Gia vị tẩm ướp', 0, 'gia-vi-tam-uop', '2022-03-08'),
(17, 'Món rừng núi', 1, 'mon-rung-nui', '2022-03-26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_news`
--

CREATE TABLE `category_news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_news`
--

INSERT INTO `category_news` (`id`, `name`, `description`, `status`, `slug`) VALUES
(4, 'Món ngon bổ mỗi ngày', 'Hướng dẫn chị em nấu các món ngon đơn giản mỗi ngày', 1, 'mon-ngon-bo-moi-ngay'),
(5, 'Sức khỏe đời sống', 'Hướng dẫn sống khỏe sống đẹp', 1, 'suc-khoe-doi-song'),
(6, 'Sắp xếp thời gian hợp lý', 'Hướng dẫn cách sắp xếp time hợp lý để hài hòa giữa công việc và gia đình', 1, 'sap-xep-thoi-gian-hop-ly'),
(7, 'Hâm nóng tình cảm vợ chồng', 'Những mẹo hay để giữ vững tình cảm vợ chồng', 1, 'ham-nong-tinh-cam-vo-chong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `name_user_comment` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `content`, `name_user_comment`, `time`, `product_id`, `user_id`, `status`) VALUES
(4, 'Sản phẩm này mua số lượng lớn được ko nhỉ?', 'cong hoa', '2022-03-18 18:09:37', 7, 1, 0),
(5, 'làm người yêu anh nhé', 'Lê Hữu Vinh', '2022-03-19 16:59:16', 7, 4, 1),
(11, 'Xinh như này phải có 10 người yêu', 'Lê Hữu Vinh', '2022-03-20 02:37:11', 7, 4, 1),
(12, 'Thêm chai rượi nữa thì tuyệt vời', 'Lê Hữu Vinh', '2022-03-20 07:07:49', 5, 4, 1),
(13, 'xin giới thiệu a là Hòa, làm người yêu anh nhé', 'Nguyễn Công Hòa', '2022-03-21 09:43:27', 7, 1, 1),
(15, 'Làm nồi lẩu thì tuyệt vời nhỉ', 'Lê Hữu Vinh', '2022-03-24 10:45:01', 2, 4, 1),
(16, 'Nhìn ngon chảy nước miếng', 'Lê Hữu Vinh', '2022-03-24 10:53:12', 3, 4, 1),
(21, 'anh rất yêu em', 'Lê Hữu Vinh', '2022-03-25 11:28:00', 7, 4, 1),
(22, 'ngon dã man', 'Lê Hữu Vinh', '2022-03-25 12:36:09', 2, 4, 1),
(23, 'ngon ko shop, bán ít về nhậu', 'Lê Hữu Vinh', '2022-03-25 12:48:23', 4, 4, 1),
(24, 'có bán kèm bia shop?', 'Nguyễn Công Hòa', '2022-03-26 14:23:30', 16, 1, 1),
(25, 'Đã mua ăn rất ngon nha bà con', 'Lê Hữu Vinh', '2022-03-31 20:03:38', 4, 4, 1),
(26, 'Thêm tí rượu nữa thì hết nước chấm', 'Lê Hữu Vinh', '2023-08-16 14:01:33', 15, 4, 1),
(27, 'Đẹp bằng em không mấy anh?', 'Lê Thị Hoài Linh', '2023-08-16 15:15:13', 7, 3, 1),
(28, 'Nấu nối cháo thì hết sẩy mấy anh ơi!!', 'Lê Thị Hoài Linh', '2023-08-17 18:31:34', 23, 3, 1),
(29, 'Khá là ok', 'Lê Hữu Vinh', '2023-08-17 18:47:01', 23, 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `used` int(11) DEFAULT 0,
  `condition` varchar(255) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `duration` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user_used` text DEFAULT NULL,
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`id`, `name`, `code`, `amount`, `used`, `condition`, `rate`, `duration`, `id_user_used`, `updated_at`, `created_at`) VALUES
(9, 'Ngày thứ 6 đen tối', 'BLACKFRIDAY', 500, 500, 'percent', '10', '2025-03-07 15:11:31', ',4', '2023-08-16', '2022-03-21'),
(10, 'Giải phóng miền Nam', '30/4/1975', 500, 3, 'money', '50000', '2022-12-23 21:52:00', ',4,6,1', '2022-04-03', '2022-03-23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `product_id`) VALUES
(13, 'thitbodonglanh4380.gif', 3),
(14, 'thit-bo-uc-300x2132874.jpg', 3),
(15, 'images7118.jfif', 3),
(17, '134123-loi-vai-bo-11041.webp', 2),
(18, 'loi-than-bo-my8809.webp', 2),
(19, 'loi-than-b0-my-14926.webp', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `content` text NOT NULL,
  `description` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` text NOT NULL,
  `category_news_id` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `content`, `description`, `meta_desc`, `meta_keyword`, `status`, `image`, `category_news_id`, `view`) VALUES
(7, 'Cách nấu ăn ngon', 'cach-nau-an-ngon-2', '<p>Bạn đang muốn l&agrave;m m&oacute;n g&igrave; lạ miệng để chi&ecirc;u đ&atilde;i cả nh&agrave; nhưng kh&ocirc;ng c&oacute; &yacute; tưởng g&igrave; v&igrave; c&aacute;c nguy&ecirc;n liệu qu&aacute; quen thuộc? H&ocirc;m nay, cũng với&nbsp;<a href=\"https://monngonmoingay.com/tim-kiem/%C4%91%C3%B9i%20g%C3%A0/\">đ&ugrave;i g&agrave;</a>, nhưng đầu bếp sẽ giới thiệu một c&aacute;ch chế biến v&agrave; thực hiện mới &ldquo;Đ&ugrave;i g&agrave; &aacute;p chảo xốt thơm&rdquo;. Bảo đảm cả nh&agrave; sẽ trố mắt ngạc nhi&ecirc;n cho m&agrave; xem.</p>\r\n\r\n<p><img alt=\"nguyên liệu\" src=\"https://monngonmoingay.com/wp-content/themes/monngonmoingay/images/icon-nguyenlieu.png\" style=\"height:30px; width:33px\" />&nbsp;NGUY&Ecirc;N LIỆU</p>\r\n\r\n<p><em>M: muỗng canh - m: muỗng cafe</em></p>\r\n\r\n<ul>\r\n	<li>Đ&ugrave;i g&agrave; g&oacute;c tư : 2 c&aacute;i</li>\r\n	<li>H&agrave;nh t&acirc;y: 1/2 củ</li>\r\n	<li>Ớt chu&ocirc;ng xanh : 1/4 tr&aacute;i</li>\r\n	<li>Thơm ch&iacute;n : 1/4 tr&aacute;i</li>\r\n	<li>Ớt sừng : 2 tr&aacute;i</li>\r\n	<li>Gừng : 15g</li>\r\n	<li>H&agrave;nh t&iacute;m băm : 1M</li>\r\n	<li>Nước tỏi : 2M</li>\r\n	<li>Nước dừa tươi : 2 ch&eacute;n</li>\r\n	<li>X&agrave; l&aacute;ch</li>\r\n	<li>Dầu ăn, dầu điều, ti&ecirc;u, nước mắm, tương ớt, nước bột năng</li>\r\n	<li><a href=\"https://monngonmoingay.com/nuoc-tuong-phu-si/\">Nước tương&nbsp;</a><a href=\"https://monngonmoingay.com/nuoc-tuong-phu-si/\"><img alt=\"Nước tương\" src=\"https://monngonmoingay.com/wp-content/uploads/2015/07/nuoc-tuong-phu-si-icon.png\" style=\"height:16px; width:49px\" /></a></li>\r\n	<li><a href=\"https://monngonmoingay.com/hat-nem-aji-ngon-ga/\">Hạt n&ecirc;m&nbsp;</a><a href=\"https://monngonmoingay.com/hat-nem-aji-ngon-ga/\"><img alt=\"Hạt nêm Aji-ngon® Gà\" src=\"https://monngonmoingay.com/wp-content/uploads/2015/07/aji-ngon-1.jpg\" style=\"height:22px; width:61px\" />&nbsp;G&agrave;</a></li>\r\n</ul>\r\n\r\n<p><img alt=\"nguyên liệu\" src=\"https://monngonmoingay.com/wp-content/themes/monngonmoingay/images/icon-soche.png\" style=\"height:30px; width:30px\" />&nbsp;SƠ CHẾ</p>\r\n\r\n<p>&ndash; Đ&ugrave;i g&agrave; l&oacute;c bỏ xương, ướp 2M nước h&agrave;nh t&iacute;m, 2M nước tỏi, 1m nước mắm, 1/2m ti&ecirc;u, 1M nước tương &ldquo;Ph&uacute; Sĩ&rdquo; v&agrave; 1M hạt n&ecirc;m Aji-ngon&reg; G&agrave; để 15 ph&uacute;t cho thấm.</p>\r\n\r\n<p>&ndash; H&agrave;nh t&acirc;y, gừng, ớt chu&ocirc;ng, ớt sừng cắt quả tr&aacute;m, thơm cắt rẻ quạt.</p>\r\n\r\n<p><img alt=\"nguyên liệu\" src=\"https://monngonmoingay.com/wp-content/themes/monngonmoingay/images/icon-thuchien.png\" style=\"height:30px; width:33px\" />&nbsp;THỰC HIỆN</p>\r\n\r\n<p>&ndash; Đun n&oacute;ng dầu, cho g&agrave; v&agrave;o&nbsp;<a href=\"https://monngonmoingay.com/cac-mon-chien-ngon/\">chi&ecirc;n &aacute;p chảo</a>&nbsp;hai mặt đến khi g&agrave; ch&iacute;n v&agrave;ng, vớt ra để r&aacute;o dầu, cắt l&aacute;t vừa ăn</p>\r\n\r\n<p>&ndash; Phi thơm h&agrave;nh t&iacute;m, cho gừng, h&agrave;nh t&acirc;y, ớt sừng, ớt chu&ocirc;ng, thơm v&agrave;o x&agrave;o nhanh tay n&ecirc;m 1/2M hạt n&ecirc;m Aji-ngon&reg; G&agrave;, tr&uacute;t ra dĩa để ri&ecirc;ng.</p>\r\n\r\n<p>&ndash; Đun s&ocirc;i nước dừa n&ecirc;m 2M tương ớt, 2M nước tương &ldquo;Ph&uacute; Sĩ&rdquo;, 1M dầu điều, đun nhỏ lửa khoảng 10 ph&uacute;t, cho hỗn hợp x&agrave;o v&agrave;o, th&ecirc;m nước bột năng v&agrave;o, tắt lửa.</p>\r\n\r\n<p><img alt=\"nguyên liệu\" src=\"https://monngonmoingay.com/wp-content/themes/monngonmoingay/images/icon-cachdung.png\" style=\"height:30px; width:22px\" />&nbsp;C&Aacute;CH D&Ugrave;NG</p>\r\n\r\n<p>&ndash; Rưới xốt l&ecirc;n dĩa, xếp x&agrave; l&aacute;ch xung quanh,xếp g&agrave; l&ecirc;n tr&ecirc;n, trang tr&iacute; ớt cắt sợi ng&ograve; r&iacute;, l&aacute; quế, ăn k&egrave;m x&ocirc;i hoặc cơm trắng.</p>\r\n\r\n<p>&ndash; M&oacute;n ăn đi k&egrave;m:&nbsp;<a href=\"https://monngonmoingay.com/salad-cam-ca-hoi/\">Salad cam c&aacute; hồi</a></p>\r\n\r\n<p><img alt=\"nguyên liệu\" src=\"https://monngonmoingay.com/wp-content/themes/monngonmoingay/images/icon-machnho.png\" style=\"height:30px; width:30px\" />&nbsp;M&Aacute;CH NHỎ</p>\r\n\r\n<p>&ndash; Kh&ocirc;ng n&ecirc;n nấu l&acirc;u để c&aacute;c loại rau củ để giữ được hương vị v&agrave; m&agrave;u sắc, độ gi&ograve;n của rau củ.</p>\r\n\r\n<p>&ndash; Ướp thơm trước với đường để c&acirc;n bằng vị chua.</p>', '<p>Hướng dẫn nấu ăn ngon cho c&aacute;c b&agrave; mẹ</p>', 'nấu ăn ngon.cách nấu ăn', 'ngon.nấu ăn.bà mẹ', 1, '1_CVJH9916.png', 4, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `watched` tinyint(1) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `content`, `user_id`, `watched`, `time`) VALUES
(1, 'thanks', 3, 1, '2023-08-17 18:08:04'),
(2, 'ok men', 3, 1, '2023-08-17 18:08:04'),
(3, 'hihi', 3, 1, '2023-08-17 18:08:04'),
(4, 'Cảm ơn bạn đã mua hàng, mã đơn hàng là: <b>order_1692265685</b>', 3, 1, '2023-08-17 18:08:04'),
(5, 'Bạn đã hủy đơn hàng thành công!!', 3, 1, '2023-08-17 18:08:04'),
(6, 'Cảm ơn bạn đã mua hàng, mã đơn hàng là: <b>order_1692266485</b>', 3, 1, '2023-08-17 18:08:04'),
(7, 'Bạn đã hủy đơn hàng mã: <b>order_1692266485</b>', 3, 1, '2023-08-17 18:08:04'),
(8, 'Chào mừng <b>Le Thi Kim Suong</b> đã đăng kí thành công. Hãy mua sắm ngay nào.', 7, 1, '2023-08-17 18:08:04'),
(9, 'Cảm ơn bạn đã mua hàng, mã đơn hàng là: <b>order_1692271118</b>', 3, 1, '2023-08-17 18:18:45'),
(10, 'Cảm ơn bạn đã mua hàng, mã đơn hàng là: <b>order_1692290844</b>', 3, 1, '2023-08-17 23:47:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `total_money` int(20) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Đang chờ xử lý',
  `reason` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `order_code`, `customer_id`, `shipping_id`, `payment`, `total_money`, `discount`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(116, 'order_1648917424', 4, 120, 'atm', 1500000, 0, 'Đơn đã hủy', 'Admin hủy', '2022-04-02 23:37:29', '2022-04-02'),
(117, 'order_1648917526', 4, 121, 'cash', 300000, 0, 'Đơn đã hủy', 'hết tiền', '2022-04-02 23:38:54', '2023-08-16'),
(118, 'order_1648973925', 1, 122, 'atm', 680000, 50000, 'Đang chờ xử lý', NULL, '2022-04-03 15:18:59', '2022-04-03'),
(119, 'order_1692166654', 4, 123, 'cash', 77000, 0, 'Đang chờ xử lý', NULL, '2023-08-16 13:18:18', '2023-08-16'),
(120, 'order_1692169661', 4, 124, 'atm', 1100000, 220000, 'Đã thanh toán-chờ nhận hàng', NULL, '2023-08-16 14:08:18', '2023-08-16'),
(121, 'order_1692176995', 3, 125, 'atm', 1028500, 0, 'Đơn đã hủy', '222', '2023-08-16 16:10:22', '2023-08-17'),
(122, 'order_1692258066', 3, 126, 'cash', 1100000, 0, 'Đơn đã hủy', '123', '2023-08-17 14:41:13', '2023-08-17'),
(123, 'order_1692262000', 3, 127, 'cash', 176000, 0, 'Đơn đã hủy', 'hết tiền', '2023-08-17 15:46:47', '2023-08-17'),
(124, 'order_1692263097', 3, 128, 'atm', 374000, 0, 'Đơn đã hủy', '333', '2023-08-17 16:05:24', '2023-08-17'),
(125, 'order_1692264598', 3, 129, 'atm', 38500, 0, 'Đơn đã hủy', 'cdcds', '2023-08-17 16:30:05', '2023-08-17'),
(126, 'order_1692265451', 3, 130, 'cash', 770000, 0, 'Đơn đã hủy', 'cdcdc', '2023-08-17 16:44:18', '2023-08-17'),
(127, 'order_1692265576', 3, 131, 'cash', 38500, 0, 'Đơn đã hủy', 'dcsc', '2023-08-17 16:46:20', '2023-08-17'),
(128, 'order_1692265685', 3, 132, 'cash', 88000, 0, 'Đơn đã hủy', 'cdcs', '2023-08-17 16:48:12', '2023-08-17'),
(129, 'order_1692266485', 3, 133, 'cash', 66000, 0, 'Đơn đã hủy', '2222', '2023-08-17 17:01:31', '2023-08-17'),
(130, 'order_1692271118', 3, 134, 'cash', 66000, 0, 'Đang chờ xử lý', NULL, '2023-08-17 18:18:44', '2023-08-17'),
(131, 'order_1692290844', 3, 135, 'cash', 3366000, 0, 'Đang chờ xử lý', NULL, '2023-08-17 23:47:32', '2023-08-17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` bigint(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_quantyti` varchar(50) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_quantyti`, `created_at`) VALUES
(215, 116, 7, 'Phở', '500000', '3', '2022-04-02'),
(217, 117, 5, 'Đùi góc tư dai', '300000', '1', '2022-04-02'),
(218, 118, 7, 'Phở', '500000', '1', '2022-04-03'),
(219, 118, 14, 'Cánh gà', '60000', '3', '2022-04-03'),
(220, 119, 16, 'Đùi gà', '35000', '2', '2023-08-16'),
(221, 120, 7, 'Phở', '500000', '2', '2023-08-16'),
(222, 121, 16, 'Đùi gà', '35000', '6', '2023-08-16'),
(223, 121, 15, 'Chân gà', '80000', '3', '2023-08-16'),
(224, 121, 5, 'Đùi tư dai', '300000', '1', '2023-08-16'),
(225, 121, 24, 'Lòng gà', '35000', '3', '2023-08-16'),
(226, 121, 22, 'Nạc lợn nái', '80000', '1', '2023-08-16'),
(227, 122, 7, 'Phở', '500000', '2', '2023-08-17'),
(228, 123, 15, 'Chân gà', '80000', '2', '2023-08-17'),
(229, 124, 15, 'Chân gà', '80000', '1', '2023-08-17'),
(230, 124, 14, 'Cánh gà', '60000', '1', '2023-08-17'),
(231, 124, 3, 'Đùi', '200000', '1', '2023-08-17'),
(232, 125, 16, 'Đùi gà', '35000', '1', '2023-08-17'),
(233, 126, 7, 'Phở', '500000', '1', '2023-08-17'),
(234, 126, 3, 'Đùi', '200000', '1', '2023-08-17'),
(235, 127, 16, 'Đùi gà', '35000', '1', '2023-08-17'),
(236, 128, 15, 'Chân gà', '80000', '1', '2023-08-17'),
(237, 129, 14, 'Cánh gà', '60000', '1', '2023-08-17'),
(238, 130, 14, 'Cánh gà', '60000', '1', '2023-08-17'),
(239, 131, 7, 'Phở', '500000', '6', '2023-08-17'),
(240, 131, 14, 'Cánh gà', '60000', '1', '2023-08-17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `price` varchar(255) NOT NULL,
  `exp` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `count` int(11) NOT NULL,
  `count_sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `origin`, `price`, `exp`, `category_id`, `description`, `image`, `view`, `count`, `count_sold`, `status`, `note`, `created_at`, `updated_at`) VALUES
(2, 'Ba chỉ bò', 'Mumbai, India', '190000', '2023-07-06', 3, '<h1>ĐẶC TRƯNG CỦA THỊT B&Ograve; MỸ? SO S&Aacute;NH KH&Aacute;C BIỆT GIỮA THỊT B&Ograve; &Uacute;C V&Agrave; THỊT B&Ograve; MỸ?</h1>\r\n\r\n<p>&nbsp;22 Th&aacute;ng 08, 2021</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Những năm gần đ&acirc;y thịt b&ograve; nhập khẩu đ&atilde; kh&ocirc;ng c&ograve;n xa lạ đối với người ti&ecirc;u d&ugrave;ng Việt Nam. Nếu như trước đ&acirc;y thịt b&ograve; nhập khẩu chỉ được d&ugrave;ng trong c&aacute;c nh&agrave; h&agrave;ng sang trọng&nbsp; th&igrave; giờ đ&acirc;y thịt b&ograve; nhập khẩu xuất hiện hầu hết trong c&aacute;c bữa ăn của c&aacute;c gia đ&igrave;nh Việt với chất lượng tốt, gi&aacute; th&agrave;nh hợp t&uacute;i tiền.</p>\r\n\r\n<p>Tr&ecirc;n thị trường Việt Nam c&oacute; rất nhiều loại thịt b&ograve; được nhập khẩu từ c&aacute;c nước như Mỹ, &Uacute;c, Canada&hellip;.được đ&aacute;nh gi&aacute; c&oacute; chất lượng tốt, ổn định về gi&aacute; cả&hellip;, trong số c&aacute;c loại thịt b&ograve; nhập khẩu c&oacute; thịt b&ograve; Mỹ được người ti&ecirc;u d&ugrave;ng ưa chuộng nhất. Vậy&nbsp;<a href=\"https://hunggiaco.com/danh-muc/thit-bo-nhap-khau.html\"><strong>Thịt b&ograve; Mỹ</strong></a>&nbsp;c&oacute; những đặc trưng g&igrave;? &nbsp;để ph&acirc;n biệt giữa thịt b&ograve; Mỹ v&agrave;&nbsp;<a href=\"https://hunggiaco.com/danh-muc/thit-bo-nhap-khau.html\"><strong>thịt b&ograve; nhập khẩu &Uacute;c</strong></a>&nbsp;h&atilde;y c&ugrave;ng t&igrave;m hiểu qua b&agrave;i viết dưới đ&acirc;y nh&eacute;!</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/bap-bo-my.jpg\" /><br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<h2><strong>Đặc trưng của thịt b&ograve; Mỹ</strong></h2>\r\n\r\n<p><a href=\"http://hunggiaco.com/\"><strong>Thịt b&ograve; Mỹ</strong></a>&nbsp;nổi tiếng tr&ecirc;n to&agrave;n thế giới bởi độ mềm v&agrave; thơm ngon, vị ngọt đặc trưng khiến thực kh&aacute;ch ăn một lần nhớ m&atilde;i kh&ocirc;ng qu&ecirc;n. Thịt b&ograve; Mỹ được đ&aacute;nh gi&aacute; c&oacute; chất lượng tốt bởi to&agrave;n bộ quy tr&igrave;nh chăn nu&ocirc;i, chế biến đến đ&oacute;ng g&oacute;i v&agrave; ph&acirc;n phối ra thị trường đều được kiểm so&aacute;t một c&aacute;ch nghi&ecirc;m ngặt đảm bảo c&aacute;c ti&ecirc;u chuẩn về chất lượng v&agrave; vệ sinh an to&agrave;n thực phẩm rất được người d&acirc;n tin d&ugrave;ng.</p>\r\n\r\n<p><a href=\"https://zinfood.com/danh-muc/thit-bo-my.html\"><strong>Thịt b&ograve; Mỹ</strong></a>&nbsp;khi được cấp đ&ocirc;ng thường c&oacute; m&agrave;u đỏ hơi sậm, c&oacute; độ mềm ho&agrave;n hảo, khi chế biến c&oacute; hương vị thơm ngon, ngậy nhưng kh&ocirc;ng b&eacute;o v&agrave; đặc biệt kh&ocirc;ng bị kh&ocirc; như thịt b&ograve; của nước ta. C&aacute;c sản phẩm của thịt b&ograve; Mỹ đều được người ti&ecirc;u d&ugrave;ng v&ocirc; c&ugrave;ng y&ecirc;u th&iacute;ch như: Ba chỉ b&ograve; Mỹ, sườn B&ograve; Mỹ, L&otilde;i vai B&ograve; Mỹ&hellip;.<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"gau-bo-my-gia-tot\" src=\"https://hunggiaco.com/upload/images/gau-bo-nhap-khau-gia-re.jpg\" /><br />\r\n&nbsp;</p>\r\n\r\n<h2><strong>Gi&aacute; trị dinh dưỡng c&oacute; trong thịt b&ograve; Mỹ</strong></h2>\r\n\r\n<p><a href=\"https://hunggiaco.com/danh-muc/thit-bo-nhap-khau.html\"><strong>Thịt b&ograve; Mỹ</strong></a>&nbsp;được xem l&agrave; một loại thực phẩm gi&agrave;u chất dinh dưỡng, đặc biệt l&agrave; Protein, vitamin B6 c&ugrave;ng nhiều kho&aacute;ng chất kh&aacute;c, gi&uacute;p tăng sức đề kh&aacute;ng cũng như cung cấp năng lượng cho cơ thể.<br />\r\nNgo&agrave;i ra thịt b&ograve; Mỹ chứa h&agrave;m lượng chất b&eacute;o thấp n&ecirc;n sẽ hạn chế nguy cơ bị b&eacute;o ph&igrave; v&agrave; c&aacute;c bệnh về tim mạch. Đặc biệt,&nbsp;<a href=\"https://famfood.vn/new/gia-thit-bo-my-hien-nay-tren-thi-truong-bao-nhieu-tien.html\"><strong>thịt b&ograve; mỹ</strong></a>&nbsp;rất tốt cho sức khỏe của b&agrave; bầu bởi thực phẩm n&agrave;y cung cấp sắt, vitamin B6, B12 đồng thời gi&uacute;p cho c&aacute;c mẹ bầu giữ d&aacute;ng, hạn chế tăng c&acirc;n trong qu&aacute; tr&igrave;nh mang thai.<br />\r\n<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/loi-vai-bo-my-dong-lanh.jpg\" /><br />\r\n<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<h2><strong>So s&aacute;nh kh&aacute;c biệt giữa thịt b&ograve; &uacute;c v&agrave; thịt b&ograve; mỹ</strong></h2>\r\n\r\n<p>Ở Việt Nam thịt b&ograve; đ&ocirc;ng lạnh nhập khẩu được ti&ecirc;u thụ chủ yếu l&agrave; thịt B&ograve; Mỹ v&agrave;&nbsp;<a href=\"https://famfood.vn/new/gia-thit-bo-uc-hien-nay-tren-thi-truong.html\"><strong>thịt B&ograve; &Uacute;c&nbsp;</strong></a>v&agrave; được đ&aacute;nh gi&aacute; c&oacute; chất lượng tốt, rất được ưa chuộng. Tuy nhi&ecirc;n, giữa thịt b&ograve; &uacute;c v&agrave; b&ograve; mỹ cũng c&oacute; sự kh&aacute;c biệt m&agrave; bất kỳ thực kh&aacute;ch đ&atilde; d&ugrave;ng hai loại thịt n&agrave;y đểu c&oacute; thể nhận ra kh&aacute; dễ d&agrave;ng:</p>\r\n\r\n<p>Thịt b&ograve; Mỹ khi chế biến sẽ c&oacute; độ đậm đ&agrave; hơn v&agrave; dễ ngấm gia vị hơn so với thịt b&ograve; &Uacute;c. Do đ&oacute;, đối với những người s&agrave;nh ăn&nbsp;<a href=\"http://zinfood.com/\"><strong>thịt b&ograve; Mỹ&nbsp;</strong></a>sẽ dễ ph&aacute;t hiện ra m&ugrave;i vị đặc trưng v&agrave; độ mềm ngon hơn thịt b&ograve; Mỹ.</p>\r\n\r\n<p>Hơn nữa, thịt b&ograve; Mỹ&nbsp;c&oacute; vị ngọt v&agrave; thịt chắc hơn thịt b&ograve; &Uacute;c, khi ăn sẽ c&oacute; cảm gi&aacute;c dễ tan trong miệng kh&ocirc;ng bị dai. Vị ngọt thơm đậm đ&agrave; được giữ nguy&ecirc;n vị, phần thịt mềm nhất của b&ograve; Mỹ đ&oacute; l&agrave; sườn non v&agrave; thăn nội.&nbsp;</p>\r\n\r\n<p>Ngo&agrave;i ra, thịt b&ograve; Mỹ c&oacute; độ gi&ograve;n hơn&nbsp;<a href=\"https://zinfood.com/danh-muc/thit-bo-uc.html\"><strong>thịt b&ograve; &Uacute;c</strong></a>&nbsp;ở phần bắp b&ograve;, gầu b&ograve;&hellip; thường được sử dụng l&agrave;m nhiều m&oacute;n như steak, nướng, lẩu, bỏ l&ograve;&hellip;</p>\r\n\r\n<p>Tr&ecirc;n thị trường&nbsp;<a href=\"http://hunggiaco.com/\"><strong>gi&aacute; thịt b&ograve; Mỹ</strong></a>&nbsp;thường cao hơn so với&nbsp;<a href=\"https://hunggiaco.com/danh-muc/thit-bo-nhap-khau.html\"><strong>gi&aacute;&nbsp;thịt b&ograve; &Uacute;c</strong></a>, tuy nhi&ecirc;n, gi&aacute; th&agrave;nh của cả hai loại n&agrave;y lu&ocirc;n ổn định, ch&ecirc;nh lệch nhau kh&ocirc;ng đ&aacute;ng kể.<br />\r\n<br />\r\n<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"ba-chi-bo-my-gia-re\" src=\"https://hunggiaco.com/upload/images/ba-chi-bo-my.jpg\" /><br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<h2><strong>Ở đ&acirc;u b&aacute;n thịt b&ograve; Mỹ nhập khẩu uy t&iacute;n</strong></h2>\r\n\r\n<p>C&oacute; rất nhiều địa chỉ b&aacute;n&nbsp;<strong>thịt b&ograve; Mỹ&nbsp;</strong>tr&ecirc;n thị trường, tuy nhi&ecirc;n để lựa chọn được những miếng thịt b&ograve; Mỹ ngon, chất lượng cần phải t&igrave;m đến &nbsp;những địa chỉ cung cấp uy t&iacute;n, c&oacute; thương hiệu tr&aacute;nh mua phải h&agrave;ng k&eacute;m chất lượng, ảnh hưởng đến sức khỏe của bản th&acirc;n v&agrave; gia đ&igrave;nh.</p>\r\n\r\n<p>&nbsp;Hưng Gia - đơn vị nhập khẩu trực tiếp&nbsp;<a href=\"https://hunggiaco.com/danh-muc/thit-bo-nhap-khau.html\"><strong>thịt b&ograve; Mỹ</strong></a>&nbsp;cung cấp số lượng lớn ra thị trường cho c&aacute;c đại l&yacute;, bếp ăn, nh&agrave; h&agrave;ng với chất lượng tốt, đảm bảo vệ sinh an to&agrave;n thực phẩm, gi&aacute; cả cạnh trạnh.</p>\r\n\r\n<p>H&atilde;y li&ecirc;n hệ với&nbsp;<a href=\"http://hunggiaco.com/\"><strong>Hưng Gia</strong></a>&nbsp;để được tư vấn, hỗ trợ tốt nhất.</p>', 'Ba-chi-bo-uc.jpg', 4, 9968, 22, '1', 'Sản phẩm nhập khẩu từ Ấn Độ với các kiểm định khắt khe của nước sở tại, được hiệp hội thịt Ấn Độ bảo đảm chất lượng.', '2022-03-08', '2023-08-17'),
(3, 'Đùi', 'Mumbai, India', '200000', '2023-07-06', 3, '<h2><strong>Tại sao thịt tr&acirc;u lại nhập khẩu từ Ấn Độ?</strong></h2>\r\n\r\n<p>Ấn Độ l&agrave; quốc gia ti&ecirc;u thụ nhiều&nbsp;<a href=\"https://thucphamhuunghi.com/bai-viet/la-mieng-voi-mon-thit-trau-gac-bep-cho-quan-nhau\" target=\"_blank\">thịt tr&acirc;u</a>&nbsp;bậc nhất tr&ecirc;n thế giới v&igrave; ở đất nước n&agrave;y người ta kh&ocirc;ng ti&ecirc;u thụ thịt b&ograve; v&igrave; l&yacute; do t&ocirc;n gi&aacute;o. Với diện t&iacute;ch đất canh t&aacute;c n&ocirc;ng nghiệp khổng lồ v&agrave; c&oacute; số lượng tr&acirc;u khoảng 106,6 triệu con, số lượng tr&acirc;u ở Ấn Độ chiếm khoảng 58% tổng số tr&acirc;u tr&ecirc;n to&agrave;n thế giới.</p>\r\n\r\n<p>Ch&iacute;nh v&igrave; vậy, tr&acirc;u được nu&ocirc;i nhiều ở khắp mọi nơi với mục đ&iacute;ch để l&agrave;m thực phẩm như thịt lợn ở nước ta, thậm ch&iacute; ở nước n&agrave;y, thịt tr&acirc;u chỉ c&oacute; gi&aacute; rẻ bằng &frac12; so với c&aacute;c loại thịt kh&aacute;c. Ngo&agrave;i ti&ecirc;u thụ trong nước, thịt tr&acirc;u Ấn Độ c&ograve;n được xuất khẩu sang nhiều nước trong đ&oacute; c&oacute; Việt Nam.</p>\r\n\r\n<p><img alt=\"Thịt trâu Ấn Độ có chất lượng như thế nào?\" src=\"https://thucphamhuunghi.com/plugins/responsive_filemanager/source/thit%20trau%20an%20do.jpg\" style=\"height:381px; width:512px\" /></p>\r\n\r\n<h2><strong>Thịt tr&acirc;u Ấn Độ c&oacute; thực sự được người Việt Nam tin d&ugrave;ng?</strong></h2>\r\n\r\n<p>Việt Nam cũng l&agrave; quốc gia ti&ecirc;u thụ nhiều thịt tr&acirc;u, quốc gia n&agrave;y cũng nhập khẩu thịt tr&acirc;u. Theo số liệu thống k&ecirc; từ cơ quan chức năng hằng năm, lượng thịt tr&acirc;u đ&ocirc;ng lạnh nhập khẩu ch&iacute;nh ngạch v&agrave;o Việt Nam l&agrave; rất lớn, nhất l&agrave; tr&acirc;u Ấn Độ do thịt tr&acirc;u Ấn Độ c&oacute; chất lượng tốt v&agrave; gi&aacute; th&agrave;nh kh&aacute; mềm.</p>\r\n\r\n<p>Trung b&igrave;nh một năm, Việt Nam nhập về gần 38.000 tấn thịt tr&acirc;u đ&ocirc;ng lạnh. Ri&ecirc;ng trong năm 2018, Việt Nam nhập khẩu tr&ecirc;n 40.000 tấn thịt tr&acirc;u từ Ấn Độ v&agrave; một số nước kh&aacute;c. Hiện nay, trung b&igrave;nh mỗi th&aacute;ng Việt Nam nhập khẩu khoảng 3.000 tấn thịt tr&acirc;u c&aacute;c loại.</p>\r\n\r\n<p>&nbsp;Cho n&ecirc;n thịt tr&acirc;u Ấn Độ hiện đang l&agrave; một loại thực phẩm rất ngon, rất gi&agrave;u chất dinh dưỡng, l&agrave; loại thực phẩm chất lượng bổ sung cho sự đa dạng trong khẩu phần ăn của mỗi gia đ&igrave;nh v&agrave; đặc biệt l&agrave; một trong những thực phẩm&nbsp; được người ti&ecirc;u d&ugrave;ng Việt Nam sử dụng thường xuy&ecirc;n trong c&aacute;c bữa cơm h&agrave;ng ng&agrave;y hoặc trong c&aacute;c bữa tiệc . V&igrave; thế c&aacute;c qu&aacute;n ăn, nh&agrave; h&agrave;ng hay lựa chọn thịt tr&acirc;u đ&ocirc;ng lạnh nhập khẩu từ Ấn Độ v&igrave; gi&aacute; cả tốt, đa dạng c&aacute;c loại thịt.</p>\r\n\r\n<h2><strong>Nguồn dinh dưỡng đến từ thịt tr&acirc;u Ấn Độ</strong></h2>\r\n\r\n<p>Thịt tr&acirc;u kh&aacute; giống với&nbsp;<a href=\"https://thucphamhuunghi.com/danh-muc/thit-bo-uc-my\" target=\"_blank\">thịt b&ograve;</a>&nbsp;nhưng h&agrave;m lượng dinh dưỡng c&ograve;n cao hơn v&agrave; c&oacute; lợi cho sức khỏe người ti&ecirc;u d&ugrave;ng hơn. Về dinh dưỡng th&igrave; thịt tr&acirc;u tốt hơn thịt b&ograve; v&igrave;:</p>\r\n\r\n<ul>\r\n	<li>Tỷ lệ mỡ &iacute;t hơn 5 lần</li>\r\n	<li>H&agrave;m lượng sắt cao hơn hẳn thịt b&ograve;</li>\r\n	<li>Về h&agrave;m lượng protein th&igrave; thịt tr&acirc;u v&agrave; thịt b&ograve; h&agrave;m lượng như nhau.</li>\r\n</ul>\r\n\r\n<p><img alt=\"Thịt trâu Ấn Độ có chất lượng như thế nào?\" src=\"https://thucphamhuunghi.com/plugins/responsive_filemanager/source/th%E1%BB%8Bt%20tr%C3%A2u_1.jpg\" style=\"height:412px; width:550px\" /></p>\r\n\r\n<p>Chất dinh dưỡng trong thịt tr&acirc;u Ấn Độ cũng kh&aacute; cao so với c&aacute;c loại thịt kh&aacute;c:</p>\r\n\r\n<ul>\r\n	<li>Tỷ lệ chất đạm gấp đ&ocirc;i so với thịt lợn</li>\r\n	<li>Lượng chất b&eacute;o v&agrave; chất đường vừa phải</li>\r\n	<li>Nhiều muối v&ocirc; cơ (canxi, phosphore, sắt...)</li>\r\n</ul>\r\n\r\n<p>Tr&acirc;u Ấn Độ nhập về Việt Nam ở THỰC PHẨM HỮU NGHỊ với c&aacute;c th&agrave;nh phần thịt đa dạng như: th&acirc;n ngoại tr&acirc;u, th&acirc;n nội tr&acirc;u, nạm sườn, g&acirc;n tr&acirc;u v&agrave; đu&ocirc;i tr&acirc;u,&hellip; sẽ l&agrave; một sự lựa chọn th&ocirc;ng minh để cung cấp c&aacute;c vitamin như (B1, B2, B6, B12, PP...), bổ sung kho&aacute;ng chất v&agrave; muối v&ocirc; cơ cho cơ thể.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>C&ocirc;ng ty cung cấp thịt tr&acirc;u Ấn Độ uy t&iacute;n - chất lượng tại TPHCM</strong></h2>\r\n\r\n<p>Để c&oacute; thịt tr&acirc;u Ấn Độ chất lượng ho&agrave;n hảo, bạn h&atilde;y t&igrave;m đến những cửa h&agrave;ng b&aacute;n thịt tr&acirc;u Ấn Độ nhập khẩu chất lượng nhất, an to&agrave;n thực phẩm, để đảm bảo dinh dưỡng cho gia đ&igrave;nh bạn tốt nhất.</p>\r\n\r\n<p><a href=\"https://thucphamhuunghi.com/\" target=\"_blank\">THỰC PHẨM HỮU NGHỊ</a>&nbsp;l&agrave; một đơn vị đ&aacute;ng tin cậy để bạn lựa chọn bởi ch&uacute;ng t&ocirc;i đảm bảo cho c&aacute;c bạn những yếu tố sau:</p>\r\n\r\n<ul>\r\n	<li>THỰC PHẨM HỮU NGHỊ lu&ocirc;n tự h&agrave;o l&agrave; nh&agrave; nhập khẩu khai ph&aacute; thị trường thịt tr&acirc;u nhập khẩu đạt chuẩn về thị trường Việt Nam. C&ocirc;ng ty chuy&ecirc;n cung cấp thịt tr&acirc;u đ&ocirc;ng lạnh chất lượng, c&oacute; đầy đủ c&aacute;c giấy tờ chứng minh nguồn gốc xuất xứ, giấy th&uacute; y, giấy an to&agrave;n vệ sinh thực phẩm, được chứng nhận ISO 2018,&hellip; cho c&aacute;c cơ quan, x&iacute; nghiệm v&agrave; hệ thống c&aacute;c nh&agrave; h&agrave;ng kh&aacute;ch sạn tại Việt Nam m&agrave; đặc biệt l&agrave; th&agrave;nh phố Hồ Ch&iacute; Minh.</li>\r\n	<li>THỰC PHẨM HỮU NGHỊ lu&ocirc;n đặt chất lượng của sản phẩm nhập khẩu l&ecirc;n h&agrave;ng đầu. Kh&ocirc;ng để đ&ocirc;ng nhiều ng&agrave;y hay t&aacute;i đ&ocirc;ng nhiều lần n&ecirc;n giữ nguy&ecirc;n được hương vị thịt ngọt, tươi ngon, m&agrave;u sắc đẹp.</li>\r\n	<li>THỰC PHẨM HỮU NGHỊ lu&ocirc;n kinh doanh c&oacute; đạo đức, trọng lượng sản phẩm lu&ocirc;n đảm bảo ch&iacute;nh x&aacute;c, kh&ocirc;ng c&acirc;n thiếu hay bớt x&eacute;n với c&aacute;c đơn h&agrave;ng số lượng lớn.</li>\r\n</ul>\r\n\r\n<p><em>&nbsp;C&aacute;c bạn hay nhấc m&aacute;y l&ecirc;n v&agrave; gọi tới hotline: 0901.892.899 hoặc đặt h&agrave;ng ngay tại website:&nbsp;<a href=\"https://thucphamhuunghi.com/\">https://thucphamhuunghi.com</a>&nbsp;để c&oacute; thể mua được h&agrave;ng ch&iacute;nh h&atilde;ng với chất lượng tươi ngon, đảm bảo vệ sinh c&aacute;c bạn nh&eacute;.</em></p>\r\n\r\n<p><em>Cảm ơn sự tin tưởng v&agrave; lựa chọn của người ti&ecirc;u d&ugrave;ng đối với cửa h&agrave;ng THỰC PHẨM HỮU NGHỊ. Ch&iacute;nh những điều đ&oacute; đ&atilde; g&oacute;p phần th&uacute;c đẩy động lực khiến ch&uacute;ng t&ocirc;i c&agrave;ng muốn quyết t&acirc;m thực hiện v&agrave; đặt uy t&iacute;n của m&igrave;nh l&ecirc;n h&agrave;ng đầu để phục vụ c&aacute;c bạn một c&aacute;ch tốt nhất. H&atilde;y lu&ocirc;n theo d&otilde;i ch&uacute;ng t&ocirc;i để kh&ocirc;ng bỏ lỡ thực phẩm tươi ngon của THỰC PHẨM HỮU NGHỊ nh&eacute;!</em></p>', 'thit trau an do.jpg', 3, 9968, 18, '1', 'Sản phẩm nhập khẩu từ Ấn Độ với các kiểm định khắt khe của nước sở tại, được hiệp hội thịt Ấn Độ bảo đảm chất lượng.', '2022-03-08', '2023-08-16'),
(4, 'Lòng trâu', 'Ấn Độ', '150000', '2022-03-16', 5, 'Sản phẩm nội tạng trâu sạch sẽ thơm ngon ăn vào chỉ có ghiền', 'long-trau-an-do.jpg', 0, 475, 8, '1', 'Đạt tiêu chuẩn IOS 9000, được hội thực phẩm Ấn Độ công nhận an toàn vệ sinh thực phẩm', '2022-03-15', '2022-03-29'),
(5, 'Đùi tư dai', 'Mê Linh, Hà Nội', '300000', '2022-09-15', 2, '<p><strong>Đ&ugrave;i g&oacute;c tư g&agrave; dai</strong> l&agrave; một loại thực phẩm thơm ngon được nhiều người lựa chọn trong nhiều năm trở lại đ&acirc;y. Đặc biệt l&agrave; c&aacute;c bộ phận gi&agrave;u dinh dưỡng như đ&ugrave;i g&oacute;c tư g&agrave; dai th&igrave; lại c&agrave;ng được ưa chuộng hơn. Vậy độ dinh dưỡng của đ&ugrave;i g&oacute;c tư g&agrave; dai mang đến cho ch&uacute;ng ta l&agrave; g&igrave;? liệu n&oacute; c&oacute; giống với g&agrave; dai h&agrave;n quốc hay kh&ocirc;ng th&igrave; ngay sau đ&acirc;y ch&uacute;ng ta sẽ c&ugrave;ng nhau t&igrave;m hiểu<img alt=\"\" src=\"https://thucphamhuunghi.com/plugins/responsive_filemanager/source/Thit%20Ga/dui-ga-dai.jpg\" /></p>\r\n\r\n<p><strong>Đ&ugrave;i g&oacute;c tư g&agrave; dai c&oacute; xuất xứ ở đ&acirc;u?</strong></p>\r\n\r\n<p>C&ocirc;ng ty thực phẩm Hữu Nghị xin được mang đến cho người d&ugrave;ng y&ecirc;u th&iacute;ch đ&ugrave;i g&agrave; g&oacute;c tư tại việt nam sản phẩm đ&ugrave;i g&oacute;c tư g&agrave; dai được nhập khẩu từ Mỹ v&agrave; &Uacute;c. Qua quy tr&igrave;nh kiểm định nghi&ecirc;m ngặt tại đ&acirc;y th&igrave; ch&uacute;ng t&ocirc;i tự tin về chất lượng của sản phẩm n&agrave;y. Đ&ugrave;i g&oacute;c tư g&agrave; dai l&agrave; sản phẩm được nhiều kh&aacute;ch h&agrave;ng lựa chọn khi đến với thực phẩm Hữu Nghị ch&uacute;ng t&ocirc;i. Ngo&agrave;i ra khi về Việt Nam đ&atilde; được kiểm định v&agrave; kiểm dịch của cục vsattp TPHCM. Đảm bảo an to&agrave;n, tin tưởng về xuất xứ, nguồn gốc r&otilde; r&agrave;ng.</p>\r\n\r\n<p><strong>Đ&ugrave;i g&oacute;c tư g&agrave; dai, gi&agrave;y dinh dưỡng, thịt dai v&agrave; chắc</strong></p>\r\n\r\n<p>Từ l&acirc;u thịt g&agrave; đ&atilde; l&agrave; một loại thực phẩm thơm ngon, gi&agrave;u chất dinh dưỡng, với h&agrave;m lượng vitamin cao, chất b&eacute;o v&agrave; kho&aacute;ng chất rất tốt để bồi bổ xức khỏe. Đặc biệt bộ phận đ&ugrave;i g&oacute;c tư th&igrave; lại l&agrave; nơi d&agrave;y thịt, dinh dưỡng tập trung cao th&igrave; đảm bảo mang đến cho bạn những m&oacute;n ăn hấp dẫn với đ&ugrave;i g&oacute;c tư g&agrave; dai.</p>\r\n\r\n<p><img alt=\"\" src=\"https://thucphamhuunghi.com/plugins/responsive_filemanager/source/Thit%20Ga/dui-ga-han-quoc.jpg\" /></p>\r\n\r\n<p><strong>Đ&ugrave;i g&oacute;c tư g&agrave; dai được b&aacute;n như thế n&agrave;o?</strong></p>\r\n\r\n<p>Hiện tại <strong>Thực Phẩm Hữu Nghị</strong> cung cấp đến thị trường đ&ugrave;i g&agrave; dai nhập khẩu tại Mỹ, &Uacute;c, th&ugrave;ng đ&oacute;ng với 10kg. C&aacute;c kh&aacute;ch h&agrave;ng c&oacute; thể lựa chọn để chế biến ra c&aacute;c sản phẩm thơm ngon v&agrave; th&iacute;ch hợp cho c&aacute;c qu&aacute;n cơm b&igrave;nh d&acirc;n, c&aacute;c qu&aacute;n cơm g&agrave; xối mỡ. Đảm bảo an to&agrave;n v&agrave; chất lượng. Thay v&igrave; lựa chọn g&agrave; dai H&agrave;n Quốc với nhiều b&ecirc; bối tr&ecirc;n thị trường hiện nay th&igrave; tại sao bạn kh&ocirc;ng lựa chọn đ&ugrave;i g&oacute;c tư g&agrave; dai nhập khẩu &Uacute;c, Mỹ c&oacute; b&aacute;n tại Thực phẩm Hữu Nghị để an t&acirc;m hơn về chất lượng sản phẩm.</p>\r\n\r\n<p><em><strong>Thực phẩm Hữu Nghị cam kết</strong></em></p>\r\n\r\n<ul>\r\n	<li>Ch&uacute;ng t&ocirc;i cam kết gi&aacute; b&aacute;n đ&ugrave;i g&oacute;c tư g&agrave; dai cạnh tranh tr&ecirc;n thị trường, gi&aacute; rẻ cho mọi nh&agrave;</li>\r\n	<li>C&oacute; quy tr&igrave;nh kiểm định định chất lượng gắt gao, cam kết sạch v&agrave; an to&agrave;n</li>\r\n	<li>Đ&ugrave;i g&oacute;c tư g&agrave; dai thơm ngon, c&ograve;n nguy&ecirc;n gi&aacute; trị dinh dưỡng</li>\r\n	<li>Xuất xứ d&otilde; d&agrave;ng</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"https://thucphamhuunghi.com/plugins/responsive_filemanager/source/Thit%20Ga/dui-goc-tu-dai.jpg\" /></p>\r\n\r\n<p>Tr&ecirc;n đ&acirc;y l&agrave; những th&ocirc;ng tin cần thiết về sản phẩm <strong>đ&ugrave;i g&oacute;c tư g&agrave; dai</strong>, bạn ho&agrave;n to&agrave;n c&oacute; thể lựa chọn ngay để chế biến ra những m&oacute;n ăn thơm ngon v&agrave; hấp dẫn nhất.<br />\r\n&nbsp;</p>', 'dui-dai.jfif', 1, 922, 5, '1', 'Chuẩn ISO 1999, được kiểm chứng của cục vệ sinh an toàn Hà Nội', '2022-03-15', '2023-08-16'),
(7, 'Phở', 'Việt Nam', '500000', '2022-03-25', 6, '<p><img alt=\"\" src=\"http://localhost/lvtn2022/public/backend/ckfinder/userfiles/images/bfoe.jpg\" style=\"height:960px; width:713px\" /></p>\r\n\r\n<p>con em n&agrave;y xinh qu&aacute; nhỉ, chắc l&agrave; c&oacute; người y&ecirc;u rồi</p>', 'bfoe.jpg', 24, 30, 22, '1', 'Sản phẩm này chỉ có tại Việt Nam', '2022-03-15', '2023-08-17'),
(14, 'Cánh gà', 'Hà Nội, Việt Nam', '60000', '2022-03-30', 1, '<p>Ch&uacute;ng t&ocirc;i cam kết cung cấp C&aacute;nh g&agrave; đ&ocirc;ng lạnh&nbsp;<strong>đảm bảo vệ sinh an to&agrave;n thực phẩm</strong>, kh&ocirc;ng bơm nước, kh&ocirc;ng ướp h&oacute;a chất, đảm bảo ổn định gi&aacute; cả, thời gian cung cấp, để qu&yacute; kh&aacute;ch h&agrave;ng y&ecirc;n t&acirc;m kinh doanh.</p>\r\n\r\n<p>Với nhiều năm kinh doanh trong lĩnh vực n&agrave;y, ch&uacute;ng t&ocirc;i đ&atilde;&nbsp;<strong>ph&acirc;n phối C&aacute;nh g&agrave; đ&ocirc;ng lạnh cho rất nhiều đối t&aacute;c lớn từ c&aacute; nh&acirc;n đến doanh nghiệp tr&ecirc;n khắp cả nước</strong>. Lu&ocirc;n hỗ trợ&nbsp;<strong>gi&aacute; sỉ tốt nhất</strong>&nbsp;nhiều chủng loại trong nước v&agrave; nhập khẩu từ nước ngo&agrave;i.</p>', 'canh-ga-dong-lanh.jpg', 1, 95, 0, '1', 'Chuẩn ISO 9000, được hiệp hội gia súc VN chứng nhận an toàn', '2022-03-25', '2023-08-16'),
(15, 'Chân gà', 'Hà Nội, Việt Nam', '80000', '2022-03-30', 1, '<p><a href=\"http://www.hangdonglanh.asia/2019/03/chan-ga-dong-lanh-nhap-khau-loai-to.html\" target=\"_blank\">Ch&acirc;n g&agrave;&nbsp;đ&ocirc;ng lạ</a><a href=\"http://www.hangdonglanh.asia/2019/03/chan-ga-dong-lanh-nhap-khau-loai-to.html\" target=\"_blank\">nh</a>&nbsp;nhập khẩu loại to l&agrave; loại ch&acirc;n g&agrave;&nbsp;được nhập khẩu trực tiếp từ&nbsp;nước ngo&agrave;i về&nbsp;với gi&aacute; th&agrave;nh rẻ,&nbsp;đảm bảo an to&agrave;n vệ&nbsp;sinh&nbsp;được sử&nbsp;dụng nhiều trong c&aacute;c nh&agrave; h&agrave;ng qu&aacute;n&nbsp;ăn. Bạn&nbsp;đang chuẩn bị&nbsp;mở&nbsp;nh&agrave; h&agrave;ng qu&aacute;n&nbsp;ăn về&nbsp;sản phẩm ch&acirc;n g&agrave; nhưng lại chưa t&igrave;m&nbsp;được nh&agrave; cung cấp&nbsp;<strong>ch&acirc;n g&agrave;&nbsp;</strong><strong>đ&ocirc;ng lạ</strong><strong>nh</strong>&nbsp;uy t&iacute;n h&atilde;y&nbsp;đến với ch&uacute;ng t&ocirc;i&nbsp;để&nbsp;được nhận&nbsp;<strong>gi&aacute; ch&acirc;n g&agrave;&nbsp;</strong><strong>đ&ocirc;</strong><strong>ng</strong>&nbsp;lạnh nhập khẩu tốt nhất, c&aacute;c sản phẩm ch&acirc;n g&agrave;&nbsp;đ&ocirc;ng lạnh nhập khẩu&nbsp;được&nbsp;đ&oacute;ng th&ugrave;ng loại 10kg v&agrave; 15kg số&nbsp;lượng ch&acirc;n từ&nbsp;18-20 chiếc/kg.&nbsp;C&aacute;c sản phẩm ch&uacute;ng t&ocirc;i b&aacute;n ra thị&nbsp;trường cam kết l&agrave; sản phẩm nhập khẩu ch&iacute;nh ngạch c&oacute;&nbsp;đầy&nbsp;đủ&nbsp;c&aacute;c loại giấy tờ</p>\r\n\r\n<p>- H&oacute;a&nbsp;đơn&nbsp;đỏ</p>\r\n\r\n<p>- Hợp&nbsp;đồng mua b&aacute;n</p>\r\n\r\n<p>- Giấy chứng nhận vệ&nbsp;sinh an to&agrave;n thực phẩm</p>\r\n\r\n<p>- Giấy chứng nhận cơ&nbsp;sở&nbsp;đủ&nbsp;điều kiện vệ&nbsp;sinh an to&agrave;n thực phẩm&nbsp;&nbsp;<s>price/65.000 (đ)&nbsp;</s><strong><s>off/-5%</s></strong></p>\r\n\r\n<p>---------------------------------------------------------------------------------------</p>\r\n\r\n<p>HANDOO FOOD CUNG CẤP H&Agrave;NG Đ&Ocirc;NG LẠNH NHẬP KHẨU</p>\r\n\r\n<p>Đ/C: Số&nbsp;12X5 Ng&otilde; 60 Dương Khu&ecirc;&nbsp;- Mai Dịch - H&agrave; Nội</p>\r\n\r\n<p>Kho h&agrave;ng: Cụm 8 Khu CN Quang Minh - M&ecirc; Linh - H&agrave; Nội</p>\r\n\r\n<p>Hotline: 0967 568 658</p>', 'chan-ga-dong-lanh-nhap-khau.jpg', 7, 496, 1, '1', 'Chuẩn ISO 9000, được hiệp hội gia súc VN chứng nhận an toàn', '2022-03-25', '2023-08-17'),
(16, 'Đùi gà', 'Đồng Nai, Việt Nam', '35000', '2022-04-02', 1, '<p>Đ&ugrave;i g&agrave; , tỏi g&agrave; ,Thịt g&agrave; chứa nhiều chất dưỡng chất c&oacute; lợi cho sức khoẻ. Đồng thời, loại thịt n&agrave;y c&ograve;n c&oacute; thể chế biến th&agrave;nh rất nhiều m&oacute;n ăn ngon như: hấp, la-gu, r&ocirc;-ti, c&agrave;-ri...Nếu chỉ th&iacute;ch ăn c&aacute;nh hoặc ch&acirc;n g&agrave;, bạn h&atilde;y đập bộ phận n&agrave;y cho hơi giập, ướp với sa tế, hạt n&ecirc;m, sau đ&oacute; nướng than. D&ugrave;ng với rau răm v&agrave; muối ti&ecirc;u quất, m&ugrave;i vị rất thơm. Ngo&agrave;i ra, bạn c&ograve;n c&oacute; thể x&eacute; nhỏ thịt g&agrave;, trộn với bắp cải nhuyễn l&agrave;m gỏi...Theo c&aacute;c nh&agrave; dinh dưỡng học, ngo&agrave;i những chất albumin, chất b&eacute;o, thịt g&agrave; c&ograve;n c&oacute; c&aacute;c vitamin A, B1, B2, C, E, axit, canxi, photpho, sắt. Đ&acirc;y l&agrave; loại thực phẩm chất lượng cao, cơ thể con người dễ hấp thu v&agrave; ti&ecirc;u ho&aacute;.Theo Đ&ocirc;ng Y, thịt g&agrave; c&oacute; t&iacute;nh &ocirc;n ngọt, kh&ocirc;ng độc, bổ dưỡng, l&agrave;nh mạnh phổi. Loại thịt n&agrave;y c&ograve;n chữa băng huyết, x&iacute;ch bạch đới, lỵ, ung nhọt, l&agrave; loại thực phẩm bổ &acirc;m cho tỳ vị, bổ kh&iacute;, huyết v&agrave; thận.</p>', 'dui-ga-dong-lanh.jpeg', 1, 598, 0, '1', 'Chuẩn ISO 9000', '2022-03-25', '2023-08-17'),
(18, 'Sườn bò Úc', 'Úc', '200000', '2022-04-01', 3, '<p>Hiện nay tr&ecirc;n thị trường c&oacute; rất nhiều<strong>&nbsp;cửa h&agrave;ng b&aacute;n thịt b&ograve;</strong>&nbsp;với gi&aacute; rất thấp, thực tế đ&oacute; ch&iacute;nh l&agrave;<strong>&nbsp;THỊT TR&Acirc;U ẤN ĐỘ</strong>&nbsp;nhưng quảng c&aacute;o l&agrave;<strong>&nbsp;thịt b&ograve; đ&ocirc;ng lạnh</strong>, để tr&aacute;nh t&igrave;nh trạng mua nhầm h&agrave;ng Q&uacute;y kh&aacute;ch cần ph&acirc;n biệt được&nbsp;<a href=\"http://www.jbsvietnam.com/thit-bo-my.html\"><strong>thịt b&ograve; Mỹ</strong></a>,&nbsp;<a href=\"http://www.jbsvietnam.com/thit-bo-uc.html\"><strong>thịt b&ograve; &Uacute;c</strong></a>&nbsp;v&agrave;&nbsp;<a href=\"http://www.jbsvietnam.com/www.jbsvietnam.com/thit-trau-allana.html\">thịt Tr&acirc;u</a>. Sau đ&acirc;y Ad chia sẻ với qu&yacute; kh&aacute;ch c&aacute;ch nhận biết thịt TR&Acirc;U ẤN ĐỘ với thịt b&ograve; &Uacute;c v&agrave; thịt b&ograve; Mỹ.</p>\r\n\r\n<p><img alt=\"sYYn_bo_mY\" src=\"http://www.jbsvietnam.com/vnt_upload/news/03_2016/09/sYYn_bo_mY.jpg\" /></p>\r\n\r\n<p>Sườn b&ograve; Mỹ th&aacute;t l&aacute;t 1cm</p>\r\n\r\n<h2>Ph&acirc;n biệt thịt b&ograve; &Uacute;c, thịt b&ograve; Mỹ v&agrave; thịt tr&acirc;u Ấn Độ</h2>\r\n\r\n<p><br />\r\nThứ nhất, x&eacute;t về cấp độ của 3 loại tr&ecirc;n th&igrave;&nbsp;<strong>thịt b&ograve; Mỹ</strong>&nbsp;đứng đầu, kế tiếp l&agrave;&nbsp;<strong>thịt b&ograve; &Uacute;c</strong>&nbsp;&amp; sau c&ugrave;ng l&agrave;&nbsp;<strong>thịt Tr&acirc;u</strong>&nbsp;Ấn Độ. Ta x&eacute;t về d&ograve;ng thấp v&agrave; trung cấp của thịt b&ograve; &Uacute;c, thịt b&ograve; Mỹ &amp; thịt Tr&acirc;u Ấn Độ. Thứ hai, x&eacute;t về độ mềm v&agrave; &iacute;t g&acirc;n th&igrave; Thịt b&ograve; Mỹ mềm v&agrave; &iacute;t g&acirc;n, c&aacute;c v&acirc;n mỡ xem kẽ đều b&ecirc;n trong miếng thịt, khi nướng l&ecirc;n rất thơm, mỡ trong suốt. Thịt b&ograve; &Uacute;c kh&ocirc;ng mềm bằng thịt b&ograve; Mỹ cho n&ecirc;n được xếp ở hạng 2(tạm gọi l&agrave; hạng 2 do Ad xếp) c&aacute;c v&acirc;n mỡ trong thịt c&oacute; nhưng &iacute;t hơn, v&acirc;n mỡ chạy kh&ocirc;ng đều như thịt b&ograve; Mỹ, khi nướng l&ecirc;n c&oacute; thơm m&ugrave;i sữa nếu miếng thịt đ&oacute; nhiều mỡ. Tiếp đến l&agrave; thịt Tr&acirc;u Ấn Độ, loại thịt ng&agrave;y cũng mềm nhưng nhiều g&acirc;n v&agrave; mỡ kh&ocirc;, kh&ocirc;ng mịn như&nbsp;<strong>thịt b&ograve; &Uacute;c</strong>&nbsp;v&agrave;&nbsp;<strong>thịt b&ograve; Mỹ</strong>, kh&ocirc;ng c&oacute; mỡ xem kẽ, sớ thịt mịn hơn thịt b&ograve; &Uacute;c v&agrave; thịt b&ograve; Mỹ.Đối với d&ograve;ng cao cấp th&igrave; b&ograve; Mỹ lu&ocirc;n lu&ocirc;n c&oacute; v&acirc;n mỡ, mềm tuyệt đối(trừ khi qu&yacute; kh&aacute;ch kh&ocirc;ng biết chế biến), đối với hạng cao cấp của b&ograve; &Uacute;c th&igrave; v&acirc;n mỡ nhiều hơn hạng trung cấp của thịt b&ograve; &Uacute;c, &iacute;t g&acirc;n v&agrave; mỡ b&ecirc;n ngo&agrave;i. Đối với hạng cao cấp của thịt Tr&acirc;u Ấn Độ th&igrave; b&ecirc;n ngo&agrave;i sẽ c&oacute; lớp g&acirc;n b&oacute;ng(nếu người b&aacute;n đ&atilde; l&oacute;c rồi th&igrave; thua), nhưng đặc biệt ở Thịt tr&acirc;u Ấn Độ l&agrave; d&ograve;ng cao cấp kh&ocirc;ng c&oacute; mỡ v&agrave; v&acirc;n mỡ b&ecirc;n trong.</p>\r\n\r\n<p><img alt=\"nhan-biet-thit-bo-my-uc-trau\" src=\"http://www.jbsvietnam.com/vnt_upload/news/03_2016/09/nhan-biet-thit-bo-my-uc-trau.jpg\" /><br />\r\nNhận biết c&aacute;c loại thịt b&ograve;(h&igrave;nh ảnh chỉ m&ocirc; tả 70%)</p>\r\n\r\n<p>Thứ ba, qu&yacute; kh&aacute;ch n&ecirc;n mua ở những c&ocirc;ng ty uy t&iacute;n, khi mua sản phẩm ch&uacute;ng ta n&ecirc;n đến trực tiếp cửa h&agrave;ng v&agrave; y&ecirc;u cầu c&ocirc;ng ty cắt tại chỗ, chọn những phần thịt c&ograve;n nguy&ecirc;n bao b&igrave; h&uacute;t ch&acirc;n kh&ocirc;ng từ nước ngo&agrave;i sẽ đảm bảo nhất, v&igrave; bao b&igrave; h&uacute;t ch&acirc;n kh&ocirc;ng từ nước ngo&agrave;i kh&ocirc;ng thể l&agrave;m giả được.<br />\r\nTr&ecirc;n đ&acirc;y l&agrave; những th&ocirc;ng tin cần thiết để qu&yacute; kh&aacute;ch lựa chọn miếng thịt b&ograve; ngon v&agrave; đ&uacute;ng chất lượng.<br />\r\nTư vấn miễn ph&iacute; vui l&ograve;ng li&ecirc;n hệ :0975.324.324<br />\r\nĐặt h&agrave;ng : 0903.32.92.83 Cam đến b&aacute;n đ&uacute;ng h&agrave;ng.</p>', 'suong-bo-uc-my.jpg', 2, 300, 0, '1', 'Được hiệp hội bò Úc chứng nhận an toàn vệ sinh thực phẩm', '2022-03-25', '2023-08-16'),
(19, 'Nạc bò Mỹ', 'Hoa Kì', '350000', '2022-12-02', 3, '<h1>C&aacute;ch ph&acirc;n biệt thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c chuẩn x&aacute;c nhất</h1>\r\n\r\n<p>bởi: Dinh Vinh Toan&nbsp;&nbsp;26 Th&aacute;ng 11, 2019</p>\r\n\r\n<p><img alt=\"Cách phân biệt thịt bò Mỹ và thịt bò Úc chuẩn xác nhất\" src=\"https://file.hstatic.net/1000246697/article/825400637229_687933106597920768_o_1fe6d0e9223b40d7a0b32f65bc655eb4_61613ce3d67a41dfb305c485438f592d.jpg\" /></p>\r\n\r\n<p>C&aacute;c nội dung ch&iacute;nh[<a href=\"javascript:void(0)\">Ẩn</a>]</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://bongrocer.vn/blogs/cam-nang/cach-phan-biet-thit-bo-my-va-thit-bo-uc-chuan-xac-nhat#phan_biet_thit_bo_my_va_thit_bo_uc_qua_huong_vi_san_pham\">Ph&acirc;n biệt thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c qua hương vị sản phẩm</a></li>\r\n	<li><a href=\"https://bongrocer.vn/blogs/cam-nang/cach-phan-biet-thit-bo-my-va-thit-bo-uc-chuan-xac-nhat#cach_so_che_thit_bo_my_va_thit_bo_uc_co_gi_khac_nhau\">C&aacute;ch sơ chế thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c c&oacute; g&igrave; kh&aacute;c nhau</a></li>\r\n	<li><a href=\"https://bongrocer.vn/blogs/cam-nang/cach-phan-biet-thit-bo-my-va-thit-bo-uc-chuan-xac-nhat#phan_biet_thit_bo_my_va_thit_bo_uc_qua_gia_ca\">Ph&acirc;n biệt thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c qua gi&aacute; cả</a></li>\r\n</ul>\r\n\r\n<p>Tr&ecirc;n thị trường thịt b&ograve; nhập khẩu hiện nay, c&oacute; hai loại thịt b&ograve; được biết đến nhiều nhất l&agrave; thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c. C&ugrave;ng l&agrave; thịt b&ograve; nhưng mỗi loại lại c&oacute; những đặc điểm ri&ecirc;ng m&agrave; kh&ocirc;ng phải ai cũng biết được, người ti&ecirc;u d&ugrave;ng chỉ biết qua lời giới thiệu của người b&aacute;n h&agrave;ng m&agrave; th&ocirc;i. Vậy th&igrave; h&ocirc;m nay, ZinFood sẽ chỉ cho bạn c&aacute;ch ph&acirc;n biệt&nbsp;<em>thịt b&ograve; Mỹ</em>&nbsp;v&agrave;&nbsp;thịt b&ograve; &Uacute;c&nbsp;nhập khẩu một c&aacute;ch nhanh ch&oacute;ng v&agrave; chuẩn x&aacute;c nhất!</p>\r\n\r\n<p><img src=\"https://file.hstatic.net/1000246697/file/11111_47c46e39997e4600aafffa9cb2d9402e_grande.jpg\" /></p>\r\n\r\n<p>Trước ti&ecirc;n, phải khẳng định rằng chất lượng của thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c đều cực chuẩn với những điều kiện khắt khe của c&aacute;c nước ph&aacute;t triển, ch&iacute;nh v&igrave; vậy h&agrave;ng năm c&oacute; h&agrave;ng trăm tấn&nbsp;<em>thịt b&ograve;</em>&nbsp;của hai nước n&agrave;y được xuất khẩu đi khắp nơi tr&ecirc;n thế giới v&agrave; được nhiều người y&ecirc;u th&iacute;ch.&nbsp;</p>\r\n\r\n<p><em>Thịt b&ograve;</em>&nbsp;được nhập khẩu từ hai nước n&agrave;y đều l&agrave; thịt sạch với c&ocirc;ng nghệ nu&ocirc;i dưỡng ti&ecirc;n tiến, kh&ocirc;ng c&oacute; chất h&oacute;a học, kh&ocirc;ng sử dụng thức ăn tăng trọng, đều được giết mổ v&agrave; đ&oacute;ng g&oacute;i cực kỳ sạch sẽ v&agrave; vệ sinh.&nbsp;</p>\r\n\r\n<p><em>Thịt b&ograve; Mỹ&nbsp;</em>v&agrave;&nbsp;<em>thịt b&ograve; &Uacute;c</em>&nbsp;đều c&oacute; hương vị thơm ngon ri&ecirc;ng, đặc biệt l&agrave; mềm hơn thịt b&ograve; ta, th&iacute;ch hợp để l&agrave;m th&agrave;nh những m&oacute;n nướng lẩu hấp dẫn.</p>\r\n\r\n<p>Tuy nhi&ecirc;n, để ph&acirc;n biệt được 2 loại thịt n&agrave;y th&igrave; bạn cần thời gian để quan s&aacute;t v&agrave; k&egrave;m theo những th&ocirc;ng tin sau đ&acirc;y:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Ph&acirc;n biệt thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c qua hương vị sản phẩm</strong></h2>\r\n\r\n<p>Trước ti&ecirc;n, để n&oacute;i về hương vị sản phẩm c&aacute;c bạn phải hiểu rằng điều ti&ecirc;n quyết để l&agrave;m ra n&oacute; ch&iacute;nh l&agrave; quy tr&igrave;nh chăn nu&ocirc;i.&nbsp;<strong><em>Thịt b&ograve; Mỹ</em></strong>&nbsp;trong những th&aacute;ng đầu ti&ecirc;n sẽ được nu&ocirc;i bằng cỏ tự nhi&ecirc;n, trong những th&aacute;ng sau đ&oacute; sẽ được cho ăn theo chế độ đặc biệt, b&ograve; được nu&ocirc;i dưỡng trong v&ograve;ng &iacute;t nhất 120 ng&agrave;y bằng nguồn thức ăn gi&agrave;u năng lượng, c&acirc;n bằng về mặt dinh dưỡng với th&agrave;nh phần chủ yếu l&agrave; ng&ocirc;, chiếm &iacute;t nhất 70% khối lượng thức ăn h&agrave;ng ng&agrave;y.</p>\r\n\r\n<p>C&ograve;n với&nbsp;<strong><em>b&ograve; &Uacute;c</em></strong>, b&ograve; ho&agrave;n to&agrave;n được nu&ocirc;i dưỡng v&agrave; vỗ b&eacute;o bằng cỏ tự nhi&ecirc;n, được nu&ocirc;i trong v&ograve;ng &iacute;t nhất 100 ng&agrave;y bằng nguồn thức ăn gi&agrave;u năng lượng, c&acirc;n bằng về mặt dinh dưỡng với th&agrave;nh phần chủ yếu l&agrave;m từ c&aacute;c loại hạt ngũ cốc (chiếm 70%).</p>\r\n\r\n<p><img src=\"https://file.hstatic.net/1000246697/file/thit-ba-chi-bo-my_b087f3235e54450cb62021bbddec932b_grande.jpg\" /></p>\r\n\r\n<p>Ch&iacute;nh v&igrave; sự kh&aacute;c nhau trong kh&acirc;u chăn nu&ocirc;i n&agrave;y n&ecirc;n hương vị v&agrave; chất lượng&nbsp;<strong><em>thịt b&ograve; Mỹ</em></strong>&nbsp;v&agrave; thịt b&ograve; &Uacute;c c&oacute; sự kh&aacute;c biệt kh&aacute; lớn: Thịt b&ograve; Mỹ Chất lượng ổn định, thịt chắc, c&oacute; nhiều v&acirc;n mỡ, thịt mềm, c&oacute; m&ugrave;i vị tr&aacute;i c&acirc;y c&ograve;n thịt b&ograve; &Uacute;c th&igrave; c&oacute; thịt nạc, &iacute;t mỡ bao phủ ph&iacute;a ngo&agrave;i v&agrave; thịt kh&ocirc;ng c&oacute; v&acirc;n mỡ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>C&aacute;ch sơ chế thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c c&oacute; g&igrave; kh&aacute;c nhau</strong></h2>\r\n\r\n<p><strong><em>Thịt b&ograve; Mỹ</em></strong>&nbsp;l&agrave; sản phẩm thịt được nhập khẩu đ&ocirc;ng lạnh, với khoa học c&ocirc;ng nghệ hiện đại,&nbsp;<strong><em>thịt b&ograve; Mỹ</em></strong>&nbsp;được cấp đ&ocirc;ng nguy&ecirc;n tảng ngay sau khi mổ thịt v&agrave; l&agrave;m sạch theo d&acirc;y chuyền sản xuất truyền thống của Mỹ, giữ nguy&ecirc;n độ dinh dưỡng v&agrave; chất lượng thịt tươi ngon.</p>\r\n\r\n<p>Hạn sử dụng của&nbsp;<strong><em>thịt b&ograve; Mỹ</em></strong>&nbsp;nguy&ecirc;n tảng được cấp đ&ocirc;ng l&ecirc;n tới 12 th&aacute;ng. Khi c&aacute;c k&ecirc;nh ph&acirc;n phối nhập khẩu về Việt Nam, những miếng thịt b&ograve; nguy&ecirc;n tảng tr&ecirc;n dưới chục kg sẽ được cắt th&aacute;i v&agrave; đ&oacute;ng khay theo y&ecirc;u cầu của kh&aacute;ch h&agrave;ng &ndash; l&uacute;c n&agrave;y&nbsp;<strong><em>thịt b&ograve; Mỹ</em></strong>&nbsp;đ&atilde; cắt th&aacute;i c&oacute; hạn sử dụng tối đa 6 th&aacute;ng. M&aacute;y cắt mỏng thịt sẽ được thực hiện tại c&aacute;c đại l&yacute; ph&acirc;n phối ở Việt Nam theo y&ecirc;u cầu v&agrave; nhu cầu sử dụng của người d&ugrave;ng.</p>\r\n\r\n<p><img src=\"https://file.hstatic.net/1000246697/file/tp040101003_545b3987b55c4e6db0c31db618ea2aba_grande.jpg\" /></p>\r\n\r\n<p>Trong khi đ&oacute;,&nbsp;<strong><em>thịt b&ograve; &Uacute;c</em></strong>&nbsp;nhập khẩu về Việt Nam được ưa chuộng hơn cả lại l&agrave; sản phẩm thịt b&ograve; &Uacute;c tươi. Thịt b&ograve; &Uacute;c tươi c&oacute; hạn sử dụng tối đa l&ecirc;n tới 3 th&aacute;ng, do c&ocirc;ng nghệ ti&ecirc;n tiến của &Uacute;c, thịt b&ograve; tươi vẫn giữ nguy&ecirc;n hiện trạng v&agrave; hương vị, tuy nhi&ecirc;n việc bảo quản khi ở c&aacute;c đại l&yacute; cung cấp thịt b&ograve; &Uacute;c tươi tại nước ta cần phải cực kỳ hiện đại mới giữ được chất lượng tươi nguy&ecirc;n như mới n&agrave;y.</p>\r\n\r\n<p><img src=\"https://file.hstatic.net/1000246697/file/75593833_1561825400637229_687933106597920768_o_eb6ef2d3703b4c2abe1c93e24adc9210_grande.jpg\" /></p>\r\n\r\n<p>Tr&ecirc;n thực tế th&igrave; rất nhiều cơ sở ph&acirc;n phối, đầu mối nhập h&agrave;ng thịt b&ograve; &Uacute;c xuất khẩu chưa đạt được d&acirc;y chuyền giữ đ&ocirc;ng, l&agrave;m lạnh sản phẩm ti&ecirc;u chuẩn khiến cho chất lượng thịt b&ograve; &Uacute;c tươi c&oacute; phần đi xuống hơn so với sản phẩm gốc được nhập về.</p>\r\n\r\n<p>Tất nhi&ecirc;n cũng c&oacute; những phần thịt b&ograve; &Uacute;c được cấp đ&ocirc;ng rồi xuất khẩu ra c&aacute;c nước trong đ&oacute; c&oacute; Việt Nam nhưng sản phẩm n&agrave;y kh&ocirc;ng qu&aacute; nổi bật như phần thịt tươi.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Ph&acirc;n biệt thịt b&ograve; Mỹ v&agrave; thịt b&ograve; &Uacute;c qua gi&aacute; cả</strong></h2>\r\n\r\n<p>Hiện nay, thịt b&ograve; Mỹ l&agrave; sản phẩm c&oacute; gi&aacute; nhỉnh hơn thịt b&ograve; &Uacute;c. Nếu như b&ograve; Mỹ c&oacute; gi&aacute; th&agrave;nh tương tự như b&ograve; ta hoặc cao hơn th&igrave; b&ograve; &Uacute;c c&oacute; gi&aacute; th&agrave;nh thậm ch&iacute; c&ograve;n rẻ hơn b&ograve; ta. Điều n&agrave;y một phần cũng l&agrave; v&igrave; nước &Uacute;c c&oacute; nền chăn nu&ocirc;i b&ograve; đạt hiệu quả cao, năng suất m&agrave; chi ph&iacute; v&agrave; vốn bỏ ra kh&ocirc;ng qu&aacute; lớn, b&ecirc;n cạnh đ&oacute; chất lượng<strong>&nbsp;</strong><em>thịt b&ograve; Mỹ</em>&nbsp;cũng được đ&aacute;nh gi&aacute; cao hơn b&ograve; &Uacute;c n&ecirc;n gi&aacute; th&agrave;nh của thịt b&ograve; Mỹ cũng nhỉnh hơn&nbsp;thịt b&ograve; &Uacute;c.</p>\r\n\r\n<p>Như vậy, hai loại thịt b&ograve; với hai phương ph&aacute;p chăn nu&ocirc;i kh&aacute;c nhau sẽ cho ra hương vị v&agrave; chất lượng cũng kh&aacute;c nhau. Nhưng nh&igrave;n chung, thịt b&ograve; &Uacute;c v&agrave; thịt b&ograve; Mỹ đều được chăn nu&ocirc;i trong quy tr&igrave;nh kh&eacute;p k&iacute;n hiện đại v&agrave; đảm bảo. Điều n&agrave;y gi&uacute;p duy tr&igrave; được chất lượng thịt v&agrave; người ti&ecirc;u d&ugrave;ng c&oacute; thể y&ecirc;n t&acirc;m khi sử dụng sản phẩm.</p>', 'thit-loi-nac-vai-bo-uc.jpg', 1, 1000, 0, '1', 'Sản xuất theo dây chuyền hiện đại của Hòa Kì, an toàn vệ sinh thực phẩm', '2022-03-25', '2023-08-16'),
(20, 'Thịt mông', 'Hòa Bình, Việt Nam', '50000', '2022-04-06', 4, '<p>Tại miền Đ&ocirc;ng v&agrave; miền T&acirc;y, người nu&ocirc;i heo gọi b&aacute;n nhiều do lo ngại gi&aacute; sẽ tiếp tục giảm th&ecirc;m, k&eacute;o gi&aacute; c&ograve;n phổ biến 57.000 - 61.000 đồng/kg t&ugrave;y v&ugrave;ng v&agrave; t&ugrave;y chất lượng heo.</p>\r\n\r\n<p><a href=\"https://cafefcdn.com/203337114487263232/2021/6/30/photo-1-16250246702461513005546.jpg\"><img alt=\"Tiêu thụ thịt heo khó khăn, giá giảm vì Covid-19 - Ảnh 1.\" src=\"https://cafefcdn.com/203337114487263232/2021/6/30/photo-1-16250246702461513005546.jpg\" /></a></p>\r\n\r\n<p>Diễn biến gi&aacute; thịt heo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tại chợ Ngọc Lũ, tỉnh H&agrave; Nam, ng&agrave;y 27/6, lượng heo nhập chợ đạt khoảng 3.000 con, trong đ&oacute; heo Th&aacute;i hết c&aacute;ch ly c&oacute; 4 xe, heo miền Trung/miền Nam 6 -7 xe, c&ograve;n lại l&agrave; heo d&acirc;n quanh chợ b&aacute;n ra. Chợ b&aacute;n chậm với gi&aacute; h&agrave;ng đầu 68.500 - 69.000 đồng/kg, phổ biến 65.000 đồng/kg.</p>\r\n\r\n<p>Do lượng heo nhập chợ B&igrave;nh Điền, TP HCM tăng mạnh, đạt hơn 2.200 con từ mức 1.500 - 1.600 con trước đ&oacute;. Th&ecirc;m v&agrave;o đ&oacute;, nhiều chợ truyền thống bị đ&oacute;ng cửa do c&oacute; ca nhiễm Covid-19 n&ecirc;n gi&aacute; heo tại chợ rớt mạnh c&ograve;n 35.000 - 40.000 đồng/kg v&agrave;o cuối phi&ecirc;n. Thương l&aacute;i lỗ nặng v&igrave; gi&aacute; heo giảm.</p>', 'mong-lon.webp', 0, 1000, 0, '1', 'Lợn được nuôi theo phong cách hoang dã không cám cò, an toàn nguyên chất', '2022-03-25', '2022-04-03'),
(21, 'Ba chỉ', 'Nghệ An, Việt Nam', '55000', '2022-04-09', 4, '<h1>B&iacute; quyết ph&acirc;n biệt thịt lợn sạch v&agrave; thịt lợn bẩn</h1>\r\n\r\n<p>16/04/2018 09:55</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(Baonghean.vn) -Trước t&igrave;nh trạng &quot;thịt bẩn&quot;, &quot;thịt độc&quot; ng&agrave;y c&agrave;ng nhiều khiến người ti&ecirc;u d&ugrave;ng kh&ocirc;ng khỏi hoang mang. Vậy l&agrave;m thế n&agrave;o để ph&acirc;n biệt bằng mắt thường c&oacute; thể mua được thịt lợn sạch, đảm bảo vệ sinh v&agrave; an to&agrave;n cho gia đ&igrave;nh?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Những mẹo dưới đ&acirc;y sẽ gi&uacute;p c&aacute;c gia đ&igrave;nh lựa chọn được thịt lợn sạch kh&ocirc;ng mang mầm bệnh, thuốc tăng trọng, chất tạo nạc...</p>\r\n\r\n<p><strong>1.Thịt lợn mang mầm bệnh</strong></p>\r\n\r\n<p><strong>Thịt lợn gạo:</strong>&nbsp;Bằng mắt thường rất dễ d&agrave;ng nhận thấy nếu lợn bị gạo, trong thớ thịt sẽ c&oacute; k&eacute;n giun m&agrave;u trắng; những đốm trắng n&agrave;y h&igrave;nh bầu dục, c&oacute; khi lớn bằng hạt đậu.</p>\r\n\r\n<p><strong>Lợn bị thương h&agrave;n:</strong>&nbsp;Bề mặt da c&oacute; những nốt bầm hoặc lấm tấm xuất huyết, thịt nh&atilde;o, tai bị t&iacute;m.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lợn&nbsp;bị bệnh tả:</strong>&nbsp;Nốt xuất huyết nằm dưới da hoặc tr&ecirc;n v&agrave;nh tai, lấm tấm như nốt muỗi đốt.</p>\r\n\r\n<p><strong>Lợn&nbsp;bị tụ huyết tr&ugrave;ng:</strong>&nbsp;Thịt c&oacute; những mảng bầm, tụ m&aacute;u.</p>\r\n\r\n<p><strong>Lợn bị bệnh đ&oacute;ng dấu:</strong>&nbsp;Bề mặt da c&oacute; những nốt tr&ograve;n đỏ hoặc t&iacute;a, c&oacute; khi m&agrave;u t&iacute;m bầm; k&iacute;ch thước kh&aacute;c nhau, như h&igrave;nh đ&oacute;ng dấu.</p>\r\n\r\n<p><strong>2. Nhận biết lợn ăn tăng trọng, chất tạo nạc</strong></p>\r\n\r\n<p><a href=\"https://photo-cms-baonghean.zadn.vn/w800/Uploaded/2022/xqymkxrlxk/2018_04_15/32776346_1542018.jpg\"><img src=\"https://photo-cms-baonghean.zadn.vn/w607/Uploaded/2022/xqymkxrlxk/2018_04_15/32776346_1542018.jpg\" /></a>Khi thấy thịt nạc c&oacute; m&agrave;u đỏ đạm kh&aacute;c thường, lớp mỡ mỏng đ&oacute; lợn đ&atilde; ăn chất tạo nạc.</p>\r\n\r\n<p><strong>M&ugrave;i vị</strong>:&nbsp;Thịt lợn si&ecirc;u nạc sẽ c&oacute; m&ugrave;i tanh hơn thịt lợn sạch.</p>\r\n\r\n<p><strong>M&agrave;u sắc:</strong>&nbsp;Thịt lợn sạch c&oacute; m&agrave;u hồng tươi. Thịt lợn si&ecirc;u nạc thường c&oacute; m&agrave;u đỏ đậm kh&aacute;c thường, s&aacute;ng v&agrave; b&oacute;ng; da c&oacute; thể xuất hiện những đốm đỏ.</p>\r\n\r\n<p><strong>Kiểm tra lớp mỡ:</strong>&nbsp;Lợn si&ecirc;u nạc thường c&oacute; lớp mỡ mỏng dưới 1cm v&agrave; lỏng lẻo, phần nạc b&aacute;m s&aacute;t v&agrave;o da. Với &quot;thịt lợn sạch&quot; mỡ thường d&agrave;y 1,5 - 2cm, c&oacute; m&agrave;u trắng trong hoặc trắng ng&agrave;.</p>\r\n\r\n<p><strong>Kiểm tra khối thịt:&nbsp;</strong>Thịt lợn sạch, khối thịt rắn chắc, c&oacute; độ đ&agrave;n hồi cao khi ấn xuống, thớ thịt đều, đường cắt mặt thịt kh&ocirc; r&aacute;o.</p>\r\n\r\n<p>Lợn ăn tăng trọng, chất tạo nạc thịt thường kh&ocirc;, cứng hơn v&agrave; &iacute;t đ&agrave;n hồi; c&oacute; cảm gi&aacute;c ứ nước b&ecirc;n trong, cục nạc nổi th&agrave;nh u, khi th&aacute;i c&oacute; thể c&oacute; dịch v&agrave;ng chảy ra.</p>\r\n\r\n<p>Một c&aacute;ch thử đơn giản kh&aacute;c l&agrave; khi th&aacute;i thịt th&agrave;nh miếng d&agrave;y 3 - 4 cm, nếu kh&ocirc;ng đứng thẳng được th&igrave; đ&oacute; l&agrave; thịt đ&atilde; nu&ocirc;i tăng trọng.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"https://photo-cms-baonghean.zadn.vn/w800/Uploaded/2022/xqymkxrlxk/2018_04_15/41622041_1542018.jpg\"><img src=\"https://photo-cms-baonghean.zadn.vn/w607/Uploaded/2022/xqymkxrlxk/2018_04_15/41622041_1542018.jpg\" /></a>Thịt lợn sạch thường c&oacute; lớp mỡ d&agrave;y, độ đ&agrave;n hồi cao.</p>\r\n\r\n<p><strong>3. Kiểm tra chất bảo quản</strong></p>\r\n\r\n<p>Một số người b&aacute;n thường &ldquo;h&ocirc; biến&rdquo; thịt &ocirc;i th&agrave;nh tươi bằng c&aacute;ch ướp h&agrave;n the, muối di&ecirc;m... để đ&aacute;nh lừa cảm quan người ti&ecirc;u d&ugrave;ng.</p>\r\n\r\n<p>Khi ướp những chất n&agrave;y, thịt tr&ocirc;ng sẽ đỏ tươi, kh&ocirc;ng c&ograve;n độ d&iacute;nh dẻo tự nhi&ecirc;n, thớ thịt săn, cứng, mất độ đ&agrave;n hồi.</p>\r\n\r\n<p>Khi cắt s&acirc;u v&agrave;o b&ecirc;n trong, thịt kh&aacute; nhũn, chảy dịch, m&agrave;u hơi th&acirc;m, c&oacute; m&ugrave;i. Loại thịt n&agrave;y khi rửa sẽ chuyển m&agrave;u nhợt v&agrave; c&oacute; m&ugrave;i tanh rất kh&oacute; chịu, mỡ c&oacute; m&agrave;u v&agrave;ng.</p>\r\n\r\n<p><a href=\"https://photo-cms-baonghean.zadn.vn/w800/Uploaded/2022/xqymkxrlxk/2018_04_15/56607529_1542018.jpg\"><img src=\"https://photo-cms-baonghean.zadn.vn/w607/Uploaded/2022/xqymkxrlxk/2018_04_15/56607529_1542018.jpg\" /></a>Thịt c&oacute; chất tạo nạc thường ra nhiều nước, khi nấu l&ecirc;n cũng c&oacute; m&ugrave;i kh&ocirc;ng thơm như tự nhi&ecirc;n, khi ăn c&oacute; cảm gi&aacute;c bị kh&ocirc;.</p>\r\n\r\n<p><strong>4. Kiểm tra trong qu&aacute; tr&igrave;nh chế biến</strong></p>\r\n\r\n<p>Thịt lợn sạch khi luộc nước trong, kh&ocirc;ng v&aacute;ng bẩn; khi rang miếng thịt nở ra, kh&ocirc;ng c&oacute; nước, c&oacute; m&ugrave;i thơm.</p>\r\n\r\n<p>Thịt si&ecirc;u nạc hoặc nu&ocirc;i c&aacute;m tăng trọng khi luộc thường nhiều v&aacute;ng, nước c&oacute; m&ugrave;i h&ocirc;i, khi rang ra nhiều nước, ăn kh&ocirc;.</p>\r\n\r\n<p>Nếu lợn cho ăn chất tạo nạc, khi nấu thịt sẽ bốc hơi m&ugrave;i kh&aacute;ng sinh dễ nhận biết./.</p>', 'Ba-chi.jpg', 0, 500, 0, '1', 'Chuẩn vệ sinh an toàn thực phẩm', '2022-03-25', '2022-03-25');
INSERT INTO `product` (`id`, `name`, `origin`, `price`, `exp`, `category_id`, `description`, `image`, `view`, `count`, `count_sold`, `status`, `note`, `created_at`, `updated_at`) VALUES
(22, 'Nạc lợn nái', 'Sapa, Điện Biên Phủ', '80000', '2022-05-01', 4, '<h3>1. C&aacute;ch chọn thịt lợn (thịt heo) ngon, sạch</h3>\r\n\r\n<p>Về m&agrave;u sắc</p>\r\n\r\n<p>Bạn n&ecirc;n chọn những miếng thịt lợn tươi mới c&oacute; m&agrave;u sắc s&aacute;ng, m&agrave;u thịt ngon sẽ l&agrave; m&agrave;u hồng nhạt hay đỏ nhạt, phần mỡ sẽ c&oacute; m&agrave;u trắng trong hơi ng&agrave; ng&agrave;.</p>\r\n\r\n<p>D&ugrave;ng dao cắt thử miếng thịt theo chiều dọc sẽ thấy thớ thịt hơi se lại, bề mặt r&aacute;o, lớp b&igrave; mềm, đ&acirc;y l&agrave; thịt tươi ngon.</p>\r\n\r\n<p>Tr&aacute;nh chọn những phần thịt c&oacute; m&agrave;u sắc lạ, m&agrave;u sắc nhợt nhạt, hoặc m&agrave;u qu&aacute; sậm. Bề mặt thịt b&oacute;ng lo&aacute;ng, chạm v&agrave;o thấy hơi nhớt ở đầu ng&oacute;n tay th&igrave; tuyệt đối kh&ocirc;ng n&ecirc;n mua.</p>\r\n\r\n<p><img alt=\"Màu sắc tươi sáng, hồng nhạt hoặc đỏ nhạt \" src=\"https://cdn.tgdd.vn/2021/05/content/0-800x500.jpg\" style=\"height:500px; width:800px\" /></p>\r\n\r\n<p>Về m&ugrave;i</p>\r\n\r\n<p>Thịt ngon khi ngửi thử sẽ c&oacute; m&ugrave;i thơm đặc trưng của thịt, m&ugrave;i n&agrave;y kh&ocirc;ng g&acirc;y kh&oacute; chịu, kh&ocirc;ng c&oacute; m&ugrave;i tanh h&ocirc;i hăng mũi.</p>\r\n\r\n<p>Những miếng thịt đ&atilde; c&oacute; m&ugrave;i lạ, c&oacute; m&ugrave;i tanh h&ocirc;i, hay m&ugrave;i &ocirc;i thiu l&agrave; thịt đ&atilde; hỏng, kh&ocirc;ng được bảo quản trong điều kiện th&iacute;ch hợp.</p>\r\n\r\n<p><img alt=\"Thịt có mùi thơm đặc trưng, không có mùi lạ, mùi ôi thiu \" src=\"https://cdn.tgdd.vn/2021/05/content/1-800x500-2.jpg\" style=\"height:500px; width:800px\" /></p>\r\n\r\n<p>Về độ đ&agrave;n hồi</p>\r\n\r\n<p>D&ugrave;ng tay ấn thử v&agrave;o miếng thịt thấy thịt đ&agrave;n hồi tốt, sau khi r&uacute;t tay về thịt trở lại h&igrave;nh d&aacute;ng ban đầu, tr&ecirc;n mặt thịt kh&ocirc;ng tồn tại vết l&otilde;m l&agrave; thịt tươi ngon.</p>\r\n\r\n<p>L&uacute;c chạm v&agrave;o thấy thớ thịt săn chắc, kh&ocirc;ng qu&aacute; cứng cũng kh&ocirc;ng bị nh&atilde;o, kh&ocirc;ng c&oacute; dịch nhớt chảy ra th&igrave; c&oacute; thể chọn mua.</p>\r\n\r\n<p><img alt=\"Dùng tay ấn vào thịt để kiểm tra độ đàn hồi\" src=\"https://cdn.tgdd.vn/2021/05/content/3-800x500-4.jpg\" style=\"height:500px; width:800px\" /></p>\r\n\r\n<p>Về lớp mỡ, da</p>\r\n\r\n<p>Lợn được nu&ocirc;i trong điều kiện b&igrave;nh thường sẽ c&oacute; lớp mỡ d&agrave;y khoảng 1.5 - 2 l&oacute;ng tay, bạn c&oacute; thể dễ d&agrave;ng quan s&aacute;t lớp mỡ v&agrave; da d&agrave;y như l&agrave; đặc điểm đơn giản nhất để nhận dạng thịt lợn kh&ocirc;ng bị nu&ocirc;i th&uacute;c trọng lượng.</p>\r\n\r\n<p>N&ecirc;n chọn những miếng thịt lợn c&oacute; kết cấu thịt, mỡ ri&ecirc;ng biệt, nhưng phải d&iacute;nh chặt v&agrave;o nhau, d&ugrave;ng tay chạm v&agrave;o thấy kh&oacute; t&aacute;ch rời.</p>\r\n\r\n<p>Những miếng thịt c&oacute; mỡ v&agrave; thịt nạc rời nhau, d&ugrave;ng tay chạm v&agrave;o c&oacute; dịch v&agrave;ng chảy ra l&agrave; lợn được nu&ocirc;i bằng chất tạo nạc, kh&ocirc;ng n&ecirc;n mua.</p>\r\n\r\n<p><img alt=\"Lớp mỡ, da và thịt nạc dính chặt vào nhau khó tách rời là thịt ngon \" src=\"https://cdn.tgdd.vn/2021/05/content/4-800x500-2.jpg\" style=\"height:500px; width:800px\" /></p>\r\n\r\n<h3>2. Dấu hiệu nhận biết thịt lợn (heo) bệnh</h3>\r\n\r\n<p>B&ecirc;n cạnh những đặc điểm nhận dạng thịt lợn tươi ngon, bạn cũng cần t&igrave;m hiểu th&ecirc;m về những dấu hiệu cho thấy thịt lợn đang mắc bệnh, gi&uacute;p bạn lựa chọn được những miếng thịt tươi ngon nhất.</p>\r\n\r\n<p>Một số đặc điểm nhận dạng cơ bản như:</p>\r\n\r\n<p>Đặc điểm dễ d&agrave;ng quan s&aacute;t nhất l&agrave; thịt lợn đ&atilde; c&oacute; m&ugrave;i tanh h&ocirc;i, &ocirc;i thiu g&acirc;y kh&oacute; chịu khi ngửi phải, bề mặt thịt chạm v&agrave;o thấy nhớt v&agrave; thịt c&oacute; m&agrave;u sắc lạ.</p>\r\n\r\n<p>Tr&ecirc;n bề mặt lớp da lợn xuất hiện c&aacute;c đốm lạ với m&agrave;u sắc kh&aacute;c nhau, c&oacute; thể l&agrave; c&aacute;c đốm đỏ, đốm m&agrave;u xanh t&iacute;m hay m&agrave;u son với k&iacute;ch thước kh&aacute;c nhau.</p>\r\n\r\n<p><img alt=\"Thịt khi luộc chín có màu sắc lạ do nhiễm hàn the, tàn dư thuốc trong cơ thể \" src=\"https://cdn.tgdd.vn/2021/05/content/6-800x500-1.jpg\" style=\"height:500px; width:800px\" /></p>\r\n\r\n<p>Quan s&aacute;t thấy c&aacute;c vết tụ m&aacute;u lớn, vết bầm t&iacute;m hay c&aacute;c vết xuất huyết lấm tấm tr&ecirc;n da, đ&acirc;y l&agrave; dấu hiệu cho thấy lợn bị thương h&agrave;n hay bị tụ huyết tr&ugrave;ng.</p>\r\n\r\n<p>Khi cắt thử thịt lợn thấy b&ecirc;n trong thịt c&oacute; những hạt nhỏ mang h&igrave;nh d&aacute;ng như hạt gạo, loại n&agrave;y được gọi l&agrave; ấu tr&ugrave;ng s&aacute;n, l&agrave; một loại giun s&aacute;n g&acirc;y nguy hiểm cho cơ thể nếu d&ugrave;ng phải.</p>\r\n\r\n<p><img alt=\"Thịt lợn xuất hiện các hạt gạo trắng đục là do giun sán \" src=\"https://cdn.tgdd.vn/2021/05/content/5-800x500.jpg\" style=\"height:500px; width:800px\" /></p>\r\n\r\n<p>Những miếng thịt c&oacute; m&agrave;u sắc nhợt nhạt, thịt nh&atilde;o mềm, chạm v&agrave;o chảy dịch, c&agrave;ng rửa th&igrave; m&agrave;u c&agrave;ng nhạt v&agrave; c&oacute; m&ugrave;i tanh h&ocirc;i th&igrave; đ&acirc;y l&agrave; thịt đ&atilde; bị ướp qua h&agrave;n the.</p>\r\n\r\n<p>Dưới da hoặc tr&ecirc;n v&agrave;nh tai xuất hiện c&aacute;c đốm đỏ li ti, lấm tấm như vết muỗi đốt l&agrave; do thịt lợn bị tả.</p>\r\n\r\n<p>Ngo&agrave;i ra c&ograve;n c&oacute; thịt lợn bị nhiễm m&agrave;u v&agrave;ng l&agrave; biểu hiện của bệnh vi&ecirc;m gan.</p>', 'nac-lon.jpg', 0, 300, 0, '1', 'Nạc lợn được ướp lạnh bảo đảm an toàn vệ sinh', '2022-03-25', '2022-03-25'),
(23, 'Sườn', 'Ấn Độ', '90000', '2022-05-27', 5, '<p>Nhắc đến tr&acirc;u người ta hay nghĩ đến thịt dẻ sườn tr&acirc;u,&nbsp;g&acirc;n tr&acirc;u, hay&nbsp;bắp tr&acirc;u,... m&agrave;&nbsp;mọi người thường qu&ecirc;n đi một bộ phận cũng rất ngon đấy l&agrave;&nbsp;<a href=\"http://hunggiaco.com/danh-muc/thit-trau-nhap-khau.html\"><em><strong>thăn tr&acirc;u</strong></em></a>.<br />\r\nỞ nước ta, số lượng thịt tr&acirc;u được ti&ecirc;u thụ tr&ecirc;n thị trường&nbsp;chủ yếu l&agrave;&nbsp;<a href=\"http://hunggiaco.com/danh-muc/thit-trau-nhap-khau.html\"><em><strong>thịt tr&acirc;u nhập khẩu từ Ấn độ</strong></em></a>&nbsp;với ưu điểm l&agrave; h&agrave;ng nhập khẩu ch&iacute;nh ngạch, chất lượng thịt tốt đảm bảo chất lượng v&agrave; gi&aacute; cả phải chăng n&ecirc;n được rất&nbsp;nhiều qu&aacute;n ăn, nh&agrave; h&agrave;ng... sử dụng l&agrave;m nguy&ecirc;n liệu để chế biến. H&atilde;y c&ugrave;ng t&igrave;m hiểu b&agrave;i viết dưới đ&acirc;y để hiểu th&ecirc;m về thịt thăn tr&acirc;u nh&eacute;!<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/than-mong-trau.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Thịt thăn tr&acirc;u l&agrave; g&igrave;? C&aacute;c loại thăn tr&acirc;u phổ biến</strong></h2>\r\n\r\n<p><a href=\"http://hunggiaco.com/danh-muc/thit-trau-nhap-khau.html\"><em><strong>Thăn tr&acirc;u</strong></em></a>&nbsp;l&agrave;&nbsp;l&agrave; phần thịt nằm dưới sống lưng của tr&acirc;u chạy từ h&ocirc;ng đế cổ của con tr&acirc;u đ&acirc;y được coi l&agrave; phần thịt ngon nhất của tr&acirc;u, gần như ko c&oacute; mỡ v&agrave; g&acirc;n thịt mềm, ngọt kh&ocirc;ng dai c&oacute; d&ugrave;ng chế biến được nhiều m&oacute;n ăn như thịt tr&acirc;u nướng tảng, x&agrave;o, nh&uacute;ng mẻ, l&agrave;m tr&acirc;u g&aacute;c bếp&hellip;<br />\r\nC&oacute; hai loại thăn tr&acirc;u l&agrave; thăn nội v&agrave; thăn ngoại tr&acirc;u.<br />\r\nThăn nội hay c&ograve;n được gọi l&agrave; thăn phi l&ecirc; &ndash; một phần thịt thuộc phần gần cuối thắt lưng của con tr&acirc;u.&nbsp;<br />\r\nThịt thăn ngoại tr&acirc;u l&agrave; phần thịt được thấy qua rẻo mỡ d&agrave;y ở m&ocirc;̣t b&ecirc;n rìa lát thịt. Thịt thăn ngoại tr&acirc;u kh&ocirc;ng được m&ecirc;̀m như thăn nội tr&acirc;u nhưng lại có nhi&ecirc;̀u v&acirc;n mỡ hơn, n&ecirc;n n&oacute; có hương vị đ&acirc;̣m đà hơn.<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/than-noi-trau.jpg\" /></p>\r\n\r\n<h3><br />\r\n<br />\r\n<strong>C&aacute;c loại thăn phổ biến của Thịt Tr&acirc;u</strong></h3>\r\n\r\n<p>- Thăn Nội: M31<br />\r\n- Thăn Đ&ugrave;i: M 44&nbsp;<br />\r\n- Thăn Ngoại: M46<br />\r\n- Thăn Vai: M63 p<br />\r\n- Thăn Đầu: M67<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/than-ngoai-trau.png\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Lợi &iacute;ch của thăn tr&acirc;u</strong></h2>\r\n\r\n<ul>\r\n	<li>D&ugrave;ng để tăng cường sinh lực, ph&ograve;ng chống v&agrave; chữa trị hiệu quả nhiều bệnh m&agrave; người mắc phải.</li>\r\n	<li>Với vị ngọt, t&iacute;nh m&aacute;t, kh&ocirc;ng độc, t&aacute;c dụng bổ tỳ vị, mạnh g&acirc;n cốt, &iacute;ch huyết.</li>\r\n	<li>H&agrave;m lượng dinh dưỡng trong thịt tr&acirc;u kh&aacute; cao:</li>\r\n	<li>Tỷ lệ chất đạm gấp đ&ocirc;i so với thịt lợn,</li>\r\n	<li>Lượng chất b&eacute;o v&agrave; chất đường vừa phải,</li>\r\n	<li>&nbsp;Thịt tr&acirc;u v&agrave; thịt b&ograve; kh&aacute; giống nhau, cũng c&oacute; nhiều chất dinh dưỡng v&agrave; c&oacute; lợi cho sức khỏe. Nhưng trong thịt tr&acirc;u th&igrave; lượng chất b&eacute;o thấp hơn v&agrave; cơ nhiều hơn, n&ecirc;n c&oacute; một số người ăn ki&ecirc;ng th&iacute;ch ăn thịt tr&acirc;u hơn thịt b&ograve;.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/than-trau-ma-67.jpg\" /></p>\r\n\r\n<h2><br />\r\n<strong>C&aacute;ch lựa chọn thăn tr&acirc;u ngon</strong></h2>\r\n\r\n<p>Để c&oacute; được những m&oacute;n ăn ngon th&igrave; quan trọng nhất vẫn l&agrave; kh&acirc;u lựa chọn nguy&ecirc;n liệu. Chắc hẳn kh&ocirc;ng phải ai cũng biết c&aacute;ch chọn mua thịt thăn tr&acirc;u, vậy h&atilde;y c&ugrave;ng tham khảo&nbsp;c&aacute;ch dưới đ&acirc;y nh&eacute;:<br />\r\n<em><strong>Thịt tr&acirc;u</strong></em>&nbsp;khỏe mạnh thường c&oacute; m&agrave;u hồng sậm, c&oacute; khi m&agrave;u đỏ sậm, thớ thịt hơi th&ocirc;. Tr&ecirc;n thịt tr&acirc;u cơ bắp &iacute;t thấy c&oacute; mỡ hoặc nếu c&oacute; mỡ tr&acirc;u thường c&oacute; m&agrave;u trắng. Một phần thăn ngon l&agrave; một miếng thịt c&oacute; m&agrave;u đỏ sẫm nhưng kh&ocirc;ng t&aacute;i. Khi d&iacute; tay v&agrave;o miếng thịt kh&ocirc;ng bị d&iacute;nh, t&iacute;nh đ&agrave;n hồi cao, thịt c&oacute; thớ to, mỡ trắng. Thịt kh&ocirc;ng c&oacute; m&ugrave;i &ocirc;i, kh&ocirc;ng c&oacute; nhiều bọc nhỏ xen giữa c&aacute;c thớ thịt (dễ gặp s&aacute;n trong thịt).<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/than-%20trau.jpg\" /></p>\r\n\r\n<h2><br />\r\n<strong>C&aacute;ch chế biến thăn tr&acirc;u</strong></h2>\r\n\r\n<p>Th&ecirc;m một kh&acirc;u nữa cũng kh&ocirc;ng k&eacute;m quan trọng đ&oacute; l&agrave; c&aacute;ch chế biến thăn tr&acirc;u để tạo n&ecirc;n những m&oacute;n ăn ngon, dinh dưỡng</p>\r\n\r\n<p>Thăn tr&acirc;u v&ocirc; c&ugrave;ng ngon m&agrave; lại đầy dinh dưỡng nhưng nếu kh&ocirc;ng biết c&aacute;ch chế biến sẽ l&agrave;m mất đi c&aacute;c chất tốt cho sức khỏe: vitamin nh&oacute;m B, muối v&ocirc; cơ, phosphore, vitamin A,.. V&igrave; thế c&aacute;ch chế biến cũng l&agrave; một bước rất quan trọng để cho ra một miếng&nbsp;<a href=\"http://hunggiaco.com/danh-muc/thit-trau-nhap-khau.html\"><em><strong>thịt thăn tr&acirc;u ngon</strong></em></a>.</p>\r\n\r\n<p>Với ưu điểm l&agrave; mềm, xốp, bổ dưỡng, n&ecirc;n b&agrave; nội trợ chỉ cần ch&uacute; trọng v&agrave;o kh&acirc;u tẩm ướp gia vị cho n&oacute; vừa miệng nhất, khi đ&oacute; gia đ&igrave;nh bạn đ&atilde; c&oacute; th&ecirc;m một m&oacute;n thăn tr&acirc;u ngon bổ dưỡng v&agrave;o m&acirc;m cơm thường ng&agrave;y.</p>\r\n\r\n<p>&nbsp;Thăn tr&acirc;u thường được chế biến th&agrave;nh c&aacute;c m&oacute;n: thăn nội nướng, phở, thăn &aacute;p x&agrave;o, thăn &aacute;p chảo,...<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://hunggiaco.com/upload/images/than-trau-m44.jpg\" /></p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2><strong>Địa chỉ mua thịt thăn tr&acirc;u tươi ngon, an to&agrave;n chất lượng.</strong></h2>\r\n\r\n<p><a href=\"http://hunggiaco.com/danh-muc/thit-trau-nhap-khau.html\"><em><strong>Thịt tr&acirc;u nhập khẩu</strong></em></a>&nbsp;kh&ocirc;ng c&ograve;n xa lạ với người ti&ecirc;u d&ugrave;ng&nbsp;Việt Nam, nhưng để t&igrave;m được địa chỉ mua thịt thăn tr&acirc;u tươi ngon, đảm bảo chất lượng&nbsp;kh&ocirc;ng phải ai cũng biết điều n&agrave;y v&igrave; hiện nay tr&ecirc;n thị trường xuất hiện nhiều t&igrave;nh trạng thịt kh&ocirc;ng r&otilde; nguồn gốc, h&agrave;ng k&eacute;m chất lượng khiến người d&acirc;n hoang mang lo sợ v&agrave; t&igrave;m đến những địa chỉ uy t&iacute;n nhập khẩu ch&iacute;nh ngạch trong đ&oacute; c&oacute;&nbsp;<a href=\"http://hunggiaco.com/\"><em><strong>Thực Phẩm nhập khẩu Hưng Gia</strong></em></a>.<br />\r\nThực phẩm nhập khẩu Hưng Gia - l&agrave; đơn vị nhập khẩu trực tiếp c&aacute;c loại thực phẩm từ c&aacute;c nước tr&ecirc;n Thế giới như Anh, Ph&aacute;p, Mỹ, Nga...&nbsp;cung cấp cho c&aacute;c đại l&yacute;, bếp ăn, si&ecirc;u thị...&nbsp; những nguồn nguy&ecirc;n liệu chất lượng, c&oacute; nguồn gốc r&otilde; r&agrave;ng gi&uacute;p cho người ti&ecirc;u d&ugrave;ng an t&acirc;m về sản phẩm của C&ocirc;ng ty.<br />\r\nNgo&agrave;i th&ocirc;ng tin về những mặt h&agrave;ng sản phẩm,&nbsp;<a href=\"http://hunggiaco.com/\"><em><strong>thực phẩm nhập khẩu Hưng Gia</strong></em></a>&nbsp;c&ograve;n cung cấp những th&ocirc;ng tin cần thiết v&agrave; bổ &iacute;ch cho kh&aacute;ch h&agrave;ng về những lĩnh vực trong đời sống, gi&uacute;p kh&aacute;ch h&agrave;ng lựa chọn mặt h&agrave;ng đ&uacute;ng đắn hơn.<br />\r\nH&atilde;y l&agrave; người mua h&agrave;ng th&ocirc;ng minh, lựa chọn cho m&igrave;nh những sản phẩm sạch, chất lượng, đảm bảo nhất ở những nơi uy t&iacute;n, chất lượng.</p>', 'suon-trau.jpg', 30, 1000, 120, '1', 'Sản xuất theo công nghệ tiên tiến đến từ Ấn Độ', '2022-03-25', '2023-08-17'),
(24, 'Lòng gà', 'China', '35000', '2022-06-17', 2, '<p>B&ecirc;n cạnh&nbsp;<a href=\"https://www.bachhoaxanh.com/thit-ga\" target=\"_blank\">thịt g&agrave;</a>,<strong><a href=\"https://www.bachhoaxanh.com/thit-ga/long-ga-vi-300g\" target=\"_blank\">&nbsp;l&ograve;ng g&agrave;</a></strong>&nbsp;(bao gồm<strong>&nbsp;tim g&agrave;, mề g&agrave;, gan g&agrave;</strong>) l&agrave; một phần kh&ocirc;ng thể bỏ qua trong việc chế biến những m&oacute;n ngon từ g&agrave;. Đ&acirc;y l&agrave; những bộ phận kh&oacute; chế biến nhất nhưng lại c&oacute; hương vị rất ngon, th&iacute;ch hợp trong việc chế biến ra nhiều m&oacute;n ngon, d&acirc;n d&atilde;, quen thuộc. Ngo&agrave;i ra, mề g&agrave;, tim g&agrave; v&agrave; gan g&agrave; cũng l&agrave; những loại thực phẩm mang đến nhiều c&ocirc;ng dụng tốt cho sức khoẻ, được ưa d&ugrave;ng trong c&aacute;c m&oacute;n ăn bồi bổ sức khoẻ<br />\r\n<img alt=\"Lòng gà khay 300g (14-16 miếng) 0\" src=\"https://cdn.tgdd.vn/Products/Images/8790/232828/bhx/long-ga-vi-300g-202102061748273286.jpg\" /></p>\r\n\r\n<h3><strong>Hướng dẫn chế biến</strong></h3>\r\n\r\n<p><strong>- Mề g&agrave;:</strong>&nbsp;Khi l&agrave;m mề bạn moi hết ph&acirc;n ra sau đ&oacute; cạo, tr&aacute;nh cho nước v&agrave;o khi đ&oacute; sẽ kh&oacute; cạo lớp vỏ b&aacute;m ở mề. Khi cạo sạch bạn cho nước rửa sạch sau đ&oacute; b&oacute;p với muối trắng. B&oacute;p v&agrave; rửa lại với nước cho sạch hẳn. Bạn c&oacute; thể cho 1 &iacute;t giấm ăn xoa đều b&oacute;p trong v&ograve;ng 2 ph&uacute;t gi&uacute;p mề g&agrave; sạch v&agrave; hết m&ugrave;i h&ocirc;i.</p>\r\n\r\n<p>Xem th&ecirc;m:&nbsp;<a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/meo-lam-sach-me-ga-me-vit-me-gan-nhanh-chi-3-giay-la-xong-1316875\" target=\"_blank\">Mẹo l&agrave;m sạch mề g&agrave;, mề vịt nhanh ch&oacute;ng</a><br />\r\n<strong>- Gan g&agrave;:</strong>&nbsp;Th&aacute;i hoặc cắt gan g&agrave; th&agrave;nh những miếng vừa ăn, sau đ&oacute; rửa sạch với nước muối.<br />\r\n<strong>- Tim g&agrave;:&nbsp;</strong>TIm g&agrave; sau khi mua về bạn phải rửa sạch. Sau đ&oacute; cắt đ&ocirc;i tim để loại bỏ hết những cục m&aacute;u c&ograve;n s&oacute;t lại.</p>\r\n\r\n<h3><strong>M&oacute;n ngon với l&ograve;ng g&agrave;</strong></h3>\r\n\r\n<p>Mề g&agrave; v&agrave; tim g&agrave;&nbsp;kh&ocirc;ng chỉ l&agrave; m&oacute;n nh&acirc;m nhi trong c&aacute;c bữa tiệc bằng c&aacute;ch nướng m&agrave; c&ograve;n c&oacute; thể chế biến th&agrave;nh nhiều m&oacute;n ngon kh&aacute;c nhau, k&iacute;ch th&iacute;ch vị gi&aacute;c v&agrave; mang đến nhiều lợi &iacute;ch cho sức khoẻ như:</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cach-lam-long-ga-xao-muop-huong-cuc-ngon-986726\" target=\"_blank\">Mướp hương x&agrave;o l&ograve;ng g&agrave;</a></li>\r\n	<li><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cach-nau-mien-long-ga-don-gian-va-bo-duong-cho-ca-nha-1263343\" target=\"_blank\">Miến l&ograve;ng g&agrave;</a></li>\r\n	<li><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cach-lam-me-ga-xao-chua-ngot-thom-ngon-tham-vi-1313262\" target=\"_blank\">Mề g&agrave; x&agrave;o chua ngọt</a>,...</li>\r\n</ul>\r\n\r\n<p><strong>Lưu &yacute;:&nbsp;</strong>Sản phẩm nhận được c&oacute; thể kh&aacute;c với h&igrave;nh ảnh về m&agrave;u sắc v&agrave; số lượng nhưng vẫn đảm bảo về mặt khối lượng v&agrave; chất lượng.</p>', 'noi-tang.jfif', 0, 500, 0, '1', 'Được làm sạch cẩn thận bởi những người thợ khéo tay nhất', '2022-03-25', '2022-03-25'),
(25, 'Cánh gà', 'Hạ Long, Việt Nam', '63000', '2022-09-02', 2, '<h3>Thịt heo sạch v&agrave;<strong>&nbsp;thịt g&agrave; tươi sạch&nbsp;</strong>3F &ndash; sự lựa chọn của nhiều người nội trợ m&ugrave;a dịch</h3>\r\n\r\n<p>Nhiều sản phẩm dinh dưỡng được nhiều người ưa chuộng để tăng cường sức khỏe m&ugrave;a dịch.Trong giỏ h&agrave;ng nội trợ của người Việt, thịt l&agrave; nguồn thực phẩm kh&ocirc;ng thể thiếu. Nguồn thực phẩm n&agrave;y lu&ocirc;n dồi d&agrave;o đạm (protein), vitamin v&agrave; kho&aacute;ng chất. Những ng&agrave;y nắng n&oacute;ng n&agrave;y, dịch Covid-19 vẫn tiếp tục diễn biến căng thẳng. Thịt heo v&agrave; thịt g&agrave; c&oacute; mặt trong những bữa ăn h&agrave;ng ng&agrave;y gi&uacute;p tăng cường dinh dưỡng đ&aacute;ng kể. Để đảm bảo an to&agrave;n, người ti&ecirc;u d&ugrave;ng thường ưu ti&ecirc;n chọn mua sản phẩm thịt c&oacute; thương hiệu. Những sản phẩm n&agrave;y phải được b&agrave;y b&aacute;n tại c&aacute;c k&ecirc;nh mua sắm hiện đại, đủ c&aacute;c điều kiện về bảo quản.</p>\r\n\r\n<p>2 trong số những c&aacute;i t&ecirc;n điển h&igrave;nh nhất l&agrave; thịt heo sạch MEATDeli v&agrave; thịt g&agrave; tươi 3F. Sản phẩm n&agrave;y được b&aacute;n rộng r&atilde;i tại hệ thống gần 500 si&ecirc;u thị VinMart/cửa h&agrave;ng VinMart+ tại TP.HCM. Người ti&ecirc;u d&ugrave;ng đ&atilde; l&agrave;m quen với thương hiệu thịt heo sạch MEATDeli v&agrave; g&agrave; tươi 3F l&acirc;u nay.&nbsp; Năng lực sản xuất của hai doanh nghiệp ng&agrave;y c&agrave;ng n&acirc;ng cao. Nhờ vậy, họ c&oacute; thể đ&aacute;p ứng tốt được cả về chất v&agrave; lượng cho thị trường năng động gần 10 triệu d&acirc;n của th&agrave;nh phố. Thực phẩm từ những thương hiệu n&agrave;y lu&ocirc;n tươi ngon, trọn dinh dưỡng. C&aacute;c sản phẩm lu&ocirc;n được kiểm so&aacute;t to&agrave;n bộ quy tr&igrave;nh từ chăn nu&ocirc;i tới giết mổ đảm bảo kh&eacute;p k&iacute;n.</p>\r\n\r\n<p><img alt=\"Thịt gà tươi sạch 3F tại Vinmart ‘cháy hàng’ mùa giãn cách\" src=\"https://tieudungchatluong.net/wp-content/uploads/2021/09/Canh-ga-tuoi-3f-600x400-1.jpg\" style=\"height:400px; width:600px\" /></p>\r\n\r\n<h3><strong>Thịt g&agrave; sạch</strong>&nbsp;3F v&agrave; thịt heo MEATDeli đạt ti&ecirc;u chuẩn ch&acirc;u &Acirc;u</h3>\r\n\r\n<p>Chị Mai Thu (quận Ph&uacute; Nhuận, TP.HCM) vừa chọn mua g&agrave; tươi tại si&ecirc;u thị VinMart Phan X&iacute;ch Long. Chị chia sẻ từ ng&agrave;y dịch Covid-19, gia đ&igrave;nh chị chỉ mua thịt g&agrave;, thịt heo sạch trong si&ecirc;u thị. Tất cả bao b&igrave;, nh&atilde;n m&aacute;c đều phải r&otilde; r&agrave;ng nguồn gốc. Nhờ vậy chị mới thấy y&ecirc;n t&acirc;m về an to&agrave;n thực phẩm v&agrave; sức khỏe cho cả gia đ&igrave;nh. Đ&acirc;y cũng l&agrave; suy nghĩ chung của nhiều người ti&ecirc;u d&ugrave;ng đối với MEATDeli v&agrave; thịt g&agrave; sạch 3F.. V&igrave; vậy, sản phẩm thịt sạch MEATDeli v&agrave; g&agrave; tươi 3F cứ ra quầy đến đ&acirc;u b&aacute;n hết tới đ&oacute;.</p>\r\n\r\n<p>Quản l&iacute; quầy h&agrave;ng thịt tại si&ecirc;u thị VinMart Thảo Điền cho biết những con số ấn tượng. Ngay trong ng&agrave;y 31/5, sức mua c&aacute;c sản phẩm thịt heo sạch v&agrave; g&agrave; tươi tăng 40% so với ng&agrave;y thường. Hai sản phẩm n&agrave;y lu&ocirc;n được người ti&ecirc;u d&ugrave;ng chọn mua nhiều nhất so với c&aacute;c sản phẩm thịt kh&aacute;c.</p>\r\n\r\n<h3>Gi&aacute; trị dinh dưỡng của&nbsp;<strong>thịt g&agrave; sạch</strong>&nbsp;3F v&agrave; thịt heo sạch MEATDeli&nbsp;</h3>\r\n\r\n<p>Theo c&aacute;c chuy&ecirc;n gia dinh dưỡng, thịt g&agrave; c&oacute; gi&aacute; trị dinh dưỡng l&agrave;nh mạnh với sức khỏe, năng lượng cao. Nguồn protein tuyệt vời, &iacute;t calo v&agrave; chất b&eacute;o b&atilde;o h&ograve;a trong thịt gia cầm sẽ tạo n&ecirc;n một m&oacute;n ăn tốt cho sức khỏe. Bởi vậy, dễ hiểu khi sức ti&ecirc;u thụ của thịt heo m&aacute;t v&agrave; g&agrave; tươi tăng mạnh, trong đ&oacute; thịt g&agrave; tươi 3F được ưa chuộng hơn cả.</p>\r\n\r\n<p>Thịt heo sạch MEATDeli v&agrave; g&agrave; tươi 3F đều sản xuất theo m&ocirc; h&igrave;nh t&iacute;ch hợp ho&agrave;n chỉnh theo chuỗi t&iacute;ch hợp 3F (feed &ndash; farm &ndash; food). To&agrave;n bộ chuỗi cung ứng kh&eacute;p k&iacute;n n&agrave;y. Tất cả đảm bảo sản phẩm thịt tươi, ngon, an to&agrave;n đến tận tay người ti&ecirc;u d&ugrave;ng. Trong đ&oacute;, tổ hợp chế biến thịt heo sạch c&ocirc;ng nghệ từ ch&acirc;u &Acirc;u đ&aacute;p ứng ti&ecirc;u chuẩn BRC.</p>\r\n\r\n<h3>Đ&acirc;y l&agrave; ti&ecirc;u chuẩn h&agrave;ng đầu thế giới về an to&agrave;n thực phẩm. Thịt heo sau khi chế biến sẽ được l&agrave;m m&aacute;t v&agrave; đ&oacute;ng g&oacute;i với c&ocirc;ng nghệ Oxy-Fresh. Quy tr&igrave;nh đ&oacute;ng g&oacute;i ngay tại nh&agrave; m&aacute;y nhằm ngăn ngừa vi khuẩn x&acirc;m nhập. Như vậy để giữ trọn dưỡng chất c&ugrave;ng độ ngon tối ưu của thịt. Sản phẩm thịt heo sạch MEATDeli lu&ocirc;n được bảo quản xuy&ecirc;n suốt ở nhiệt độ 0-4&deg;C từ nh&agrave; m&aacute;y đến người ti&ecirc;u d&ugrave;ng.</h3>\r\n\r\n<p>Tr&ecirc;n to&agrave;n hệ thống VinMart/VinMart+ của TP.HCM. MEATDeli cung cấp gần 30 chủng loại thịt heo phong ph&uacute; tươi ngon với 2 d&ograve;ng chuẩn ngon v&agrave; thượng hạng. C&aacute;c sản phẩm bao gồm bắp gi&ograve; cuộn, cốt lết, sườn thăn, sườn st. Louis, ba rọi&hellip; D&ograve;ng sản phẩm đầu ti&ecirc;n l&agrave; thịt heo với giải ph&aacute;p tiện lợi. D&ograve;ng sản phẩm n&agrave;y tiết kiệm thời gian cho b&agrave; nội trợ như: thịt xay tươi ướp sẵn, thịt heo d&agrave;nh cho m&oacute;n kho, thịt heo d&agrave;nh cho m&oacute;n x&agrave;o&hellip; D&ograve;ng sản phẩm thứ hai l&agrave; Gi&ograve; Chả dai ngon ngọt thịt, đượm vị truyền thống: gi&ograve; thủ, gi&ograve; lụa l&aacute; chuối, chả b&igrave; ớt xi&ecirc;m xanh&hellip;<strong>Thịt G&agrave; tươi sạch&nbsp;</strong>3F đảm bảo nguồn g&agrave; sạch đạt chuẩn &ldquo;3 kh&ocirc;ng&rdquo;.</p>\r\n\r\n<p>Kh&ocirc;ng c&oacute; hormone tăng trưởng. Kh&ocirc;ng c&oacute; dư lượng kh&aacute;ng sinh. Kh&ocirc;ng c&oacute; vi sinh vật g&acirc;y bệnh. Ti&ecirc;u chuẩn n&agrave;y gi&uacute;p sản phẩm lu&ocirc;n tươi ngon v&agrave; an to&agrave;n trong suốt hạn sử dụng. Sản phẩm thuộc sở hữu của C&ocirc;ng ty 3F Việt. Đ&acirc;y l&agrave; một trong những doanh nghiệp nội địa h&agrave;ng đầu. C&ocirc;ng ty chủ yếu cung cấp c&aacute;c sản phẩm từ gia cầm như thịt g&agrave; tươi đ&oacute;ng g&oacute;i v&agrave; c&aacute;c sản phẩm từ thịt g&agrave;. 3F Việt sở hữu hệ thống ho&agrave;n chỉnh từ con giống, trại ấp, trại thịt đến cơ sở chế biến v&agrave; đ&oacute;ng g&oacute;i thực phẩm quy m&ocirc; lớn. Tất cả đều đạt ti&ecirc;u chuẩn khắt khe về m&ocirc;i trường v&agrave; vệ sinh an to&agrave;n thực phẩm.</p>', 'canh-ga-tuoi.jpg', 0, 350, 0, '0', 'Chuẩn ISO 9000, sản xuất bởi nghê nhân Hạ Long rất khéo tay', '2022-03-25', '2022-03-25'),
(26, 'Thân gà', 'Hà Nội, Việt Nam', '50000', '2022-09-01', 2, '<p>Thực Phẩm Ngọc Minh l&agrave; cửa hàng chuy&ecirc;n cung cấp c&aacute;c sản phẩm Gia cầm &ndash; thuỷ cầm tươi sống cho thị trường th&agrave;nh phố Hồ Ch&iacute; Minh , Đồng Nai , B&igrave;nh Dương v&agrave; c&aacute;c tỉnh ph&iacute;a Nam bao gồm c&aacute;c chợ đầu mối, chợ lẻ, nh&agrave; h&agrave;ng, kh&aacute;ch sạn, qu&aacute;n ăn, bếp ăn c&ocirc;ng nghiệp, trường học, c&ocirc;ng ty... với mặt h&agrave;ng chủ lực l&agrave; gia cầm sạch đ&atilde; qua kiểm dịch .</p>\r\n\r\n<p>Trong qu&aacute; tr&igrave;nh h&igrave;nh th&agrave;nh v&agrave; ph&aacute;t triển ,từ những ng&agrave;y đầu kinh doanh với qui m&ocirc; nhỏ , ch&uacute;ng t&ocirc;i lu&ocirc;n lu&ocirc;n phấn đấu v&agrave; đến h&ocirc;m nay sản phẩm gia cầm của Ngọc Minh được giết mổ tr&ecirc;n d&acirc;y chuyền hiện đại ,đảm bảo an to&agrave;n vệ sinh trong kh&acirc;u quản l&yacute; chuồng trại, chế biến , bảo quản v&agrave; vận chuyển ph&acirc;n phối , nhằm đưa đến kh&aacute;ch h&agrave;ng những sản phẩm hợp v&ecirc;̣ sinh nh&acirc;́t.</p>\r\n\r\n<p>Cửa h&agrave;ng cần hợp t&aacute;c to&agrave;n diện v&agrave; l&acirc;u d&agrave;i với nhiều đơn vị cung cấp thực phẩm sạch để mang đến c&aacute;c loại thực phẩm đạt ti&ecirc;u chuẩn từ kh&acirc;u nu&ocirc;i trồng, chế biến đến vận chuyển, ph&acirc;n phối tới tay người ti&ecirc;u d&ugrave;ng. Tất cả sản phẩm tại cửa h&agrave;ng đều c&oacute; nguồn gốc xuất xứ r&otilde; r&agrave;ng. Việc vận chuyển thực phẩm từ cửa h&agrave;ng đến tay người ti&ecirc;u d&ugrave;ng phải lu&ocirc;n được thực hiện trong điều kiện nhiệt độ th&iacute;ch hợp để đảm bảo độ tươi ngon v&agrave; chất lượng. Mọi vật liệu chứa đựng thực phẩm đều đạt ti&ecirc;u chuẩn sạch v&agrave; an to&agrave;n nhằm mục đ&iacute;ch hạn chế sự sinh trưởng của vi khuẩn.</p>', 'than-ga.jfif', 0, 222, 0, '1', 'Chuẩn ISO 9000, thân gà được làm sạch một cách thủ công, an toàn sạch sẽ', '2022-03-25', '2022-03-25'),
(27, 'Mực ống', 'Biển Cửa Lò, Nghệ An, VN', '150000', '2022-04-10', 6, '<h3>Dấu hiệu nhận biết mực ống</h3>\r\n\r\n<p><img alt=\"Dấu hiệu nhận biết mực ống\" src=\"https://cdn.tgdd.vn/Files/2019/08/29/1193017/cach-nhan-biet-va-chon-muc-ong-tuoi-che-bien-mon-ngon-cho-gia-dinh-202201070841177969.jpeg\" style=\"height:140px; width:360px\" /></p>\r\n\r\n<p>Để nhận biết được mực ống kh&ocirc;ng kh&oacute; đặc biệt l&agrave; ở&nbsp;<strong>phần v&acirc;y đu&ocirc;i được xuất ph&aacute;t từ giữa th&acirc;n k&eacute;o d&agrave;i xuống cuối th&acirc;n h&igrave;nh thoi,</strong>&nbsp;c&oacute; t&uacute;i mực đen để bảo vệ m&igrave;nh ph&ograve;ng khi c&oacute; kẻ th&ugrave; tấn c&ocirc;ng.</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute; mực ống c&oacute; đặc điểm l&agrave;<strong>&nbsp;th&acirc;n d&agrave;i, h&igrave;nh ống c&oacute; 8 r&acirc;u nhỏ v&agrave; 2 x&uacute;c tu d&agrave;i</strong>, da c&oacute; nhiều đốm hồng, mắt to trong suốt.</p>\r\n\r\n<h3>2C&aacute;ch chọn mực ống tươi ngon</h3>\r\n\r\n<p><strong>Nh&igrave;n m&agrave;u sắc mực:</strong></p>\r\n\r\n<p>Nếu l&agrave; mực ống tươi th&igrave; nh&igrave;n lớp&nbsp;<strong>da m&agrave;u n&acirc;u th&igrave; sẽ l&agrave; n&acirc;u đậm</strong>&nbsp;c&ograve;n m&agrave;u trắng sẽ trắng b&oacute;ng chứ kh&ocirc;ng đục nh&eacute;.</p>\r\n\r\n<p><strong>D&ugrave;ng tay cảm nhận độ săn chắc của mực:</strong></p>\r\n\r\n<p>Khi chọn mua mực ống hay mực n&agrave;o cũng vậy nếu muốn biết n&oacute; tươi hay kh&ocirc;ng bạn h&atilde;y&nbsp;<strong>d&ugrave;ng tay ấn v&agrave;o phần thịt</strong>&nbsp;nếu sau khi ấn v&agrave;&nbsp;<strong>thả tay ra th&igrave; thịt mực sẽ nhanh ch&oacute;ng trở lại trạng th&aacute;i ban đầu</strong>&nbsp;như vậy l&agrave; mực tươi. C&ograve;n nếu như thịt mực mềm, nh&atilde;o kh&ocirc;ng c&oacute; độ đ&agrave;n hồi l&agrave; mực đ&atilde; cũ.</p>\r\n\r\n<p><strong>Ch&uacute; &yacute; m&agrave;u mắt mực:</strong></p>\r\n\r\n<p><img alt=\"Cách nhận biết và chọn mực ống tươi, chế biến món ngon cho gia đình \" src=\"https://cdn.tgdd.vn/Files/2019/08/29/1193017/cach-nhan-biet-va-chon-muc-ong-tuoi-che-bien-mon-ngon-cho-gia-dinh-201908292012247702.jpg\" style=\"height:140px; width:360px\" /></p>\r\n\r\n<p>Đ&atilde; l&agrave; mực tươi sẽ c&oacute;&nbsp;<strong>mắt rất s&aacute;ng, trong</strong>&nbsp;thậm ch&iacute; chị em c&oacute; thể nh&igrave;n thấy r&otilde; con ngươi b&ecirc;n trong c&ograve;n nếu mực kh&ocirc;ng ngon mắt sẽ mờ v&agrave; đục.</p>\r\n\r\n<p><strong>Kiểm tra r&acirc;u mực:</strong></p>\r\n\r\n<p><img alt=\"Cách nhận biết và chọn mực ống tươi, chế biến món ngon cho gia đình \" src=\"https://cdn.tgdd.vn/Files/2019/08/29/1193017/cach-nhan-biet-va-chon-muc-ong-tuoi-che-bien-mon-ngon-cho-gia-dinh-201908292013587949.jpg\" style=\"height:140px; width:360px\" /></p>\r\n\r\n<p><strong>Mực ống c&oacute; 8 r&acirc;u nhỏ v&agrave; 2 x&uacute;c tu</strong>&nbsp;khi bạn mua bạn cần lưu &yacute; nếu c&ograve;n đủ số r&acirc;u, x&uacute;c tu v&agrave; n&oacute; d&iacute;nh chặt v&agrave;o nhau l&agrave; mực c&ograve;n tươi nếu như n&oacute; bị rơi rớt mất một số r&acirc;u th&igrave; l&agrave; mực đ&atilde; bị ươn rồi.</p>\r\n\r\n<h3>3Những m&oacute;n ngon được chế biến từ mực ống</h3>\r\n\r\n<p>Với mực ống th&igrave; chị em c&oacute; thể chế biến th&agrave;nh nhiều m&oacute;n ăn kh&aacute;c nhau:</p>\r\n\r\n<p><strong>Mực ống nhồi thịt sốt me:</strong></p>\r\n\r\n<p><img alt=\"Cách nhận biết và chọn mực ống tươi, chế biến món ngon cho gia đình \" src=\"https://cdn.tgdd.vn/Files/2019/08/29/1193017/cach-nhan-biet-va-chon-muc-ong-tuoi-che-bien-mon-ngon-cho-gia-dinh-201908292013173076.jpg\" style=\"height:140px; width:360px\" /></p>\r\n\r\n<p>Đ&acirc;y l&agrave; m&oacute;n ăn kh&ocirc;ng chỉ ngon m&agrave; c&ograve;n c&oacute; m&agrave;u sắc v&ocirc; c&ugrave;ng hấp dẫn nữa, khi ăn bạn sẽ cảm nhận được vị gi&ograve;n sần sật của mực, thịt mềm, thơm, k&egrave;m theo vị chua ngọt của đường v&agrave; nước cốt me.</p>\r\n\r\n<p>Nếu như v&agrave;o dịp nh&agrave; c&oacute; kh&aacute;ch bạn đ&atilde;i m&oacute;n mực ống nhồi thịt sốt me th&igrave; c&ograve;n g&igrave; tuyệt vời hơn.</p>\r\n\r\n<p><strong>Mực ống x&agrave;o cần tỏi:</strong></p>\r\n\r\n<p>Những miếng mực ngọt thịt, gi&ograve;n gi&ograve;n c&ugrave;ng với hương thơm từ cần t&acirc;y mang đến m&ugrave;i vị ri&ecirc;ng v&agrave; phong c&aacute;ch cực ri&ecirc;ng. C&aacute;ch chế biến m&oacute;n ăn n&agrave;y cũng v&ocirc; c&ugrave;ng đơn giản chỉ cần v&agrave;i bước nhỏ l&agrave; bạn đ&atilde; c&oacute; ngay một m&oacute;n ăn ngon chi&ecirc;u đ&atilde;i cả gia đ&igrave;nh</p>\r\n\r\n<p><strong>Mực ống nướng:</strong></p>\r\n\r\n<p>L&agrave; một m&oacute;n ăn được nhiều người ưa th&iacute;ch m&agrave; c&aacute;ch chế biến cũng cực dễ lu&ocirc;n nh&eacute;! Chẳng cần tốn qu&aacute; nhiều c&ocirc;ng sức chỉ cần chọn mua được mực ống tươi về rửa sạch v&agrave; đem l&ecirc;n nướng th&ocirc;i. Chỉ sau v&agrave;i ph&uacute;t l&agrave; đ&atilde; c&oacute; ngay m&oacute;n mực nướng cực bắt mắt, m&ugrave;i thơm quyến rũ khẩu vị người ăn. Gắp một miếng mực nướng chấm tương ớt, hay nước mắm gừng th&igrave; quả l&agrave; kh&ocirc;ng c&oacute; g&igrave; tuyệt hơn.</p>\r\n\r\n<p><strong>Mực ống hấp:</strong></p>\r\n\r\n<p><img alt=\"Cách nhận biết và chọn mực ống tươi, chế biến món ngon cho gia đình \" src=\"https://cdn.tgdd.vn/Files/2019/08/29/1193017/cach-nhan-biet-va-chon-muc-ong-tuoi-che-bien-mon-ngon-cho-gia-dinh-201908292013364674.jpg\" style=\"height:140px; width:360px\" /></p>\r\n\r\n<p>Với c&aacute;ch hấp mực sẽ gi&uacute;p giữ nguy&ecirc;n m&ugrave;i vị của mực, khi ăn bạn sẽ cảm nhận được vị gi&ograve;n của mực. Với m&oacute;n mực hấp bạn c&oacute; thể trang tr&iacute; nhiều c&aacute;ch kh&aacute;c nhau để c&ugrave;ng gia đ&igrave;nh thưởng thức hay đ&atilde;i tiệc đều được nh&eacute;!</p>', 'muc-ong.jpg', 0, 190, 0, '1', 'Mực tươi lấy từ biển Cửa Lò khi thuyền vừa cập bến', '2022-03-25', '2022-03-25'),
(28, 'Sò lông', 'Đảo Phú Quốc, Việt Nam', '95000', '2022-09-02', 6, '<h2><strong>Giới thiệu th&ocirc;ng tin về s&ograve; l&ocirc;ng</strong></h2>\r\n\r\n<p><strong>S&ograve; l&ocirc;ng&nbsp;</strong>hay c&ograve;n được biết đến với t&ecirc;n gọi kh&aacute;c l&agrave;<strong>&nbsp;s&ograve; l&ocirc;ng</strong>&nbsp;biển. Đ&acirc;y l&agrave; động vật th&acirc;n mềm thuộc họ s&ograve; Arcidae v&agrave; thường ph&acirc;n bổ nhiều ở c&aacute;c v&ugrave;ng biển nơi c&oacute; kh&iacute; hậu nhiệt đới như: Th&aacute;i B&igrave;nh Dương, Ấn Độ Dương v&agrave; một số v&ugrave;ng biển từ Đ&ocirc;ng Phi tới ch&acirc;u &Uacute;c, Nhật Bản v&agrave; cả Việt Nam.&nbsp;</p>\r\n\r\n<p>S&ograve; l&ocirc;ng c&oacute; ngoại h&igrave;nh gần giống với s&ograve; huyết nhưng k&iacute;ch thước lớn hơn với khoảng 33mm chiều ngang, 38mm chiều cao v&agrave; 48mm chiều d&agrave;i. Hai mặt vỏ s&ograve; h&igrave;nh bầu dục, kh&ocirc;ng bằng nhau. Mặt ngo&agrave;i vỏ của loại s&ograve; n&agrave;y c&oacute; nhiều đường gờ xếp chồng l&ecirc;n nhau chạy thẳng từ đỉnh bản lề tới m&eacute;p vỏ tr&ocirc;ng như m&aacute;i ng&oacute;i nh&agrave;. Ngo&agrave;i c&ugrave;ng của vỏ s&ograve; được bao phủ một lớp l&ocirc;ng m&agrave;u n&acirc;u.&nbsp;</p>\r\n\r\n<p>Ở nước ta, s&ograve; l&ocirc;ng ph&acirc;n bố chủ y&ecirc;u ở một số v&ugrave;ng biển thuộc miền Trung v&agrave; miền Nam như: Huế, Ki&ecirc;n Giang,&hellip; Kh&ocirc;ng chỉ l&agrave; loại hải được nhiều người trong nước y&ecirc;u th&iacute;ch, s&ograve; l&ocirc;ng c&ograve;n l&agrave; mặt h&agrave;ng xuất khẩu mang lại gi&aacute; trị kinh tế cao.&nbsp;</p>\r\n\r\n<p><img alt=\"Loại sò này có ngoại hình gần giống với sò huyết nhưng kích thước lớn hơn\" src=\"https://haisantrungnam.vn/wp-content/uploads/2020/03/so-long-1.jpg\" style=\"height:525px; width:700px\" /></p>\r\n\r\n<p>Loại s&ograve; n&agrave;y c&oacute; ngoại h&igrave;nh gần giống với s&ograve; huyết nhưng k&iacute;ch thước lớn hơn</p>\r\n\r\n<h2><strong>Gi&aacute; trị dinh dưỡng&nbsp;</strong></h2>\r\n\r\n<p>S&ograve; l&ocirc;ng l&agrave; loại hải sản c&oacute; thịt ngọt, dai, b&eacute;o ngậy tự nhi&ecirc;n v&agrave; chứa nhiều gi&aacute; trị dinh dưỡng trong th&agrave;nh phần. Đặc biệt l&agrave; h&agrave;m lượng đạm, kẽm, sắt cao hơn rất nhiều so với c&aacute;c loại thịt, c&aacute; v&agrave; hải sản th&ocirc;ng thường kh&aacute;c.&nbsp;</p>\r\n\r\n<p>Theo c&aacute;c nghi&ecirc;n cứu khoa học đ&atilde; chỉ ra rằng, trong 100g thịt s&ograve; c&oacute; chứa nhiều chứa nhiều vitamin v&agrave; kho&aacute;ng chất trong th&agrave;nh phần. Cụ thể l&agrave; khoảng: 3g carbohydrates, 0,4g chất b&eacute;o, 8,8g chất đạm, c&ugrave;ng nhiều kho&aacute;ng chất, calo v&agrave; c&aacute;c loại vitamin kh&aacute;c như A, C, D, vitamin nh&oacute;m B. Vậy n&ecirc;n, đ&acirc;y ch&iacute;nh l&agrave; nguồn thực phẩm được nhiều chuy&ecirc;n gia dinh dưỡng khuy&ecirc;n n&ecirc;n bổ sung thường xuy&ecirc;n cho cơ thể.&nbsp;</p>\r\n\r\n<p><img alt=\"Sò lông là loại hải sản có thịt ngọt, dai, béo ngậy tự nhiên và chứa nhiều giá trị dinh dưỡng\" src=\"https://haisantrungnam.vn/wp-content/uploads/2020/03/so-long-2.jpg\" style=\"height:700px; width:700px\" /></p>\r\n\r\n<p>S&ograve; l&ocirc;ng l&agrave; loại hải sản c&oacute; thịt ngọt, dai, b&eacute;o ngậy tự nhi&ecirc;n v&agrave; chứa nhiều gi&aacute; trị dinh dưỡng</p>\r\n\r\n<h2><strong>C&ocirc;ng dụng của s&ograve; l&ocirc;ng với sức khỏe con người&nbsp;</strong></h2>\r\n\r\n<p>Kh&ocirc;ng chỉ l&agrave; nguồn thực phẩm thơm ngon, gi&agrave;u chất dinh dưỡng, s&ograve; l&ocirc;ng c&ograve;n được biết đến l&agrave; một vị thuốc trong Đ&ocirc;ng y c&oacute; t&ecirc;n gọi l&agrave; Mao Khảm v&agrave; mang đến rất nhiều c&ocirc;ng dụng cho sức khỏe. Một trong c&aacute;c số đ&oacute; m&agrave; ch&uacute;ng ta c&oacute; thể kể đến như:&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Bổ sung kh&iacute; huyết, điều trị thiếu m&aacute;u, huyết hư, điều h&ograve;a kinh nguyệt ở nữ giới.</li>\r\n	<li>Bổ thận, tr&aacute;ng dương, điều trị xuất tinh sớm, tăng cường sinh lực cho nam giới.</li>\r\n	<li>Điều trị đau dạ d&agrave;y, rối loạn ti&ecirc;u h&oacute;a, đại tiện ra m&aacute;u, thanh nhiệt v&agrave; đẩy l&ugrave;i bệnh trĩ hiệu quả.</li>\r\n	<li>Ti&ecirc;u đờm ở trẻ nhỏ v&agrave; người lớn tuổi nhanh ch&oacute;ng.</li>\r\n	<li>Gi&uacute;p giảm đau v&agrave; l&agrave;m tan m&aacute;u bầm tr&ecirc;n cơ thể hiệu quả.&nbsp;</li>\r\n</ul>\r\n\r\n<p><img alt=\"Loại sò này là một vị thuốc trong Đông y có tên gọi là Mao Khảm và mang đến rất nhiều công dụng cho sức khỏe\" src=\"https://haisantrungnam.vn/wp-content/uploads/2020/03/so-long-3.jpg\" style=\"height:700px; width:700px\" /></p>\r\n\r\n<p>Loại s&ograve; n&agrave;y l&agrave; một vị thuốc trong Đ&ocirc;ng y c&oacute; t&ecirc;n gọi l&agrave; Mao Khảm v&agrave; mang đến rất nhiều c&ocirc;ng dụng cho sức khỏe</p>\r\n\r\n<h2><strong>Kh&aacute;m ph&aacute; những m&oacute;n ăn ngon từ s&ograve; l&ocirc;ng</strong></h2>\r\n\r\n<p>Sau đ&acirc;y l&agrave; một số m&oacute;n ngon, dễ chế biến từ s&ograve; l&ocirc;ng m&agrave; bạn c&oacute; thể tham khảo v&agrave; thực hiện ngay tại nh&agrave;:</p>\r\n\r\n<h3><strong><em>S&ograve; l&ocirc;ng nướng mỡ h&agrave;nh</em></strong></h3>\r\n\r\n<p>Nguy&ecirc;n liệu:</p>\r\n\r\n<ul>\r\n	<li>S&ograve; l&ocirc;ng tươi: 2,5 kg</li>\r\n	<li>Rau răm: 1 b&oacute;&nbsp;</li>\r\n	<li>H&agrave;nh l&aacute;: 200g</li>\r\n	<li>Lạc rang: 400g</li>\r\n	<li>H&agrave;nh t&iacute;m, tỏi kh&ocirc;: 2 củ</li>\r\n	<li>Ớt tươi: 7 quả</li>\r\n	<li>Chanh: 1 quả</li>\r\n	<li>Gia vị: Mắm, muối, ti&ecirc;u, m&igrave; ch&iacute;nh, đường, dầu ăn,&hellip;</li>\r\n</ul>\r\n\r\n<p>C&aacute;ch l&agrave;m:</p>\r\n\r\n<ul>\r\n	<li>Bước 1: S&ograve; rửa sạch ng&acirc;m c&ugrave;ng nước muối lo&atilde;ng khoảng 1 tiếng. Sau đ&oacute; vớt ra để r&aacute;o v&agrave; trụng qua nước nước s&ocirc;i. T&aacute;ch bỏ 1 phần vỏ kh&ocirc;ng d&iacute;nh thịt s&ograve;</li>\r\n	<li>Bước 2: H&agrave;nh l&aacute;, nhạt rửa sạch v&agrave; th&aacute;i nhỏ. Rau răm nhặt, rửa sạch v&agrave; để r&aacute;o nước. Lạc rang gi&atilde; nhỏ. Ớt rửa sạch, th&aacute;i l&aacute;t. Chanh vắt lấy nước cốt, bỏ hạt.</li>\r\n	<li>Bước 3: Phi thơm h&agrave;nh, tỏi băm c&ugrave;ng dầu ăn v&agrave; cho h&agrave;nh l&aacute; c&ugrave;ng một ch&uacute;t nước mắm v&agrave;o đảo đều v&agrave; tắt bếp.&nbsp;</li>\r\n	<li>Bước 4: Xếp s&ograve; l&ecirc;n vỉ nướng, rưới nước mỡ h&agrave;nh, lạc v&agrave;o từng con s&ograve; v&agrave; đặt vỉ l&ecirc;n bếp than nướng trong khoảng 15 &ndash; 20 ph&uacute;t.&nbsp;</li>\r\n	<li>Bước 5: S&ograve; ch&iacute;n xếp ra đĩa ăn k&egrave;m với nước chấm chanh, tỏi, ớt chua ngọt v&agrave; rau răm.</li>\r\n</ul>\r\n\r\n<p><img alt=\"Hương vị thơm ngon khó cưỡng của món sò nướng mỡ hành\" src=\"https://haisantrungnam.vn/wp-content/uploads/2020/03/so-long-4.jpg\" style=\"height:442px; width:700px\" /></p>\r\n\r\n<p>Hương vị thơm ngon kh&oacute; cưỡng của m&oacute;n s&ograve; nướng mỡ h&agrave;nh</p>\r\n\r\n<h3><strong><em>S&ograve; x&agrave;o gi&aacute; hẹ</em></strong></h3>\r\n\r\n<p>Nguy&ecirc;n liệu:</p>\r\n\r\n<ul>\r\n	<li>S&ograve; tươi: 500g</li>\r\n	<li>Gi&aacute;, rau hẹ: 300g</li>\r\n	<li>Rau thơm: H&agrave;nh l&aacute;, ng&ograve;</li>\r\n	<li>Ớt hiểm: 1 quả</li>\r\n	<li>Gia vị: nước mắm, bột n&ecirc;m, bột ngọt, đường, ti&ecirc;u, dầu ăn&hellip;.</li>\r\n</ul>\r\n\r\n<p>C&aacute;ch l&agrave;m:&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Bước 1:&nbsp; S&ograve; rửa sạch ng&acirc;m c&ugrave;ng nước muối lo&atilde;ng khoảng 1 tiếng. Sau đ&oacute; vớt ra để r&aacute;o v&agrave; trụng qua nước nước s&ocirc;i v&agrave; t&aacute;ch thấy ruột. H&agrave;nh l&aacute;, ng&ograve; nhặt rửa sạch, th&aacute;i nhỏ v&agrave; để ri&ecirc;ng. Gi&aacute;, hẹ rửa sạch để r&aacute;o nước. Ớt rửa sạch, cắt l&aacute;t.</li>\r\n	<li>Bước 2: Ướp s&ograve; c&ugrave;ng với bột canh, m&igrave;, ch&iacute;nh, hạt n&ecirc;m, h&agrave;nh l&aacute;, ớt khoảng 15 &ndash; 20 ph&uacute;t cho ngấm đều gia vị.&nbsp;</li>\r\n	<li>Bước 3: Đặt chảo l&ecirc;n bếp, chảo n&oacute;ng cho dầu ăn v&agrave;o, dầu s&ocirc;i th&igrave; cho s&ograve; v&agrave;o đảo đều tay đến khi ch&iacute;n.</li>\r\n	<li>Bước 4: Tiếp tục cho gi&aacute;, hẹ v&agrave;o đảo c&ugrave;ng với thịt s&ograve; khoảng 2 ph&uacute;t.</li>\r\n	<li>Bước 5: N&ecirc;m nếm lại gia vị cho vừa ăn, tắt bếp cho ng&ograve; v&agrave; rắc ti&ecirc;u v&agrave;o trộn đều, d&ugrave;ng n&oacute;ng với cơm.&nbsp;</li>\r\n</ul>\r\n\r\n<h2><strong>Lời kết</strong></h2>\r\n\r\n<p><strong>S&ograve; l&ocirc;ng</strong>&nbsp;kh&ocirc;ng chỉ l&agrave; loại hải sản thơm ngon, gi&agrave;u dinh dưỡng m&agrave; c&ograve;n rất dễ chế biến, ph&ugrave; hợp với mọi đối tượng sử dụng. Ch&iacute;nh v&igrave; vậy, đ&acirc;y được xem l&agrave; nguồn thực phẩm n&ecirc;n thường xuy&ecirc;n v&agrave;o khẩu phần ăn của mỗi người. Tuy nhi&ecirc;n, để đảm bảo sức khỏe th&igrave; bạn n&ecirc;n lựa chọn những cơ sở uy t&iacute;n để mua những con h&agrave;u tươi ngon, được đ&aacute;nh bắt tự nhi&ecirc;n. Nếu c&ograve;n g&igrave; thắc mắc, bạn h&atilde;y li&ecirc;n hệ với&nbsp;<a href=\"https://haisantrungnam.vn/\" target=\"_blank\"><strong>Hải Sản Trung Nam</strong></a>&nbsp;theo địa chỉ sau đ&acirc;y để được hỗ trợ nhanh nhất nh&eacute;!</p>', 'so-long.jpg', 0, 500, 0, '1', 'Nhập khẩu trực tiếp từ đảo Phú Quốc, chế biến quy trình chuẩn hải sản', '2022-03-25', '2022-03-25'),
(29, 'Tôm hùm', 'Đảo Bạch Long Vĩ, VN', '400000', '2022-07-09', 6, '<p>Tại thị trường H&agrave; Nội, nh&agrave; h&agrave;ng Hải Sản Baba được biết đến l&agrave; địa chỉ chuy&ecirc;n cung cấp c&aacute;c mặt h&agrave;ng hải sản tươi ngon, gi&aacute; hấp dẫn. Xuất hiện tr&ecirc;n thị trường lần đầu ti&ecirc;n v&agrave;o những năm 80 của thế kỷ XX; nh&agrave; h&agrave;ng đ&atilde; dần tạo được uy t&iacute;n vững chắc từ những d&ograve;ng hải sản chất lượng m&agrave; m&igrave;nh cung cấp.</p>\r\n\r\n<p>Kh&ocirc;ng chỉ l&agrave;&nbsp;<strong>địa chỉ b&aacute;n t&ocirc;m h&ugrave;m gi&aacute; rẻ&nbsp;</strong>chuy&ecirc;n bỏ mối cho c&aacute;c chợ đầu mối tại thị trường H&agrave; Nội; nh&agrave; h&agrave;ng c&ograve;n hỗ trợ chế biến t&ocirc;m h&ugrave;m với những c&ocirc;ng thức hấp dẫn; đ&aacute;p ứng mọi y&ecirc;u cầu về gi&aacute; trị dinh dưỡng, chất lượng hương vị v&agrave; t&iacute;nh thẩm mỹ cao.</p>\r\n\r\n<p><strong>TH&Ocirc;NG TIN LI&Ecirc;N HỆ:</strong></p>\r\n\r\n<p>Địa chỉ: Tại số 32 Đại Từ, Ho&agrave;ng Mai, Tp. H&agrave; Nội.</p>\r\n\r\n<p>Website:&nbsp;<a href=\"https://haisanbaba.com/\">https://haisanbaba.com/</a></p>\r\n\r\n<p>Email:&nbsp;<a href=\"mailto:panxin2007pt@gmail.com\">panxin2007pt@gmail.com</a></p>\r\n\r\n<h2><strong>Cửa h&agrave;ng S&oacute;i Biển</strong></h2>\r\n\r\n<p>S&oacute;i Biển đ&atilde; c&oacute; th&acirc;m ni&ecirc;n 8 năm tr&ecirc;n thị trường cung cấp hải sản tại thị trường H&agrave; Nội. Đ&acirc;y l&agrave; địa chỉ chuy&ecirc;n cung cấp hải sản tươi sống nổi tiếng. Trong đ&oacute; c&oacute; t&ocirc;m h&ugrave;m. Tất cả đều được đ&aacute;nh bắt từ v&ugrave;ng huyện đảo L&yacute; Sơn- V&ugrave;ng biển nổi tiếng với rất nhiều lo&agrave;i hải sản qu&yacute; hiếm.</p>\r\n\r\n<p><img alt=\"\" src=\"https://haisanbaba.com/wp-content/uploads/Top-10-dia-chi-tom-hum-uy-tin-gia-re-3.jpg\" style=\"height:720px; width:720px\" /></p>\r\n\r\n<p>Dịch vụ lu&ocirc;n cam kết mang đến cho kh&aacute;ch h&agrave;ng đa dạng c&aacute;c loại t&ocirc;m h&ugrave;m, từ loại cao cấp như Alaska cho đến t&ocirc;m h&ugrave;m xanh, t&ocirc;m h&ugrave;m đất&hellip;Tất cả được b&aacute;n với gi&aacute; rẻ, đảm bảo tươi ngon, gi&aacute; trị dinh dưỡng vượt trội.</p>\r\n\r\n<p><strong>TH&Ocirc;NG TIN LI&Ecirc;N HỆ</strong></p>\r\n\r\n<ul>\r\n	<li>Địa chỉ 1: 116 E3 Th&aacute;i Thịnh, Thịnh Quang, Đống Đa, H&agrave; Nội</li>\r\n	<li>Địa chỉ 2: 13B Phan Huy Ch&uacute;, Ho&agrave;n Kiếm</li>\r\n	<li>Địa chi 3: 145 Nguyễn Tu&acirc;n, Thanh Xu&acirc;n</li>\r\n	<li>Website: https://soibien.vn/site/store</li>\r\n</ul>\r\n\r\n<h2><strong>Si&ecirc;u thị hải sản Huyền Chiến</strong></h2>\r\n\r\n<p>Chọn mua t&ocirc;m h&ugrave;m tại si&ecirc;u thị hải sản Huyền Chiến lu&ocirc;n khiến kh&aacute;ch h&agrave;ng h&agrave;i l&ograve;ng với những g&igrave; m&igrave;nh lựa chọn. Kh&ocirc;ng chỉ đảm bảo chất lượng m&agrave; t&ocirc;m h&ugrave;m được cung cấp ở đ&acirc;y cũng c&oacute; gi&aacute; b&aacute;n rất &ldquo;mềm&rdquo;. Bởi tất cả đều được nhập trực tiếp từ thuyền đ&aacute;nh bắt, kh&ocirc;ng qua trung gian. Đ&acirc;y hiện được xem l&agrave; 1 trong những điểm cung cấp t&ocirc;m h&ugrave;m n&oacute;i ri&ecirc;ng v&agrave; hải sản n&oacute;i chung nổi tiếng tại thị trường H&agrave; Nội.</p>\r\n\r\n<p><strong>TH&Ocirc;NG TIN LI&Ecirc;N HỆ</strong></p>\r\n\r\n<p>Địa chỉ:&nbsp;Số 2 Cầu Đất, Chương Dương Độ, Ho&agrave;n Kiếm, H&agrave; Nội</p>\r\n\r\n<p>ĐT:&nbsp;0985 694 330</p>\r\n\r\n<p>Facebook:&nbsp;https://www.facebook.com/haisanhuyenchien/</p>\r\n\r\n<p>Email:&nbsp;haisanhuyenchien@gmail.com</p>\r\n\r\n<h2><strong>Chợ hải sản Hải Ph&ograve;ng</strong></h2>\r\n\r\n<p>Nếu c&oacute; nhu cầu mua t&ocirc;m h&ugrave;m tại Hải Ph&ograve;ng th&igrave; bạn c&oacute; thể t&igrave;m đến Chợ hải sản Hải Ph&ograve;ng. Ở đ&acirc;y chuy&ecirc;n cung cấp đa dạng c&aacute;c loại t&ocirc;m h&ugrave;m tươi sống như: t&ocirc;m h&ugrave;m b&ocirc;ng, t&ocirc;m h&ugrave;m xanh, t&ocirc;m h&ugrave;m Alaska&hellip;Kh&ocirc;ng chỉ l&agrave; nh&agrave; cung cấp t&ocirc;m h&ugrave;m h&agrave;ng đầu tại thị trường Hải Ph&ograve;ng, đ&acirc;y c&ograve;n l&agrave; địa chỉ ph&acirc;n phối hải sản, t&ocirc;m h&ugrave;m đến nhiều tỉnh th&agrave;nh tr&ecirc;n cả nước. Với mức gi&aacute; ưu đ&atilde;i, dịch vụ lu&ocirc;n khiến kh&aacute;ch h&agrave;ng h&agrave;i l&ograve;ng khi trải nghiệm.</p>\r\n\r\n<p><strong>TH&Ocirc;NG TIN LI&Ecirc;N HỆ</strong></p>\r\n\r\n<p>Điện Thoại:&nbsp;0868.719.222</p>\r\n\r\n<p>Email: haisanhp.com@gmail.com</p>\r\n\r\n<p>Website: www.haisanhp.com</p>\r\n\r\n<h2><strong>Hải sản Biển Xanh</strong></h2>\r\n\r\n<p>C&oacute; một địa chỉ chuy&ecirc;n cung cấp hải sản nổi tiếng tại Nha Trang. Đ&oacute; ch&iacute;nh l&agrave; nh&agrave; h&agrave;ng Hải Sản Biển Xanh. Ở đ&acirc;y, kh&aacute;ch h&agrave;ng c&oacute; thể lựa chọn đa dạng c&aacute;c lo&agrave;i hải sản chất lượng tươi sống. Tất nhi&ecirc;n, t&ocirc;m h&ugrave;m cũng l&agrave; lựa chọn kh&ocirc;ng ngoại lệ. Tất cả t&ocirc;m h&ugrave;m được cung cấp đều đang tươi sống, đ&aacute;nh bắt trực tiếp tại biển Nha Trang. D&ugrave; l&agrave; về hương vị, phong c&aacute;ch chế biến hay gi&aacute; cả, Hải Sản Biển Xanh vẫn c&oacute; khả năng &ldquo;ghi điểm&rdquo; rất cao trong mắt kh&aacute;ch h&agrave;ng.</p>\r\n\r\n<p><img alt=\"Top-10+-dia-chi-tom-hum-uy-tin-gia-re\" src=\"https://haisanbaba.com/wp-content/uploads/Top-10-dia-chi-tom-hum-uy-tin-gia-re-1.jpg\" style=\"height:410px; width:660px\" /></p>\r\n\r\n<p><strong>TH&Ocirc;NG TIN LI&Ecirc;N HỆ</strong></p>\r\n\r\n<ul>\r\n	<li>Địa chỉ:&nbsp;30 đại lộ Nguyễn Tất Thành, Nha Trang, Khánh Hoà</li>\r\n	<li>Điện thoại:&nbsp;033 979 7986.</li>\r\n</ul>\r\n\r\n<h2><strong>Hải Sản L&agrave;ng T&ocirc;m</strong></h2>\r\n\r\n<p>Khi cần mua t&ocirc;m h&ugrave;m tại thị trường Nha Trang; bạn c&oacute; thể t&igrave;m đến Hải Sản L&agrave;ng T&ocirc;m. Ở đ&acirc;y được mệnh danh l&agrave; &ldquo;thi&ecirc;n đường hải sản&rdquo; tại Nha Trang. Mọi y&ecirc;u cầu t&igrave;m mua t&ocirc;m h&ugrave;m từ tươi sống đến chế biến sẵn đều được đ&aacute;p ứng đầy đủ. Ngo&agrave;i ra, gi&aacute; cả ở đ&acirc;y cũng rất ưu đ&atilde;i, kh&ocirc;ng c&oacute; t&igrave;nh trạng &ldquo;chặt ch&eacute;m&rdquo;.</p>\r\n\r\n<p><strong>TH&Ocirc;NG TIN LI&Ecirc;N HỆ</strong></p>\r\n\r\n<ul>\r\n	<li>Địa chỉ: 12A Phạm Văn Đồng &ndash; TP Nha Trang</li>\r\n	<li>ĐIỆN THOẠI : 093 581 08 08</li>\r\n	<li>EMAIL : INFO@LANGTOM.VN</li>\r\n</ul>', 'tom-hum.jpg', 0, 600, 0, '1', 'Tươi sạch được nhập khẩu từ biển về trực tiếp tại kho', '2022-03-25', '2022-03-25');
INSERT INTO `product` (`id`, `name`, `origin`, `price`, `exp`, `category_id`, `description`, `image`, `view`, `count`, `count_sold`, `status`, `note`, `created_at`, `updated_at`) VALUES
(30, 'Trấu sấy', 'Ấn Độ', '150000', '2022-04-10', 5, '<p>Việt Nam l&agrave; điểm đến h&agrave;ng đầu của thịt tr&acirc;u Ấn Độ trong nhiều năm v&agrave; gi&uacute;p nước n&agrave;y trở th&agrave;nh nh&agrave; xuất khẩu thịt tr&acirc;u h&agrave;ng đầu thế giới. Tuy nhi&ecirc;n, cũng ch&iacute;nh việc Việt Nam giảm nhập khẩu đang khiến Ấn Độ mất dần vị tr&iacute; n&agrave;y.</p>\r\n\r\n<p>Mấy năm trước, khi nhu cầu từ Việt Nam v&agrave; c&aacute;c nước kh&aacute;c ở Đ&ocirc;ng Nam &Aacute;, T&acirc;y &Aacute; v&agrave; Ch&acirc;u Phi tăng l&ecirc;n, xuất khẩu thịt tr&acirc;u của Ấn Độ đ&atilde; li&ecirc;n tiếp tăng ở mức hai con số v&agrave; đạt đỉnh 1,47 triệu tấn trong năm 2014/15, gấp hơn 2 lần so với năm 2010/11.</p>\r\n\r\n<p>Tuy nhi&ecirc;n, kể từ đ&oacute; xuất khẩu sụt giảm do những cuộc biểu t&igrave;nh trong nước để bảo vệ gia s&uacute;c diễn ra ng&agrave;y c&agrave;ng gay gắt. Sau khi giảm xuống 1,31 triệu tấn trong năm 2015/16, xuất khẩu thịt tr&acirc;u Ấn Độ gần như kh&ocirc;ng thay đổi trong 2 năm tiếp theo, nhưng bắt đầu giảm tiếp trong giai đoạn 2018/19 do nhập khẩu v&agrave;o Việt Nam bắt đầu sụt giảm.</p>\r\n\r\n<p>Năm 2017/18, thị phần của Việt Nam trong tổng khối lượng thịt tr&acirc;u xuất khẩu của Ấn Độ đ&atilde; tăng l&ecirc;n mức cao nhất trong lịch sử, khi đạt tới 55%, so với chỉ 18% của năm trước đ&oacute;; kim ngạch cũng tăng l&ecirc;n 57%, từ mức 29% trong khoảng thời gian n&agrave;y.</p>\r\n\r\n<p>Hiện tại, Việt Nam chỉ c&ograve;n chiếm khoảng 11% về khối lượng v&agrave; 13% về gi&aacute; trị thịt tr&acirc;u xuất khẩu của Ấn Độ, theo số liệu do Cơ quan Ph&aacute;t triển Xuất khẩu N&ocirc;ng sản v&agrave; Thực phẩm Chế biến Ấn Độ c&ocirc;ng bố.</p>\r\n\r\n<p>Mặc d&ugrave; vậy, sự sụt giảm xuất khẩu sang Việt Nam được b&ugrave; đắp bởi sự gia tăng xuất khẩu sang c&aacute;c thị trường kh&aacute;c, do đ&oacute; đ&atilde; gi&uacute;p cho khối lượng v&agrave; gi&aacute; trị xuất khẩu kh&ocirc;ng sụt giảm qu&aacute; mạnh trong năm 2020/21.</p>\r\n\r\n<p><a href=\"https://cafefcdn.com/203337114487263232/2021/6/28/photo-1-16248668345341720815944.jpg\"><img alt=\"Xuất khẩu thịt trâu của Ấn Độ thấp nhất 9 năm do Việt Nam giảm mua - Ảnh 1.\" src=\"https://cafefcdn.com/203337114487263232/2021/6/28/photo-1-16248668345341720815944.jpg\" /></a></p>\r\n\r\n<p>Thị phần của Việt Nam trong tổng xuất khẩu thịt tr&acirc;u của Ấn Độ</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bộ N&ocirc;ng nghiệp Mỹ (USDA) ước t&iacute;nh thị phần của Ấn Độ trong xuất khẩu thịt tr&acirc;u/b&ograve; thế giới t&iacute;nh theo khối lượng giảm từ 21% trong năm 2014 xuống 12% v&agrave;o năm 2020.</p>\r\n\r\n<p>Sự trỗi dậy của Ấn Độ tr&ecirc;n thị trường xuất khẩu thịt tr&acirc;u/b&ograve; to&agrave;n cầu xuất hiện từ năm 2010, khi thế giới bắt đầu phục hồi sau cuộc khủng hoảng kinh tế v&agrave; t&agrave;i ch&iacute;nh năm 2008 v&agrave; nhu cầu đối với loại thịt tương đối rẻ tăng l&ecirc;n. Năm đ&oacute;, khối lượng thịt tr&acirc;u xuất khẩu từ Ấn Độ đ&atilde; tăng 51% l&ecirc;n 917.000 tấn, theo số liệu của USDA.</p>\r\n\r\n<p>Sau đ&oacute;, Ấn Độ đ&atilde; vượt qua Australia &ndash; nước xuất khẩu thịt tr&acirc;u/b&ograve; lớn thứ 2 thế giới &ndash; v&agrave; 2 vượt xa New Zealand &ndash; nước xuất khẩu lớn thứ 4, v&igrave; xuất khẩu từ 2 quốc gia ở Nam B&aacute;n cầu n&agrave;y năm đ&oacute; hầu như kh&ocirc;ng thay đổi.</p>\r\n\r\n<p>Năm 2012, Ấn Độ đ&atilde; so&aacute;n ng&ocirc;i Australia để trở th&agrave;nh nh&agrave; xuất khẩu thịt tr&acirc;u/b&ograve; lớn thứ hai thế giới, v&agrave; hai năm sau đ&oacute; đ&aacute;nh bật Brazil để chiếm vị tr&iacute; nước xuất khẩu số 1.</p>\r\n\r\n<p><a href=\"https://cafefcdn.com/203337114487263232/2021/6/28/photo-2-16248668350581991453725.jpg\"><img alt=\"Xuất khẩu thịt trâu của Ấn Độ thấp nhất 9 năm do Việt Nam giảm mua - Ảnh 2.\" src=\"https://cafefcdn.com/thumb_w/640/203337114487263232/2021/6/28/photo-2-16248668350581991453725.jpg\" /></a></p>\r\n\r\n<p>Xuất khẩu thịt tr&acirc;u của Ấn Độ</p>\r\n\r\n<p>Mấy năm tiếp theo, c&aacute;c nh&agrave; chức tr&aacute;ch Ấn Độ đ&atilde; &aacute;p đặt những hạn chế đối với việc vận chuyển đại gia s&uacute;c. Số lần những người biểu t&igrave;nh phản đối việc giết mổ tr&acirc;u b&ograve; cũng tăng l&ecirc;n. Đ&uacute;ng l&uacute;c đ&oacute;, tăng trưởng kinh tế to&agrave;n cầu cũng c&oacute; sự điều chỉnh, xuất khẩu thịt tr&acirc;u/b&ograve; tr&ecirc;n thế giới năm 2015 v&agrave; 2016 chậm lại. Tuy nhi&ecirc;n, Ấn Độ tiếp tục l&agrave; nước xuất khẩu thịt tr&acirc;u h&agrave;ng đầu thế giới.</p>\r\n\r\n<p>Kim ngạch xuất khẩu thịt tr&acirc;u của Ấn Độ thậm ch&iacute; c&ograve;n vượt cả xuất khẩu gạo basmati trong giai đoạn 2014/15 đến 2016/17, sau khi Iran giảm mạnh mua gạo thơm của nước n&agrave;y. Thịt tr&acirc;u tiếp tục chiếm thị phần lớn nhất trong tổng kim ngạch xuất khẩu n&ocirc;ng sản suốt 3 năm sau đ&oacute;.</p>\r\n\r\n<p>Nhưng một lần nữa, thứ tự đ&atilde; thay đổi v&agrave;o năm 2017 khi nhu cầu tr&ecirc;n to&agrave;n cầu tăng do kinh tế thế giới tăng trưởng với tốc độ nhanh dần l&ecirc;n. Brazil đ&atilde; phục hồi mạnh mẽ hơn v&agrave; gi&agrave;nh lại vị tr&iacute; h&agrave;ng đầu thế giới về xuất khẩu thịt tr&acirc;u/b&ograve;. Sau khi giảm trong năm 2017, xuất khẩu thịt tr&acirc;u của Ấn Độ tiếp tục trượt dốc trong năm 2018 v&agrave; mất vị tr&iacute; thứ hai v&agrave;o tay Australia.</p>\r\n\r\n<p>Hiện nay, Ấn Độ đang tụt dần xuống vị tr&iacute; nước xuất khẩu thịt tr&acirc;u/b&ograve; lớn thứ ba thế giới.</p>', 'say-kho.webp', 0, 360, 0, '1', 'Chuẩn ISO 9000', '2022-03-25', '2022-03-25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reply_comment`
--

CREATE TABLE `reply_comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_parent_comment` int(11) NOT NULL,
  `time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reply_comment`
--

INSERT INTO `reply_comment` (`id`, `content`, `user_id`, `id_parent_comment`, `time`) VALUES
(1, 'ok ban ei', 0, 11, '2022-03-20 04:36:55'),
(2, 'comment gi vay', 0, 10, '2022-03-20 04:36:55'),
(3, '100 người yêu được ko?', 0, 11, '2022-03-20 04:36:55'),
(4, 'ko thích', 0, 8, '2022-03-20 04:49:52'),
(8, 'ăn được ko mà ngon', 0, 3, '2022-03-20 05:52:35'),
(9, 'hihi ngon thì ăn đi', 0, 3, '2022-03-20 05:54:37'),
(23, 'uống rươu rất có hại cho sức khỏe', 4, 12, '2022-03-20 07:08:17'),
(24, 'nhưng mà ghiền rồi thì ko bỏ được', 4, 12, '2022-03-20 07:08:34'),
(25, 'Bạn chưa đủ tuổi', 0, 13, '2022-03-21 09:45:35'),
(27, 'sorry nha', 0, 20, '2022-03-24 13:14:13'),
(31, 'ok chưa men', 0, 19, '2022-03-24 13:31:15'),
(32, 'comment cai nữa nào', 0, 19, '2022-03-24 13:31:23'),
(33, 'xin lỗi ban hòa', 0, 13, '2022-03-24 13:31:45'),
(47, 'Phải giàu mới yêu em ấy được nhé bạn', 1, 21, '2022-03-26 00:31:56'),
(48, 'Shop không bán bia bạn ạ', 0, 24, '2022-03-30 00:12:00'),
(49, 'đùa đấy các bạn', 0, 26, '2023-08-16 14:02:15'),
(50, 'Thiệt ko dị bạn?', 0, 16, '2023-08-16 14:47:16'),
(52, 'ok để mua ăn thử xem sao.', 7, 28, '2023-08-17 18:32:20'),
(54, 'Cảm ơn bạn!', 0, 29, '2023-08-17 23:13:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'author'),
(3, 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `notes` text DEFAULT NULL,
  `pay_method` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `email`, `phone`, `address`, `notes`, `pay_method`, `created_at`) VALUES
(1, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0335947793', 'xóm Mỹ Thành, Yên Thành, Nghệ An.', 'Giao vào buổi trưa nhé bayby của em.', 'cash', '2022-03-08 00:00:00'),
(2, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0335947793', 'xóm Mỹ Thành, Yên Thành, Nghệ An.', 'Giao vào buổi trưa nhé bayby của em.', 'cash', '2022-03-08 00:00:00'),
(3, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0394853875', '20/12 Lê Văn Chí', 'ok', 'cash', '2022-03-08 18:03:51'),
(4, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'csdc', 'csdcscscds', 'cash', '2022-03-09 02:30:41'),
(5, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cscsc', 'cdssd', 'atm', '2022-03-09 15:13:00'),
(6, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', 'ok baby', 'atm', '2022-03-09 15:37:40'),
(7, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', 'll', 'momo', '2022-03-09 15:38:14'),
(8, 'lê hữu vinh', 'yeuthethao37@gmail.com', '0163 594 4671', 'quang sơn ,đô lương ,nghệ an', 'dddcd', 'atm', '2022-03-09 15:58:15'),
(9, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0394853875', '20/12 Lê Văn Chí', 'Giao nhanh nha đang cần gấp', 'cash', '2022-03-13 16:23:21'),
(10, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', 'Đặt chơi chơi vậy đó', 'atm', '2022-03-14 01:41:39'),
(11, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 đường 3/2 phường 8 quận 10', 'Đặt  để test thôi chứ tiền đâu mua', 'atm', '2022-03-14 01:47:40'),
(12, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 đường 3/2 phường 8 quận 10', 'Giao lẹ không là anh bom hàng đấy', 'atm', '2022-03-14 01:50:04'),
(13, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 đường 3/2 phường 8 quận 10', 'Giao lẹ không là anh bom hàng đấy', 'atm', '2022-03-14 02:11:55'),
(14, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', '33', 'atm', '2022-03-14 02:12:46'),
(15, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', '22/12 đường Lê Văn Chí, Phường Linh Trung, quận Thủ Đức', 'Giao vào buổi tối nhé mấy cưng', 'atm', '2022-03-14 23:38:16'),
(16, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'ok', 'ok', 'atm', '2022-03-15 01:33:15'),
(17, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'dscsc', 'cscd', 'atm', '2022-03-15 01:48:06'),
(18, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vdv', 'vdvd', 'atm', '2022-03-15 01:50:37'),
(19, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'csd', 'csdc', 'atm', '2022-03-15 01:53:13'),
(20, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'xas', 'xsx', 'atm', '2022-03-15 01:53:57'),
(21, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'fd', 'vdv', 'atm', '2022-03-15 01:59:44'),
(22, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'csc', 'cdcd', 'atm', '2022-03-15 02:01:23'),
(23, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 02:02:52'),
(24, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cdsc', 'cscd', 'atm', '2022-03-15 02:03:24'),
(25, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cdc', 'dcd', 'atm', '2022-03-15 02:09:02'),
(26, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 02:15:26'),
(27, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'ho chi minh', 'ok', 'atm', '2022-03-15 02:21:36'),
(28, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 02:22:31'),
(29, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cdc', 'dcd', 'atm', '2022-03-15 02:23:57'),
(30, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 02:26:02'),
(31, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 02:26:41'),
(32, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 02:27:17'),
(33, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'scs', 'cs', 'atm', '2022-03-15 14:26:16'),
(34, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cdc', 'atm', '2022-03-15 21:33:37'),
(35, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cds', 'csd', 'atm', '2022-03-15 21:41:40'),
(36, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cs', 'csd', 'atm', '2022-03-15 22:40:47'),
(37, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cs', 'cs', 'atm', '2022-03-15 22:42:38'),
(38, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vd', 'vdvd', 'atm', '2022-03-15 22:44:46'),
(39, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'gt', 't', 'atm', '2022-03-15 22:47:36'),
(40, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'csd', 'csc', 'atm', '2022-03-15 22:53:41'),
(41, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'csc', 'cscdsd', 'atm', '2022-03-15 22:54:36'),
(42, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vv', 'vv', 'atm', '2022-03-15 22:56:09'),
(43, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vv', 'bf', 'atm', '2022-03-15 22:57:14'),
(44, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vdv', 'vdv', 'atm', '2022-03-15 22:57:47'),
(45, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cs', 'csc', 'atm', '2022-03-15 23:05:50'),
(46, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vvd', 'vdvd', 'atm', '2022-03-15 23:06:58'),
(47, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vsdv', 'vsvs', 'atm', '2022-03-15 23:08:00'),
(48, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vdv', 'vdvd', 'atm', '2022-03-15 23:08:24'),
(49, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vdv', 'vd', 'atm', '2022-03-15 23:10:04'),
(50, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'fe', 'efe', 'atm', '2022-03-15 23:13:38'),
(51, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'ho chi minh', 'Giao nhanh em pho nha', 'atm', '2022-03-15 23:17:15'),
(52, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cdsc', 'cscs', 'atm', '2022-03-15 23:24:52'),
(53, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cs', 'cscds', 'atm', '2022-03-15 23:30:31'),
(54, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 23:32:20'),
(55, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'gr', 'grg', 'atm', '2022-03-15 23:44:09'),
(56, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'dư', 'dư', 'atm', '2022-03-15 23:46:31'),
(57, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vf', 'vf', 'atm', '2022-03-15 23:48:03'),
(58, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cd', 'atm', '2022-03-15 23:51:58'),
(59, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cd', 'cdc', 'atm', '2022-03-15 23:53:27'),
(60, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', '3', '3', 'atm', '2022-03-16 00:00:36'),
(61, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'vdv', 'vđ', 'atm', '2022-03-16 00:03:27'),
(62, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cscsc', 'cscsc', 'atm', '2022-03-16 00:06:38'),
(63, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', '123', '123', 'atm', '2022-03-16 00:09:37'),
(64, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cs', 'cs', 'atm', '2022-03-16 00:17:46'),
(65, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', '156', '22', 'atm', '2022-03-16 00:18:26'),
(66, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', '123', '33', 'atm', '2022-03-16 00:19:34'),
(67, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'sdc', 'csc', 'atm', '2022-03-16 00:19:57'),
(68, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cds', 'cscd', 'atm', '2022-03-16 00:22:15'),
(69, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'cs', 'csc', 'atm', '2022-03-16 00:25:12'),
(70, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', '23', '12', 'atm', '2022-03-16 00:34:13'),
(71, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'vvd', 'dvđ', 'atm', '2022-03-16 00:38:26'),
(72, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'vd', 'vdvd', 'atm', '2022-03-16 00:38:59'),
(73, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'cs', 'csds', 'atm', '2022-03-16 00:40:23'),
(74, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'xsx', 'xs', 'atm', '2022-03-16 00:42:26'),
(75, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'ho chi minh', 'nhan nha', 'atm', '2022-03-16 00:47:24'),
(76, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'dv', 'bsvs', 'atm', '2022-03-16 00:48:27'),
(77, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'xsx', 'sxs', 'atm', '2022-03-16 00:53:18'),
(78, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'cdcd', 'dd', 'atm', '2022-03-16 00:54:39'),
(79, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'Đại học quốc gia thành phố Hồ Chí Minh, Linh Trung, Thủ Đức', 'Giao vào buổi chiều nha', 'atm', '2022-03-16 02:05:08'),
(80, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'tht', 'httt', 'atm', '2022-03-16 02:24:19'),
(81, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'vv', 'v v v', 'atm', '2022-03-16 02:26:47'),
(82, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'vd', 'dvd', 'atm', '2022-03-16 02:29:54'),
(83, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'csc', 'scsc', 'atm', '2022-03-16 02:31:09'),
(84, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'csc', NULL, 'vnpay', '2022-03-16 16:15:27'),
(85, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'cdc', NULL, 'vnpay', '2022-03-16 16:39:43'),
(86, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'Đại học quốc gia Hồ Chí Minh, phường Linh trung, quận Thủ đức, thành phố Hồ Chí Minh.', 'Giao giúp tôi vào buổi chiều tối nhé.', 'cash', '2022-03-16 21:39:43'),
(87, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'ho chi minh city', 'ok bay by', 'cash', '2022-03-16 23:42:09'),
(88, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'ho chi minh', NULL, 'cash', '2022-03-17 16:02:27'),
(89, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'ho chi minh', NULL, 'cash', '2022-03-21 14:47:25'),
(90, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'cdc', NULL, 'atm', '2022-03-21 14:47:46'),
(91, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'cd', NULL, 'cash', '2022-03-21 14:48:47'),
(92, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', '123', NULL, 'cash', '2022-03-21 14:50:32'),
(93, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'cdcd', NULL, 'atm', '2022-03-21 14:51:23'),
(94, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'cdcd', NULL, 'cash', '2022-03-21 14:51:50'),
(95, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', '123', NULL, 'cash', '2022-03-23 23:00:56'),
(96, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'ho chi minh city', NULL, 'cash', '2022-03-26 15:47:47'),
(97, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'kkk', NULL, 'cash', '2022-03-26 15:49:32'),
(98, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'cd', NULL, 'cash', '2022-03-26 15:50:03'),
(99, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'cd', NULL, 'atm', '2022-03-26 15:52:30'),
(100, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'ggg', NULL, 'atm', '2022-03-26 15:52:53'),
(101, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'jjj', NULL, 'cash', '2022-03-26 15:54:45'),
(102, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'fff', NULL, 'atm', '2022-03-27 00:51:42'),
(103, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'csc', NULL, 'cash', '2022-03-27 00:52:12'),
(104, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'iii', NULL, 'atm', '2022-03-28 21:15:24'),
(105, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0335944671', 'cd', NULL, 'cash', '2022-03-28 21:17:39'),
(106, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'vd', NULL, 'atm', '2022-03-28 22:05:14'),
(107, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', '123', NULL, 'atm', '2022-03-28 22:24:10'),
(108, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0398855263', '123', NULL, 'atm', '2022-03-28 22:25:55'),
(109, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0398855263', '52 Nguyễn Hữu Cảnh, Dĩ An, Bình Dương', 'Giao vào buổi trưa cho tôi nhé!', 'atm', '2022-03-29 00:35:26'),
(110, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'vf', NULL, 'atm', '2022-03-29 00:38:39'),
(111, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'd', NULL, 'atm', '2022-03-29 00:41:56'),
(112, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'cd', NULL, 'atm', '2022-03-29 00:50:33'),
(113, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'c', NULL, 'cash', '2022-03-29 00:51:55'),
(114, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'd', NULL, 'atm', '2022-03-29 00:52:57'),
(115, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'è', 'ok con dê', 'atm', '2022-03-29 00:53:55'),
(116, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0398855263', 'ok ca em', 'im lặng', 'cash', '2022-03-29 01:00:42'),
(117, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', 'cd', 'cdc', 'atm', '2022-03-29 01:01:07'),
(118, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', '123', NULL, 'atm', '2022-03-29 01:03:24'),
(119, 'Vinh Lê Hữu', '1614117@hcmut.edu.vn', '0977486693', '123', NULL, 'atm', '2022-03-29 01:06:57'),
(120, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'linh trung, thu duc, ho chi minh', 'Giao vao buoi trua nha, thanks you!', 'atm', '2022-04-02 23:37:29'),
(121, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'fvfv', 'dd', 'cash', '2022-04-02 23:38:54'),
(122, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', '22', NULL, 'atm', '2022-04-03 15:18:59'),
(123, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', '12 district', 'giao vào buổi tối nhé', 'cash', '2023-08-16 13:18:18'),
(124, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '0977486693', 'Trần Hưng Đạo, quận 1, Hồ Chí Minh', 'giao càng nhanh càng tốt', 'atm', '2023-08-16 14:08:18'),
(125, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0335947793', 'Thành phố Vinh, tỉnh Nghệ An', NULL, 'atm', '2023-08-16 16:10:22'),
(126, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', '12 district', NULL, 'cash', '2023-08-17 14:41:13'),
(127, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', '12 district', NULL, 'cash', '2023-08-17 15:46:47'),
(128, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', 'Dĩ An, Bình Dương, Việt Nam', 'Giao lẹ đi đói lắm rồi!!', 'atm', '2023-08-17 16:05:24'),
(129, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', 'Trần Hưng Đạo, quận 1, Hồ Chí Minh', NULL, 'atm', '2023-08-17 16:30:05'),
(130, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', 'Dĩ An, Bình Dương, Việt Nam', NULL, 'cash', '2023-08-17 16:44:18'),
(131, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', '12 district', NULL, 'cash', '2023-08-17 16:46:20'),
(132, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', 'Trần Hưng Đạo, quận 1, Hồ Chí Minh', NULL, 'cash', '2023-08-17 16:48:12'),
(133, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', 'Trần Hưng Đạo, quận 1, Hồ Chí Minh', NULL, 'cash', '2023-08-17 17:01:31'),
(134, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', 'Trần Hưng Đạo, quận 1, Hồ Chí Minh', NULL, 'cash', '2023-08-17 18:18:44'),
(135, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0587256339', 'Trần Hưng Đạo, quận 1, Hồ Chí Minh', NULL, 'cash', '2023-08-17 23:47:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `provider_user_id` text NOT NULL,
  `provider` varchar(50) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `social`
--

INSERT INTO `social` (`id`, `provider_user_id`, `provider`, `login_id`) VALUES
(1, '116885702528188533708', 'GOOGLE', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'batman.jpg',
  `ip_address` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `avatar`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', 'hoayeulinh', '0394853875', 'nguyen-cong-hoa.jpg', '', '2022-03-08 15:26:23', '2022-03-21 02:42:29'),
(3, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '123123', '0587256339', 'girl-xinh-600x600.jpg', '', '2022-03-08 15:27:08', '2023-08-16 14:27:16'),
(4, 'Lê Hữu Vinh', 'vinhphac2@gmail.com', '123123', '0977486693', 'anh-dep-cau-thu-cristiano-ronaldo_110905337.jpg', '', '2022-03-16 00:24:50', '2023-08-16 15:33:06'),
(7, 'Le Thi Kim Suong', 'suong37@gmail.com', 'suong1', '0977526339', 'imager_5338.jpg', '::1', '2023-08-17 17:56:51', '2023-08-17 11:33:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visitors`
--

CREATE TABLE `visitors` (
  `ip_address` text NOT NULL,
  `date_visitor` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `visitors`
--

INSERT INTO `visitors` (`ip_address`, `date_visitor`) VALUES
('::1', '2023-08-16 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_news`
--
ALTER TABLE `category_news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reply_comment`
--
ALTER TABLE `reply_comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `category_news`
--
ALTER TABLE `category_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `reply_comment`
--
ALTER TABLE `reply_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT cho bảng `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
