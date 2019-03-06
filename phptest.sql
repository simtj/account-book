-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-02-22 05:49
-- 서버 버전: 10.1.36-MariaDB
-- PHP 버전: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `phptest`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `account`
--

CREATE TABLE `account` (
  `idx` int(11) NOT NULL,
  `field_1` varchar(255) NOT NULL DEFAULT '' COMMENT '업체명',
  `field_2` varchar(255) NOT NULL DEFAULT '' COMMENT '전화번호',
  `field_3` varchar(255) NOT NULL DEFAULT '' COMMENT '상호',
  `field_4` varchar(255) NOT NULL DEFAULT '' COMMENT '등록번호',
  `field_5` varchar(255) NOT NULL DEFAULT '' COMMENT '대표자성명',
  `field_6` varchar(255) NOT NULL DEFAULT '' COMMENT '사업장주소',
  `field_7` varchar(255) NOT NULL DEFAULT '' COMMENT '업태',
  `field_8` varchar(255) NOT NULL DEFAULT '' COMMENT '종목',
  `field_9` varchar(255) NOT NULL DEFAULT '' COMMENT '품명',
  `field_10` varchar(255) NOT NULL DEFAULT '' COMMENT '메일주소',
  `field_11` varchar(255) NOT NULL DEFAULT '' COMMENT '예금주',
  `field_12` varchar(255) NOT NULL DEFAULT '' COMMENT '예상일',
  `field_13` varchar(255) NOT NULL DEFAULT '' COMMENT '단가'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `closing_account`
--

CREATE TABLE `closing_account` (
  `idx` int(11) NOT NULL,
  `field_1` varchar(255) NOT NULL DEFAULT '' COMMENT '업체명',
  `field_2` varchar(255) NOT NULL DEFAULT '' COMMENT '단가',
  `field_3` varchar(255) NOT NULL DEFAULT '' COMMENT '미수금',
  `field_4` varchar(255) NOT NULL DEFAULT '' COMMENT '순매출',
  `field_5` varchar(255) NOT NULL DEFAULT '' COMMENT '공급가액',
  `field_6` varchar(255) NOT NULL DEFAULT '' COMMENT '세액',
  `field_7` varchar(255) NOT NULL DEFAULT '' COMMENT '계산서금액',
  `field_8` varchar(255) NOT NULL DEFAULT '' COMMENT '미수포함금',
  `field_9` varchar(255) NOT NULL DEFAULT '' COMMENT '입금액',
  `field_10` varchar(255) NOT NULL DEFAULT '' COMMENT '입금날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `closing_account`
--
ALTER TABLE `closing_account`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `closing_account`
--
ALTER TABLE `closing_account`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
