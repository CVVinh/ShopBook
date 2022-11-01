-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 10:01 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ct275_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` char(5) NOT NULL DEFAULT 'HD0',
  `makh` char(5) NOT NULL DEFAULT 'KH0',
  `ngaylap` date NOT NULL DEFAULT current_timestamp(),
  `giatrihd` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `makh`, `ngaylap`, `giatrihd`) VALUES
('HD001', 'KH001', '2021-11-15', 114000),
('HD002', 'KH001', '2021-11-15', 150000),
('HD004', 'KH001', '2021-11-27', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `makh` char(5) NOT NULL,
  `ho` varchar(30) NOT NULL,
  `ten` varchar(10) NOT NULL,
  `gioitinh` varchar(5) NOT NULL DEFAULT 'Nam',
  `sdt` varchar(11) NOT NULL DEFAULT '0325789589',
  `dchi` varchar(255) NOT NULL DEFAULT 'Số 7, đường 3/2, phường Xuân Khánh, quận Ninh Kiều, TP Cần Thơ',
  `email` varchar(255) DEFAULT 'email123@gmail.com',
  `congviec` varchar(255) DEFAULT 'Tự Do',
  `matkhau` varchar(255) NOT NULL DEFAULT '12345'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makh`, `ho`, `ten`, `gioitinh`, `sdt`, `dchi`, `email`, `congviec`, `matkhau`) VALUES
('KH001', 'Cao Vinh', 'vinhcao', 'Nam', '0326250990', 'KTX B, ĐHCT', 'vinh123@gmail.com', 'Kỹ Sư', '1f32aa4c9a1d2ea010adcf2348166a04'),
('KH002', 'Cao Vien', 'viencao', 'Nam', '0326250990', 'KTX B, ĐHCT', 'vien123@gmail.com', 'Kỹ Sư', '1f32aa4c9a1d2ea010adcf2348166a04'),
('KH003', 'Cao Thi Ngoc Anh', 'anhcao', 'Nữ', '0326250990', 'KTX B, ĐHCT', 'anh123@gmail.com', 'Kỹ Sư', '1f32aa4c9a1d2ea010adcf2348166a04'),
('KH004', 'Nguyen Thi Kim Ngoc', 'kimngoc', 'Nữ', '0326250990', '3/2, xuan khanh, ninh  kieu, can tho 2', 'ngoc123@gmail.com', 'Kỹ Sư', '1f32aa4c9a1d2ea010adcf2348166a04');

-- --------------------------------------------------------

--
-- Table structure for table `loaisach`
--

