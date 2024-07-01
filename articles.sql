-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 28 2024 г., 14:43
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `np`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`) VALUES
(1, 'MySQL Tutorial', 'DBMS stands for DataBase ...'),
(2, 'How To Use MySQL Well', 'After you went through a ...'),
(3, 'Optimizing MySQL', 'In this tutorial, we show ...'),
(4, '1001 MySQL Tricks', '1. Never run mysqld as root. 2. ...'),
(5, 'MySQL vs. YourSQL', 'In the following database comparison ...'),
(6, 'MySQL Security', 'When configured properly, MySQL ...'),
(7, 'Учебник MySQL', 'СУБД означает База Данных ...'),
(8, 'Как правильно использовать MySQL', 'После того, как вы прошли через ...'),
(9, 'Оптимизация MySQL', 'В этом уроке мы покажем ...'),
(10, '1001 трюк MySQL', '1. Никогда не запускайте mysqld от имени пользователя root. 2. ...'),
(11, 'MySQL против YourSQL', 'В следующем сравнении баз данных ...'),
(12, 'Безопасность MySQL', 'При правильной настройке MySQL ...');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `articles` ADD FULLTEXT KEY `title` (`title`,`body`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
