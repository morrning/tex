-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 26, 2017 at 03:26 PM
-- Server version: 5.7.20-0ubuntu0.17.10.1
-- PHP Version: 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_department`
--

CREATE TABLE `a_department` (
  `id` int(11) NOT NULL,
  `departmentName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upper` int(11) NOT NULL,
  `members` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_group`
--

CREATE TABLE `a_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bundle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `options` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `a_group`
--

INSERT INTO `a_group` (`id`, `group_name`, `des`, `bundle`, `options`) VALUES
(1, 'admins', 'گروه مدیران کل سامانه با دسترسی نا محدود', 'CORE', ''),
(2, 'standardUser', 'دسترسی عمومی به امکانات سامانه', 'CORE', ''),
(18, 'FaniGRPFaniHead', 'مدیریت فنی', 'faniBundle', '10'),
(19, 'FaniGRPContractual', 'امور قرارداد‌ها', 'faniBundle', '10'),
(20, 'FaniGRPMapping', 'نقشه برداری', 'faniBundle', '10'),
(21, 'FaniGRPPeymanResidegi', 'پیمان و رسیدگی', 'faniBundle', '10'),
(22, 'FaniGRPQC', 'کنترل کیفیت', 'faniBundle', '10'),
(23, 'FaniGRPViewer', 'ناظران پروژه', 'faniBundle', '10');

-- --------------------------------------------------------

--
-- Table structure for table `a_permission`
--

CREATE TABLE `a_permission` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bundle_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_status` int(11) NOT NULL,
  `options` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `a_permission`
--

