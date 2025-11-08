-- Host: 127.0.0.1
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_expensetracker`
--
CREATE DATABASE IF NOT EXISTS `sp_expensetracker` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sp_expensetracker`;

-- --------------------------------------------------------

--
-- Table structure for table `et_transactions`
--

CREATE TABLE `et_transactions` (
  `trans_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `accounts` text NOT NULL,
  `category` text NOT NULL,
  `amount` int(11) NOT NULL,
  `trans_type` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `et_transactions`
--
ALTER TABLE `et_transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `et_transactions`
--
ALTER TABLE `et_transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;







