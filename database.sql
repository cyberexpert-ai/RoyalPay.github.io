-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2024 at 11:41 AM
-- Server version: 10.6.18-MariaDB-cll-lve-log
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jwyvwind_kalwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_history`
--

CREATE TABLE `activity_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `device_information` text DEFAULT NULL,
  `action_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bharatpe_tokens`
--

CREATE TABLE `bharatpe_tokens` (
  `id` int(11) NOT NULL,
  `user_token` longtext DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `cookie` text DEFAULT NULL,
  `merchantId` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `Upiid` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cxr_notifications`
--

CREATE TABLE `cxr_notifications` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `type` enum('success','info','warning','error') DEFAULT NULL,
  `expiry_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cxr_notifications`
--

INSERT INTO `cxr_notifications` (`id`, `message`, `type`, `expiry_time`) VALUES
(1, 'The New Dashboard Is Coming Soon 🤑', 'success', '2024-05-26 16:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `gift_codes`
--

CREATE TABLE `gift_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `is_redeemed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gift_codes`
--

INSERT INTO `gift_codes` (`id`, `code`, `amount`, `expiry_date`, `is_redeemed`) VALUES
(2, 'G40ZB072', 100.00, '2002-05-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `googlepay_tokens`
--

CREATE TABLE `googlepay_tokens` (
  `id` int(12) NOT NULL,
  `user_token` longtext DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `Instance_Id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `Upiid` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `googlepay_transactions`
--

CREATE TABLE `googlepay_transactions` (
  `id` int(11) NOT NULL,
  `user_token` longtext DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `utr` bigint(20) DEFAULT NULL,
  `user_id` int(12) DEFAULT NULL,
  `paymentTimestamp` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc`
--

CREATE TABLE `hdfc` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `seassion` varchar(255) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `upi_hdfc` varchar(255) NOT NULL,
  `UPI` varchar(255) NOT NULL,
  `tidlist` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` mediumtext NOT NULL,
  `user_token` longtext NOT NULL,
  `status` enum('SUCCESS','PENDING','FAILURE') DEFAULT 'PENDING',
  `amount` int(11) NOT NULL,
  `utr` longtext DEFAULT NULL,
  `customer_name` longtext DEFAULT NULL,
  `customer_mobile` longtext NOT NULL,
  `redirect_url` longtext NOT NULL,
  `remark1` longtext NOT NULL,
  `remark2` longtext NOT NULL,
  `gateway_txn` longtext NOT NULL,
  `method` text NOT NULL,
  `HDFC_TXNID` mediumtext DEFAULT NULL,
  `upiLink` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `byteTransactionId` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `paytm_txn_ref` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notifi_send` enum('yes','no') DEFAULT 'no',
  `webhook_sent` enum('yes','no') DEFAULT 'no',
  `route` enum('1','2') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_links`
--

CREATE TABLE `payment_links` (
  `id` int(11) NOT NULL,
  `link_token` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nonce` varchar(255) DEFAULT NULL,
  `payee_vpa` varchar(255) DEFAULT NULL,
  `is_already_link` enum('yes','no') DEFAULT 'no',
  `bytevip_link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paytm_tokens`
--

CREATE TABLE `paytm_tokens` (
  `id` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `MID` varchar(255) DEFAULT NULL,
  `Upiid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phonepe_tokens`
--

CREATE TABLE `phonepe_tokens` (
  `sl` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `phoneNumber` longtext NOT NULL,
  `userId` longtext NOT NULL,
  `token` longtext NOT NULL,
  `refreshToken` longtext NOT NULL,
  `name` text NOT NULL,
  `device_data` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Deactive',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_orders`
--

CREATE TABLE `plan_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_type` enum('route1','route2') NOT NULL,
  `status` enum('success','pending','cancel') DEFAULT 'pending',
  `notifi_send` enum('yes','no') DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `transactionId` mediumtext NOT NULL,
  `status` mediumtext NOT NULL,
  `order_id` mediumtext NOT NULL,
  `vpa` mediumtext NOT NULL,
  `paymentApp` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `user_token` mediumtext NOT NULL,
  `UTR` mediumtext NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `mobile` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `merchantTransactionId` varchar(255) DEFAULT NULL,
  `transactionNote` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `short_urls`
--

CREATE TABLE `short_urls` (
  `id` int(11) NOT NULL,
  `short_url` varchar(50) NOT NULL,
  `long_url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `url_clicks` int(11) DEFAULT 0,
  `link_type` enum('paylink','other') DEFAULT 'other'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_id`
--

CREATE TABLE `store_id` (
  `sl` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `unitId` longtext NOT NULL,
  `roleName` longtext NOT NULL,
  `groupValue` longtext NOT NULL,
  `groupId` longtext NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `merchant_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `theme` enum('light','dark','semi-dark','bordered-theme') NOT NULL DEFAULT 'light',
  `user_token` varchar(255) NOT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `callback_url` longtext DEFAULT NULL,
  `upi_id` mediumtext DEFAULT NULL COMMENT 'This is the UPI ID for PhonePe',
  `acc_lock` int(11) DEFAULT 0,
  `acc_ban` enum('on','off') DEFAULT 'off',
  `hdfc_connected` enum('Yes','No') DEFAULT 'No',
  `phonepe_connected` enum('Yes','No') DEFAULT 'No',
  `paytm_connected` enum('Yes','No') DEFAULT 'No',
  `bharatpe_connected` enum('Yes','No') DEFAULT 'No',
  `googlepay_connected` enum('Yes','No') DEFAULT 'No',
  `amazonpay_connected` enum('Yes','No') DEFAULT 'No',
  `instance_id` varchar(255) DEFAULT NULL,
  `instance_secret` varchar(255) DEFAULT NULL,
  `telegram_subscribed` enum('on','off') DEFAULT 'off',
  `telegram_chat_id` bigint(20) DEFAULT NULL,
  `telegram_username` varchar(255) DEFAULT NULL,
  `totp_user` enum('off','on') NOT NULL DEFAULT 'off',
  `totp_secret` varchar(255) DEFAULT NULL,
  `route_1` enum('on','off') DEFAULT 'on',
  `route_2` enum('on','off') DEFAULT 'off',
  `wallet` decimal(10,2) DEFAULT 0.00,
  `frozenwallet` decimal(10,2) DEFAULT 0.00,
  `vip_expiry` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `merchant_id`, `password`, `email`, `company`, `theme`, `user_token`, `secret_key`, `expiry`, `callback_url`, `upi_id`, `acc_lock`, `acc_ban`, `hdfc_connected`, `phonepe_connected`, `paytm_connected`, `bharatpe_connected`, `googlepay_connected`, `amazonpay_connected`, `instance_id`, `instance_secret`, `telegram_subscribed`, `telegram_chat_id`, `telegram_username`, `totp_user`, `totp_secret`, `route_1`, `route_2`, `wallet`, `frozenwallet`, `vip_expiry`) VALUES
(632, 'oyo', '8619170399', 'MRQMEDAUDT4J1719171471', '$2y$10$zEnAIn84xoIhpM9awhblTOm7KXQI4u845D2RitNKF1ECXX/c8Jbe6', 'Demo@gmail.com', 'ompho', 'light', '12a6aa5daf26fda8cc431c01361de5a2', 'ADxI7o2AEwVAZMZPGH8bzmPF6iKt9bFk', '2029-06-26', NULL, 'Q384067488@ybl', 0, 'off', 'No', 'No', 'No', 'No', 'No', 'No', 'ILGXsdFHcn513171471', '0DuwEwk5wxklW6q3Pdih9y5H1cseLgtD', 'off', NULL, NULL, 'off', 'BJ3QPQAREXBKMWGN', 'on', 'on', 0.00, 0.00, '2028-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_txnid` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `operation_type` enum('credit','debit') DEFAULT NULL,
  `notifi_send` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `withdraw_id` varchar(255) NOT NULL DEFAULT 'none',
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bank_account_number` varchar(20) NOT NULL DEFAULT 'none',
  `ifsc_code` varchar(20) NOT NULL DEFAULT 'none',
  `status` enum('pending','completed','cancelled','processing') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `notifi_send` enum('yes','no') DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals_upi`
--

CREATE TABLE `withdrawals_upi` (
  `id` int(11) NOT NULL,
  `withdraw_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','cancelled','processing') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `notify_send` enum('yes','no') DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_history`
--
ALTER TABLE `activity_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bharatpe_tokens`
--
ALTER TABLE `bharatpe_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bharatpe_tokens_user_id` (`user_id`);

--
-- Indexes for table `cxr_notifications`
--
ALTER TABLE `cxr_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_codes`
--
ALTER TABLE `gift_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `googlepay_tokens`
--
ALTER TABLE `googlepay_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_googlepay_tokens_user_id` (`user_id`);

--
-- Indexes for table `googlepay_transactions`
--
ALTER TABLE `googlepay_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_googlepay_transactions_user_id` (`user_id`);

--
-- Indexes for table `hdfc`
--
ALTER TABLE `hdfc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hdfc_user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Indexes for table `payment_links`
--
ALTER TABLE `payment_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paytm_tokens_user_id` (`user_id`);

--
-- Indexes for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  ADD PRIMARY KEY (`sl`),
  ADD KEY `fk_phonepe_tokens_user_id` (`user_id`);

--
-- Indexes for table `plan_orders`
--
ALTER TABLE `plan_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchantTransactionId` (`merchantTransactionId`),
  ADD KEY `fk_reports_user_id` (`user_id`);

--
-- Indexes for table `short_urls`
--
ALTER TABLE `short_urls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_url` (`short_url`);

--
-- Indexes for table `store_id`
--
ALTER TABLE `store_id`
  ADD PRIMARY KEY (`sl`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_wallet_txnid` (`wallet_txnid`),
  ADD KEY `fk_wallet_transactions_user_id` (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_withdraw_id` (`withdraw_id`),
  ADD KEY `withdrawals_ibfk_1` (`user_id`);

--
-- Indexes for table `withdrawals_upi`
--
ALTER TABLE `withdrawals_upi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withdraw_id` (`withdraw_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_history`
--
ALTER TABLE `activity_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bharatpe_tokens`
--
ALTER TABLE `bharatpe_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cxr_notifications`
--
ALTER TABLE `cxr_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gift_codes`
--
ALTER TABLE `gift_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `googlepay_tokens`
--
ALTER TABLE `googlepay_tokens`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `googlepay_transactions`
--
ALTER TABLE `googlepay_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hdfc`
--
ALTER TABLE `hdfc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_links`
--
ALTER TABLE `payment_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=625;

--
-- AUTO_INCREMENT for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plan_orders`
--
ALTER TABLE `plan_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `short_urls`
--
ALTER TABLE `short_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_id`
--
ALTER TABLE `store_id`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=634;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals_upi`
--
ALTER TABLE `withdrawals_upi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_history`
--
ALTER TABLE `activity_history`
  ADD CONSTRAINT `activity_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bharatpe_tokens`
--
ALTER TABLE `bharatpe_tokens`
  ADD CONSTRAINT `fk_bharatpe_tokens_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `googlepay_tokens`
--
ALTER TABLE `googlepay_tokens`
  ADD CONSTRAINT `fk_googlepay_tokens_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `googlepay_transactions`
--
ALTER TABLE `googlepay_transactions`
  ADD CONSTRAINT `fk_googlepay_transactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hdfc`
--
ALTER TABLE `hdfc`
  ADD CONSTRAINT `fk_hdfc_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  ADD CONSTRAINT `fk_paytm_tokens_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  ADD CONSTRAINT `fk_phonepe_tokens_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `plan_orders`
--
ALTER TABLE `plan_orders`
  ADD CONSTRAINT `plan_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `store_id`
--
ALTER TABLE `store_id`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `fk_wallet_transactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `withdrawals_upi`
--
ALTER TABLE `withdrawals_upi`
  ADD CONSTRAINT `withdrawals_upi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
