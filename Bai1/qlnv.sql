-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2021 lúc 05:30 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlnv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loainhanvien`
--

CREATE TABLE `loainhanvien` (
  `MALOAINV` varchar(50) NOT NULL,
  `TENLOAINV` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loainhanvien`
--

INSERT INTO `loainhanvien` (`MALOAINV`, `TENLOAINV`) VALUES
('001', 'Truc Ban'),
('003', 'Bảo Vệ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MANHANVIEN` varchar(50) NOT NULL,
  `HO` varchar(50) NOT NULL,
  `TEN` varchar(50) NOT NULL,
  `NGAYSINH` date NOT NULL,
  `GIOITINH` varchar(50) NOT NULL,
  `DIACHI` varchar(50) NOT NULL,
  `ANH` varchar(50) NOT NULL,
  `MALOAINV` varchar(50) NOT NULL,
  `MAPHONG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MANHANVIEN`, `HO`, `TEN`, `NGAYSINH`, `GIOITINH`, `DIACHI`, `ANH`, `MALOAINV`, `MAPHONG`) VALUES
('001', 'CCC', 'AA', '2000-09-04', 'Nam', '123ABC', '', '001', '011'),
('002', 'Nguyen', 'Hung', '0000-00-00', 'Nam', '123xyz', 'Array', '001', '011'),
('003', 'Nguyen', 'Hung', '0000-00-00', 'Nam', '123xyz', '', '001', '011'),
('004', 'B', 'A', '2000-09-09', 'Nam', 'AVC', 'avatar.jpg', '001', '011'),
('008', 'BBB', 'ccc', '2000-04-09', 'Nam', 'Abc123', '123.jpg', '001', '011'),
('009', 'AA', 'AA', '2000-09-04', 'Nam', '123ABC', '123.JPG', '001', '011');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `MAPHONG` varchar(50) NOT NULL,
  `TENPHONG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`MAPHONG`, `TENPHONG`) VALUES
('011', 'CCC'),
('033', 'Quản trị');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ID` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ID`, `username`, `pass`, `level`) VALUES
(1, 'ABC', 'ABC', 0),
(2, 'BCD', 'BCD', 0),
(3, '123', '123', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loainhanvien`
--
ALTER TABLE `loainhanvien`
  ADD PRIMARY KEY (`MALOAINV`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MANHANVIEN`),
  ADD KEY `MALOAINV` (`MALOAINV`),
  ADD KEY `MAPHONG` (`MAPHONG`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MAPHONG`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`MALOAINV`) REFERENCES `loainhanvien` (`MALOAINV`),
  ADD CONSTRAINT `nhanvien_ibfk_2` FOREIGN KEY (`MAPHONG`) REFERENCES `phongban` (`MAPHONG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
