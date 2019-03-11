-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 19-03-11 07:06
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
  `company` varchar(255) NOT NULL DEFAULT '' COMMENT '업체명',
  `phone_number` varchar(255) NOT NULL DEFAULT '' COMMENT '전화번호',
  `mutual` varchar(255) NOT NULL DEFAULT '' COMMENT '상호',
  `registration_number` varchar(255) NOT NULL DEFAULT '' COMMENT '등록번호',
  `ceo_name` varchar(255) NOT NULL DEFAULT '' COMMENT '대표자성명',
  `business_address` varchar(255) NOT NULL DEFAULT '' COMMENT '사업장주소',
  `business_conditions` varchar(255) NOT NULL DEFAULT '' COMMENT '업태',
  `company_stock` varchar(255) NOT NULL DEFAULT '' COMMENT '종목',
  `product` varchar(255) NOT NULL DEFAULT '' COMMENT '품명',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '메일주소',
  `account_holder` varchar(255) NOT NULL DEFAULT '' COMMENT '예금주',
  `expected_date` varchar(255) NOT NULL DEFAULT '' COMMENT '예상일',
  `unit_price` varchar(255) NOT NULL DEFAULT '' COMMENT '단가'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `closing_account`
--

CREATE TABLE `closing_account` (
  `idx` int(11) NOT NULL,
  `company` varchar(255) NOT NULL DEFAULT '' COMMENT '업체명',
  `unit_price` varchar(255) NOT NULL DEFAULT '' COMMENT '단가',
  `accounts_receivable` varchar(255) NOT NULL DEFAULT '' COMMENT '미수금',
  `sales` varchar(255) NOT NULL DEFAULT '' COMMENT '순매출',
  `supply_value` varchar(255) NOT NULL DEFAULT '' COMMENT '공급가액',
  `tax_amount` varchar(255) NOT NULL DEFAULT '' COMMENT '세액',
  `bill_amount` varchar(255) NOT NULL DEFAULT '' COMMENT '계산서금액',
  `accounts_alloy` varchar(255) NOT NULL DEFAULT '' COMMENT '미수포함금',
  `deposit` varchar(255) NOT NULL DEFAULT '' COMMENT '입금액',
  `deposit_date` varchar(255) NOT NULL DEFAULT '' COMMENT '입금날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `wolbyeol`
--

CREATE TABLE `wolbyeol` (
  `idx` int(11) NOT NULL,
  `company_idx` int(11) NOT NULL COMMENT '업체코드',
  `company` varchar(255) NOT NULL COMMENT '업체명',
  `year` varchar(255) NOT NULL COMMENT '년',
  `month` varchar(255) NOT NULL COMMENT '월',
  `day` varchar(255) NOT NULL COMMENT '일',
  `unit_price` int(11) NOT NULL COMMENT '단가',
  `breakfast` int(11) NOT NULL COMMENT '아침',
  `lunch` int(11) NOT NULL COMMENT '점심',
  `dinner` int(11) NOT NULL COMMENT '저녁',
  `snack` int(11) NOT NULL COMMENT '야식',
  `special` int(11) NOT NULL COMMENT '특식',
  `special_price` int(11) NOT NULL COMMENT '특식 단가',
  `total_conut` int(11) NOT NULL COMMENT '합계',
  `total_price` int(11) NOT NULL COMMENT '총액',
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일'
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
-- 테이블의 인덱스 `wolbyeol`
--
ALTER TABLE `wolbyeol`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `closing_account`
--
ALTER TABLE `closing_account`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `wolbyeol`
--
ALTER TABLE `wolbyeol`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
