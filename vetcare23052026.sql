-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 23 2026 г., 07:28
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vetcare`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `time_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `pet_id`, `doctor_id`, `service_id`, `date`, `time`, `time_at`, `status`) VALUES
(46, 15, 1, 4, 9, '2026-05-22', '11:00:00', '2026-05-22 22:50:21', 'active');

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `event` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`id`, `userID`, `event`, `time`) VALUES
(1, 4, 'authorization', '2026-04-10 23:26:40'),
(2, 4, 'authorization', '2026-04-11 00:02:26'),
(3, 4, 'logout', '2026-04-11 00:06:56'),
(5, 4, 'authorization', '2026-04-16 22:49:09'),
(6, 4, 'authorization', '2026-04-17 17:18:18'),
(7, 4, 'logout', '2026-04-17 17:27:43'),
(8, 4, 'authorization', '2026-04-17 23:23:00'),
(9, 4, 'logout', '2026-04-17 23:23:58'),
(10, 4, 'authorization', '2026-05-05 14:24:01'),
(11, 4, 'logout', '2026-05-05 14:26:57'),
(12, 4, 'authorization', '2026-05-05 14:32:07'),
(13, 4, 'authorization', '2026-05-05 15:32:27'),
(14, 4, 'logout', '2026-05-05 17:23:22'),
(15, 4, 'authorization', '2026-05-15 15:01:43'),
(16, 4, 'logout', '2026-05-15 16:26:27'),
(17, 4, 'authorization', '2026-05-15 17:57:55'),
(18, 4, 'logout', '2026-05-15 18:14:34'),
(19, 4, 'authorization', '2026-05-15 18:14:43'),
(20, 4, 'logout', '2026-05-15 19:29:34'),
(21, 4, 'authorization', '2026-05-15 19:29:54'),
(22, 4, 'logout', '2026-05-15 19:47:43'),
(23, 4, 'authorization', '2026-05-15 19:47:49'),
(24, 4, 'logout', '2026-05-15 20:28:29'),
(25, 13, 'authorization', '2026-05-15 20:34:28'),
(26, 13, 'authorization', '2026-05-17 10:56:29'),
(27, 13, 'logout', '2026-05-17 14:19:53'),
(28, 4, 'authorization', '2026-05-17 14:20:03'),
(29, 4, 'logout', '2026-05-17 19:47:26'),
(30, 13, 'authorization', '2026-05-17 19:47:34'),
(31, 13, 'authorization', '2026-05-19 08:51:08'),
(32, 13, 'authorization', '2026-05-21 01:24:45'),
(33, 13, 'logout', '2026-05-21 15:23:48'),
(34, 13, 'logout', '2026-05-21 15:24:05'),
(35, 13, 'logout', '2026-05-21 15:25:39'),
(36, 13, 'logout', '2026-05-21 15:26:24'),
(37, 13, 'logout', '2026-05-21 15:27:17'),
(38, 13, 'authorization', '2026-05-21 15:27:25'),
(39, 13, 'logout', '2026-05-21 15:28:27'),
(40, 13, 'authorization', '2026-05-21 15:28:33'),
(41, 13, 'logout', '2026-05-21 15:31:44'),
(42, 13, 'authorization', '2026-05-21 15:31:50'),
(43, 13, 'logout', '2026-05-21 15:32:58'),
(44, 4, 'authorization', '2026-05-21 15:33:03'),
(45, 4, 'logout', '2026-05-21 15:33:53'),
(46, 13, 'authorization', '2026-05-21 15:34:02'),
(47, 13, 'authorization', '2026-05-21 15:53:05'),
(48, 13, 'logout', '2026-05-21 15:55:03'),
(49, 13, 'authorization', '2026-05-21 15:55:15'),
(50, 13, 'logout', '2026-05-21 16:00:28'),
(51, 13, 'authorization', '2026-05-21 16:00:34'),
(52, 13, 'logout', '2026-05-21 16:01:46'),
(53, 13, 'authorization', '2026-05-21 16:01:56'),
(54, 13, 'logout', '2026-05-21 16:03:16'),
(55, 13, 'authorization', '2026-05-21 16:03:23'),
(56, 13, 'logout', '2026-05-21 16:03:30'),
(57, 13, 'authorization', '2026-05-21 16:03:36'),
(58, 13, 'logout', '2026-05-21 16:05:40'),
(59, 13, 'authorization', '2026-05-21 16:05:46'),
(60, 13, 'logout', '2026-05-21 16:06:29'),
(61, 13, 'authorization', '2026-05-21 16:06:35'),
(62, 13, 'logout', '2026-05-21 16:07:23'),
(63, 13, 'authorization', '2026-05-21 16:07:30'),
(64, 13, 'logout', '2026-05-21 16:32:55'),
(65, 16, 'authorization', '2026-05-21 16:34:51'),
(66, 16, 'logout', '2026-05-21 16:35:24'),
(67, 16, 'authorization', '2026-05-21 16:35:30'),
(68, 16, 'logout', '2026-05-21 16:35:54'),
(69, 16, 'authorization', '2026-05-21 16:35:58'),
(70, 16, 'logout', '2026-05-21 17:36:10'),
(71, 13, 'authorization', '2026-05-21 17:36:20'),
(72, 13, 'logout', '2026-05-21 17:36:52'),
(73, 16, 'authorization', '2026-05-21 17:37:02'),
(74, 16, 'logout', '2026-05-21 18:19:48'),
(75, 13, 'authorization', '2026-05-21 18:20:35'),
(76, 13, 'logout', '2026-05-21 18:42:13'),
(77, 16, 'authorization', '2026-05-21 18:42:22'),
(78, 16, 'logout', '2026-05-21 18:56:55'),
(79, 13, 'authorization', '2026-05-21 18:57:10'),
(80, 13, 'logout', '2026-05-21 19:06:57'),
(81, 16, 'authorization', '2026-05-21 19:07:08'),
(82, 13, 'authorization', '2026-05-23 03:36:46');

