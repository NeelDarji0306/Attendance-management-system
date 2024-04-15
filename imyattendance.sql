-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 08:50 AM
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
-- Database: `imyattendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityId` int(11) NOT NULL,
  `cityName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityId`, `cityName`) VALUES
(1, 'gujarat'),
(2, 'maharashtra'),
(3, 'uttarpradesh'),
(4, 'tamil nadu'),
(5, 'delhi'),
(10, 'hariyana');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `collegeId` int(11) NOT NULL,
  `collegeName` varchar(255) NOT NULL,
  `university_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`collegeId`, `collegeName`, `university_id`, `city_id`) VALUES
(1, 'AIT-Ahmedabad Institute of Technology', 1, 1),
(2, 'LDCE-Lalbhai Dalpatbhai college of Engineering', 1, 1),
(3, 'VGEC-Vishwakarma Government Engineering College', 1, 1),
(4, 'GIT Gandhinagar', 1, 1),
(5, 'LJ Institute of Engineering and Technology', 1, 1),
(6, 'ADIT-A. D. Patel Institute of Technology', 2, 1),
(7, 'GCET-G H Patel College of Engineering & Technology', 2, 1),
(8, 'MBIT-Madhuben & Bhanubhai Patel Institute of Technology', 2, 1),
(9, 'Walchand College of Engineering', 3, 2),
(10, 'KE Societys Rajarambapu Institute of Technology', 3, 2),
(11, 'Logic System Institute of Management and Information Technology', 4, 3),
(12, 'Loyola College', 5, 4),
(13, 'Deen Dayal Upadhyaya College', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `collegeattendance`
--

CREATE TABLE `collegeattendance` (
  `attendanceId` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `sem` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `laborlec` varchar(20) NOT NULL,
  `presentNumbers` text NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collegeattendance`
--

