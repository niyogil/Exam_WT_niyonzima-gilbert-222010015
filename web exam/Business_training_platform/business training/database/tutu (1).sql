-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(50) NOT NULL,
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Username`, `Email`, `Password`, `Image`) VALUES
(0, 'niyonzima', 'niyonzima@gmail.com', '$2y$10$6Nc42PFNxP.GsX/tSg7xYesQwDaWYg7I4Qn6HtSVWGW89gmYMHOoO', 0x75706c6f6164732f53637265656e73686f7420323032342d30352d3133203139353933372e706e67),
(1, 'Laurier HABIYAREMYE', 'laurier@gmail.com', '$2y$10$rYik6UeqXZ1HkMg17Gu6guoQLlSdB5so8ELv4ZPfv6PfYio8oTldm', 0x75706c6f6164732f74656163686572382e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `archivements`
--

CREATE TABLE `archivements` (
  `ArchivementID` int(11) NOT NULL,
  `UserID` int(10) NOT NULL,
  `ArchivementName` text NOT NULL,
  `ArchivementDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archivements`
--

INSERT INTO `archivements` (`ArchivementID`, `UserID`, `ArchivementName`, `ArchivementDate`) VALUES
(1, 1, 'Completion of courses', '2024-05-20'),
(2, 1, 'Completion of courses', '2024-05-20'),
(3, 1, 'Completion of courses', '2024-05-20'),
(4, 1, 'Completion of courses', '2024-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `AssessmentID` int(50) NOT NULL,
  `Title` text NOT NULL,
  `Question` text NOT NULL,
  `CorrectAnswer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`AssessmentID`, `Title`, `Question`, `CorrectAnswer`) VALUES
