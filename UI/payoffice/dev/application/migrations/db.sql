--
-- Database: `bocpaymentspatch`
--
CREATE DATABASE IF NOT EXISTS `bocpaymentspatch` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bocpaymentspatch`;


--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `bocpaymentspatch`.`ci_sessions`;

CREATE TABLE IF NOT EXISTS `bocpaymentspatch`.`ci_sessions` (
    `id` varchar(128) NOT NULL,
    `ip_address` varchar(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` blob NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
);

-- When sess_match_ip = TRUE
-- ALTER TABLE ci_sessions ADD PRIMARY KEY (id, ip_address);

-- When sess_match_ip = FALSE
ALTER TABLE ci_sessions ADD PRIMARY KEY (id);

-- To drop a previously created primary key (use when changing the setting)
-- ALTER TABLE ci_sessions DROP PRIMARY KEY;


--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `bocpaymentspatch`.`user_logs`;
CREATE TABLE `bocpaymentspatch`.`user_logs` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `user_id` varchar(45) NOT NULL,
  `logged_in_on` date NOT NULL,
  `logged_in_at` time NOT NULL,
  `logged_out_on` date NULL,
  `logged_out_at` time NULL,
  `reset_status` varchar(1) NULL,
  `session_id` VARCHAR(128) NOT NULL , 
  `status` varchar(1) NOT NULL,
  `browseagent` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `machine_name` varchar(255) NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `bocpaymentspatch`.`activities`;
CREATE TABLE `bocpaymentspatch`.`activities` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `type` varchar(45) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `bocpaymentspatch`.`activities`;
INSERT INTO `activities` (`id`, `type`, `activity`, `action`) VALUES
(1, 'Request', 'Create Request', 'Created'),
(2, 'Request', 'Update Request', 'Updated'),
(3, 'Request', 'Verify Request', 'Verified'),
(4, 'Request', 'Authorize Request', 'Authorized'),
(5, 'Request', 'Reject Request', 'Rejected'),

(6, 'Message', 'Create Message', 'Created'),
(7, 'Message', 'Update Message', 'Updated'),
(8, 'Message', 'Verify Message', 'Verified'),
(9, 'Message', 'Authorize Message', 'Authorized'),
(10, 'Message', 'Reject Message', 'Rejected'),

(11, 'Payment', 'Hold Payment', 'Hold'),
(12, 'Payment', 'Forcefully Debit Payment', 'Debited'),
(13, 'Payment', 'Reauthorize Payment', 'Reauthorized'),

(14, 'Payment', 'Cancel Payment', 'Declined'),
(15, 'Payment', 'Initiate Payment Cancellation', 'Initiated'),
(16, 'Payment', 'Accept Payment Cancellation', 'Accepted'),
(17, 'Payment', 'Cancel Payment', 'Canceled'),
(18, 'Payment', 'Send SMS', 'Sent'),
(19, 'Payment', 'Send Email', 'Sent'),
(20, 'Payment', 'Print Receipt', 'Printed'),

(21, 'Rate', 'Reserve Rate', 'Reserved'),
(22, 'Fund', 'Reserve Funds', 'Reserved'),
(23, 'Fund', 'Cancel Funds', 'Canceled'),

(24, 'Report', 'View Report', 'Viewed')
;



--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `bocpaymentspatch`.`audit_logs`;
CREATE TABLE `bocpaymentspatch`.`audit_logs` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `user_id` varchar(45) NOT NULL,
  `activity_id` INT(11) NOT NULL,
  `description` varchar(255) NULL,
  `status` varchar(1) NOT NULL,
  `user_role` varchar(5) NOT NULL,
  `user_branch` varchar(5) NOT NULL,
  `cluster_id` varchar(5) NOT NULL,
  `action_date` date NOT NULL,
  `action_time` time NOT NULL,
  `browse_agent` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `machine_name` varchar(255) NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- For testing only
INSERT INTO `globalbiccodes` (`ID`, `SFIFTCODE`, `BRANCHNAME`, `BANKNAME`, `COUNTRYCODE`, `COUNTRYNAME`, `CITYNAME`, `ACCOUNTLEN`, `CREATED_AT`, `CREATED_BY`, `UPDATED_AT`, `UPDATED_BY`) VALUES 
(NULL, 'PSBKLKL0XXX', '', 'PEOPLE\'S BANK, TEST', 'LK', 'Sri Lanka', 'COLOMBO', '0', CURRENT_TIMESTAMP, 'SYSTEM', CURRENT_TIMESTAMP, 'SYSTEM');