INSERT INTO `collegeattendance` (`attendanceId`, `date`, `department`, `sem`, `subject`, `laborlec`, `presentNumbers`, `teacher_id`, `college_id`) VALUES
(2, '2024-03-10', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601010, 12102040601012', 5, 6),
(3, '2024-03-12', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601010, 12102040601011, 12102040601009, 12102040601012, 12102040601001', 5, 6),
(4, '2024-03-13', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601010, 12102040601011, 12102040601009, 12102040601001', 5, 6),
(5, '2024-03-14', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601010, 12102040601011, 12102040601012, 12102040601001', 5, 6),
(6, '2024-03-15', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601010, 12102040601011, 12102040601009, 12102040601012, 12102040601001', 5, 6),
(7, '2024-03-16', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601010, 12102040601009, 12102040601012, 12102040601001', 5, 6),
(8, '2024-03-11', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601011, 12102040601009, 12102040601012, 12102040601001', 5, 6),
(9, '2024-03-17', 'computer engineering', 1, 'indian constitution', 'lec', '12102040601001, 12102040601010, 12102040601012', 5, 6),
(10, '2024-03-12', 'computer engineering', 1, 'calculus', 'lab', '12102040601001, 12102040601009, 12102040601010, 12102040601012', 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `collegeleaverequests`
--

CREATE TABLE `collegeleaverequests` (
  `leaveRequestId` int(11) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collegestudents`
--

CREATE TABLE `collegestudents` (
  `studentId` int(11) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `sem` int(11) NOT NULL,
  `rollNumber` bigint(20) NOT NULL,
  `phoneNumber` bigint(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collegestudents`
--

INSERT INTO `collegestudents` (`studentId`, `branch`, `sem`, `rollNumber`, `phoneNumber`, `user_id`) VALUES
(1, 'Computer Engineering', 1, 12102040601010, 9548625841, 2),
(2, 'Computer Engineering', 2, 12245120205010, 9856243610, 34),
(4, 'Computer Engineering', 1, 12102040601011, 9352102103, 42),
(5, 'Computer Engineering', 1, 12102040601009, 6354952102, 43),
(6, 'Computer Engineering', 1, 12102040601012, 6854296570, 44),
(7, 'Computer Engineering', 1, 12102040601001, 6954850213, 45);

-- --------------------------------------------------------

--
-- Table structure for table `collegeteachers`
--

CREATE TABLE `collegeteachers` (
  `teacherId` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `subjectTaught` text NOT NULL DEFAULT '<p style="color:red">Pending - Yet to be filled by teacher </p>',
  `phoneNumber` bigint(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collegeteachers`
--

INSERT INTO `collegeteachers` (`teacherId`, `department`, `subjectTaught`, `phoneNumber`, `user_id`) VALUES
(1, 'Computer Engineering', '[{\"sem\":\"1\",\"dep\":\"computer engineering\",\"laborlec\":\"lec\",\"sub\":\"indian constitution\",\"tid\":\"1\"}]', 9428661231, 4),
(5, 'Computer Engineering', '[{\"sem\":\"1\",\"dep\":\"computer engineering\",\"laborlec\":\"lab\",\"sub\":\"calculus\",\"tid\":\"5\"},{\"sem\":\"1\",\"dep\":\"computer engineering\",\"laborlec\":\"lec\",\"sub\":\"indian constitution\",\"tid\":\"5\"},{\"sem\":\"1\",\"dep\":\"computer engineering\",\"laborlec\":\"lec\",\"sub\":\"professional communication\",\"tid\":\"5\"}]', 6565247896, 19),
(6, 'Computer Engineering', '[{\"sem\":\"1\",\"dep\":\"computer engineering\",\"laborlec\":\"lec\",\"sub\":\"introduction to computer programming with c\",\"tid\":\"6\"}]', 9457615430, 23),
(8, 'Computer Engineering', '<p style=\"color:red\">Pending - Yet to be filled by teacher </p>', 9852165472, 29),
(12, 'Computer Engineering', '', 70070070, 38);

-- --------------------------------------------------------

--
-- Table structure for table `depsemsubasperuni`
--

CREATE TABLE `depsemsubasperuni` (
  `dep` varchar(255) NOT NULL,
  `sem` int(11) NOT NULL,
  `sub` text NOT NULL,
  `university_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `depsemsubasperuni`
--

INSERT INTO `depsemsubasperuni` (`dep`, `sem`, `sub`, `university_id`) VALUES
('Automobile Engineering', 1, 'programming for problem solving,basic electrical engineering,basic mechanical engineering,environmental science,physics,maths-I', 1),
('Automobile Engineering', 2, 'basic civil engineering,engineering graphics & design,maths-II,basic mechanical engineering2,workshop,english,chemistry', 1),
('Automobile Engineering', 3, 'effective technical communication,complex variable and partial differential equations,indian constitution,design engineerin 1 A,material science and metallurgy,engineering thermodynamics,kinematics and theory of machine', 1),
('Automobile Engineering', 4, 'design engineering 1 b,basic of automobile systems,automotive manufacturing processes and technology,fluid mechanics and fluid machines,fundamentals of machine design,orgainsational behaviour', 1),
('Automobile Engineering', 5, 'design engineering 2 a,contributor personality development program,transport management and laws,automobile engines,heat transfer,dynamics of machinery,oil hydraulics and pneumatics ', 1),
('Automobile Engineering', 6, 'design engineering 2 b,automobile chassis and body engineering,Alternative Fuel and Power Systems,Dynamics of Machinery,Computer Aided Design,Refrigeration and Air Conditioning', 1),
('Automobile Engineering', 7, 'Project,Vehicle Maintenance and Garage Practice (Dept Elec-I),Automobile Component Design,Vehicle Dynamics (Dept Elec-I),Vehicle Testing and Homologation,Transport Management & Laws2,Two and Three Wheeler Technology (Dept Elec-I),Oil Hydraulics and Pneumatics (Dept Elec-I)', 1),
('Automobile Engineering', 8, 'Project 2,Special Purpose Vehicle,Automobile System Design,Applied Industrual Engineering in Automobile,Computer Integrated Manufacturing in Automobile Industry (Dept Elec-II),Noise, Vibration and Harshness and Safety (Dept Elec-III),Automotive and Combustion Engine Technology (Dept Elec-III)', 1),
('Computer Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 1),
('Computer Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 1),
('Computer Engineering', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution,	Data Structures,Database Management Systems,	Digital Fundamentals,Advanced Engineering Mathematics,Engineering Economics and Managment', 1),
('Computer Engineering', 4, 'Operating System,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Numerical and Statistical Methods for Computer Engineering,Computer Networks,Design Engineering - I B', 1),
('Computer Engineering', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Microprocessor and Interfacing,	System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 1),
('Computer Engineering', 6, 'Design Engineering - II B,Software Engineering,Computer Graphics,Theory of Computation,Advanced Java,Web Technology,Embedded & VLSI Design,	Distributed Operating System,.Net Technology', 1),
('Computer Engineering', 7, 'Project,Complier Design,Information and Network Security,Mobile Computing and Wireless Communication,Image Processing,Service Oriented Computing,	Distributed DBMS,Data Mining and Business Intelligence', 1),
('Computer Engineering', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Big Data Analytics,Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 1),
('Civil Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 1),
('Civil Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 1),
('Civil Engineering', 3, 'Effective Technical Communication,Indian Constitution,Geotechnical Engineering,Building Constructiuon Technology,Mechanics Of Solids,Building and Town Planning', 1),
('Civil Engineering', 4, 'Design Engineering 1 B,SURVEYING,	Structural Analysis - I,Complex Variables and Partial Differential Equations,	Civil Engineering - Societal & Global Impact', 1),
('Civil Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Concrete Technology,Transportation Engineering,Design of Structures,Pavement Design and Highway construction,Structural analysis-II,Soil Mechanics,Pipeline Engineering,Remote Sensing and GIS,	Python Programming', 1),
('Civil Engineering', 6, 'Advanced Construction And Equipments,Applied Fluid Mechanics,	Railway, Bridge And Tunnel Engineering,Water & Waste Water Engineering,Elementary Structural Design,Urban Transportation System,	Design Engineering - II B', 1),
('Civil Engineering', 7, 'Project - I,Traffic Engineering,Design of Reinforced Concrete Structures,	Irrigation Engineering,Professional Practices & Valuation,Earthquake Engineering', 1),
('Civil Engineering', 8, 'Project -II,Foundation Engineering,Design of Steel Structures,Construction Management,Harbour & Airport Engineering', 1),
('Electrical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 1),
('Electrical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,	Basic Mechanical Engineering,Workshop,English,Chemistry', 1),
('Electrical Engineering', 3, 'Design Engineering 1 A,Effective Technical Communication,Indian Constitution,Control System Theory,Electrical Circuit Analysis,Analog and Digital Electronics,Applied Mathematics for Electrical Engineering', 1),
('Electrical Engineering', 4, 'Design Engineering-1B,Economics for Engineers,Electromagnetics Field,Electrical Machine- I,Power System- I,Power Electronics,Disaster Management(Inst. Elec.)', 1),
('Electrical Engineering', 5, 'Power Electronics – I,Microprocessor & Micro-controller Interfacing,Electrical Power System – I,Control System Engineeringl,Elements of Electrical Design,Design Engineering - II A,Cyber Security', 1),
('Electrical Engineering', 6, 'Power Electronics – II,Design of DC Machines & Transformer,High Voltage Engineering,Utilization of Electrical Enenrgy and Traction,Electrical Power System – II,Control of Electrical Drives,Design Engineering - II B', 1),
('Electrical Engineering', 7, 'Project - I,Interconnected Power System,Switch Gear and Protection,Design of AC Machines,Advanced Power Electronics', 1),
('Electrical Engineering', 8, 'Power System Planning And Design,Power System Operation And Control,Testing and Commissioning of Electrical Equipments,Power Quality and Management', 1),
('Electronics & Communication', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 1),
('Electronics & Communication', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 1),
('Electronics & Communication', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution,Design Engineering 1 A,Control Systems,Digital System Design,Network Theory', 1),
('Electronics & Communication', 4, 'Design Engineering,Analog Circuit Design,Signal and Systems,Professional Ethics,Microprocessor & Microcontroller,Electromagnetic Theory,Electromic Measurement Laboratory', 1),
('Electronics & Communication', 5, 'Design Engineering - II A,Cyber Security (Inst. Elec.),Disaster Management (Inst. Elec.),Microcontroller and Interfacing (EC),Engineering Electromagnetics,Electronic and Communication,Audio Video Systems,Mini Project', 1),
('Electronics & Communication', 6, 'Design Engineering - II B,Digital Communication,Antenna and Wave Propagation,Optical Communication (Dept Elec-I),Power Electronics Devices and Circuits (Dept Elec-I),VLSI Technology and Design,Advanced Microprocessor (Dept Elec-I),Telecommunication Switching Systems and Networks (Dept Elec-I)', 1),
('Electronics & Communication', 7, 'Project,Microwave Engineering,Digital Signal Processing (Dept Elec-II),Wireless Communication,Embedded Systems (Dept Elec-II),Satellite Communication (Dept Elec-II),Data Communication and Networking (Dept Elec-II),Biomedical Instrumentation (Dept Elec-II),Industrial Automation (Dept Elec-II)', 1),
('Electronics & Communication', 8, 'Fundamentals of Image Processing (Dept Elec - III),Radar & Navigational Aids (Dept Elec - III),Project II,Device Driver & Writing (Dept Elec - III),Testing And Verification (Dept Elec - III)', 1),
('Information Technology', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 1),
('Information Technology', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 1),
('Information Technology', 3, 'Effective Technical Communication,Design Engineering 1 A,Probability and Statistics,Indian Constitution,Data Structures,Database Management Systems,Digital Fundamentals', 1),
('Information Technology', 4, 'Operating System and Virtualization,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Design Engineering - I B', 1),
('Information Technology', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Computer Graphics,System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 1),
('Information Technology', 6, 'Design Engineering - II B,Software Engineering,Image Processing (Dept Elec-I),Data Compression and Data Retrieval,Advanced Java,Web Technology,Embedded & VLSI Design,Distributed Operating System,.Net Technology', 1),
('Information Technology', 7, 'Project,Information and Network Security,Mobile Computing and Wireless Communication,Big Data Analytics (Dept Elec-II),Service Oriented Computing,Distributed DBMS,Data Mining and Business Intelligence', 1),
('Information Technology', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Mutlimedia and Animation (Dept Elec - III),Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 1),
('Mechanical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 1),
('Mechanical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 1),
('Mechanical Engineering', 3, 'Effective Technical Communication,Complex Variables and Partial Differential Equations,Indian Constitution,Material Science And Metallurgy,Engineering Thermodynamics,Kinematics And Theory Of Machines', 1),
('Mechanical Engineering', 4, 'Design Engineering 1 B,Mechanical Measurement & Metrology,Fluid Mechanics,Machine Design & Industrial Drafting,Manufacturing Processes - II', 1),
('Mechanical Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Control Engineering,Heat Transfer,Operation Research,Dynamics of Machinery,Manufacturing Technology,Oil Hydraulics And Pneumatics', 1),
('Mechanical Engineering', 6, 'Dynamics of Machinery,Internal Combustion Engines,Computer Aided Design,Industrial Engineering,Refrigeration and Airconditioning,Production Technology,Design Engineering - II B', 1),
('Mechanical Engineering', 7, 'Project,Operation Research,Computer Aided Manufacturing,Machine Design,Power Plant Engineering,Oil Hydraulics and Pneumatics', 1),
('Mechanical Engineering', 8, 'Project - II,Renewable Energy Engineering,Product Design and Value Engineering (Departmental Elective II),Rapid Prototyping (Departmental Elective II),Quality Engineering (Departmental Elective II)', 1),
('Computer Engineering', 1, 'Calculus,Introduction to Computer Programming with C,Basics of Electrical and Electronics Engineering,Indian Constitution,Engineering Workshop,Professional Communication', 2),
('Computer Engineering', 2, 'Linear Algebra Vector Calculus and ODE,Object Oriented Programming,Basic Mechanical Engineering,Energy and Environment Science,Engineering Graphics,Physics', 2),
('Computer Engineering', 3, 'Indian Ethos and Value Education,Fundamentals of Economics and Business Management,Probability Statistics and Numerical Methods,Data Structures,Database Management Systems,Digital Fundamentals,Creativity Problem Solving and Innovation', 2),
('Computer Engineering', 4, 'Technical Writing and Soft Skills,Computer Organization & Architecture,Operating System,Programming With Java,Seminar,Discrete,Mathematics,Entrepreneur Skills ', 2),
('Computer Engineering', 5, 'Design and Analysis of Algorithms,Python for Data Science,Computer Networks,Web Development,Advanced Java Programming (Professional Elective – I),Computer Graphics (Professional Elective – I),Distributed Computing (Professional Elective – I),Energy Systems (Open Elective – I),Fuzzy Logic with Engineering Applications (Open Elective – I),Disaster Management (Open Elective – I),Project Management (Open Elective – I)', 2),
('Computer Engineering', 6, 'Software Engineering,Artificial Intelligence and Machine Learning,Microprocessor Technologies,.NET Technology (Professional Elective – II),Advanced Web Development (Professional Elective – II),Cyber Security (Professional Elective – II),Fuzzy Logic With Engineering Application (Open Elective – II),Supply Chain Management (Open Elective – II),Smart Cities Planning and Management (Open Elective – II),Multimedia Systems and Applications (Open Elective – II)', 2),
('Computer Engineering', 7, 'Summer Internship,Compiler Design,Information and Network Security,Internet of Things,Mobile Application Development (Professional Elective – III),Blockchain (Professional Elective – III),Big Data Analytics (Professional Elective – IV),Data Mining and Business Intelligence (Professional Elective – IV),UI-UX Design (Professional Elective – IV)', 2),
('Computer Engineering', 8, 'Industrial Internship,Industry-User Defined Project (UDP-IDP),Augmented Reality and Virtual Reality (Professional Elective Course – VI),Deep Learning and Applications (Professional Elective Course – V),Geographical Information Systems (Professional Elective Course – VI),High Performance Computing (Professional Elective Course – V),Introduction to Software Defined Networking (Professional Elective Course – V)', 2),
('Information Technology', 1, 'Basic of Electrical and Electronics Engineering,Calculus,Constitution of India,Engineering workshop,Computer Programming with C,Professional Communication', 2),
('Information Technology', 2, 'Basic Mechanical Engineering,Engineering Graphics,Linear Algebra Vector Calculus and ODE,Object Oriented Programming,Physics,Energy and Environment Science', 2),
('Information Technology', 3, 'Data Structures,Database Management Systems,Digital Fundamentals,Indian Ethos and Value Education,Fundamentals of Economics and Business Management,Probability Statistics and Numerical Methods,Creativity Problem Solving and Innovation', 2),
('Information Technology', 4, 'Computer Organization & Architecture,Operating System,Seminar,Technical Writing and Soft Skills,Entrepreneur Skills,Computer Network,Programming With Java', 2),
('Information Technology', 5, 'Design and Analysis of Algorithms,Software Engineering,Programming with Python,Web Development,Advanced Java Programming (Professional Elective Course – I),Cyber Security (Professional Elective Course – I),Artificial Intelligence (Professional Elective Course – I),Disaster Management (Open Elective – I),Energy Systems (Open Elective – I),Probability Theory with Applications (Open Elective – I),Project Management (Open Elective – I)', 2),
('Information Technology', 6, 'Mini Project,Information and Network Security,Machine Learning,Internet of Things,Data Mining and Business Intelligence (Professional Elective Course -II),Advanced Web Development (Professional Elective Course -II),Supply Chain Management (Open Elective – II),Multimedia Systems and Applications (Open Elective – II),Smart Cities Planning and Management (Open Elective – II)', 2),
('Information Technology', 7, 'Summer Training,Data Science and Visualization,Introduction to Cloud Computing,Mobile Application Development,Big Data Analytics (Professional Elective Course – III),UI/UX Design (Professional Elective Course – IV)', 2),
('Information Technology', 8, 'Industrial Internship,Industry-User Defined Project (UDP-IDP),Augmented Reality and Virtual Reality (Professional Elective Course – V),Geographical Information Systems (Professional Elective Course – V),High Performance Computing (Professional Elective Course – V),Introduction to Software Defined Networking (Professional Elective Course – VI),Natural Language Processing (Professional Elective Course – VI),Service Oriented Computing (Professional Elective Course – VI)', 2),
('Automobile Engineering', 1, 'programming for problem solving,basic electrical engineering,basic mechanical engineering,environmental science,physics,maths-I', 2),
('Automobile Engineering', 2, 'basic civil engineering,engineering graphics & design,maths-II,basic mechanical engineering2,workshop,english,chemistry', 2),
('Automobile Engineering', 3, 'effective technical communication,complex variable and partial differential equations,indian constitution,design engineerin 1 A,material science and metallurgy,engineering thermodynamics,kinematics and theory of machine', 2),
('Automobile Engineering', 4, 'design engineering 1 b,basic of automobile systems,automotive manufacturing processes and technology,fluid mechanics and fluid machines,fundamentals of machine design,orgainsational behaviour', 2),
('Automobile Engineering', 5, 'design engineering 2 a,contributor personality development program,transport management and laws,automobile engines,heat transfer,dynamics of machinery,oil hydraulics and pneumatics ', 2),
('Automobile Engineering', 6, 'design engineering 2 b,automobile chassis and body engineering,Alternative Fuel and Power Systems,Dynamics of Machinery,Computer Aided Design,Refrigeration and Air Conditioning', 2),
('Automobile Engineering', 7, 'Project,Vehicle Maintenance and Garage Practice (Dept Elec-I),Automobile Component Design,Vehicle Dynamics (Dept Elec-I),Vehicle Testing and Homologation,Transport Management & Laws2,Two and Three Wheeler Technology (Dept Elec-I),Oil Hydraulics and Pneumatics (Dept Elec-I)', 2),
('Automobile Engineering', 8, 'Project 2,Special Purpose Vehicle,Automobile System Design,Applied Industrual Engineering in Automobile,Computer Integrated Manufacturing in Automobile Industry (Dept Elec-II),Noise, Vibration and Harshness and Safety (Dept Elec-III),Automotive and Combustion Engine Technology (Dept Elec-III)', 2),
('Civil Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 2),
('Civil Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 2),
('Civil Engineering', 3, 'Effective Technical Communication,Indian Constitution,Geotechnical Engineering,Building Constructiuon Technology,Mechanics Of Solids,Building and Town Planning', 2),
('Civil Engineering', 4, 'Design Engineering 1 B,SURVEYING, Structural Analysis - I,Complex Variables and Partial Differential Equations, Civil Engineering - Societal & Global Impact', 2),
('Civil Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Concrete Technology,Transportation Engineering,Design of Structures,Pavement Design and Highway construction,Structural analysis-II,Soil Mechanics,Pipeline Engineering,Remote Sensing and GIS, Python Programming', 2),
('Civil Engineering', 6, 'Advanced Construction And Equipments,Applied Fluid Mechanics, Railway, Bridge And Tunnel Engineering,Water & Waste Water Engineering,Elementary Structural Design,Urban Transportation System, Design Engineering - II B', 2),
('Civil Engineering', 7, 'Project - I,Traffic Engineering,Design of Reinforced Concrete Structures, Irrigation Engineering,Professional Practices & Valuation,Earthquake Engineering', 2),
('Civil Engineering', 8, 'Project -II,Foundation Engineering,Design of Steel Structures,Construction Management,Harbour & Airport Engineering', 2),
('Electrical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 2),
('Electrical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II, Basic Mechanical Engineering,Workshop,English,Chemistry', 2),
('Electrical Engineering', 3, 'Design Engineering 1 A,Effective Technical Communication,Indian Constitution,Control System Theory,Electrical Circuit Analysis,Analog and Digital Electronics,Applied Mathematics for Electrical Engineering', 2),
('Electrical Engineering', 4, 'Design Engineering-1B,Economics for Engineers,Electromagnetics Field,Electrical Machine- I,Power System- I,Power Electronics,Disaster Management(Inst. Elec.)', 2),
('Electrical Engineering', 5, 'Power Electronics – I,Microprocessor & Micro-controller Interfacing,Electrical Power System – I,Control System Engineeringl,Elements of Electrical Design,Design Engineering - II A,Cyber Security', 2),
('Electrical Engineering', 6, 'Power Electronics – II,Design of DC Machines & Transformer,High Voltage Engineering,Utilization of Electrical Enenrgy and Traction,Electrical Power System – II,Control of Electrical Drives,Design Engineering - II B', 2),
('Electrical Engineering', 7, 'Project - I,Interconnected Power System,Switch Gear and Protection,Design of AC Machines,Advanced Power Electronics', 2),
('Electrical Engineering', 8, 'Power System Planning And Design,Power System Operation And Control,Testing and Commissioning of Electrical Equipments,Power Quality and Management', 2),
('Electronics & Communication', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 2),
('Electronics & Communication', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 2),
('Electronics & Communication', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution,Design Engineering 1 A,Control Systems,Digital System Design,Network Theory', 2),
('Electronics & Communication', 4, 'Design Engineering,Analog Circuit Design,Signal and Systems,Professional Ethics,Microprocessor & Microcontroller,Electromagnetic Theory,Electromic Measurement Laboratory', 2),
('Electronics & Communication', 5, 'Design Engineering - II A,Cyber Security (Inst. Elec.),Disaster Management (Inst. Elec.),Microcontroller and Interfacing (EC),Engineering Electromagnetics,Electronic and Communication,Audio Video Systems,Mini Project', 2),
('Electronics & Communication', 6, 'Design Engineering - II B,Digital Communication,Antenna and Wave Propagation,Optical Communication (Dept Elec-I),Power Electronics Devices and Circuits (Dept Elec-I),VLSI Technology and Design,Advanced Microprocessor (Dept Elec-I),Telecommunication Switching Systems and Networks (Dept Elec-I)', 2),
('Electronics & Communication', 7, 'Project,Microwave Engineering,Digital Signal Processing (Dept Elec-II),Wireless Communication,Embedded Systems (Dept Elec-II),Satellite Communication (Dept Elec-II),Data Communication and Networking (Dept Elec-II),Biomedical Instrumentation (Dept Elec-II),Industrial Automation (Dept Elec-II)', 2),
('Electronics & Communication', 8, 'Fundamentals of Image Processing (Dept Elec - III),Radar & Navigational Aids (Dept Elec - III),Project II,Device Driver & Writing (Dept Elec - III),Testing And Verification (Dept Elec - III)', 2),
('Mechanical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 2),
('Mechanical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 2),
('Mechanical Engineering', 3, 'Effective Technical Communication,Complex Variables and Partial Differential Equations,Indian Constitution,Material Science And Metallurgy,Engineering Thermodynamics,Kinematics And Theory Of Machines', 2),
('Mechanical Engineering', 4, 'Design Engineering 1 B,Mechanical Measurement & Metrology,Fluid Mechanics,Machine Design & Industrial Drafting,Manufacturing Processes - II', 2),
('Mechanical Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Control Engineering,Heat Transfer,Operation Research,Dynamics of Machinery,Manufacturing Technology,Oil Hydraulics And Pneumatics', 2),
('Mechanical Engineering', 6, 'Dynamics of Machinery,Internal Combustion Engines,Computer Aided Design,Industrial Engineering,Refrigeration and Airconditioning,Production Technology,Design Engineering - II B', 2),
('Mechanical Engineering', 7, 'Project,Operation Research,Computer Aided Manufacturing,Machine Design,Power Plant Engineering,Oil Hydraulics and Pneumatics', 2),
('Mechanical Engineering', 8, 'Project - II,Renewable Energy Engineering,Product Design and Value Engineering (Departmental Elective II),Rapid Prototyping (Departmental Elective II),Quality Engineering (Departmental Elective II)', 2),
('Automobile Engineering', 1, 'programming for problem solving,basic electrical engineering,basic mechanical engineering,environmental science,physics,maths-I', 3),
('Automobile Engineering', 2, 'basic civil engineering,engineering graphics & design,maths-II,basic mechanical engineering2,workshop,english,chemistry', 3),
('Automobile Engineering', 3, 'effective technical communication,complex variable and partial differential equations,indian constitution,design engineerin 1 A,material science and metallurgy,engineering thermodynamics,kinematics and theory of machine', 3),
('Automobile Engineering', 4, 'design engineering 1 b,basic of automobile systems,automotive manufacturing processes and technology,fluid mechanics and fluid machines,fundamentals of machine design,orgainsational behaviour', 3),
('Automobile Engineering', 5, 'design engineering 2 a,contributor personality development program,transport management and laws,automobile engines,heat transfer,dynamics of machinery,oil hydraulics and pneumatics ', 3),
('Automobile Engineering', 6, 'design engineering 2 b,automobile chassis and body engineering,Alternative Fuel and Power Systems,Dynamics of Machinery,Computer Aided Design,Refrigeration and Air Conditioning', 3),
('Automobile Engineering', 7, 'Project,Vehicle Maintenance and Garage Practice (Dept Elec-I),Automobile Component Design,Vehicle Dynamics (Dept Elec-I),Vehicle Testing and Homologation,Transport Management & Laws2,Two and Three Wheeler Technology (Dept Elec-I),Oil Hydraulics and Pneumatics (Dept Elec-I)', 3),
('Automobile Engineering', 8, 'Project 2,Special Purpose Vehicle,Automobile System Design,Applied Industrual Engineering in Automobile,Computer Integrated Manufacturing in Automobile Industry (Dept Elec-II),Noise, Vibration and Harshness and Safety (Dept Elec-III),Automotive and Combustion Engine Technology (Dept Elec-III)', 3),
('Computer Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 3),
('Computer Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 3),
('Computer Engineering', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution, Data Structures,Database Management Systems, Digital Fundamentals,Advanced Engineering Mathematics,Engineering Economics and Managment', 3),
('Computer Engineering', 4, 'Operating System,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Numerical and Statistical Methods for Computer Engineering,Computer Networks,Design Engineering - I B', 3),
('Computer Engineering', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Microprocessor and Interfacing, System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 3),
('Computer Engineering', 6, 'Design Engineering - II B,Software Engineering,Computer Graphics,Theory of Computation,Advanced Java,Web Technology,Embedded & VLSI Design, Distributed Operating System,.Net Technology', 3),
('Computer Engineering', 7, 'Project,Complier Design,Information and Network Security,Mobile Computing and Wireless Communication,Image Processing,Service Oriented Computing, Distributed DBMS,Data Mining and Business Intelligence', 3),
('Computer Engineering', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Big Data Analytics,Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 3),
('Civil Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 3),
('Civil Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 3),
('Civil Engineering', 3, 'Effective Technical Communication,Indian Constitution,Geotechnical Engineering,Building Constructiuon Technology,Mechanics Of Solids,Building and Town Planning', 3),
('Civil Engineering', 4, 'Design Engineering 1 B,SURVEYING, Structural Analysis - I,Complex Variables and Partial Differential Equations, Civil Engineering - Societal & Global Impact', 3),
('Civil Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Concrete Technology,Transportation Engineering,Design of Structures,Pavement Design and Highway construction,Structural analysis-II,Soil Mechanics,Pipeline Engineering,Remote Sensing and GIS, Python Programming', 3),
('Civil Engineering', 6, 'Advanced Construction And Equipments,Applied Fluid Mechanics, Railway, Bridge And Tunnel Engineering,Water & Waste Water Engineering,Elementary Structural Design,Urban Transportation System, Design Engineering - II B', 3),
('Civil Engineering', 7, 'Project - I,Traffic Engineering,Design of Reinforced Concrete Structures, Irrigation Engineering,Professional Practices & Valuation,Earthquake Engineering', 3),
('Civil Engineering', 8, 'Project -II,Foundation Engineering,Design of Steel Structures,Construction Management,Harbour & Airport Engineering', 3),
('Electrical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 3),
('Electrical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II, Basic Mechanical Engineering,Workshop,English,Chemistry', 3),
('Electrical Engineering', 3, 'Design Engineering 1 A,Effective Technical Communication,Indian Constitution,Control System Theory,Electrical Circuit Analysis,Analog and Digital Electronics,Applied Mathematics for Electrical Engineering', 3),
('Electrical Engineering', 4, 'Design Engineering-1B,Economics for Engineers,Electromagnetics Field,Electrical Machine- I,Power System- I,Power Electronics,Disaster Management(Inst. Elec.)', 3),
('Electrical Engineering', 5, 'Power Electronics – I,Microprocessor & Micro-controller Interfacing,Electrical Power System – I,Control System Engineeringl,Elements of Electrical Design,Design Engineering - II A,Cyber Security', 3),
('Electrical Engineering', 6, 'Power Electronics – II,Design of DC Machines & Transformer,High Voltage Engineering,Utilization of Electrical Enenrgy and Traction,Electrical Power System – II,Control of Electrical Drives,Design Engineering - II B', 3),
('Electrical Engineering', 7, 'Project - I,Interconnected Power System,Switch Gear and Protection,Design of AC Machines,Advanced Power Electronics', 3),
('Electrical Engineering', 8, 'Power System Planning And Design,Power System Operation And Control,Testing and Commissioning of Electrical Equipments,Power Quality and Management', 3),
('Electronics & Communication', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 3),
('Electronics & Communication', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 3),
('Electronics & Communication', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution,Design Engineering 1 A,Control Systems,Digital System Design,Network Theory', 3),
('Electronics & Communication', 4, 'Design Engineering,Analog Circuit Design,Signal and Systems,Professional Ethics,Microprocessor & Microcontroller,Electromagnetic Theory,Electromic Measurement Laboratory', 3),
('Electronics & Communication', 5, 'Design Engineering - II A,Cyber Security (Inst. Elec.),Disaster Management (Inst. Elec.),Microcontroller and Interfacing (EC),Engineering Electromagnetics,Electronic and Communication,Audio Video Systems,Mini Project', 3),
('Electronics & Communication', 6, 'Design Engineering - II B,Digital Communication,Antenna and Wave Propagation,Optical Communication (Dept Elec-I),Power Electronics Devices and Circuits (Dept Elec-I),VLSI Technology and Design,Advanced Microprocessor (Dept Elec-I),Telecommunication Switching Systems and Networks (Dept Elec-I)', 3),
('Electronics & Communication', 7, 'Project,Microwave Engineering,Digital Signal Processing (Dept Elec-II),Wireless Communication,Embedded Systems (Dept Elec-II),Satellite Communication (Dept Elec-II),Data Communication and Networking (Dept Elec-II),Biomedical Instrumentation (Dept Elec-II),Industrial Automation (Dept Elec-II)', 3),
('Electronics & Communication', 8, 'Fundamentals of Image Processing (Dept Elec - III),Radar & Navigational Aids (Dept Elec - III),Project II,Device Driver & Writing (Dept Elec - III),Testing And Verification (Dept Elec - III)', 3),
('Information Technology', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 3),
('Information Technology', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 3),
('Information Technology', 3, 'Effective Technical Communication,Design Engineering 1 A,Probability and Statistics,Indian Constitution,Data Structures,Database Management Systems,Digital Fundamentals', 3),
('Information Technology', 4, 'Operating System and Virtualization,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Design Engineering - I B', 3),
('Information Technology', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Computer Graphics,System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 3),
('Information Technology', 6, 'Design Engineering - II B,Software Engineering,Image Processing (Dept Elec-I),Data Compression and Data Retrieval,Advanced Java,Web Technology,Embedded & VLSI Design,Distributed Operating System,.Net Technology', 3),
('Information Technology', 7, 'Project,Information and Network Security,Mobile Computing and Wireless Communication,Big Data Analytics (Dept Elec-II),Service Oriented Computing,Distributed DBMS,Data Mining and Business Intelligence', 3),
('Information Technology', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Mutlimedia and Animation (Dept Elec - III),Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 3),
('Mechanical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 3),
('Mechanical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 3),
('Mechanical Engineering', 3, 'Effective Technical Communication,Complex Variables and Partial Differential Equations,Indian Constitution,Material Science And Metallurgy,Engineering Thermodynamics,Kinematics And Theory Of Machines', 3),
('Mechanical Engineering', 4, 'Design Engineering 1 B,Mechanical Measurement & Metrology,Fluid Mechanics,Machine Design & Industrial Drafting,Manufacturing Processes - II', 3),
('Mechanical Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Control Engineering,Heat Transfer,Operation Research,Dynamics of Machinery,Manufacturing Technology,Oil Hydraulics And Pneumatics', 3),
('Mechanical Engineering', 6, 'Dynamics of Machinery,Internal Combustion Engines,Computer Aided Design,Industrial Engineering,Refrigeration and Airconditioning,Production Technology,Design Engineering - II B', 3),
('Mechanical Engineering', 7, 'Project,Operation Research,Computer Aided Manufacturing,Machine Design,Power Plant Engineering,Oil Hydraulics and Pneumatics', 3),
('Mechanical Engineering', 8, 'Project - II,Renewable Energy Engineering,Product Design and Value Engineering (Departmental Elective II),Rapid Prototyping (Departmental Elective II),Quality Engineering (Departmental Elective II)', 3),
('Automobile Engineering', 1, 'programming for problem solving,basic electrical engineering,basic mechanical engineering,environmental science,physics,maths-I', 4),
('Automobile Engineering', 2, 'basic civil engineering,engineering graphics & design,maths-II,basic mechanical engineering2,workshop,english,chemistry', 4),
('Automobile Engineering', 3, 'effective technical communication,complex variable and partial differential equations,indian constitution,design engineerin 1 A,material science and metallurgy,engineering thermodynamics,kinematics and theory of machine', 4),
('Automobile Engineering', 4, 'design engineering 1 b,basic of automobile systems,automotive manufacturing processes and technology,fluid mechanics and fluid machines,fundamentals of machine design,orgainsational behaviour', 4),
('Automobile Engineering', 5, 'design engineering 2 a,contributor personality development program,transport management and laws,automobile engines,heat transfer,dynamics of machinery,oil hydraulics and pneumatics ', 4),
('Automobile Engineering', 6, 'design engineering 2 b,automobile chassis and body engineering,Alternative Fuel and Power Systems,Dynamics of Machinery,Computer Aided Design,Refrigeration and Air Conditioning', 4),
('Automobile Engineering', 7, 'Project,Vehicle Maintenance and Garage Practice (Dept Elec-I),Automobile Component Design,Vehicle Dynamics (Dept Elec-I),Vehicle Testing and Homologation,Transport Management & Laws2,Two and Three Wheeler Technology (Dept Elec-I),Oil Hydraulics and Pneumatics (Dept Elec-I)', 4),
('Automobile Engineering', 8, 'Project 2,Special Purpose Vehicle,Automobile System Design,Applied Industrual Engineering in Automobile,Computer Integrated Manufacturing in Automobile Industry (Dept Elec-II),Noise, Vibration and Harshness and Safety (Dept Elec-III),Automotive and Combustion Engine Technology (Dept Elec-III)', 4),
('Computer Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 4),
('Computer Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 4),
('Computer Engineering', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution, Data Structures,Database Management Systems, Digital Fundamentals,Advanced Engineering Mathematics,Engineering Economics and Managment', 4),
('Computer Engineering', 4, 'Operating System,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Numerical and Statistical Methods for Computer Engineering,Computer Networks,Design Engineering - I B', 4),
('Computer Engineering', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Microprocessor and Interfacing, System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 4),
('Computer Engineering', 6, 'Design Engineering - II B,Software Engineering,Computer Graphics,Theory of Computation,Advanced Java,Web Technology,Embedded & VLSI Design, Distributed Operating System,.Net Technology', 4),
('Computer Engineering', 7, 'Project,Complier Design,Information and Network Security,Mobile Computing and Wireless Communication,Image Processing,Service Oriented Computing, Distributed DBMS,Data Mining and Business Intelligence', 4),
('Computer Engineering', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Big Data Analytics,Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 4),
('Civil Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 4),
('Civil Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 4),
('Civil Engineering', 3, 'Effective Technical Communication,Indian Constitution,Geotechnical Engineering,Building Constructiuon Technology,Mechanics Of Solids,Building and Town Planning', 4),
('Civil Engineering', 4, 'Design Engineering 1 B,SURVEYING, Structural Analysis - I,Complex Variables and Partial Differential Equations, Civil Engineering - Societal & Global Impact', 4),
('Civil Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Concrete Technology,Transportation Engineering,Design of Structures,Pavement Design and Highway construction,Structural analysis-II,Soil Mechanics,Pipeline Engineering,Remote Sensing and GIS, Python Programming', 4),
('Civil Engineering', 6, 'Advanced Construction And Equipments,Applied Fluid Mechanics, Railway, Bridge And Tunnel Engineering,Water & Waste Water Engineering,Elementary Structural Design,Urban Transportation System, Design Engineering - II B', 4),
('Civil Engineering', 7, 'Project - I,Traffic Engineering,Design of Reinforced Concrete Structures, Irrigation Engineering,Professional Practices & Valuation,Earthquake Engineering', 4),
('Civil Engineering', 8, 'Project -II,Foundation Engineering,Design of Steel Structures,Construction Management,Harbour & Airport Engineering', 4),
('Electrical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 4),
('Electrical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II, Basic Mechanical Engineering,Workshop,English,Chemistry', 4),
('Electrical Engineering', 3, 'Design Engineering 1 A,Effective Technical Communication,Indian Constitution,Control System Theory,Electrical Circuit Analysis,Analog and Digital Electronics,Applied Mathematics for Electrical Engineering', 4),
('Electrical Engineering', 4, 'Design Engineering-1B,Economics for Engineers,Electromagnetics Field,Electrical Machine- I,Power System- I,Power Electronics,Disaster Management(Inst. Elec.)', 4),
('Electrical Engineering', 5, 'Power Electronics – I,Microprocessor & Micro-controller Interfacing,Electrical Power System – I,Control System Engineeringl,Elements of Electrical Design,Design Engineering - II A,Cyber Security', 4),
('Electrical Engineering', 6, 'Power Electronics – II,Design of DC Machines & Transformer,High Voltage Engineering,Utilization of Electrical Enenrgy and Traction,Electrical Power System – II,Control of Electrical Drives,Design Engineering - II B', 4),
('Electrical Engineering', 7, 'Project - I,Interconnected Power System,Switch Gear and Protection,Design of AC Machines,Advanced Power Electronics', 4),
('Electrical Engineering', 8, 'Power System Planning And Design,Power System Operation And Control,Testing and Commissioning of Electrical Equipments,Power Quality and Management', 4),
('Electronics & Communication', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 4),
('Electronics & Communication', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 4),
('Electronics & Communication', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution,Design Engineering 1 A,Control Systems,Digital System Design,Network Theory', 4),
('Electronics & Communication', 4, 'Design Engineering,Analog Circuit Design,Signal and Systems,Professional Ethics,Microprocessor & Microcontroller,Electromagnetic Theory,Electromic Measurement Laboratory', 4),
('Electronics & Communication', 5, 'Design Engineering - II A,Cyber Security (Inst. Elec.),Disaster Management (Inst. Elec.),Microcontroller and Interfacing (EC),Engineering Electromagnetics,Electronic and Communication,Audio Video Systems,Mini Project', 4),
('Electronics & Communication', 6, 'Design Engineering - II B,Digital Communication,Antenna and Wave Propagation,Optical Communication (Dept Elec-I),Power Electronics Devices and Circuits (Dept Elec-I),VLSI Technology and Design,Advanced Microprocessor (Dept Elec-I),Telecommunication Switching Systems and Networks (Dept Elec-I)', 4),
('Electronics & Communication', 7, 'Project,Microwave Engineering,Digital Signal Processing (Dept Elec-II),Wireless Communication,Embedded Systems (Dept Elec-II),Satellite Communication (Dept Elec-II),Data Communication and Networking (Dept Elec-II),Biomedical Instrumentation (Dept Elec-II),Industrial Automation (Dept Elec-II)', 4),
('Electronics & Communication', 8, 'Fundamentals of Image Processing (Dept Elec - III),Radar & Navigational Aids (Dept Elec - III),Project II,Device Driver & Writing (Dept Elec - III),Testing And Verification (Dept Elec - III)', 4),
('Information Technology', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 4),
('Information Technology', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 4),
('Information Technology', 3, 'Effective Technical Communication,Design Engineering 1 A,Probability and Statistics,Indian Constitution,Data Structures,Database Management Systems,Digital Fundamentals', 4),
('Information Technology', 4, 'Operating System and Virtualization,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Design Engineering - I B', 4),
('Information Technology', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Computer Graphics,System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 4),
('Information Technology', 6, 'Design Engineering - II B,Software Engineering,Image Processing (Dept Elec-I),Data Compression and Data Retrieval,Advanced Java,Web Technology,Embedded & VLSI Design,Distributed Operating System,.Net Technology', 4),
('Information Technology', 7, 'Project,Information and Network Security,Mobile Computing and Wireless Communication,Big Data Analytics (Dept Elec-II),Service Oriented Computing,Distributed DBMS,Data Mining and Business Intelligence', 4),
('Information Technology', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Mutlimedia and Animation (Dept Elec - III),Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 4),
('Mechanical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 4),
('Mechanical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 4),
('Mechanical Engineering', 3, 'Effective Technical Communication,Complex Variables and Partial Differential Equations,Indian Constitution,Material Science And Metallurgy,Engineering Thermodynamics,Kinematics And Theory Of Machines', 4),
('Mechanical Engineering', 4, 'Design Engineering 1 B,Mechanical Measurement & Metrology,Fluid Mechanics,Machine Design & Industrial Drafting,Manufacturing Processes - II', 4),
('Mechanical Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Control Engineering,Heat Transfer,Operation Research,Dynamics of Machinery,Manufacturing Technology,Oil Hydraulics And Pneumatics', 4),
('Mechanical Engineering', 6, 'Dynamics of Machinery,Internal Combustion Engines,Computer Aided Design,Industrial Engineering,Refrigeration and Airconditioning,Production Technology,Design Engineering - II B', 4),
('Mechanical Engineering', 7, 'Project,Operation Research,Computer Aided Manufacturing,Machine Design,Power Plant Engineering,Oil Hydraulics and Pneumatics', 4),
('Mechanical Engineering', 8, 'Project - II,Renewable Energy Engineering,Product Design and Value Engineering (Departmental Elective II),Rapid Prototyping (Departmental Elective II),Quality Engineering (Departmental Elective II)', 4),
('Automobile Engineering', 1, 'programming for problem solving,basic electrical engineering,basic mechanical engineering,environmental science,physics,maths-I', 5);
INSERT INTO `depsemsubasperuni` (`dep`, `sem`, `sub`, `university_id`) VALUES
('Automobile Engineering', 2, 'basic civil engineering,engineering graphics & design,maths-II,basic mechanical engineering2,workshop,english,chemistry', 5),
('Automobile Engineering', 3, 'effective technical communication,complex variable and partial differential equations,indian constitution,design engineerin 1 A,material science and metallurgy,engineering thermodynamics,kinematics and theory of machine', 5),
('Automobile Engineering', 4, 'design engineering 1 b,basic of automobile systems,automotive manufacturing processes and technology,fluid mechanics and fluid machines,fundamentals of machine design,orgainsational behaviour', 5),
('Automobile Engineering', 5, 'design engineering 2 a,contributor personality development program,transport management and laws,automobile engines,heat transfer,dynamics of machinery,oil hydraulics and pneumatics ', 5),
('Automobile Engineering', 6, 'design engineering 2 b,automobile chassis and body engineering,Alternative Fuel and Power Systems,Dynamics of Machinery,Computer Aided Design,Refrigeration and Air Conditioning', 5),
('Automobile Engineering', 7, 'Project,Vehicle Maintenance and Garage Practice (Dept Elec-I),Automobile Component Design,Vehicle Dynamics (Dept Elec-I),Vehicle Testing and Homologation,Transport Management & Laws2,Two and Three Wheeler Technology (Dept Elec-I),Oil Hydraulics and Pneumatics (Dept Elec-I)', 5),
('Automobile Engineering', 8, 'Project 2,Special Purpose Vehicle,Automobile System Design,Applied Industrual Engineering in Automobile,Computer Integrated Manufacturing in Automobile Industry (Dept Elec-II),Noise, Vibration and Harshness and Safety (Dept Elec-III),Automotive and Combustion Engine Technology (Dept Elec-III)', 5),
('Computer Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 5),
('Computer Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 5),
('Computer Engineering', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution, Data Structures,Database Management Systems, Digital Fundamentals,Advanced Engineering Mathematics,Engineering Economics and Managment', 5),
('Computer Engineering', 4, 'Operating System,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Numerical and Statistical Methods for Computer Engineering,Computer Networks,Design Engineering - I B', 5),
('Computer Engineering', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Microprocessor and Interfacing, System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 5),
('Computer Engineering', 6, 'Design Engineering - II B,Software Engineering,Computer Graphics,Theory of Computation,Advanced Java,Web Technology,Embedded & VLSI Design, Distributed Operating System,.Net Technology', 5),
('Computer Engineering', 7, 'Project,Complier Design,Information and Network Security,Mobile Computing and Wireless Communication,Image Processing,Service Oriented Computing, Distributed DBMS,Data Mining and Business Intelligence', 5),
('Computer Engineering', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Big Data Analytics,Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 5),
('Civil Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 5),
('Civil Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 5),
('Civil Engineering', 3, 'Effective Technical Communication,Indian Constitution,Geotechnical Engineering,Building Constructiuon Technology,Mechanics Of Solids,Building and Town Planning', 5),
('Civil Engineering', 4, 'Design Engineering 1 B,SURVEYING, Structural Analysis - I,Complex Variables and Partial Differential Equations, Civil Engineering - Societal & Global Impact', 5),
('Civil Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Concrete Technology,Transportation Engineering,Design of Structures,Pavement Design and Highway construction,Structural analysis-II,Soil Mechanics,Pipeline Engineering,Remote Sensing and GIS, Python Programming', 5),
('Civil Engineering', 6, 'Advanced Construction And Equipments,Applied Fluid Mechanics, Railway, Bridge And Tunnel Engineering,Water & Waste Water Engineering,Elementary Structural Design,Urban Transportation System, Design Engineering - II B', 5),
('Civil Engineering', 7, 'Project - I,Traffic Engineering,Design of Reinforced Concrete Structures, Irrigation Engineering,Professional Practices & Valuation,Earthquake Engineering', 5),
('Civil Engineering', 8, 'Project -II,Foundation Engineering,Design of Steel Structures,Construction Management,Harbour & Airport Engineering', 5),
('Electrical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 5),
('Electrical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II, Basic Mechanical Engineering,Workshop,English,Chemistry', 5),
('Electrical Engineering', 3, 'Design Engineering 1 A,Effective Technical Communication,Indian Constitution,Control System Theory,Electrical Circuit Analysis,Analog and Digital Electronics,Applied Mathematics for Electrical Engineering', 5),
('Electrical Engineering', 4, 'Design Engineering-1B,Economics for Engineers,Electromagnetics Field,Electrical Machine- I,Power System- I,Power Electronics,Disaster Management(Inst. Elec.)', 5),
('Electrical Engineering', 5, 'Power Electronics – I,Microprocessor & Micro-controller Interfacing,Electrical Power System – I,Control System Engineeringl,Elements of Electrical Design,Design Engineering - II A,Cyber Security', 5),
('Electrical Engineering', 6, 'Power Electronics – II,Design of DC Machines & Transformer,High Voltage Engineering,Utilization of Electrical Enenrgy and Traction,Electrical Power System – II,Control of Electrical Drives,Design Engineering - II B', 5),
('Electrical Engineering', 7, 'Project - I,Interconnected Power System,Switch Gear and Protection,Design of AC Machines,Advanced Power Electronics', 5),
('Electrical Engineering', 8, 'Power System Planning And Design,Power System Operation And Control,Testing and Commissioning of Electrical Equipments,Power Quality and Management', 5),
('Electronics & Communication', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 5),
('Electronics & Communication', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 5),
('Electronics & Communication', 3, 'Effective Technical Communication,Probability and Statistics,Indian Constitution,Design Engineering 1 A,Control Systems,Digital System Design,Network Theory', 5),
('Electronics & Communication', 4, 'Design Engineering,Analog Circuit Design,Signal and Systems,Professional Ethics,Microprocessor & Microcontroller,Electromagnetic Theory,Electromic Measurement Laboratory', 5),
('Electronics & Communication', 5, 'Design Engineering - II A,Cyber Security (Inst. Elec.),Disaster Management (Inst. Elec.),Microcontroller and Interfacing (EC),Engineering Electromagnetics,Electronic and Communication,Audio Video Systems,Mini Project', 5),
('Electronics & Communication', 6, 'Design Engineering - II B,Digital Communication,Antenna and Wave Propagation,Optical Communication (Dept Elec-I),Power Electronics Devices and Circuits (Dept Elec-I),VLSI Technology and Design,Advanced Microprocessor (Dept Elec-I),Telecommunication Switching Systems and Networks (Dept Elec-I)', 5),
('Electronics & Communication', 7, 'Project,Microwave Engineering,Digital Signal Processing (Dept Elec-II),Wireless Communication,Embedded Systems (Dept Elec-II),Satellite Communication (Dept Elec-II),Data Communication and Networking (Dept Elec-II),Biomedical Instrumentation (Dept Elec-II),Industrial Automation (Dept Elec-II)', 5),
('Electronics & Communication', 8, 'Fundamentals of Image Processing (Dept Elec - III),Radar & Navigational Aids (Dept Elec - III),Project II,Device Driver & Writing (Dept Elec - III),Testing And Verification (Dept Elec - III)', 5),
('Information Technology', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 5),
('Information Technology', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 5),
('Information Technology', 3, 'Effective Technical Communication,Design Engineering 1 A,Probability and Statistics,Indian Constitution,Data Structures,Database Management Systems,Digital Fundamentals', 5),
('Information Technology', 4, 'Operating System and Virtualization,Object Oriented Programming - I,Principles Of Economics And Management,Computer Organization & Architecture,Discrete Mathematics,Design Engineering - I B', 5),
('Information Technology', 5, 'Analysis and Design of Algorithms,Object Oriented Programming using JAVA,Computer Graphics,System Programming,Design Engineering - II A,Cyber Security,Disaster Management', 5),
('Information Technology', 6, 'Design Engineering - II B,Software Engineering,Image Processing (Dept Elec-I),Data Compression and Data Retrieval,Advanced Java,Web Technology,Embedded & VLSI Design,Distributed Operating System,.Net Technology', 5),
('Information Technology', 7, 'Project,Information and Network Security,Mobile Computing and Wireless Communication,Big Data Analytics (Dept Elec-II),Service Oriented Computing,Distributed DBMS,Data Mining and Business Intelligence', 5),
('Information Technology', 8, 'Artificial Intelligence,Project (Phase-II),IOT and Applications,Mutlimedia and Animation (Dept Elec - III),Python Programming,Cloud Infrastructure and Services,Web Data Management,iOS Programming,Android Programming', 5),
('Mechanical Engineering', 1, 'Programming for Problem Solving,Basic Electrical Engineering,Basic Mechanical Engineering,Environmental Science,Physics,Maths-I', 5),
('Mechanical Engineering', 2, 'Basic Civil Engineering,Engineering Graphics & Design,Mathematics-II,Basic Mechanical Engineering,Workshop,English,Chemistry', 5),
('Mechanical Engineering', 3, 'Effective Technical Communication,Complex Variables and Partial Differential Equations,Indian Constitution,Material Science And Metallurgy,Engineering Thermodynamics,Kinematics And Theory Of Machines', 5),
('Mechanical Engineering', 4, 'Design Engineering 1 B,Mechanical Measurement & Metrology,Fluid Mechanics,Machine Design & Industrial Drafting,Manufacturing Processes - II', 5),
('Mechanical Engineering', 5, 'Design Engineering - II A,Contributor Personality Development Program,Integrated Personality Development Course,Control Engineering,Heat Transfer,Operation Research,Dynamics of Machinery,Manufacturing Technology,Oil Hydraulics And Pneumatics', 5),
('Mechanical Engineering', 6, 'Dynamics of Machinery,Internal Combustion Engines,Computer Aided Design,Industrial Engineering,Refrigeration and Airconditioning,Production Technology,Design Engineering - II B', 5),
('Mechanical Engineering', 7, 'Project,Operation Research,Computer Aided Manufacturing,Machine Design,Power Plant Engineering,Oil Hydraulics and Pneumatics', 5),
('Mechanical Engineering', 8, 'Project - II,Renewable Energy Engineering,Product Design and Value Engineering (Departmental Elective II),Rapid Prototyping (Departmental Elective II),Quality Engineering (Departmental Elective II)', 5);

-- --------------------------------------------------------

--
-- Table structure for table `schoolattendance`
--

CREATE TABLE `schoolattendance` (
  `attendanceId` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `standard` varchar(25) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `presentNumbers` text NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `schoolname_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schoolattendance`
--

INSERT INTO `schoolattendance` (`attendanceId`, `date`, `standard`, `subject`, `presentNumbers`, `teacher_id`, `schoolname_id`) VALUES
(1, '2024-03-10', '10', 'english', '1, 2, 4, 5', 1, 5),
(2, '2024-03-11', '10', 'english', '1, 2, 3, 4, 5', 1, 5),
(3, '2024-03-12', '10', 'english', '1, 2, 3, 5', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `schoolleaverequests`
--

CREATE TABLE `schoolleaverequests` (
  `leaveRequestId` int(11) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schoolname`
--

CREATE TABLE `schoolname` (
  `schoolnameId` int(11) NOT NULL,
  `schoolnameName` varchar(255) NOT NULL,
  `schooltype_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schoolname`
--

INSERT INTO `schoolname` (`schoolnameId`, `schoolnameName`, `schooltype_id`, `city_id`) VALUES
(1, 'Adani public school', 2, 1),
(2, 'Pramukh Vidhyalaya', 1, 1),
(3, 'Mahatma Gandhi School', 2, 1),
(4, 'Zenith School', 2, 1),
(5, 'Shivam Vidhyalaya', 1, 1),
(6, 'Eklavya Residential School', 1, 2),
(7, 'Rajiv Gandhi Academy of E- School', 1, 2),
(8, 'Indus International School', 2, 2),
(9, 'St Paul School', 2, 2),
(10, 'Greenwoods School', 2, 2),
(11, 'Jagat Taran Golden Jubilee School', 1, 3),
(12, 'Jawahar Navodaya Vidyalaya Bahraich', 1, 3),
(13, 'Abhishek Public School', 2, 3),
(14, 'Genesis Global School', 2, 3),
(15, 'Amity International School', 2, 3),
(16, 'Achyuta Academy', 1, 4),
(17, 'Adarsh Vidhyalaya Public School', 1, 4),
(18, 'The Hindu Higher Secondary School', 2, 4),
(19, 'CPS Global School', 2, 4),
(20, 'Unity Public School', 2, 4),
(21, 'Kendriya Vidyalaya, Pitampura', 1, 5),
(22, 'Kendriya Vidyalaya, Sector-25, Rohini', 1, 5),
(23, 'CRPF Public School, Rohini', 2, 5),
(24, 'DAV Public School, Ashok Vihar', 2, 5),
(25, 'Prabhu Dayal Public School, Shalimar Bagh', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `schoolstudents`
--

CREATE TABLE `schoolstudents` (
  `studentId` int(11) NOT NULL,
  `standard` varchar(255) NOT NULL,
  `rollNumber` bigint(20) NOT NULL,
  `phoneNumber` bigint(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schoolstudents`
--

INSERT INTO `schoolstudents` (`studentId`, `standard`, `rollNumber`, `phoneNumber`, `user_id`) VALUES
(1, '12th-arts', 7, 8451235487, 3),
(2, '12th-sci-a', 22, 4444444444, 36),
(5, '10', 1, 2222222222, 47),
(6, '10', 2, 1264487460, 48),
(7, '10', 3, 6359451246, 49),
(8, '10', 4, 6451942760, 50),
(9, '10', 5, 6945134510, 51);

-- --------------------------------------------------------

--
-- Table structure for table `schoolteachers`
--

CREATE TABLE `schoolteachers` (
  `teacherId` int(11) NOT NULL,
  `classAssigned` varchar(255) NOT NULL,
  `subjectTaught` text NOT NULL DEFAULT '<p style="color:red">Pending - Yet to be filled by teacher </p>',
  `phoneNumber` bigint(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schoolteachers`
--

INSERT INTO `schoolteachers` (`teacherId`, `classAssigned`, `subjectTaught`, `phoneNumber`, `user_id`) VALUES
(1, '10', '[{\"std\":\"10\",\"sub\":\"english\",\"tid\":\"1\"},{\"std\":\"9\",\"sub\":\"english\",\"tid\":\"1\"}]', 8446273189, 5),
(7, '11th-sci-a', '[{\"std\":\"10\",\"sub\":\"maths\",\"tid\":\"7\"},{\"std\":\"8\",\"sub\":\"maths\",\"tid\":\"7\"}]', 6321854970, 25),
(8, '10', '[{\"std\":\"3\",\"sub\":\"english\",\"tid\":\"8\"}]', 6315975240, 26),
(10, '12th-sci-a', '[{\"std\":\"12th-sci-a\",\"sub\":\"maths\",\"tid\":\"10\"}]\n', 4561475204, 35),
(11, '8', '<p style=\"color:red\">Pending - Yet to be filled by teacher </p>', 6954852130, 37);

-- --------------------------------------------------------

--
-- Table structure for table `schooltype`
--

CREATE TABLE `schooltype` (
  `schooltypeId` int(11) NOT NULL,
  `schooltypeType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schooltype`
--

INSERT INTO `schooltype` (`schooltypeId`, `schooltypeType`) VALUES
(1, 'gov'),
(2, 'pvt');

-- --------------------------------------------------------

--
-- Table structure for table `stdsubasperschlname`
--

CREATE TABLE `stdsubasperschlname` (
  `std` varchar(255) NOT NULL,
  `sub` varchar(255) NOT NULL,
  `schoolname_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stdsubasperschlname`
--

INSERT INTO `stdsubasperschlname` (`std`, `sub`, `schoolname_id`) VALUES
('1', 'english,maths,gujarati', 1),
('2', 'english,maths,gujarati', 1),
('3', 'english,maths,gujarati,evs', 1),
('4', 'english,maths,gujarati,evs', 1),
('5', 'english,maths,gujarati,evs', 1),
('6', 'english,maths,gujarati,hindi,social science,science', 1),
('7', 'english,maths,gujarati,hindi,social science,science,sanskrit', 1),
('8', 'english,maths,gujarati,hindi,social science,science,sanskrit', 1),
('9', 'english,maths,gujarati,hindi,social science,science,sanskrit', 1),
('10', 'english,maths,gujarati,hindi,social science,science,sanskrit', 1),
('11th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 1),
('12th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 1),
('11th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 1),
('12th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 1),
('11th-sci-a', 'physics,chemistry,maths,english', 1),
('12th-sci-a', 'physics,chemistry,maths,english', 1),
('11th-sci-b', 'physics,chemistry,biology,english', 1),
('12th-sci-b', 'physics,chemistry,biology,english', 1),
('1', 'english,maths,gujarati', 2),
('2', 'english,maths,gujarati', 2),
('3', 'english,maths,gujarati,evs', 2),
('4', 'english,maths,gujarati,evs', 2),
('5', 'english,maths,gujarati,evs', 2),
('6', 'english,maths,gujarati,hindi,social science,science', 2),
('7', 'english,maths,gujarati,hindi,social science,science,sanskrit', 2),
('8', 'english,maths,gujarati,hindi,social science,science,sanskrit', 2),
('9', 'english,maths,gujarati,hindi,social science,science,sanskrit', 2),
('10', 'english,maths,gujarati,hindi,social science,science,sanskrit', 2),
('11th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 2),
('12th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 2),
('11th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 2),
('12th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 2),
('11th-sci-a', 'physics,chemistry,maths,english', 2),
('12th-sci-a', 'physics,chemistry,maths,english', 2),
('11th-sci-b', 'physics,chemistry,biology,english', 2),
('12th-sci-b', 'physics,chemistry,biology,english', 2),
('1', 'english,maths,gujarati', 3),
('2', 'english,maths,gujarati', 3),
('3', 'english,maths,gujarati,evs', 3),
('4', 'english,maths,gujarati,evs', 3),
('5', 'english,maths,gujarati,evs', 3),
('6', 'english,maths,gujarati,hindi,social science,science', 3),
('7', 'english,maths,gujarati,hindi,social science,science,sanskrit', 3),
('8', 'english,maths,gujarati,hindi,social science,science,sanskrit', 3),
('9', 'english,maths,gujarati,hindi,social science,science,sanskrit', 3),
('10', 'english,maths,gujarati,hindi,social science,science,sanskrit', 3),
('11th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 3),
('12th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 3),
('11th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 3),
('12th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 3),
('11th-sci-a', 'physics,chemistry,maths,english', 3),
('12th-sci-a', 'physics,chemistry,maths,english', 3),
('11th-sci-b', 'physics,chemistry,biology,english', 3),
('12th-sci-b', 'physics,chemistry,biology,english', 3),
('1', 'english,maths,gujarati', 4),
('2', 'english,maths,gujarati', 4),
('3', 'english,maths,gujarati,evs', 4),
('4', 'english,maths,gujarati,evs', 4),
('5', 'english,maths,gujarati,evs', 4),
('6', 'english,maths,gujarati,hindi,social science,science', 4),
('7', 'english,maths,gujarati,hindi,social science,science,sanskrit', 4),
('8', 'english,maths,gujarati,hindi,social science,science,sanskrit', 4),
('9', 'english,maths,gujarati,hindi,social science,science,sanskrit', 4),
('10', 'english,maths,gujarati,hindi,social science,science,sanskrit', 4),
('11th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 4),
('12th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 4),
('11th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 4),
('12th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 4),
('11th-sci-a', 'physics,chemistry,maths,english', 4),
('12th-sci-a', 'physics,chemistry,maths,english', 4),
('11th-sci-b', 'physics,chemistry,biology,english', 4),
('12th-sci-b', 'physics,chemistry,biology,english', 4),
('1', 'english,maths,gujarati', 5),
('2', 'english,maths,gujarati', 5),
('3', 'english,maths,gujarati,evs', 5),
('4', 'english,maths,gujarati,evs', 5),
('5', 'english,maths,gujarati,evs', 5),
('6', 'english,maths,gujarati,hindi,social science,science', 5),
('7', 'english,maths,gujarati,hindi,social science,science,sanskrit', 5),
('8', 'english,maths,gujarati,hindi,social science,science,sanskrit', 5),
('9', 'english,maths,gujarati,hindi,social science,science,sanskrit', 5),
('10', 'english,maths,gujarati,hindi,social science,science,sanskrit', 5),
('11th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 5),
('12th-arts', 'geography,philosopy,political science,history,psychology,english,gujarati,hindi,sociology', 5),
('11th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 5),
('12th-com', 'accounts,statistics,economics,english,gujarati,organisation of commerece & management,computer', 5),
('11th-sci-a', 'physics,chemistry,maths,english', 5),
('12th-sci-a', 'physics,chemistry,maths,english', 5),
('11th-sci-b', 'physics,chemistry,biology,english', 5),
('12th-sci-b', 'physics,chemistry,biology,english', 5);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `universityId` int(11) NOT NULL,
  `universityName` varchar(255) NOT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`universityId`, `universityName`, `city_id`) VALUES
(1, 'GTU-Gujarat Technological University', 1),
(2, 'CVMU-Charutar Vidya Mandal University', 1),
(3, 'Shivaji University', 2),
(4, 'Integral University', 3),
(5, 'University of Madras', 4),
(6, 'University of Delhi', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `profilePic` varchar(255) DEFAULT 'images/default.jpg',
  `schoolOrCollege` varchar(15) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `university_id` int(11) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  `schooltype_id` int(11) DEFAULT NULL,
  `schoolname_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `email`, `password`, `firstName`, `lastName`, `role`, `profilePic`, `schoolOrCollege`, `city_id`, `university_id`, `college_id`, `schooltype_id`, `schoolname_id`) VALUES
(1, 'neeldarji089@gmail.com', 'admin', 'neel', 'darji', 'admin', 'images/default.jpg', NULL, 1, NULL, NULL, NULL, NULL),
(2, 'abcde@gmail.com', 'raksha', 'raksha', 'rajashree', 'student', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(3, 'heell@gmail.com', 'heel', 'heell', 'harjil', 'student', 'images/default.jpg', 'school', 2, NULL, NULL, 2, 9),
(4, 'keel@gmail.com', 'keel', 'keel', 'karjii', 'teacher', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(5, 'leel@gmail.com', 'leel', 'leel', 'larji', 'teacher', 'images/default.jpg', 'school', 1, NULL, NULL, 1, 5),
(19, 'guru@gmail.com', 'teacher@123', 'guruu', 'mahan', 'teacher', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(23, 'fenil@gmail.com', 'teacher@123', 'fenil', 'singh', 'teacher', 'images/default.jpg', 'college', 1, 2, 8, NULL, NULL),
(25, 'kirtan@gmail.com', 'teacher@123', 'kirtan', 'singh', 'teacher', 'images/default.jpg', 'school', 5, NULL, NULL, 1, 21),
(26, 'dipesh@gmail.com', 'teacher@123', 'dipesh', 'singh', 'teacher', 'images/default.jpg', 'school', 1, NULL, NULL, 1, 2),
(29, 'kartik@gmail.com', 'teacher@123', 'kartik', 'aryan', 'teacher', 'images/1710224520366.jpg', 'college', 5, 6, 13, NULL, NULL),
(34, 'ff@gmail.com', 'student@123', 'fenil', 'singh', 'student', 'images/default.jpg', 'college', 1, 1, 1, NULL, NULL),
(35, 'rrr@gmail.com', 'teacher@123', 'rrr', 'rrr', 'teacher', 'images/default.jpg', 'school', 2, NULL, NULL, 1, 6),
(36, '22@g.c', 'student@123', 'dipesh', 'panchal', 'student', 'images/default.jpg', 'school', 2, NULL, NULL, 1, 6),
(37, 'nnn@gmail.com', 'teacher@123', 'nil', 'panchal', 'teacher', 'images/default.jpg', 'school', 1, NULL, NULL, 2, 1),
(38, 'jamesbond007@chalchall.com', 'teacher@123', 'pratham', 'thakkar', 'teacher', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(42, 'qqq@g.c', 'student@123', 'qqq', 'qqqq', 'student', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(43, 'e@g.c', 'student@123', 'eee', 'eeee', 'student', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(44, 'p@g.c', 'student@123', 'ppp', 'pppp', 'student', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(45, 'a@g.c', 'student@123', 'aaaa', 'aaaa', 'student', 'images/default.jpg', 'college', 1, 2, 6, NULL, NULL),
(47, 'aa@g.c', 'student@123', 'ankit', 'bhatt', 'student', 'images/default.jpg', 'school', 1, NULL, NULL, 1, 5),
(48, 'b@gmail.com', 'student@123', 'binit', 'kumbawat', 'student', 'images/default.jpg', 'school', 1, NULL, NULL, 1, 5),
(49, 'c@gmail.com', 'student@123', 'chetan', 'chauhan', 'student', 'images/default.jpg', 'school', 1, NULL, NULL, 1, 5),
(50, 'd@gmail.com', 'student@123', 'dipen', 'd', 'student', 'images/default.jpg', 'school', 1, NULL, NULL, 1, 5),
(51, 'h@gmail.com', 'student@123', 'harsh', 'singh', 'student', 'images/default.jpg', 'school', 1, NULL, NULL, 1, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityId`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`collegeId`),
  ADD KEY `university_id` (`university_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `collegeattendance`
--
ALTER TABLE `collegeattendance`
  ADD PRIMARY KEY (`attendanceId`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `collegeleaverequests`
--
ALTER TABLE `collegeleaverequests`
  ADD PRIMARY KEY (`leaveRequestId`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `collegestudents`
--
ALTER TABLE `collegestudents`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `collegeteachers`
--
ALTER TABLE `collegeteachers`
  ADD PRIMARY KEY (`teacherId`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `depsemsubasperuni`
--
ALTER TABLE `depsemsubasperuni`
  ADD KEY `university_id` (`university_id`);

--
-- Indexes for table `schoolattendance`
--
ALTER TABLE `schoolattendance`
  ADD PRIMARY KEY (`attendanceId`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `schoolname_id` (`schoolname_id`);

--
-- Indexes for table `schoolleaverequests`
--
ALTER TABLE `schoolleaverequests`
  ADD PRIMARY KEY (`leaveRequestId`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `schoolname`
--
ALTER TABLE `schoolname`
  ADD PRIMARY KEY (`schoolnameId`),
  ADD KEY `schooltype_id` (`schooltype_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `schoolstudents`
--
ALTER TABLE `schoolstudents`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `schoolteachers`
--
ALTER TABLE `schoolteachers`
  ADD PRIMARY KEY (`teacherId`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `schooltype`
--
ALTER TABLE `schooltype`
  ADD PRIMARY KEY (`schooltypeId`);

--
-- Indexes for table `stdsubasperschlname`
--
ALTER TABLE `stdsubasperschlname`
  ADD KEY `schoolname_id` (`schoolname_id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`universityId`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `schooltype_id` (`schooltype_id`),
  ADD KEY `schoolname_id` (`schoolname_id`),
  ADD KEY `university_id` (`university_id`),
  ADD KEY `college_id` (`college_id`),
  ADD KEY `lastName` (`lastName`),
  ADD KEY `firstName` (`firstName`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `collegeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `collegeattendance`
--
ALTER TABLE `collegeattendance`
  MODIFY `attendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `collegeleaverequests`
--
ALTER TABLE `collegeleaverequests`
  MODIFY `leaveRequestId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collegestudents`
--
ALTER TABLE `collegestudents`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `collegeteachers`
--
ALTER TABLE `collegeteachers`
  MODIFY `teacherId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schoolattendance`
--
ALTER TABLE `schoolattendance`
  MODIFY `attendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schoolleaverequests`
--
ALTER TABLE `schoolleaverequests`
  MODIFY `leaveRequestId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolname`
--
ALTER TABLE `schoolname`
  MODIFY `schoolnameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `schoolstudents`
--
ALTER TABLE `schoolstudents`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schoolteachers`
--
ALTER TABLE `schoolteachers`
  MODIFY `teacherId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schooltype`
--
ALTER TABLE `schooltype`
  MODIFY `schooltypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `universityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `college`
--
ALTER TABLE `college`
  ADD CONSTRAINT `college_ibfk_1` FOREIGN KEY (`university_id`) REFERENCES `university` (`universityId`),
  ADD CONSTRAINT `college_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`cityId`);

--
-- Constraints for table `collegeattendance`
--
ALTER TABLE `collegeattendance`
  ADD CONSTRAINT `collegeattendance_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `collegeteachers` (`teacherId`),
  ADD CONSTRAINT `collegeattendance_ibfk_2` FOREIGN KEY (`college_id`) REFERENCES `college` (`collegeId`);

--
-- Constraints for table `collegeleaverequests`
--
ALTER TABLE `collegeleaverequests`
  ADD CONSTRAINT `collegeleaverequests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`);

--
-- Constraints for table `collegestudents`
--
ALTER TABLE `collegestudents`
  ADD CONSTRAINT `collegestudents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `collegeteachers`
--
ALTER TABLE `collegeteachers`
  ADD CONSTRAINT `collegeteachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `depsemsubasperuni`
--
ALTER TABLE `depsemsubasperuni`
  ADD CONSTRAINT `depsemsubasperuni_ibfk_1` FOREIGN KEY (`university_id`) REFERENCES `university` (`universityId`);

--
-- Constraints for table `schoolattendance`
--
ALTER TABLE `schoolattendance`
  ADD CONSTRAINT `schoolattendance_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `schoolteachers` (`teacherId`),
  ADD CONSTRAINT `schoolattendance_ibfk_2` FOREIGN KEY (`schoolname_id`) REFERENCES `schoolname` (`schoolnameId`);

--
-- Constraints for table `schoolleaverequests`
--
ALTER TABLE `schoolleaverequests`
  ADD CONSTRAINT `schoolleaverequests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`);

--
-- Constraints for table `schoolname`
--
ALTER TABLE `schoolname`
  ADD CONSTRAINT `schoolname_ibfk_1` FOREIGN KEY (`schooltype_id`) REFERENCES `schooltype` (`schooltypeId`),
  ADD CONSTRAINT `schoolname_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`cityId`);

--
-- Constraints for table `schoolstudents`
--
ALTER TABLE `schoolstudents`
  ADD CONSTRAINT `schoolstudents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `schoolteachers`
--
ALTER TABLE `schoolteachers`
  ADD CONSTRAINT `schoolteachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `stdsubasperschlname`
--
ALTER TABLE `stdsubasperschlname`
  ADD CONSTRAINT `stdsubasperschlname_ibfk_1` FOREIGN KEY (`schoolname_id`) REFERENCES `schoolname` (`schoolnameId`);

--
-- Constraints for table `university`
--
ALTER TABLE `university`
  ADD CONSTRAINT `university_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`cityId`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`cityId`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`schooltype_id`) REFERENCES `schooltype` (`schooltypeId`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`schoolname_id`) REFERENCES `schoolname` (`schoolnameId`),
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`university_id`) REFERENCES `university` (`universityId`),
  ADD CONSTRAINT `users_ibfk_5` FOREIGN KEY (`college_id`) REFERENCES `college` (`collegeId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