(1, 'Business', 'What is a business strategy?', 'A business strategy is a plan of action designed to achieve specific goals or objectives set by a company. It outlines how the organization will compete in the marketplace, allocate resources, and achieve sustainable growth and profitability.'),
(3, 'Digital Transformation Strategies', 'What are digital transformation strategies?', 'Digital transformation strategies are initiatives that leverage digital technologies to fundamentally change business operations, processes, and customer experiences to adapt to the evolving digital landscape.'),
(4, 'Introduction to SWOT Analysis', 'What is the purpose of SWOT analysis?', 'SWOT analysis is a strategic planning tool used to identify internal strengths and weaknesses, as well as external opportunities and threats, to inform business decisions.'),
(5, 'Operational Excellence and Efficiency', 'Define operational excellence and efficiency?', 'Operational excellence and efficiency refer to the consistent achievement of high performance and productivity through streamlined processes, optimal resource utilization, and continuous improvement initiatives.');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `name`, `course`, `date`) VALUES
(2, 'asd', 'asd', '2024-05-22'),
(3, 'asd', 'asd', '2024-05-22'),
(4, 'asd', 'asd', '2024-05-22'),
(5, 'asd', 'asd', '2024-05-22'),
(6, 'asd', 'asd', '2024-05-22'),
(7, 'asd', 'asd', '2024-05-22'),
(8, 'sd', 'hg', '2024-05-29'),
(9, 'sd', 'hg', '2024-05-29'),
(10, 'a', 'er', '2024-05-23'),
(11, 'sdfg', 'sdfg', '2024-05-23'),
(12, 'ngumire', 'business', '2024-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `InstructorID` varchar(100) NOT NULL,
  `Link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `Title`, `Description`, `InstructorID`, `Link`) VALUES
(1, 'Introduction to Business', 'It\'s been a while since I uploaded new content, but here\'s hoping I can stick to a schedule now that the fall semester is about to begin. In this lecture, I\'ll answer the question: What is a business? Dop answer this question will breakdown what separates a business from other organizations as a concept necessary for free-market businesses to thrive: the mutually beneficial exchange. Enjoy!', '1', 'https://youtu.be/UnQTs_q7Juo'),
(2, 'Financial Analysis for Strategic Decision Making', 'Learn how to use financial statements and metrics to inform strategic decisions. This course covers ratio analysis, financial forecasting, and valuation techniques.\r\n', '2', 'https://youtu.be/3W_LwpeG8c8'),
(3, 'Digital Transformation Strategies', ' Understand the impact of digital technologies on business models and strategies. Explore case studies and develop strategies for leading digital transformation initiatives.', '3', 'https://youtu.be/YmwftR4PQFM'),
(4, 'Competitive Market Analysis', 'Dive into methods for analyzing competitors and markets. Learn how to gather competitive intelligence and use it to shape strategic decisions.\r\n', '4', 'https://youtu.be/xaIeoPtHnuY'),
(5, 'Strategic Leadership and Management', 'This course focuses on the skills and practices required for effective strategic leadership. Topics include vision setting, change management, and organizational alignment.', '5', 'https://youtu.be/GT_NNu0JIMA'),
(6, 'Innovation and Entrepreneurship', 'Explore the role of innovation in business strategy. Learn how to foster an entrepreneurial mindset and create strategies for new product development and market entry.\r\n', '6', 'https://youtu.be/rLA-vVLNvws'),
(7, 'Global Business Strategies', 'Develop an understanding of the complexities of global markets. This course covers international market entry strategies, cross-cultural management, and global supply chain management.\r\n', '7', 'https://youtu.be/mEIqLcGxZRM'),
(8, 'Sustainable Business Strategies', 'Learn how to create strategies that balance economic performance with social and environmental responsibility. Topics include corporate social responsibility (CSR) and sustainable business models.', '8', 'https://youtu.be/ydPNQ7nTHyE'),
(9, 'Data-Driven Strategic Planning', 'Utilize data analytics to inform strategic planning. This course covers data collection, analysis, and the use of business intelligence tools to drive strategic decisions.\r\n', '9', 'https://youtu.be/lgCNTuLBMK4'),
(10, 'Crisis Management and Business Continuity', 'Prepare for and respond to business crises. Learn how to develop crisis management plans and ensure business continuity in the face of unexpected disruptions.', '10', 'https://youtu.be/eLVeP8wEUdI'),
(11, 'Customer-Centric Business Strategies', 'Focus on creating strategies that prioritize customer needs and experiences. Topics include customer journey mapping, loyalty programs, and personalized marketing strategies.\r\n', '11', 'https://youtu.be/O6Nj3kPoQt8'),
(12, 'Mergers and Acquisitions Strategy', ' Understand the strategic considerations and processes involved in mergers and acquisitions. Learn about valuation, negotiation, and integration planning.\r\n', '12', 'https://youtu.be/gup4KmPirLQ'),
(13, 'Strategic HR Management', 'Align human resources practices with business strategy. This course covers talent management, organizational culture, and strategic workforce planning.\r\n', '13', 'https://youtu.be/2A_YrAVJukI'),
(14, 'Operational Excellence and Efficiency', ' Learn how to improve operational processes to support strategic goals. Topics include lean management, Six Sigma, and process reengineering.', '14', 'https://youtu.be/4EDYfSl-fmc'),
(15, 'Blockchain and Business Strategy', 'Explore how blockchain technology can be integrated into business strategies. Learn about its applications in various industries and its potential to disrupt traditional business models.', '15', 'https://youtu.be/yubzJw0uiE4'),
(16, 'Introduction to SWOT Analysis', 'Description:\r\nSWOT Analysis is a powerful strategic planning tool that helps organizations identify their internal Strengths and Weaknesses, as well as external Opportunities and Threats. This course provides a comprehensive understanding of how to conduct a SWOT analysis effectively and how to use the insights gained to inform strategic decision-making.\r\n\r\nKey Learning Objectives:\r\n\r\nUnderstand the fundamentals of SWOT analysis and its importance in strategic planning.\r\nLearn how to identify and evaluate internal strengths and weaknesses within an organization.\r\nDiscover how to analyze external opportunities and threats that can impact business success.\r\nGain practical skills in conducting a SWOT analysis through real-world case studies and examples.\r\nDevelop strategies to leverage strengths, mitigate weaknesses, capitalize on opportunities, and counteract threats.\r\nIntegrate SWOT analysis into the broader strategic planning process to enhance business performance.\r\n\r\nCourse Outline:\r\n1.Introduction to SWOT Analysis:\r\n *Definition and purpose\r\n *Historical background and evolution\r\n *Benefits and limitations\r\n2.Identifying Strengths\r\n\r\n *Assessing internal capabilities and resources\r\n *Analyzing competitive advantages\r\n *Examples of common strengths in various industries\r\n3.Recognizing Weaknesses\r\n\r\n *Identifying internal areas for improvement\r\n *Evaluating operational inefficiencies and skill gaps\r\n *Examples of typical weaknesses in businesses\r\n3.Exploring Opportunities\r\n\r\n *Understanding market trends and industry shifts\r\n *Identifying new market segments and growth areas\r\n *Case studies of businesses that successfully capitalized on opportunities\r\n4.Assessing Threats\r\n\r\n *Analyzing external risks and challenges\r\n *Competitive threats and market saturation\r\n *Strategies for risk mitigation and management\r\n5.Conducting a SWOT Analysis\r\n\r\n *Step-by-step guide to conducting a thorough SWOT analysis\r\n *Tools and techniques for data collection and analysis\r\n *Interactive workshop with real-world scenarios\r\n6.Integrating SWOT Analysis into Strategic Planning\r\n\r\n *Developing strategic initiatives based on SWOT findings\r\n *Setting objectives and key performance indicators (KPIs)\r\n *Monitoring and adjusting strategies over time\r\n7.Case Studies and Practical Applications\r\n\r\n *In-depth analysis of successful SWOT implementations\r\n *Group discussions and presentations\r\n *Practical exercises to apply SWOT analysis in your organization\r\n\r\n\r\nBy the end of this course, participants will have a robust understanding of SWOT analysis and its application in strategic planning. They will be equipped with the skills to perform SWOT analyses and use the insights to drive business success and achieve competitive advantage.', '16', 'https://youtu.be/JXXHqM6RzZQ');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `EnrollmentID` int(50) NOT NULL,
  `UserID` int(50) NOT NULL,
  `CourseID` int(50) NOT NULL,
  `EnrollmentDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`EnrollmentID`, `UserID`, `CourseID`, `EnrollmentDate`) VALUES
