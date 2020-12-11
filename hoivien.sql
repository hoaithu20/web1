-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 04, 2020 lúc 10:05 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoivien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaithuong`
--

CREATE TABLE `giaithuong` (
  `magiaithuong` int(11) NOT NULL,
  `tengiaithuong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giaithuong`
--

INSERT INTO `giaithuong` (`magiaithuong`, `tengiaithuong`) VALUES
(1, 'giải nhất toán'),
(2, 'giải nhì tin học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoivien`
--

CREATE TABLE `hoivien` (
  `mahoivien` int(11) NOT NULL,
  `tenhoivien` varchar(255) NOT NULL,
  `ngayvaohoi` date NOT NULL DEFAULT current_timestamp(),
  `noicongtac` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoivien`
--

INSERT INTO `hoivien` (`mahoivien`, `tenhoivien`, `ngayvaohoi`, `noicongtac`) VALUES
(100, 'Nguyễn Văn An', '2020-11-29', 'Hà nội'),
(101, 'Phạm Thảo Nhi', '2020-11-24', 'H');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoivien_giaithuong`
--

CREATE TABLE `hoivien_giaithuong` (
  `mahoivien` int(11) NOT NULL,
  `magiaithuong` int(11) NOT NULL,
  `ngayduocnhan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoivien_giaithuong`
--

INSERT INTO `hoivien_giaithuong` (`mahoivien`, `magiaithuong`, `ngayduocnhan`) VALUES
(101, 1, '2020-11-11'),
(100, 1, '2020-11-11'),
(101, 2, '2020-11-26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `giaithuong`
--
ALTER TABLE `giaithuong`
  ADD PRIMARY KEY (`magiaithuong`);

--
-- Chỉ mục cho bảng `hoivien`
--
ALTER TABLE `hoivien`
  ADD PRIMARY KEY (`mahoivien`);

--
-- Chỉ mục cho bảng `hoivien_giaithuong`
--
ALTER TABLE `hoivien_giaithuong`
  ADD KEY `mahoivien` (`mahoivien`),
  ADD KEY `magiaithuong` (`magiaithuong`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hoivien_giaithuong`
--
ALTER TABLE `hoivien_giaithuong`
  ADD CONSTRAINT `hoivien_giaithuong_ibfk_1` FOREIGN KEY (`mahoivien`) REFERENCES `hoivien` (`mahoivien`),
  ADD CONSTRAINT `hoivien_giaithuong_ibfk_2` FOREIGN KEY (`magiaithuong`) REFERENCES `giaithuong` (`magiaithuong`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