INSERT INTO `a_permission` (`id`, `permission_name`, `bundle_name`, `group_id`, `permission_status`, `options`) VALUES
(1, 'SUPERADMIN', 'CORE', '1', 1, NULL),
(2, 'SUPERADMIN', 'faniBundle', '1', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `a_roll`
--

CREATE TABLE `a_roll` (
  `id` int(11) NOT NULL,
  `rollName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upper` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `user_cob_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `selected` tinyint(1) NOT NULL,
  `group_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `a_roll`
--

INSERT INTO `a_roll` (`id`, `rollName`, `upper`, `userID`, `user_cob_title`, `selected`, `group_id`) VALUES
(2, 'مدیر پشتیبانی سامانه', '0', 1, 'بابک علی زاده مدیر پشتیبانی سامانه', 1, '1'),
(6, 'مدیر عامل موسسه امید پارس', '0', 4, 'محمد شاهوردی,مدیر عامل موسسه امید پارس', 1, '2,22,18'),
(7, 'مدیر فنی و مهندسی موسسه امیدپارس', '6', 2, 'ادریس مهدیانی,مدیر فنی و مهندسی موسسه امیدپارس', 1, '2,18'),
(8, 'سرپرست کارگاه راه آهن درود خرم آباد', '9', 3, 'علی باقری,سرپرست کارگاه راه آهن درود خرم آباد', 1, '2'),
(9, 'مدیرپروژه راه آهن درود خرم آباد', '6', 5, 'منصور حمیدی ,مدیرپروژه راه آهن درود خرم آباد', 1, '2'),
(10, 'مدیر برنامه‌ریزی و کنترل‌پروژه موسسه امیدپارس', '6', 8, 'عباس میناخانی ,مدیر برنامه‌ریزی و کنترل‌پروژه موسسه امیدپارس', 1, '2'),
(11, 'مسئول برنامه‌ریزی و کنترل‌پروژه قطعه ۲ راه‌آهن درود‌خرم‌آباد', '8', 9, 'حسین ابدالی,مسئول برنامه‌ریزی و کنترل‌پروژه قطعه ۲ راه‌آهن درود‌خرم‌آباد', 1, '2'),
(12, 'مدیر فنی و مهندسی پروژه راه‌آهن درود‌خرم‌آباد', '8', 6, 'علی چگنی ,مدیر فنی و مهندسی پروژه راه‌آهن درود‌خرم‌آباد', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `a_users`
--

CREATE TABLE `a_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `online_guid` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `family_user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code_meli` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `org_num` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `a_users`
--

INSERT INTO `a_users` (`id`, `username`, `password`, `name_user`, `online_guid`, `family_user`, `code_meli`, `father_name`, `org_num`, `title`, `tel`, `full_name`, `image_id`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'بابک', '', 'علی زاده', '3320055267', 'رمضان', '410008', 'مهندس', '09183282405', 'مهندس بابک علی زاده', NULL),
(2, 'mahdiyani-ope', 'e10adc3949ba59abbe56e057f20f883e', 'ادریس', '', 'مهدیانی', '333333333333', 'امیر ارسلان', '14255555', 'مهندس', '091412547544', 'مهندس ادریس مهدیانی', NULL),
(3, 'bagheri-opa', 'e10adc3949ba59abbe56e057f20f883e', 'علی', NULL, 'باقری', '1111111111', 'ابراهیم', '410001', 'مهندس', '09120457845', 'مهندس علی باقری', NULL),
(4, 'shahverdi-opm', 'e10adc3949ba59abbe56e057f20f883e', 'محمد', NULL, 'شاهوردی', '332005527', 'علی', '410009', 'مهندس', '02181444001', 'مهندس محمد شاهوردی', NULL),
(5, 'hamidi-opm', 'e10adc3949ba59abbe56e057f20f883e', 'منصور', NULL, 'حمیدی', '3320055267', 'علی', '410008', 'مهندس', '09121254178', 'مهندس منصور حمیدی', NULL),
(6, 'chegeni-opa', 'e10adc3949ba59abbe56e057f20f883e', 'علی', NULL, 'چگنی', '0', 'علی', '410008', 'مهندس', '02181444001', 'مهندس علی چگنی', NULL),
(7, 'mosavi-ops', 'e10adc3949ba59abbe56e057f20f883e', 'سید تاج‌الدین', NULL, 'موسوی', '0', 'علی', '410008', 'مهندس', '02181444001', 'مهندس سید تاج‌الدین موسوی', NULL),
(8, 'minakhani-opa', 'e10adc3949ba59abbe56e057f20f883e', 'عباس', NULL, 'میناخانی', '0', 'علی', '410008', 'مهندس', '02181444001', 'مهندس عباس میناخانی', NULL),
(9, 'abdali-oph', 'e10adc3949ba59abbe56e057f20f883e', 'حسین', 'b01falsitver4nqr66uih9fq4i', 'ابدالی', '0', 'علی', '410008', 'مهندس', '02181444001', 'مهندس حسین ابدالی', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fani_progress`
--

CREATE TABLE `fani_progress` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `dateSubmit` int(11) NOT NULL,
  `progressP` int(11) NOT NULL,
  `progressR` int(11) NOT NULL,
  `progressB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fani_progress`
--

INSERT INTO `fani_progress` (`id`, `project`, `dateSubmit`, `progressP`, `progressR`, `progressB`) VALUES
(43, 10, 1385510400, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fani_project`
--

CREATE TABLE `fani_project` (
  `id` int(11) NOT NULL,
  `projectName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` longtext COLLATE utf8_unicode_ci,
  `startDate` int(11) NOT NULL,
  `employer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moshaverK` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moshaverP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateFinish` int(11) NOT NULL,
  `peymankar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grpfani_head` int(11) NOT NULL DEFAULT '0',
  `grpcontractual` int(11) NOT NULL DEFAULT '0',
  `grpmapping` int(11) NOT NULL DEFAULT '0',
  `grpqc` int(11) NOT NULL DEFAULT '0',
  `grppeyman_residegi` int(11) NOT NULL DEFAULT '0',
  `grpviewers` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fani_project`
--

INSERT INTO `fani_project` (`id`, `projectName`, `des`, `startDate`, `employer`, `moshaverK`, `moshaverP`, `dateFinish`, `peymankar`, `grpfani_head`, `grpcontractual`, `grpmapping`, `grpqc`, `grppeyman_residegi`, `grpviewers`) VALUES
(10, 'زیرسازی راه‌آهن درود-خرم‌آباد', NULL, 1385510400, 'وزارت راه و شهرسازی', 'مهندسین مشاور پارس', 'مهندسین مشاور مترا', 60, 'قرارگاه سازندگی خاتم‌النبیا(ص)-موسسه امیدپارس', 18, 19, 20, 22, 21, 23);

-- --------------------------------------------------------

--
-- Table structure for table `fani_situation`
--

CREATE TABLE `fani_situation` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `f1Amount` int(11) NOT NULL,
  `dateF1Amount` int(11) NOT NULL,
  `f2Amount` int(11) NOT NULL,
  `dateF2Amount` int(11) DEFAULT NULL,
  `f3Amount` int(11) NOT NULL,
  `dateF3Amount` int(11) DEFAULT NULL,
  `submiter` int(11) NOT NULL,
  `lastEdit` int(11) NOT NULL,
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_files`
--

CREATE TABLE `file_files` (
  `id` int(11) NOT NULL,
  `fileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileSize` int(11) NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fileType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submitDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file_files`
--

INSERT INTO `file_files` (`id`, `fileName`, `fileSize`, `permission`, `file`, `fileType`, `submitDate`) VALUES
(3, 'da454db6193a35457bd4d7977f3af4b1.txt', 14128, NULL, 'da454db6193a35457bd4d7977f3af4b1.txt', 'text/plain', 0),
(4, '542ab1d151d9a21b9418c7297242397d.jpeg', 298105, NULL, '542ab1d151d9a21b9418c7297242397d.jpeg', 'image/jpeg', 1513657098);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` int(11) NOT NULL,
  `reciver` int(11) NOT NULL,
  `dateSend` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateView` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SID` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_news`
--

CREATE TABLE `news_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `submiter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `submitDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_news`
--

INSERT INTO `news_news` (`id`, `title`, `body`, `img`, `submiter`, `submitDate`) VALUES
(1, 'راه اندازی آزمایشی سامانه', '<p>با لطف خداوند متعال امروز سامانه مدیریت کل به صورت آزمایشی راه اندازی شد.</p>', '0', '0', '1511592295'),
(2, 'توقف موقت سامانه', '<p>سامانه مدیریت کل به دلیل به روز رسانی به مدت چند ساعت در دسترس نخواهد بود</p>', '0', '0', '1511601039'),
(3, 'سامانه متمرکز پیشرفت در عملیات', '<p>به استحضار کاربران گرامی می رساند با توجه به نیاز قرارگاه سازندگی به ورود ابزار های ضروری به عرصه ظهور جهت پیشبرد اهداف سامانه پیشرفت در عملیات راه اندازی شده و از هم اکنون قابل استفاده می باشد.</p>', '0', '0', '1512481501'),
(4, 'چطور یکپارچه مدیریت کنیم', '<p>به زودی با این سبک از مدیریت آشنا خواهید شد</p>', '0', '0', '1512916908'),
(5, 'به روز رسانی سایت مدیریت پروژه ها', '<p>در کارتابل فنی به روز رسانی پیشرفت پروژه ها به روز شده و هم اکنون میتوان پیشرفت های ریالی فیزیکی و برنامه ای را برای هر یک ثبت نمود.</p>', '0', '0', '1513827335');

-- --------------------------------------------------------

--
-- Table structure for table `sys_configs`
--

CREATE TABLE `sys_configs` (
  `id` int(11) NOT NULL,
  `systemMessage` longtext COLLATE utf8_unicode_ci,
  `isOffline` tinyint(1) NOT NULL,
  `softwareVersion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `databaseVersion` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_configs`
--

INSERT INTO `sys_configs` (`id`, `systemMessage`, `isOffline`, `softwareVersion`, `databaseVersion`) VALUES
(1, '<ul>\r\n	<li>لطفا در صورت هر گونه مشکل در سامانه با پشتیبان سامانه تماس حاصل فرمایید.</li>\r\n	<li>شماره تلفن پشتیبانی (علی زاده)&nbsp; ۰۹۱۸۳۲۸۲۴۰۵</li>\r\n</ul>', 0, '1.1.9610', '1.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `sys_log`
--

CREATE TABLE `sys_log` (
  `id` int(11) NOT NULL,
  `logDes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bundleName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateSubmit` int(11) NOT NULL,
  `options` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_log`
--

INSERT INTO `sys_log` (`id`, `logDes`, `bundleName`, `dateSubmit`, `options`) VALUES
(51, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513361515, '2'),
(52, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513361530, '2'),
(53, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513361546, '2'),
(54, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513361559, '2'),
(55, 'admin وارد سیستم شد.', 'UserBundle', 1513400197, NULL),
(56, 'admin وارد سیستم شد.', 'UserBundle', 1513415532, NULL),
(57, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513486595, '2'),
(58, 'admin وارد سیستم شد.', 'UserBundle', 1513567429, NULL),
(59, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513825956, '4'),
(60, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513825966, '4'),
(61, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513827904, '4'),
(62, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513836172, '5'),
(63, 'اطلاعات پیشرفت پروژه به روز شد.', 'faniBundle', 1513842881, '8'),
(64, 'admin وارد سیستم شد.', 'UserBundle', 1513862072, NULL),
(65, 'admin وارد سیستم شد.', 'UserBundle', 1513942814, NULL),
(66, 'admin وارد سیستم شد.', 'UserBundle', 1514057379, NULL),
(67, 'admin وارد سیستم شد.', 'UserBundle', 1514150655, NULL),
(68, 'admin وارد سیستم شد.', 'UserBundle', 1514217300, NULL),
(69, 'admin وارد سیستم شد.', 'UserBundle', 1514298037, NULL),
(70, 'admin وارد سیستم شد.', 'UserBundle', 1514318894, NULL),
(71, 'abdali-oph وارد سیستم شد.', 'UserBundle', 1514319826, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_department`
--
ALTER TABLE `a_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_group`
--
ALTER TABLE `a_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_permission`
--
ALTER TABLE `a_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_roll`
--
ALTER TABLE `a_roll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_users`
--
ALTER TABLE `a_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fani_progress`
--
ALTER TABLE `fani_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fani_project`
--
ALTER TABLE `fani_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fani_situation`
--
ALTER TABLE `fani_situation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_files`
--
ALTER TABLE `file_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_news`
--
ALTER TABLE `news_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_configs`
--
ALTER TABLE `sys_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_log`
--
ALTER TABLE `sys_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_department`
--
ALTER TABLE `a_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `a_group`
--
ALTER TABLE `a_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `a_permission`
--
ALTER TABLE `a_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `a_roll`
--
ALTER TABLE `a_roll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `a_users`
--
ALTER TABLE `a_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `fani_progress`
--
ALTER TABLE `fani_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `fani_project`
--
ALTER TABLE `fani_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `fani_situation`
--
ALTER TABLE `fani_situation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `file_files`
--
ALTER TABLE `file_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news_news`
--
ALTER TABLE `news_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sys_configs`
--
ALTER TABLE `sys_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sys_log`
--
ALTER TABLE `sys_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
