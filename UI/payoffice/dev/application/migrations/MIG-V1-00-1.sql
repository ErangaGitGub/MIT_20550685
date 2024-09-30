-- ==========================================================================================
-- DATE MODIFIED: 2021-03-16
-- USER: IT207317
-- ==========================================================================================

--
-- Table structure for table `rtgsbiccodes`
--

CREATE TABLE `rtgsbiccodes` (
  `ID` int(11) NOT NULL,
  `SFIFTCODE` varchar(255) NOT NULL,
  `BRANCHNAME` varchar(255) NOT NULL,
  `BANKNAME` varchar(255) NOT NULL,
  `COUNTRYCODE` varchar(255) NOT NULL,
  `COUNTRYNAME` varchar(255) NOT NULL,
  `CITYNAME` varchar(255) NOT NULL,
  `ACCOUNTLEN` int(11) DEFAULT '0',
  `CREATED_AT` datetime DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` varchar(255) DEFAULT 'SYSTEM',
  `UPDATED_AT` datetime DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_BY` varchar(255) DEFAULT 'SYSTEM'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for table `rtgsbiccodes`
--
ALTER TABLE `rtgsbiccodes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SFIFTCODE` (`SFIFTCODE`) USING BTREE,
  ADD KEY `COUNTRYCODE` (`COUNTRYCODE`) USING BTREE,
  ADD KEY `CITYNAME` (`CITYNAME`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rtgsbiccodes`
--
ALTER TABLE `rtgsbiccodes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;COMMIT;


--
-- Dumping data for table `rtgsbiccodes`
--

INSERT INTO `rtgsbiccodes` (`ID`, `SFIFTCODE`, `BRANCHNAME`, `BANKNAME`, `COUNTRYCODE`, `COUNTRYNAME`, `CITYNAME`, `ACCOUNTLEN`, `CREATED_AT`, `CREATED_BY`, `UPDATED_AT`, `UPDATED_BY`) VALUES
(1, 'AMNALKLXXXX', '', 'Amana Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(2, 'AXISLKLXXXX', '', 'Axis Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(3, 'BCEYLKLXXXX', '', 'Bank of Ceylon', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(4, 'BKCHLKLXXXX', '', 'Bank of China, Colombo', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(5, 'BSAMLKLXXXX', '', 'Sampath Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(6, 'CALDLKLXXXX', '', 'Capital Alliance', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(7, 'CBCELKLXEPF', '', 'Employees Provident Fund (CBSL)', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(8, 'CBCELKLXXXX', '', 'Central Bank of Sri Lanka', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(9, 'CCEYLKLXXXX', '', 'Commercial Bank of Ceylon', 'LK', 'Sri Lanka', '', 10, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(10, 'CDSPLKLCXXX', '', 'Colombo Stock Exchange', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(11, 'CGRBLKLXXXX', '', 'Cargills Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(12, 'CITILKLXXXX', '', 'Citibank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(13, 'CSSLLKLXXXX', '', 'Entrust Securities PVT LTD', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(14, 'DEUTLKLXXXX', '', 'Deutsche Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(15, 'DFCCLKLXXXX', '', 'DFCC Vardhana Bank LTD', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(16, 'FCTLLKLXXXX', '', 'First Capital Treasuries', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(17, 'HABBLKLCXXX', '', 'Habib Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(18, 'HBLILKLXXXX', '', 'Hatton National Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(19, 'HNBSLKLXXXX', '', 'Acuity Securities LTD', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(20, 'HSBCLKLXXXX', '', 'Hongkong & Shanghai Banking Corp.', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(21, 'ICICLKLXXXX', '', 'ICICI Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(22, 'IDIBLKLCXXX', '', 'Indian Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(23, 'IOBALKLCXXX', '', 'Indian Overseas Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(24, 'MUCBLKLCXXX', '', 'Muslim Commercial Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(25, 'NDBSLKLXXXX', '', 'NDB Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(26, 'NSBFLKLXXXX', '', 'NSB Fund Management ', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(27, 'NTBCLKLXXXX', '', 'Nations Trust Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(28, 'NWSLLKLXXXX', '', 'NAT Wealth Securities', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(29, 'PABSLKLXXXX', '', 'Pan Asia Banking Corporation LTD.', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(30, 'PBBELKLXXXX', '', 'Public Bank Berhad', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(31, 'PPTLLKLXXXX', '', 'Perpetual Treasuries', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(32, 'PSBKLKLXXXX', '', 'People?s Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(33, 'SBINLKLXXXX', '', 'State Bank of India', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(34, 'SCBLLKLXXXX', '', 'Standard Chartered Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(35, 'SEYBLKLXXXX', '', 'Seylan Bank', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(36, 'UBCLLKLCXXX', '', 'Union Bank of Colombo', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM'),
(37, 'WTEYLKLXXXX', '', 'Wealth Trust Securities PVT LTD', 'LK', 'Sri Lanka', '', 0, '2021-03-16 13:38:04', 'SYSTEM', '2021-03-16 13:38:05', 'SYSTEM');



-- ==========================================================================================
-- DATE MODIFIED: 2021-03-22
-- USER: IT207317
-- ==========================================================================================

CREATE TABLE `templates` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `temp_ref` varchar(255) NOT NULL,
  `temp_name` varchar(255) NOT NULL,
  `temp_channel` varchar(45) NOT NULL,
  `temp_type` varchar(45) NOT NULL,
  `brcode` INT(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT 'SYSTEM',
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(45) DEFAULT 'SYSTEM',
  `ip_address` varchar(45) NOT NULL,
  `machine_name` varchar(255) NULL,
  PRIMARY KEY (`id`), UNIQUE (`temp_ref`, `temp_name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;