CREATE TABLE `loaisach` (
  `maloai` char(5) NOT NULL,
  `tenloai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaisach`
--

INSERT INTO `loaisach` (`maloai`, `tenloai`) VALUES
('LS001', 'Sách Giáo trình'),
('LS002', 'Sách Khoa học công nghệ – Kinh tế'),
('LS003', 'Sách Truyện, tiểu thuyết'),
('LS004', 'Sách Văn học nghệ thuật'),
('LS005', 'Sách Chính trị – pháp luật'),
('LS006', 'Sách Văn hóa xã hội – Lịch sử'),
('LS007', 'Sách Tâm lý, tâm linh, tôn giáo'),
('LS008', 'Sách Sách thiếu nhi');

-- --------------------------------------------------------

--
-- Table structure for table `phieumuahang`
--

CREATE TABLE `phieumuahang` (
  `masach` char(9) NOT NULL DEFAULT 'MS0',
  `mahd` char(5) NOT NULL DEFAULT 'HD0',
  `soluong` int(11) NOT NULL DEFAULT 1,
  `ngaydat` date NOT NULL DEFAULT current_timestamp(),
  `ngaygiao` date NOT NULL DEFAULT current_timestamp(),
  `kieuthanhtoan` varchar(255) NOT NULL DEFAULT 'Thanh Toán Khi Nhận Hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phieumuahang`
--

INSERT INTO `phieumuahang` (`masach`, `mahd`, `soluong`, `ngaydat`, `ngaygiao`, `kieuthanhtoan`) VALUES
('LS1TL1S7', 'HD004', 1, '2021-11-28', '2021-12-02', 'Thanh toán khi nhận hàng'),
('LS3TL1S10', 'HD002', 1, '2021-11-15', '2021-11-20', 'Ví ShopLite/ZaloPay'),
('LS4TL1S2', 'HD002', 2, '2021-11-15', '2021-11-20', 'Ví ShopLite/ZaloPay'),
('LS4TL1S5', 'HD001', 1, '2021-11-15', '2021-11-20', 'Thanh toán khi nhận hàng'),
('LS6TL1S10', 'HD001', 2, '2021-11-15', '2021-11-20', 'Thanh toán khi nhận hàng');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `masach` char(9) NOT NULL DEFAULT 'LS8TL1S',
  `matheloai` char(6) NOT NULL DEFAULT 'LS8TL1',
  `tensach` varchar(255) NOT NULL,
  `tacgia` varchar(255) DEFAULT 'Nhiều Tác Giả',
  `nxb` varchar(255) DEFAULT 'NHÀ XUẤT BẢN TRẺ',
  `namxb` timestamp NULL DEFAULT current_timestamp(),
  `ngonngu` varchar(30) DEFAULT 'English - Việt Nam',
  `kichthuoc` varchar(255) DEFAULT '13 x 19  cm',
  `hinhanh` varchar(255) DEFAULT '../anh/khtn/LS8TL1S.jpg',
  `soluong` int(11) NOT NULL DEFAULT 20,
  `giaban` float NOT NULL DEFAULT 50000,
  `giamgia` int(11) NOT NULL DEFAULT 0,
  `sotrang` int(11) NOT NULL DEFAULT 200,
  `bientap` varchar(255) NOT NULL DEFAULT 'Nhiều Tác Giả'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`masach`, `matheloai`, `tensach`, `tacgia`, `nxb`, `namxb`, `ngonngu`, `kichthuoc`, `hinhanh`, `soluong`, `giaban`, `giamgia`, `sotrang`, `bientap`) VALUES
('LS1TL1S1', 'LS1TL1', 'Sách Tiếng Việt 1 - tập một ', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:03:28', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1TV1_1.jpg', 20, 15000, 10, 152, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S10', 'LS1TL1', 'Sách Giáo Dục Thể Chất 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:28:07', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1GDTC1_1.jpg', 20, 12000, 5, 80, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S2', 'LS1TL1', 'Sách Tiếng Việt 1 - tập hai', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:20:31', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1TV1_2.jpg', 20, 13000, 10, 148, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S3', 'LS1TL1', 'Sách Toán 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:21:44', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1T1_1.jpg', 20, 20000, 11, 200, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S4', 'LS1TL1', 'Sách Tự nhiên và xã hội 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:22:31', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1TNXH1_1.jpg', 20, 12000, 5, 128, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S5', 'LS1TL1', 'Sách Hoạt động trải nghiệm 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:23:45', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1HDTN1_1.jpg', 20, 13000, 10, 100, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S6', 'LS1TL1', 'Sách Giáo dục thể chất 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:24:35', 'English - Việt Nam', '17 x 24 cm ', '../anh/lop1/LS1TL1GDTC1_1.jpg', 20, 13000, 10, 104, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S7', 'LS1TL1', 'Sách Đạo đức 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:25:16', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1DD1_1.jpg', 20, 10000, 10, 72, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S8', 'LS1TL1', 'Sách Âm nhạc 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:25:56', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1AN1_1.jpg', 20, 9000, 5, 60, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL1S9', 'LS1TL1', 'Sách Mỹ thuật 1', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 01:26:52', 'English - Việt Nam', '17 x 24 cm', '../anh/lop1/LS1TL1MT1_1.jpg', 20, 10000, 0, 84, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL2S1', 'LS1TL2', 'Sách Tiếng Việt 2 - tập một ', 'Nguyễn Thị Bích Hà, Trần Mạnh Hưởng, Đặng Kim Nga, Nguyễn Thị Tố Ninh', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:35:57', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2TV2_1.jpg', 20, 15000, 0, 152, 'Nguyễn Minh Thuyết'),
('LS1TL2S10', 'LS1TL2', 'Sách Giáo Dục Thể Chất 2', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:50:06', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2GDTC2_1.jpg', 20, 8000, 0, 80, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL2S2', 'LS1TL2', 'Sách Tiếng Việt 2 - tập hai', 'Nguyễn Khánh Hà, Hoàng Thị Minh Hương, Trần Bích Thủy, Lê Hữu Tình', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:38:45', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2TV2_2.jpg', 20, 14000, 0, 148, 'Nguyễn Minh Thuyết'),
('LS1TL2S3', 'LS1TL2', 'Sách Toán 2 - tập một', 'Nguyễn Hoài Anh, Trần Thúy Ngà, Nguyễn Thị Thanh Sơn', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:41:12', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2T2_2.jpg', 20, 12000, 0, 108, 'Đỗ Đức Thái, Đỗ Tiến Đạt'),
('LS1TL2S4', 'LS1TL2', 'Sách Toán 2', 'Nhiều Tác Giả', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:41:50', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2T2_1.jpg', 20, 18000, 0, 200, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL2S5', 'LS1TL2', 'Sách Tự nhiên và xã hội 2 ', 'Nguyễn Tuyết Nga, Lương Việt Thái, Phùng Thanh Huyền', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:42:55', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2TNXH2_1.jpg', 20, 13000, 0, 128, 'Mai Sỹ Tuấn, Bùi Phương Nga'),
('LS1TL2S6', 'LS1TL2', 'Sách Giáo dục thể chất 2', 'Nguyễn Duy Linh, Phạm Tràng Kha', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:45:37', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2GDTC2_1.jpg', 20, 10000, 0, 104, 'Lưu Quang Hiệp, Phạm Đông Đức'),
('LS1TL2S7', 'LS1TL2', 'Sách Đạo đức 2', 'Nguyễn Thị Việt Hà, Vũ Thị Mai Hương', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:46:54', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2DD2_1.jpg', 20, 8000, 0, 72, 'Trần Văn Thắng, Ngô Vũ Thu Hằng'),
('LS1TL2S8', 'LS1TL2', 'Sách Âm nhạc 2', 'Tạ Hoàng Mai Anh, Nguyễn Thị Quỳnh Mai', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:47:46', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2AN2_1.jpg', 20, 7000, 0, 60, 'NHÀ XUẤT BẢN TRẺ'),
('LS1TL2S9', 'LS1TL2', 'Sách Mỹ thuật 2', 'Phạm Đình Bình, Nguyễn Thị Hiền', 'Đại học sư phạm thành phố Hồ Chí Minh và Nhà xuất bản Đại học Sư Phạm', '2021-09-22 00:49:09', 'English - Việt Nam', '19 x 26.5 cm', '../anh/lop2/LS1TL2MT2_1.jpg', 20, 9000, 0, 84, 'Nguyễn Thị Đông, Nguyễn Hải Kiên'),
('LS2TL1S1', 'LS2TL1', 'Sách - Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Thiên Văn Học', 'Rachel Firth', 'Nhà Xuất Bản Thế Giới', '2017-03-21 11:08:19', 'English - Việt Nam', '18,6 x 23,5 cm', '../anh/thienvan/LS2TL1S1.jpg', 15, 29000, 0, 48, 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Thiên Văn Học (Tái Bản)'),
('LS2TL1S10', 'LS2TL1', 'Thiên Văn Vật Lý', 'Nhiều Tác Giả', 'Independently published | NHÀ XUẤT BẢN GIÁO DỤC', '2021-09-21 23:12:33', 'English - Việt Nam', '16 x 24 cm', '../anh/thienvan/LS2TL1S10.jpg', 15, 420000, 0, 311, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL1S2', 'LS2TL1', 'Bách Khoa Cho Trẻ Em - Bách Khoa Vũ Trụ', 'Dorling Kindersley', 'NXB Dân Trí', '2015-11-08 12:08:10', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/thienvan/LS2TL1S2.jpg', 15, 128000, 0, 127, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL1S3', 'LS2TL1', 'Bầu Trời Tuổi Thơ', 'Giáo sư – Nhà khoa học Nguyễn Quang Riệu', 'Independently published | NHÀ XUẤT BẢN GIÁO DỤC', '2021-09-21 23:42:37', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/thienvan/LS2TL1S3.jpg', 15, 737000, 0, 200, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL1S4', 'LS2TL1', 'Trái Đất Và Hệ Mặt Trời', 'Đặng Vũ Tuấn Sơn', 'Nxb Thông tin & truyền thông', '2019-08-01 12:18:05', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/thienvan/LS2TL1S4.jpg', 15, 125000, 0, 256, 'NXB Thông Tin và Truyền Thông'),
('LS2TL1S5', 'LS2TL1', 'Vũ Trụ', 'Carl Sagan', 'Independently published | NHÀ XUẤT BẢN GIÁO DỤC', '2021-09-21 23:29:26', 'English - Việt Nam', '16 x 24 cm', '../anh/thienvan/LS2TL1S5.jpg', 15, 100000, 0, 200, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL1S6', 'LS2TL1', 'Thiên Văn – Tang Thượng', ' Tang Thượng', 'NXB Phụ Nữ', '2021-02-05 17:13:27', 'English - Việt Nam', '15.5 x 23.2 cm', '../anh/thienvan/LS2TL1S6.jpg', 15, 105000, 0, 376, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL1S7', 'LS2TL1', 'Huyền Thoại Về Các Chòm Sao – Hoàn Vũ', 'Hoàn Vũ', 'Independently published | NHÀ XUẤT BẢN GIÁO DỤC', '2021-09-21 23:21:36', 'English - Việt Nam', '16 x 24 cm', '../anh/thienvan/LS2TL1S7.jpg', 15, 100000, 0, 200, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL1S8', 'LS2TL1', 'Vũ Trụ Toàn Ảnh – Michael Talbot', 'Nhiều Tác Giả', 'Independently published | NHÀ XUẤT BẢN GIÁO DỤC', '2021-09-21 23:18:31', 'English - Việt Nam', '16 x 24 cm', '../anh/thienvan/LS2TL1S8.jpg', 15, 100000, 0, 200, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL1S9', 'LS2TL1', 'BÀI TẬP THIÊN VĂN', 'PHẠM VIẾT TRINH- PHAN VĂN ĐỒNG', 'GIÁO DỤC VIỆT NAM', '2012-09-21 13:17:16', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/thienvan/LS2TL1S9.jpg', 15, 22000, 0, 159, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S1', 'LS2TL2', 'Spine of the Dragon (Brillant and fabulous)', 'Kevin J. Anderson', 'Independently published | NHÀ XUẤT BẢN GIÁO DỤC', '2021-09-21 22:56:57', 'English - Việt Nam', '16 x 24 cm', '../anh/vientuong/LS2TL2S1.jpg', 15, 520000, 0, 510, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S10', 'LS2TL2', '[Kinh Dị Trinh Thám] Nơi Đây Có Quỷ...', 'Võ Hoàng Phúc', 'Independently published | NHÀ XUẤT BẢN TRẺ', '2021-09-22 02:09:17', 'English - Việt Nam', '17 x 24 cm và 29.5 x 20.5 cm', '../anh/vientuong/LS2TL2S10.jpg', 20, 350000, 0, 300, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S2', 'LS2TL2', 'The Books of Caledan Trilogy (Books of Caledan #1-3)', 'Meg Cowley', 'Independently published', '2021-09-21 22:47:26', 'English - Việt Nam', '16 x 24 cm', '../anh/vientuong/LS2TL2S2.jpg', 15, 100000, 0, 829, 'Independently published | NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S3', 'LS2TL2', 'Order of Valxiron (2019)\n(The third book in the Chronicles of Pelenor series)A novel by Meg Cowley', 'Meg Cowley', 'Independently published', '2018-01-13 10:00:00', 'English - Việt Nam', '16 x 24 cm', '../anh/vientuong/LS2TL2S3.jpg', 15, 600000, 0, 200, 'Independently published | NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S4', 'LS2TL2', 'Tam Thể', 'Nhiều Tác Giả', 'Nhã Nam', '2021-09-22 01:39:30', 'English - Việt Nam', '17 x 24 cm và 29.5 x 20.5 cm', '../anh/vientuong/LS2TL2S4.jpg', 20, 360000, 0, 520, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S5', 'LS2TL2', 'Người Truyền Ký Ức', 'Lois Lowry', 'Nhã Nam', '2021-09-22 01:47:11', 'English - Việt Nam', '17 x 24 cm và 29.5 x 20.5 cm', '../anh/vientuong/LS2TL2S5.jpg', 20, 250000, 0, 246, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S6', 'LS2TL2', 'Trạm Tín Hiệu Số 23', 'Hugh Howey', 'Sách Bookism', '2021-09-22 01:50:16', 'English - Việt Nam', '17 x 24 cm và 29.5 x 20.5 cm', '../anh/vientuong/LS2TL2S6.jpg', 20, 350000, 0, 300, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S7', 'LS2TL2', 'Gặp Gỡ Trong Mơ', 'Laurie Conrad', 'Independently published | NHÀ XUẤT BẢN TRẺ', '2021-09-22 02:00:11', 'English - Việt Nam', '17 x 24 cm và 29.5 x 20.5 cm', '../anh/vientuong/LS2TL2S7.jpg', 20, 250000, 0, 200, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S8', 'LS2TL2', 'Thế Giới Bị Quỷ Ám', 'Carl Sagan', 'Independently published | NHÀ XUẤT BẢN TRẺ', '2021-09-22 02:01:27', 'English - Việt Nam', '17 x 24 cm và 29.5 x 20.5 cm', '../anh/vientuong/LS2TL2S8.jpg', 20, 350000, 0, 320, 'NHÀ XUẤT BẢN TRẺ'),
('LS2TL2S9', 'LS2TL2', '10 Điều Kinh Dị Nhất – Những Xác Ướp Ai Cập Rùng Rợn Mà Bạn Phải Tránh Xa', 'Nhiều Tác Giả', 'Independently published | NHÀ XUẤT BẢN TRẺ', '2021-09-22 02:05:11', 'English - Việt Nam', '17 x 24 cm và 29.5 x 20.5 cm', '../anh/vientuong/LS2TL2S9.jpg', 20, 260000, 0, 220, 'NHÀ XUẤT BẢN TRẺ'),
('LS3TL1S1', 'LS3TL1', 'Doraemon truyện dài tập 1: Thăm công viên khủng long', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:41:26', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S1.jpg', 10, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S10', 'LS3TL1', 'Doraemon truyện dài tập 10: Ngôi sao cảm', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:53:53', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S10.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S2', 'LS3TL1', 'Doraemon truyện dài tập 2: Bí mật hành tinh màu tím', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:44:35', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S2.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S3', 'LS3TL1', 'Doraemon truyện dài tập 3: Pho tượng thần khổng lồ', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:46:07', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S3.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S4', 'LS3TL1', 'Doraemon truyện dài tập 4: Lâu đài dưới đáy biển', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:46:59', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S4.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S5', 'LS3TL1', 'Doraemon truyện dài tập 5: Nobita lạc vào xứ quỷ', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:48:08', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S5.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S6', 'LS3TL1', 'Doraemon truyện dài tập 6: Tên độc tài vũ trụ', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:49:57', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S6.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S7', 'LS3TL1', 'Doraemon truyện dài tập 7: Cuộc xâm lăng của binh đoàn Robot', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:50:57', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S7.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S8', 'LS3TL1', 'Doraemon truyện dài tập 8: Cuộc phiêu lưu vào lòng đất', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:51:47', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S8.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS3TL1S9', 'LS3TL1', 'Doraemon truyện dài tập 9: Chiến thắng quỷ Kamat', 'FUJIKO.F.FUJIO', 'NXB KIM ĐỒNG – NHÀ XUẤT BẢN SÁCH NỔI TIẾNG CHO THIẾU NHI', '2021-09-22 02:53:00', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/truyentranh/LS3TL1S9.jpg', 20, 50000, 0, 200, 'NGUYỄN THẮNG VU, ĐỨC LÂM biên soạn với sự tham gia của SONG LAN ANH, LÊ PHƯƠNG LIÊN, PHẠM MINH HÀ, TẠ PHƯƠNG HÀ, BÙI ANH ĐÀO, ĐỨC LIÊN'),
('LS4TL1S1', 'LS4TL1', 'THƠ VĂN HÀN MẠC TỬ', 'Trần Quang Chu', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:00:37', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tho/LS4TL1S1.jpg', 20, 200000, 0, 668, 'Nhiều Nhà Văn'),
('LS4TL1S10', 'LS4TL1', 'Nguyễn Du - Truyện Thúy Kiều (Bản Đăc Biệt) (Bìa Mềm)', 'Nguyễn Du', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:32:21', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tho/LS4TL1S10.jpg', 20, 60000, 0, 292, 'Nhiều Nhà Văn'),
('LS4TL1S2', 'LS4TL1', 'Tủ Sách Bác Hồ - Tuyển Tập Thơ Văn Hồ Chí Minh', 'Hồ Chí Minh', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:03:23', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tho/LS4TL1S2.jpg', 20, 50000, 0, 200, 'Nhiều Nhà Văn'),
('LS4TL1S3', 'LS4TL1', 'Thơ Văn Lý Trần – Trọn Bộ 3 Tập', 'Nhiều Tác Giả', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:06:13', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tho/LS4TL1S3.jpg', 20, 1289000, 0, 5000, 'Nhiều Nhà Văn'),
('LS4TL1S4', 'LS4TL1', 'Fahasa - Mảnh Trăng Thơ', 'William Lê', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:11:07', 'English - Việt Nam', '20.0 x 20.0 x 5.0 cm', '../anh/tho/LS4TL1S4.jpg', 20, 109000, 0, 256, 'William Lê'),
('LS4TL1S5', 'LS4TL1', 'Xuân Diệu Thơ Và Đời', 'Xuân Diệu', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:13:51', 'English - Việt Nam', '20.5 x 13.5 cm', '../anh/tho/LS4TL1S5.jpg', 20, 50000, 0, 299, 'Nhiều Nhà Văn'),
('LS4TL1S6', 'LS4TL1', 'Tố Hữu Thơ Và Đời', 'Tố Hữu', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:16:07', 'English - Việt Nam', '20.5 x 13.5 cm', '../anh/tho/LS4TL1S6.jpg', 20, 52000, 0, 297, 'Nhiều Nhà Văn'),
('LS4TL1S7', 'LS4TL1', 'Tuyển Tập Kim Lân', 'Kim Lân', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:19:58', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tho/LS4TL1S7.jpg', 20, 68000, 0, 420, 'Nhiều Nhà Văn'),
('LS4TL1S8', 'LS4TL1', 'Thơ Xuân Quỳnh', 'Xuân Quỳnh', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:24:29', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tho/LS4TL1S8.jpg', 20, 30000, 0, 140, 'Nhiều Nhà Văn'),
('LS4TL1S9', 'LS4TL1', 'NDB Thơ Hồ Xuân Hương', 'Hồ Xuân Hương', 'NHÀ XUẤT BẢN HỘI NHÀ VĂN', '2021-09-22 04:27:08', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tho/LS4TL1S9.jpg', 20, 50000, 0, 200, 'Nhiều Nhà Văn'),
('LS5TL1S1', 'LS5TL1', 'Luật Ban Hành Văn Bản Quy Phạm Pháp Luật (Hiện Hành) (Sửa Đổi, Bổ Sung Năm 2020)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:44:22', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S1.jpg', 20, 42700, 0, 216, 'Nhiều Tác Giả'),
('LS5TL1S10', 'LS5TL1', 'Luật Nhà Ở (Hiện Hành) (Sửa Đổi, Bổ Sung Năm 2019, 2020)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 05:00:12', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S10.jpg', 20, 32000, 0, 195, 'Nhiều Tác Giả'),
('LS5TL1S2', 'LS5TL1', 'Luật Giao Thông Đường Bộ (Hiện Hành) (Sửa Đổi, Bổ Sung Năm 2018, 2019)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:46:17', 'English - Việt Nam', '19 x 13 x 0.5 cm', '../anh/ctri_luat/LS5TL1S2.jpg', 20, 21000, 0, 99, 'Nhiều Tác Giả'),
('LS5TL1S3', 'LS5TL1', 'Bộ Luật Lao Động (Hiện Hành)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:48:19', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S3.jpg', 20, 35000, 0, 192, 'Nhiều Tác Giả'),
('LS5TL1S4', 'LS5TL1', 'Luật Tín Ngưỡng, Tôn Giáo Hiện Hành (Năm 2016) Và Các Văn Bản Hưỡng Dẫn Thi Hành', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:51:33', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S4.jpg', 20, 32000, 0, 207, 'Nhiều Tác Giả'),
('LS5TL1S5', 'LS5TL1', 'Luật Bảo Hiểm Xã Hội (Hiện Hành) (Sửa Đổi Bổ Sung 2015, 2018, 2019) - Tái Bản', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:53:03', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S5.jpg', 20, 24000, 0, 116, 'Nhiều Tác Giả'),
('LS5TL1S6', 'LS5TL1', 'Luật Bảo Hiểm Y Tế (Hiện Hành) (Sửa Đổi, Bỗ Sung Năm 2013, 2014, 2015, 2018)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:54:30', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S6.jpg', 20, 17000, 0, 64, 'Nhiều Tác Giả'),
('LS5TL1S7', 'LS5TL1', 'Luật Thương Mại (Hiện Hành) (Sửa Đổi Năm 2017, 2019)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:55:56', 'English - Việt Nam', '19 x 13 x 0.8 cm', '../anh/ctri_luat/LS5TL1S7.jpg', 20, 32000, 0, 191, 'Nhiều Tác Giả'),
('LS5TL1S8', 'LS5TL1', 'Luật Đất Đai (Sửa Đổi, Bổ Sung Năm 2018)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:57:07', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S8.jpg', 20, 33000, 0, 248, 'Nhiều Tác Giả'),
('LS5TL1S9', 'LS5TL1', 'Bộ Luật Dân Sự (Hiện Hành)', 'Quốc Hội', 'NHÀ XUẤT BẢN CHÍNH TRỊ QUỐC GIA', '2021-09-22 04:58:40', 'English - Việt Nam', '19 x 13 cm', '../anh/ctri_luat/LS5TL1S9.jpg', 20, 65000, 0, 350, 'Nhiều Tác Giả'),
('LS6TL1S1', 'LS6TL1', 'Ẩm Thực Theo Dưỡng Sinh Trung Hoa', 'Đông A Sáng', 'NHÀ XUẤT BẢN Đà Nẵng', '2021-09-22 05:12:30', 'English - Việt Nam', '13 x 19  cm', '../anh/amthuc/LS6TL1S1.jpg', 20, 60000, 0, 222, 'Nhiều Tác Giả'),
('LS6TL1S10', 'LS6TL1', 'Các Thức Uống Lạnh Ngon & Lạ Miệng', 'Việt Điền', 'NHÀ XUẤT BẢN Phụ Nữ', '2021-09-22 05:29:12', 'English - Việt Nam', '18 x 22 cm', '../anh/amthuc/LS6TL1S10.jpg', 20, 32000, 0, 64, 'Nhiều Tác Giả'),
('LS6TL1S2', 'LS6TL1', 'Thực Đơn Cơm Gia Đình 3 Món Miền Trung (Tái Bản)', 'Đỗ Kim Trung', 'NHÀ XUẤT Bản Văn Hoá Thông Tin', '2021-09-22 05:14:19', 'English - Việt Nam', '20.5 x 14.5 cm', '../anh/amthuc/LS6TL1S2.jpg', 20, 33000, 0, 64, 'Nhiều Tác Giả'),
('LS6TL1S3', 'LS6TL1', 'Món Chay Ngon, Dễ Làm (Tái Bản 2014)', 'Quỳnh Hương', 'NHÀ XUẤT Bản Văn Hoá Thông Tin', '2021-09-22 05:16:56', 'English - Việt Nam', '20.5 x 14.5 cm', '../anh/amthuc/LS6TL1S3.jpg', 20, 28000, 0, 128, 'Nhiều Tác Giả'),
('LS6TL1S4', 'LS6TL1', 'Thực Đơn Cơm Chay 3 Món', 'Cẩm Tuyết', 'NHÀ XUẤT Bản Thời Đại', '2021-09-22 05:18:25', 'English - Việt Nam', '20.5 x 14.5 cm', '../anh/amthuc/LS6TL1S4.jpg', 20, 31000, 0, 63, 'Nhiều Tác Giả'),
('LS6TL1S5', 'LS6TL1', '30 Món Ăn Ngày Thường (Tập 1)', 'Nguyễn Thị Phụng', 'NHÀ XUẤT Bản Tổng hợp TP.HCM', '2021-09-22 05:20:37', 'English - Việt Nam', '20.5 x 14.5 cm', '../anh/amthuc/LS6TL1S5.jpg', 20, 32000, 0, 63, 'Nhiều Tác Giả'),
('LS6TL1S6', 'LS6TL1', 'Kỹ Thuật Chế Biến Các Món Nướng', 'Nguyễn Trúc Chi', 'NHÀ XUẤT Bản Tổng Hợp TPHCM', '2021-09-22 05:22:13', 'English - Việt Nam', '18 x 10 cm', '../anh/amthuc/LS6TL1S6.jpg', 20, 22000, 0, 96, 'Nhiều Tác Giả'),
('LS6TL1S7', 'LS6TL1', 'Kỹ Thuật Chế Biến Món Ăn Từ Cá', 'Triệu Thị Chơi', 'NHÀ XUẤT BẢN Tổng Hợp TPHCM', '2021-09-22 05:24:19', 'English - Việt Nam', '14,5 x 20,5 cm', '../anh/amthuc/LS6TL1S7.jpg', 20, 41000, 0, 202, 'Nhiều Tác Giả'),
('LS6TL1S8', 'LS6TL1', 'Pha Chế Thức Uống Bằng Rau Quả Đậu Hạt', 'Triệu Thị Chơi', 'NHÀ XUẤT BẢN Tổng Hợp TPHCM', '2021-09-22 05:26:22', 'English - Việt Nam', '19 x 13 x 1 cm', '../anh/amthuc/LS6TL1S8.jpg', 20, 22000, 0, 100, 'Nhiều Tác Giả'),
('LS6TL1S9', 'LS6TL1', 'Các Món Giải Khát Ăn Chơi (Tái Bản)', 'Cẩm Tuyết', 'NHÀ XUẤT BẢN Văn Hoá Thông Tin', '2021-09-22 05:27:57', 'English - Việt Nam', '20.5 x 14.5 cm', '../anh/amthuc/LS6TL1S9.jpg', 20, 28000, 0, 160, 'Nhiều Tác Giả'),
('LS7TL1S1', 'LS7TL1', 'Cân Bằng Cảm Xúc, Cả Lúc Bão Giông (Tái Bản 2020)', 'Richard Nicholls', 'NHÀ XUẤT BẢN Thế Giới', '2021-09-22 05:42:58', 'English - Việt Nam', '13.5 x 20.5 cm', '../anh/tamly/LS7TL1S1.jpg', 20, 77000, 0, 350, 'Nhiều Tác Giả'),
('LS7TL1S10', 'LS7TL1', 'Nghĩ, Nói, Trưởng Thành Và Làm Nên Sự Nghiệp', 'Ken Tucker', 'NHÀ XUẤT BẢN Thanh Niên', '2021-09-22 08:20:02', 'English - Việt Nam', '20.5 x 14.5 cm', '../anh/tamly/LS7TL1S10.jpg', 20, 60000, 20, 168, 'Nhiều Tác Giả'),
('LS7TL1S2', 'LS7TL1', 'Khéo Ăn Nói Sẽ Có Được Thiên Hạ - Bản Mới', 'Trác Nhã', 'NHÀ XUẤT BẢN Văn Học', '2021-09-22 05:44:54', 'English - Việt Nam', '14.5 x 20.5 cm', '../anh/tamly/LS7TL1S2.jpg', 20, 88000, 0, 406, 'Nhiều Tác Giả'),
('LS7TL1S3', 'LS7TL1', 'Hài Hước Một Chút Thế Giới Sẽ Khác Đi', 'The Book Worm', 'NHÀ XUẤT BẢN Thanh Niên', '2021-09-22 05:46:23', 'English - Việt Nam', '14,5 x 20,5 cm', '../anh/tamly/LS7TL1S3.jpg', 20, 50000, 0, 228, 'Nhiều Tác Giả'),
('LS7TL1S4', 'LS7TL1', 'Tâm Lý Học Nghệ Thuật Giao Tiếp Thành Công', 'Lưu Diễm Hoa', 'NHÀ XUẤT BẢN Thanh Niên', '2021-09-22 05:48:42', 'English - Việt Nam', '24 x 16 cm', '../anh/tamly/LS7TL1S4.jpg', 20, 95000, 0, 232, 'Nhiều Tác Giả'),
('LS7TL1S5', 'LS7TL1', 'Tâm Lý Học - Nghệ Thuật Giải Mã Hành Vi', 'Trần Lộ', 'NHÀ XUẤT BẢN Thanh Niên', '2021-09-22 05:50:59', 'English - Việt Nam', '24 x 16 cm', '../anh/tamly/LS7TL1S5.jpg', 20, 123000, 0, 448, 'Nhiều Tác Giả'),
('LS7TL1S6', 'LS7TL1', 'Đọc Vị Tâm Tư Qua Ngôn Ngữ Cơ Thể', 'Uông Tư Nguyên', 'NHÀ XUẤT BẢN Thế Giới', '2021-09-22 08:08:19', 'English - Việt Nam', '20.5 x 14 cm', '../anh/tamly/LS7TL1S6.jpg', 20, 108000, 20, 312, 'Nhiều Tác Giả'),
('LS7TL1S7', 'LS7TL1', 'Giải Mã Hành Vi - Bắt Gọn Tâm Lý', 'Lộc Dã', 'NHÀ XUẤT BẢN Lao động', '2021-09-22 08:11:10', 'English - Việt Nam', '23 x 15 cm', '../anh/tamly/LS7TL1S7.jpg', 20, 130000, 20, 300, 'Nhiều Tác Giả'),
('LS7TL1S8', 'LS7TL1', 'Tâm Lý Học Biểu Cảm', 'Mã Hạo Thiên', 'NHÀ XUẤT BẢN Văn Học', '2021-09-22 08:13:32', 'English - Việt Nam', '20.5 x 14.5 cm', '../anh/tamly/LS7TL1S8.jpg', 20, 98000, 18, 252, 'Nhiều Tác Giả'),
('LS7TL1S9', 'LS7TL1', 'Ngôn Từ Thay Đổi Tư Duy', 'Shelle Rose Charvet', 'NHÀ XUẤT BẢN Lao Động', '2021-09-22 08:16:13', 'English - Việt Nam', '24 x 16 cm', '../anh/tamly/LS7TL1S9.jpg', 20, 188000, 18, 408, 'Nhiều Tác Giả'),
('LS8TL1S1', 'LS8TL1', 'Bách Khoa Tri Thức Cho Trẻ Em - Lịch Sử Văn Hóa (Bìa Cứng)', 'Lưu Kim Song - Lý Văn Hân', 'NHÀ XUẤT BẢN Mỹ Thuật', '2021-09-22 08:34:02', 'English - Việt Nam', '29.5 x 20.5 x 0.5 cm', '../anh/khtn/LS8TL1S1.jpg', 20, 120000, 15, 80, 'Nhiều Tác Giả'),
('LS8TL1S10', 'LS8TL1', 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Pirates - Cướp Biển', 'Deborah Lock', 'NHÀ XUẤT BẢN Hà Nội', '2021-09-22 09:06:21', 'English - Việt Nam', '19 x 24 cm', '../anh/khtn/LS8TL1S10.jpg', 20, 55000, 20, 56, 'Nhiều Tác Giả'),
('LS8TL1S2', 'LS8TL1', 'Bách Khoa Tri Thức Cho Trẻ Em - Văn Hóa Nghệ Thuật (Bìa Cứng)', 'Lưu Kim Song - Lý Văn Hân', 'NHÀ XUẤT BẢN Mỹ Thuật', '2021-09-22 08:36:20', 'English - Việt Nam', '20.5 x 29.5 cm', '../anh/khtn/LS8TL1S2.jpg', 20, 120000, 15, 80, 'Nhiều Tác Giả'),
('LS8TL1S3', 'LS8TL1', 'Bách Khoa Tri Thức Cho Trẻ Em - Động Vật - Thực Vật (Bìa Cứng)', 'Lưu Kim Song - Lý Văn Hân', 'NHÀ XUẤT BẢN Mỹ Thuật', '2021-09-22 08:39:59', 'English - Việt Nam', '20.5 x 29.5 cm', '../anh/khtn/LS8TL1S3.jpg', 20, 120000, 15, 88, 'Nhiều Tác Giả'),
('LS8TL1S4', 'LS8TL1', 'Bách Khoa Tri Thức Cho Trẻ Em - Không Gian Vũ Trụ (Bìa Cứng)', 'Lưu Kim Song, Lý Văn Hân', 'NHÀ XUẤT Mỹ Thuật', '2021-09-22 08:43:07', 'English - Việt Nam', '20.5 x 29.5 cm', '../anh/khtn/LS8TL1S4.jpg', 20, 120000, 15, 84, 'Nhiều Tác Giả'),
('LS8TL1S5', 'LS8TL1', 'Bách Khoa Tri Thức Cho Trẻ Em - Diện Mạo Thế Giới (Bìa Cứng)', 'Lưu Kim Song, Lý Văn Hân', 'NHÀ XUẤT BẢN Mỹ Thuật', '2021-09-22 08:49:02', 'English - Việt Nam', '20.5 x 29.5 cm', '../anh/khtn/LS8TL1S5.jpg', 20, 120000, 20, 96, 'Nhiều Tác Giả'),
('LS8TL1S6', 'LS8TL1', 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Vũ Trụ (Tái Bản 2018)', 'Ben Denne, Eileen O Brien', 'NHÀ XUẤT BẢN Thế Giới', '2021-09-22 08:54:33', 'English - Việt Nam', '18.6 x 23.5  cm', '../anh/khtn/LS8TL1S6.jpg', 20, 45000, 20, 48, 'Nhiều Tác Giả'),
('LS8TL1S7', 'LS8TL1', 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Stars And Planets - Các Ngôi Sao Và Các Hành Tinh', 'Simon Holland', 'NHÀ XUẤT BẢN Hà Nội', '2021-09-22 08:57:04', 'English - Việt Nam', '19 x 24 cm', '../anh/khtn/LS8TL1S7.jpg', 20, 55000, 20, 56, 'Nhiều Tác Giả'),
('LS8TL1S8', 'LS8TL1', 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Rocks And Minerals - Đá Và Khoáng Chất', 'Caroline Bingham', 'NHÀ XUẤT BẢN Hà Nội', '2021-09-22 09:02:15', 'English - Việt Nam', '19 x 24 cm', '../anh/khtn/LS8TL1S8.jpg', 20, 55000, 20, 56, 'Nhiều Tác Giả'),
('LS8TL1S9', 'LS8TL1', 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Reptiles - Bò Sát', 'Simon Holland', 'NHÀ XUẤT BẢN Hà Nội', '2021-09-22 09:04:26', 'English - Việt Nam', '19 x 24 cm', '../anh/khtn/LS8TL1S9.jpg', 20, 55000, 20, 56, 'Nhiều Tác Giả');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `matheloai` char(6) NOT NULL,
  `maloai` char(5) NOT NULL,
  `tentheloai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bang The Loai Sach';

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`matheloai`, `maloai`, `tentheloai`) VALUES
('LS1TL1', 'LS001', 'Lớp 1'),
('LS1TL2', 'LS001', 'Lớp 2'),
('LS1TL3', 'LS001', 'Lớp 3'),
('LS1TL4', 'LS001', 'Lớp 4'),
('LS1TL5', 'LS001', 'Lớp 5'),
('LS2TL1', 'LS002', 'Thiên Văn - Vũ Trụ'),
('LS2TL2', 'LS002', 'Viễn Tưởng'),
('LS2TL3', 'LS002', 'Toán Học'),
('LS2TL4', 'LS002', 'Vật Lý'),
('LS2TL5', 'LS002', 'Sinh Học'),
('LS2TL6', 'LS002', 'Máy Tính'),
('LS2TL7', 'LS002', 'Tài Chính - Kế Toán'),
('LS2TL8', 'LS002', 'Tài Chính - Tiền Tệ'),
('LS3TL1', 'LS003', 'Truyện Cười'),
('LS3TL2', 'LS003', 'Truyện Ngắn'),
('LS3TL3', 'LS003', 'Truyện Tranh'),
('LS3TL4', 'LS003', 'Ngôn Tình'),
('LS4TL1', 'LS004', 'Thơ'),
('LS4TL2', 'LS004', 'Văn Xuôi'),
('LS4TL3', 'LS004', 'Hài Kịch'),
('LS4TL4', 'LS004', 'Âm Nhạc'),
('LS4TL5', 'LS004', 'Hội Họa'),
('LS4TL6', 'LS004', 'Thể Thao'),
('LS4TL7', 'LS004', 'Du Lịch'),
('LS5TL1', 'LS005', 'Chính Trị - Pháp Luật'),
('LS6TL1', 'LS006', 'Ẩm Thực'),
('LS6TL2', 'LS006', 'Giải Trí'),
('LS6TL3', 'LS006', 'Lịch Sử Thé Giới'),
('LS6TL4', 'LS006', 'Lịch Sử Viêt Nam'),
('LS7TL1', 'LS007', 'Cảm Xúc Con Người'),
('LS7TL2', 'LS007', 'Trí Tuệ Con Người'),
('LS7TL3', 'LS007', 'Sách Kinh'),
('LS7TL4', 'LS007', 'Sách Tư Tưởng'),
('LS7TL5', 'LS007', 'Sách Trải Nghiệm'),
('LS8TL1', 'LS008', 'KH-TN'),
('LS8TL2', 'LS008', 'KH-XH'),
('LS8TL3', 'LS008', 'Âm Nhạc - Mỹ Thuật'),
('LS8TL4', 'LS008', 'Ngoại Ngũ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `makh` (`makh`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`);

--
-- Indexes for table `loaisach`
--
ALTER TABLE `loaisach`
  ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `phieumuahang`
--
ALTER TABLE `phieumuahang`
  ADD PRIMARY KEY (`masach`,`mahd`),
  ADD KEY `fk_hd_phieumuahang` (`mahd`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`masach`),
  ADD KEY `matheloai` (`matheloai`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`matheloai`),
  ADD KEY `maloai` (`maloai`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_hdkh` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `phieumuahang`
--
ALTER TABLE `phieumuahang`
  ADD CONSTRAINT `fk_hd_phieumuahang` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sach_phieumuahang` FOREIGN KEY (`masach`) REFERENCES `sach` (`masach`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `fk_sach_theloaisach` FOREIGN KEY (`matheloai`) REFERENCES `theloai` (`matheloai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `theloai`
--
ALTER TABLE `theloai`
  ADD CONSTRAINT `fk_loai_theloaisach` FOREIGN KEY (`maloai`) REFERENCES `loaisach` (`maloai`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