(2, 1, 1, '2024-05-12 22:00:49.642329'),
(3, 1, 2, '2024-05-12 22:01:38.567401');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(50) NOT NULL,
  `UserID` int(50) NOT NULL,
  `Rating` text NOT NULL,
  `Comment` text NOT NULL,
  `FeedbackDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `UserID`, `Rating`, `Comment`, `FeedbackDate`) VALUES
(1, 1, '5', 'Thank you for the help', '2024-05-12 16:24:24.000000'),
(2, 1, '4', 'Thank you for the help', '2024-05-12 16:31:21.000000'),
(3, 1, '4', 'That\'s good for us', '2024-05-12 16:32:07.000000');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `GoalID` int(50) NOT NULL,
  `UserID` int(50) NOT NULL,
  `GoalAmount` text NOT NULL,
  `TargetDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`GoalID`, `UserID`, `GoalAmount`, `TargetDate`) VALUES
(1, 1, '8679', '2024-05-16 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `InstructorID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `Name`, `Email`, `Password`, `Bio`) VALUES
(4, 'James GATETE', 'james@gmail.com', '$2y$10$dVjF2YibrHtok9ihkrIY.OSWbuEDTkJxwH5ciEugxCnPmQDxOhKiK', 'Budgeting specialist and Data Analyst for 12 years'),
(5, 'Onana SOMBE', 'onana@gmail.com', '$2y$10$vF3HTyBHDjSqCABkHJpL2e/2tNEKS.soPJ1OgsDoAwlVp07UdIpgW', 'Specialist in salaries, goods and services, transfers and interest payments,'),
(0, 'kanigizi', 'kanigizi@gmail.com', '$2y$10$wXPafTpby8A.ziHQ57FWm.LyCQ0CLggE1UH.Gp4txf0.2t7HrTSBu', 'am here'),
(0, 'kanigizi', 'kanigizi@gmail.com', '$2y$10$9YpFGdo2EwX4fi.WBVIL0ehUSdAUlc9VRRbJI6I3sMofrTnsaLYMG', 'am here');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `title`, `url`, `description`, `created_at`) VALUES
(1, 'ddddd', 'http://localhost/Business_training_platform/business%20training/resources.php', 'hhdgywiu', '2024-05-19 23:43:02'),
(3, 'sdfg', 'http://localhost/Business_training_platform/business%20training/resources.php', 'dfgh', '2024-05-20 16:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(50) NOT NULL,
  `UserID` int(50) NOT NULL,
  `Amount` text NOT NULL,
  `Category` text NOT NULL,
  `TransactionDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `Notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `UserID`, `Amount`, `Category`, `TransactionDate`, `Notes`) VALUES