-- --------------------------------------------------------

--
-- Структура таблицы `medical_information`
--

CREATE TABLE `medical_information` (
  `id` int(11) NOT NULL,
  `pets_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `results` text DEFAULT NULL,
  `next_due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `medical_information`
--

INSERT INTO `medical_information` (`id`, `pets_id`, `event_id`, `event_date`, `medicine_id`, `doctor_id`, `results`, `next_due_date`) VALUES
(2, 1, 9, '2026-05-22', NULL, 5, NULL, '2026-05-26');

-- --------------------------------------------------------

--
-- Структура таблицы `medication_reminders`
--

CREATE TABLE `medication_reminders` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `scheduled_datetime` date NOT NULL,
  `is_taken` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `medication_reminders`
--

INSERT INTO `medication_reminders` (`id`, `pet_id`, `medicine_id`, `scheduled_datetime`, `is_taken`) VALUES
(2, 1, 1, '2026-05-22', 0),
(3, 1, 2, '2026-05-29', 1),
(7, 1, 4, '2026-05-08', 0),
(8, 1, 7, '2026-05-13', 1),
(9, 1, 1, '2026-05-06', 1),
(11, 4, 1, '2026-05-06', 0),
(12, 4, 1, '2026-05-14', 1),
(13, 4, 6, '2026-05-16', 1),
(14, 1, 4, '2026-05-05', 0),
(15, 1, 5, '2026-05-27', 0),
(16, 1, 6, '2026-05-20', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `price`) VALUES
(1, 'Aspirin', 10.00),
(2, 'Amoxicillin', 15.00),
(3, 'Meloxicam', 25.00),
(4, 'Metronidazole', 18.00),
(5, 'Diazepam', 30.00),
(6, 'Prednisolone', 22.00),
(7, 'Omeprazole', 20.00),
(8, 'Clavaseptin', 35.00),
(9, 'Tramadol', 28.00),
(10, 'Furosemide', 12.00);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `user_name`, `user_email`, `message`) VALUES
(1, NULL, '1312322', '123123123@gmail.com', '123132123'),
(2, NULL, '1312322', '123123123@gmail.com', '123132123'),
(3, NULL, '1312322', '123123123@gmail.com', '1312312312'),
(4, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '11232312'),
(5, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '11232312'),
(6, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '11232312'),
(7, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dfdfdfd'),
(8, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '31312312312'),
(9, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'ddfdfdddfdf'),
(10, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dsdsdsdsdsdsds'),
(11, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '21312312312321'),
(12, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '213131'),
(13, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'tttttttttttttttttttt'),
(14, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'екккккккккккккккккк'),
(15, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'ааааааааааа'),
(16, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dfdfddf'),
(17, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dfdfddf'),
(18, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dfdfddf'),
(19, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dfdfddf'),
(20, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dfdfddf'),
(21, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'ffffffffffffffffffffff'),
(22, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '12312312123'),
(23, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'sdsssds'),
(24, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'аввавав'),
(25, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dssdsdsdsds'),
(26, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dsdsdsdsd'),
(27, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dsdsd'),
(28, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', '1233'),
(29, 4, 'wewqeqwqwqeqweqweqw', 'qweqweqweqw@gmail.com', 'dssdsds');

-- --------------------------------------------------------

--
-- Структура таблицы `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `addres` text NOT NULL,
  `pass` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `experience_work` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `personal`
--

INSERT INTO `personal` (`id`, `profession_id`, `first_name`, `second_name`, `phone_number`, `email`, `addres`, `pass`, `role_id`, `birthday`, `experience_work`, `photo`) VALUES
(1, 1, 'Max', 'Brown', '+1(212)-555-23-45', 'brownMax@gmail.com', '123 Gogol street', '45 17 442092', 2, '1996-10-04', 14, 'image/doctor-in-uniform.jpg'),
(2, 4, 'Emily', 'Johnson', '+1(305)-555-12-78', 'emily.j@dentalcare.com', '456 Ocean Drive, Miami', '78 90 123456', 5, '1988-03-22', 7, 'image/doctor-in-uniform-5.jpg'),
(3, 3, 'Sophi', 'Martin', '+1(718)-555-98-34', 'sophia.martinez@health.org', '789 Elm Street, Brooklyn', '33 67 891011', 6, '1993-07-11', 8, 'image/doctor-in-uniform-3.jpg'),
(4, 5, 'Jay', 'Will', '+1(415)-555-67-89', 'j.williams@cityhospital.com', '1010 Franklin Street, San Francisco', '12 45 789123', 7, '1975-12-01', 18, 'image/doctor-in-uniform-2.jpg'),
(5, 1, 'Olivia', 'Davis', '+1(206)-555-34-12', 'olivia.davis@kidsclinic.com', '220 Broadway, Seattle', '90 23 456789', 2, '1995-09-15', 6, 'image/doctor-in-uniform-4.jpg'),
(6, 2, 'Isabella', 'Garcia', '+1(602)-555-45-67', 'isabella.garcia@rehabaz.com', '5010 Central Avenue, Phoenix', '55 44 332211', 8, '1989-08-30', 12, 'image/doctor-in-uniform-6.jpg'),
(7, 5, 'Ethan', 'Lee', '+1(617)-555-11-22', 'ethan.lee@labcorp.com', '88 Boylston Street, Boston', '77 88 990011', 7, '1998-01-25', 7, 'image/doctor-in-uniform-8.jpg'),
(8, 4, 'Eva', 'Smith', '+1(404)-555-22-33', 'eva.smith@familyclinic.com', '2300 Peachtree Road, Atlanta', '99 11 223344', 5, '1992-02-14', 3, 'image/doctor-in-uniform-10.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `view` varchar(50) DEFAULT NULL,
  `Breed` varchar(50) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `special_marks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pets`
--

INSERT INTO `pets` (`id`, `owner_id`, `name`, `view`, `Breed`, `Age`, `weight`, `special_marks`) VALUES
(1, 4, 'Nurse', 'Dog', 'Chihua', 2, 2.30, 'Afraid of meat'),
(2, 4, 'Mike', 'Dog', 'Spaniel', 6, 14.50, 'Can read'),
(4, 2, 'Guus', 'Dog', 'German shepherd', 7, 15.00, 'Loves balls'),
(6, 1, 'Jozy', 'Cat', 'Siam', 7, 4.20, 'Fiery red'),
(7, 7, 'Huud', 'Birg', 'African parrot', 2, 0.80, 'Nutty gourmet');

-- --------------------------------------------------------

--
-- Структура таблицы `professions`
--

CREATE TABLE `professions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `professions`
--

INSERT INTO `professions` (`id`, `name`) VALUES
(1, 'Veterinarian'),
(2, 'Receptionist'),
(3, 'Practice Manager'),
(4, 'Groomer'),
(5, 'Kennel Staff');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Doctor'),
(3, 'Nurse'),
(4, 'Client'),
(5, 'Groomer'),
(6, 'Practice Manager'),
(7, 'Kennel Staff'),
(8, 'Receptionist'),
(9, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `doctor_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `doctor_type_id`) VALUES
(6, 'Vaccination', 25.00, 1),
(7, 'Neutering', 85.00, 1),
(8, 'General Checkup', 45.00, 1),
(9, 'Haircut', 35.00, 4),
(10, 'Nail Trimming', 15.00, 4),
(11, 'Fecal Exam', 20.00, 5),
(12, 'Blood Test', 35.00, 5),
(13, 'Phone Consultation', 20.00, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `subscribes`
--

INSERT INTO `subscribes` (`id`, `name`, `price`, `description`) VALUES
(1, 'Start Plan', 250.00, 'All-around care for your pet\'s health and happiness.'),
(2, 'Comprehensive Plan', 330.00, 'Complete care package with additional benefits.'),
(3, 'Essential Care Plan', 330.00, 'Essential services for your pet\'s wellbeing.'),
(4, 'Premium Health Plan', 377.00, 'The ultimate plan for complete peace of mind.');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribes_options`
--

CREATE TABLE `subscribes_options` (
  `id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `subscribes_options`
--

INSERT INTO `subscribes_options` (`id`, `price_id`, `name`) VALUES
(1, 1, 'Basic Care Plan'),
(2, 1, 'Wellness Plus Plan'),
(3, 2, 'Routine health check-ups'),
(4, 2, 'Core vaccinations'),
(5, 3, 'Unlimited health check-ups'),
(6, 3, 'Emergency care coverage'),
(7, 1, 'Senior Pet Plan'),
(8, 1, 'Puppy & Kitten Starter Plan'),
(11, 1, 'Premium Care Plan'),
(12, 1, 'Family Bundle Plan'),
(13, 1, 'Custom Care Plan'),
(14, 2, 'Parasite prevention'),
(15, 2, 'Nutritional advice'),
(16, 2, 'Nail trimming service'),
(17, 2, 'Basic grooming session'),
(18, 2, '10% discount on additional services'),
(19, 3, 'Advanced Wellness Plan'),
(20, 3, 'Parasite prevention and treatment '),
(21, 3, 'Personalized diet plan'),
(22, 3, 'Emergency Care Plan'),
(23, 3, 'All-Inclusive Premium Plan'),
(24, 4, 'Annual full-body health screening'),
(25, 4, 'Advanced vaccinations (with boosters)'),
(26, 4, 'Dental care consultation'),
(27, 4, 'Weight management program'),
(28, 4, 'Priority access to grooming services'),
(29, 4, 'Behavioral consultations'),
(30, 4, '20% discount on pet products');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `secondName` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `created_at` date NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstName`, `secondName`, `password`, `email`, `phone`, `address`, `created_at`, `role_id`) VALUES
(1, 'Ivan', 'Ivanov', '$2y$10$.YdeLaRjcSk4Wrx6RKu3geQazwOq7dlbCNpL1JnKw46ypfx5fflb2', 'ivan@gmail.com', '+79991234567', '27 Albukerky Street ', '2026-04-09', 4),
(2, 'Julius', 'Petrov', '$2y$10$sJAcbZ6CmJ6uvAmWtT93BO2RrFYYd1kXzeUp6B74tFrFHlTmni.IK', 'jul@gmail.com', '+79990233567', '33 Hefetrs Street ', '2026-04-09', 4),
(3, 'Fedya', 'Churka', '$2y$10$Od935unFJBr/XZKFD7Q05O7PCTJandg9cMZZbNG/mS2LH5jSok7Na', 'churka@gmail.com', '+79127182456', '15 Egjoki Street ', '2026-04-09', 4),
(4, 'Quentin', 'Tarantino', '$2y$10$5xPKRcrfR5U9peyREj2AJ.N46FD0QEp//AfXLcj5XwBl0cMFDzFqm', 'qweqweqweqw@gmail.com', '+73123123923', 'asdasad', '2026-04-10', 4),
(6, 'dff', 'dfdfd', NULL, 'dfdf@gmail.com', '+79494763587', '', '0000-00-00', 9),
(7, 'Mihail', 'Zaycev', NULL, 'mihazayec@gmail.com', '+73123123923', '', '0000-00-00', 9),
(8, 'rfgirsjfs', 'dsfsfldskfdlsf', NULL, 'opfjkpoaksfopk@gmail.com', '+73123123923', '', '0000-00-00', 9),
(13, 'admin', 'admin', '$2y$10$A0pUixnlJ28HSmQMN57whum/O3Rjch66nglbwMkvY5LDEw1TtYZ9y', 'admin@gmail.com', '+77777777777', 'admin', '2026-05-15', 1),
(14, 'sasdada', 'adsadasda', NULL, 'adadad@gmail.com', '+12345678901', '', '0000-00-00', 9),
(15, 'Igor', 'Vinnik', NULL, 'IgorVinnik@gmail.com', '+84892759027', '', '0000-00-00', 9),
(16, 'Max', 'Brown', '$2y$10$HZ/.FNH/8VR9CBosKpy.NODtO3M.ff9pnBOsUnrEoDn98WT3B0KS6', 'brownMax@gmail.com', '+72125552345', '123 Gogol street', '2026-05-21', 2),
(17, 'Zhukova', 'Nastja', '123456', 'zhucova@gmail.com', '+73183128921', '', '0000-00-00', 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_ibfk_1` (`user_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `appointments_ibfk_2` (`doctor_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userID`);

--
-- Индексы таблицы `medical_information`
--
ALTER TABLE `medical_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_information_ibfk_1` (`pets_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `medicine_id` (`medicine_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Индексы таблицы `medication_reminders`
--
ALTER TABLE `medication_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_id` (`medicine_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Индексы таблицы `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profession_id` (`profession_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Индексы таблицы `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_ibfk_1` (`owner_id`);

--
-- Индексы таблицы `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_type_id` (`doctor_type_id`);

--
-- Индексы таблицы `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscribes_options`
--
ALTER TABLE `subscribes_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_id` (`price_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT для таблицы `medical_information`
--
ALTER TABLE `medical_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `medication_reminders`
--
ALTER TABLE `medication_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `subscribes_options`
--
ALTER TABLE `subscribes_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `medical_information`
--
ALTER TABLE `medical_information`
  ADD CONSTRAINT `medical_information_ibfk_1` FOREIGN KEY (`pets_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_information_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_information_ibfk_3` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_information_ibfk_4` FOREIGN KEY (`doctor_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `medication_reminders`
--
ALTER TABLE `medication_reminders`
  ADD CONSTRAINT `medication_reminders_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medication_reminders_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`),
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`doctor_type_id`) REFERENCES `professions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subscribes_options`
--
ALTER TABLE `subscribes_options`
  ADD CONSTRAINT `subscribes_options_ibfk_1` FOREIGN KEY (`price_id`) REFERENCES `subscribes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