(1, 1, '65', 'Expense', '2024-05-11 22:00:00.000000', 'ANy'),
(2, 1, '65', 'Expense', '2024-05-11 22:00:00.000000', 'ANy'),
(3, 1, '65', 'Expense', '2024-05-11 22:00:00.000000', 'A'),
(4, 1, '76', 'Savings', '2024-05-11 22:00:00.000000', 'GTS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(50) NOT NULL,
  `Username` text NOT NULL,
  `Photo` blob NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `DateJoined` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Photo`, `Email`, `Password`, `DateJoined`) VALUES
(1, 'irakoze ', 0x75706c6f6164732f74656163686572362e6a7067, 'irakoze@gmail.com', 'irakoze12', '2024-05-12 14:44:40.129466'),
(2, 'bukayo', 0x75706c6f6164732f74656163686572362e6a7067, 'bukayo@gmail.com', 'bukayo12', '2024-05-12 22:06:40.416214'),
(0, 'kanigizi', 0x75706c6f6164732f312e6a706567, 'kanigizi@gmail.com', 'kanigizi12', '2024-05-20 19:14:07.789759'),
(0, 'nifa', '', 'nifa@gmail.com', '$2y$10$L3x67LrnKfptNJHZ69.mIeWpgcf/QO1eO8jABJr758LPc4iYJs.ai', '2024-05-21 23:48:54.800538'),
(0, 'nifa', '', 'nifa@gmail.com', '$2y$10$0sPUtGO3cW78eZ4VcSrZ8.tce9D/uex7X90JPRQbRedgbMWNKCWt2', '2024-05-21 23:49:23.965600'),
(0, 'nifa', '', 'nifaaa@gmail.com', '$2y$10$WRq97ddbHislpDbC4YZYvufj394iQXC6D/zE87TK9I8eSdyeGicXu', '2024-05-21 23:49:45.472434'),
(0, 'uwitonze', 0x75706c6f6164732f652e6a7067, 'uwitonze@gmail.com', 'uwitonze12', '2024-05-22 07:51:42.729958'),
(0, 'egide', 0x75706c6f6164732f642e6a7067, 'egide@gmail.com', 'egide123', '2024-05-22 08:41:59.397702'),
(0, 'kagabo', '', 'kagabo@gmail.com', '$2y$10$fP3OvHUqIW16FxYKZ3LhdOzMANNsX1iMDqo/0fnF4djJLt8qw466u', '2024-05-22 09:30:01.115019'),
(0, 'ngumire', 0x75706c6f6164732f642e6a7067, 'ngumire@gmail.com', 'ngumire', '2024-05-23 08:24:44.979949');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivements`
--
ALTER TABLE `archivements`
  ADD PRIMARY KEY (`ArchivementID`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archivements`
--
ALTER TABLE `archivements`
  MODIFY `ArchivementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
