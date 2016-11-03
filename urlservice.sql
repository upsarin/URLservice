-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 03 2016 г., 00:19
-- Версия сервера: 5.6.28-76.1-log
-- Версия PHP: 5.6.18-pl0-gentoo

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `searchsiru`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buys`
--

CREATE TABLE `buys` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `summ` int(11) DEFAULT NULL,
  `desc` varchar(10000) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `adress` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `buy_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` varchar(50) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `preview_desc` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `active` varchar(255) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cats`
--

INSERT INTO `cats` (`id`, `name`, `parent`, `desc`, `preview_desc`, `alias`, `active`) VALUES
(1, 'Корневая', 0, 'Корневая категория', 'Корневая категория', 'all', 'Y'),
(2, 'Строительство', 1, NULL, NULL, NULL, 'Y');

-- --------------------------------------------------------

--
-- Структура таблицы `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cat` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `metakeys` varchar(255) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `active_from` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active_to` timestamp NULL DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `fav` varchar(255) DEFAULT NULL,
  `desc` text,
  `preview_desc` text,
  `page_id` int(11) DEFAULT NULL,
  `active` varchar(255) DEFAULT 'Y',
  `fields` varchar(255) DEFAULT 'N',
  `parent_temp` varchar(255) DEFAULT NULL,
  `child_temp` varchar(255) DEFAULT NULL,
  `temp_folder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `multi` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `iblock` varchar(255) DEFAULT NULL,
  `input_type` varchar(255) DEFAULT NULL,
  `active` varchar(255) DEFAULT 'Y',
  `required` varchar(255) DEFAULT 'Y',
  `readonly` varchar(255) DEFAULT 'N',
  `sort` int(11) DEFAULT '100',
  `field_type` varchar(255) DEFAULT 'main',
  `default_value` varchar(1000) DEFAULT NULL,
  `default_names` varchar(1000) DEFAULT NULL,
  `default_type` varchar(255) DEFAULT NULL,
  `default_type_value` varchar(255) DEFAULT NULL,
  `siteview` varchar(255) DEFAULT 'Y' COMMENT 'будет ли показываться на сайте'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fields`
--

INSERT INTO `fields` (`id`, `type`, `code`, `multi`, `name`, `iblock`, `input_type`, `active`, `required`, `readonly`, `sort`, `field_type`, `default_value`, `default_names`, `default_type`, `default_type_value`, `siteview`) VALUES
(1, 'register', 'desc', 'N', 'Описание деятельности', 'users', 'textarea', 'Y', 'N', 'N', 97, 'main', NULL, NULL, NULL, NULL, 'Y'),
(2, 'register', 'login', 'N', 'Логин', 'users', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(3, 'register', 'name', 'N', 'Название организации', 'users', 'text', 'Y', 'Y', 'N', 96, 'main', NULL, NULL, NULL, NULL, 'Y'),
(4, 'register', 'pred_name', 'N', 'ФИО представителя', 'users', 'text', 'Y', 'N', 'N', 99, 'main', NULL, NULL, NULL, NULL, 'Y'),
(5, 'register', 'email', 'N', 'Email', 'users', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(6, 'register', 'phone', 'N', 'Телефон', 'users', 'text', 'N', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(7, 'register', 'password', 'N', 'Пароль', 'users', 'password', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(8, 'register', 'check_password', 'N', 'Подтверждение пароля', 'users', 'password', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(11, 'login', 'login', 'N', 'Логин', 'login', 'text', 'Y', 'Y', 'N', 99, 'main', NULL, NULL, NULL, NULL, 'Y'),
(12, 'login', 'email', 'N', 'Email', 'login', 'text', 'N', 'Y', 'N', 99, 'main', NULL, NULL, NULL, NULL, 'Y'),
(13, 'login', 'phone', 'N', 'Телефон', 'login', 'text', 'N', 'Y', 'N', 99, 'main', NULL, NULL, NULL, NULL, 'Y'),
(14, 'login', 'password', 'N', 'Пароль', 'login', 'password', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(15, 'system', 'display_errors', 'N', 'Ошибки PHP', 'system', 'text', 'N', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(16, 'system', 'support_email', 'N', 'Email для связи', 'system', 'text', 'N', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(17, 'system', 'date.timezone', 'N', 'Часовые пояса сайта', 'system', 'select', 'Y', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(18, 'shortlink', 'orig_url', 'N', 'Оригинальная ссылка', 'content', 'text', 'Y', 'Y', 'N', 100, 'main', '', '', '', '', 'Y'),
(19, 'shortlink', 'edit_url', 'N', 'Измененная ссылка', 'content', 'text', 'N', 'Y', 'N', 100, 'main', '', '', '', '', 'Y'),
(21, 'pages', 'name', 'N', 'Название', 'pages', 'text', 'N', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(22, 'pages', 'model', 'N', 'Модель', 'pages', 'hidden', 'Y', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(23, 'pages', 'title', 'N', 'Заголовок', 'pages', 'text', 'Y', 'N', 'N', 2, 'main', NULL, NULL, NULL, NULL, 'Y'),
(24, 'pages', 'temp', 'N', 'Шаблон страницы', 'pages', 'text', 'Y', 'N', 'N', 100, 'main', 'default', NULL, NULL, NULL, 'Y'),
(25, 'pages', 'metakeys', 'N', 'Описание страницы (для SEO)', 'pages', 'text', 'N', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(26, 'pages', 'keywords', 'N', 'Ключевые слова, фразы', 'pages', 'file', 'N', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(27, 'pages', 'index', 'N', 'Начальная страница', 'pages', 'checkbox', 'N', 'N', 'N', 100, 'main', '0', NULL, NULL, NULL, 'Y'),
(28, 'pages', 'active', 'N', 'Активно', 'pages', 'checkbox', 'Y', 'N', 'N', 1, 'main', 'Y', NULL, NULL, NULL, 'Y'),
(29, 'pages', 'menu_active', 'N', 'Активность в меню', 'pages', 'select', 'Y', 'N', 'N', 100, 'main', 'N,Y', 'Нет,Да', NULL, NULL, 'Y'),
(30, 'pages', 'menu_type', 'N', 'Тип меню (в каком меню отображается)', 'pages', 'select', 'N', 'N', 'N', 100, 'main', '', '', NULL, NULL, 'Y'),
(31, 'pages', 'temp_folder', 'N', 'Родительский шаблон', 'pages', 'text', 'Y', 'N', 'N', 100, 'main', 'default', NULL, NULL, NULL, 'Y'),
(32, 'pages', 'menu_name', 'N', 'Имя страницы в меню', 'pages', 'text', 'Y', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(33, 'pages', 'template_type', 'N', 'Тип шаблона', 'pages', 'select', 'Y', 'N', 'N', 100, 'main', 'default,personal', 'стандатрный,личный кабинет', NULL, NULL, 'Y'),
(34, 'pages', 'modules', 'N', 'Модули на странице', 'pages', 'textarea', 'N', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(35, 'pages', 'alias', 'N', 'Алиас', 'pages', 'text', 'Y', 'N', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(36, 'pages', 'permission', 'N', 'Доступ к странице', 'pages', 'select', 'Y', 'N', 'N', 100, 'main', '11,10,9,5,4,3,2,1', 'гость,забаненный пользователь,пользователь с нарушениями,зарегистрированный пользователь,контент-менеджер,специалист по рекламе,модератор, администратор', NULL, NULL, 'Y'),
(37, 'pages', 'content_type', 'N', 'Тип контента (информации на странице)', 'pages', 'select', 'Y', 'N', 'N', 100, 'main', 'N,detail,list', 'нет,детальная страница,список', NULL, NULL, 'Y'),
(38, 'pages', 'content_temp', 'N', 'Шаблон контента на странице', 'pages', 'select', 'Y', 'N', 'N', 100, 'main', 'default,news', 'стандартный,новости', NULL, NULL, 'Y'),
(39, 'cats', 'name', 'N', 'Название', 'cats', 'text', 'Y', 'Y', 'N', 1, 'main', NULL, NULL, NULL, NULL, 'Y'),
(40, 'cats', 'parent', 'N', 'Родительская категория', 'cats', 'select', 'Y', 'Y', 'N', 2, 'main', '', '', 'list', 'cats=*', 'Y'),
(41, 'cats', 'desc', 'N', 'Детальное описание', 'cats', 'textarea', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(42, 'cats', 'preview_desc', 'N', 'Краткое описание', 'cats', 'textarea', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(43, 'cats', 'alias', 'N', 'Алиас', 'cats', 'hidden', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(44, 'base_content', 'name', 'N', 'Название', 'content', 'hidden', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'N'),
(46, 'base_content', 'title', 'N', 'Название', 'content', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(47, 'base_content', 'keywords', 'N', 'Ключевые слова/фразы', 'content', 'textarea', 'Y', 'N', 'N', 105, 'main', NULL, NULL, NULL, NULL, 'Y'),
(48, 'base_content', 'metakeys', 'N', 'Описание страницы', 'content', 'textarea', 'Y', 'N', 'N', 105, 'main', NULL, NULL, NULL, NULL, 'Y'),
(49, 'base_content', 'user', 'N', 'Автор', 'content', 'select', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, 'list', 'users=*', 'N'),
(50, 'base_content', 'active_from', 'N', 'Активно с', 'content', 'date', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'N'),
(51, 'base_content', 'active_to', 'N', 'Активно до', 'content', 'date', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'N'),
(52, 'base_content', 'alias', 'N', 'alias', 'content', 'hidden', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(53, 'base_content', 'desc', 'N', 'Описание', 'content', 'textarea', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(54, 'base_content', 'preview_desc', 'N', 'Краткое описание', 'content', 'textarea', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(55, 'base_content', 'page_id', 'N', 'Страница', 'content', 'hidden', 'Y', 'Y', 'N', 100, 'main', '', NULL, '', '', 'N'),
(56, 'base_content', 'active', 'N', 'Активно', 'content', 'checkbox', 'Y', 'Y', 'N', 100, 'main', 'Y', '', NULL, NULL, 'N'),
(57, 'base_content', 'fields', 'N', 'Доп поля', 'content', 'hidden', 'Y', 'Y', 'N', 100, 'main', 'N', NULL, NULL, NULL, 'N'),
(58, 'base_content', 'parent_temp', 'N', 'Родительский шаблон', 'content', 'select', 'Y', 'Y', 'N', 100, 'main', 'default', 'default', NULL, NULL, 'N'),
(59, 'base_content', 'child_temp', 'N', 'Шаблон', 'content', 'text', 'Y', 'Y', 'N', 100, 'main', 'default', NULL, NULL, NULL, 'N'),
(60, 'base_content', 'temp_folder', 'N', 'Папка шаблона', 'content', 'text', 'Y', 'Y', 'N', 100, 'main', 'default', NULL, NULL, NULL, 'N'),
(61, 'users', 'group', 'N', 'Группа', 'users', 'select', 'Y', 'Y', 'N', 100, 'main', 'registed,moderator,admin,time-guest', 'зарегистрированный,модератор,админ,временно зарегистрированный', 'list', 'user_groups=*', 'Y'),
(62, 'users', 'active', 'N', 'Активен', 'users', 'checkbox', 'Y', 'Y', 'N', 100, 'main', 'Y', '', NULL, NULL, 'Y'),
(63, 'base_fields', 'type', 'N', 'связь', 'fields', 'hidden', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(64, 'base_fields', 'code', 'N', 'code', 'fields', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(65, 'base_fields', 'multi', 'N', 'множественное', 'fields', 'checkbox', 'Y', 'Y', 'N', 100, 'main', 'Y', '', NULL, NULL, 'Y'),
(66, 'base_fields', 'name', 'N', 'Название', 'fields', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(67, 'base_fields', 'iblock', 'N', ' iblock', 'fields', 'hidden', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(68, 'base_fields', 'input_type', 'N', 'вид поля', 'fields', 'select', 'Y', 'Y', 'N', 100, 'main', 'text,hidden,checkbox,textarea,file,html,date', 'text,hidden,checkbox,textarea,file,html,date', NULL, NULL, 'Y'),
(69, 'base_fields', 'active', 'N', 'активно', 'fields', 'checkbox', 'Y', 'Y', 'N', 100, 'main', 'Y', NULL, NULL, NULL, 'Y'),
(70, 'base_fields', 'required', 'N', 'обязательное', 'fields', 'checkbox', 'Y', 'Y', 'N', 100, 'main', 'Y', NULL, NULL, NULL, 'Y'),
(71, 'base_fields', 'readonly', 'N', 'только для чтения', 'fields', 'checkbox', 'Y', 'Y', 'N', 100, 'main', 'Y', NULL, NULL, NULL, 'Y'),
(72, 'base_fields', 'sort', 'N', 'сортировка', 'fields', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(73, 'base_fields', 'field_type', 'N', 'тип поля', 'fields', 'hidden', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(74, 'base_fields', 'default_value', 'N', 'значение по-умолчанию', 'fields', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(75, 'base_fields', 'default_names', 'N', 'имена по умолчанию', 'fields', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(76, 'base_fields', 'default_type', 'N', 'список', 'fields', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(77, 'base_fields', 'default_type_value', 'N', 'значения списка', 'fields', 'text', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, NULL, NULL, 'Y'),
(91, 'pages', 'list_limit', 'N', 'Лимит обьектов на странице', 'pages', 'text', 'Y', 'N', 'N', 100, 'main', '10', NULL, NULL, NULL, 'Y'),
(92, 'proekty', 'deadline', 'N', 'Дедлайн', 'content', 'date', 'Y', 'N', 'N', 100, 'alter', '', '', '', '', 'Y'),
(93, 'proekty', 'work_user', 'N', 'Испольнитель', 'content', 'select', 'N', 'Y', 'N', 100, 'alter', '', '', 'list', 'users=*', 'Y'),
(94, 'proekty', 'status', 'N', 'Статус', 'content', 'select', 'Y', 'Y', 'N', 100, 'alter', 'in_work,done,questions', 'в разработке,сделано,стадия обсуждения', '', '', 'Y'),
(95, 'proekty', 'parent', 'N', 'Родитель', 'content', 'hidden', 'N', 'N', 'N', 100, 'alter', '0', '', '', '', 'Y'),
(98, 'users', 'parent', 'N', 'Родительский аккаунт', 'users', 'text', 'Y', 'N', 'N', 100, 'alter', '0', '', '', '', 'Y'),
(99, 'users', 'account_type', 'N', 'тип аккаунта', 'users', 'select', 'Y', 'Y', 'N', 100, 'alter', 'developer,director,design,html,customer', 'разработчик,директор,дизайнер,верстальщик,заказчик', '', '', 'Y'),
(100, 'base_content', 'page_id', 'N', 'Страница', 'content', 'select', 'N', 'Y', 'N', 100, 'main', NULL, NULL, 'list', NULL, 'Y'),
(102, 'katalog', 'cod', 'N', 'Код', 'content', 'text', 'N', 'Y', 'N', 100, 'alter', '', '', '', '', 'Y'),
(103, 'katalog', 'price', 'N', 'Цена', 'content', 'text', 'N', 'Y', 'N', 100, 'alter', '', '', '', '', 'Y'),
(104, 'ads', 'Photo', 'N', 'Фото', 'content', 'file', 'Y', 'Y', 'N', 110, 'alter', '', '', '', '', 'Y'),
(105, 'katalog', 'consist', 'N', 'Состав', 'content', 'text', 'N', 'Y', 'N', 100, 'alter', '', '', '', '', 'Y'),
(106, 'katalog', 'edate', 'N', 'Срок годности', 'content', 'text', 'N', 'Y', 'N', 100, 'alter', '', '', '', '', 'Y'),
(108, 'base_content', 'cat', 'N', 'Категория', 'content', 'select', 'Y', 'Y', 'N', 100, 'main', NULL, NULL, 'list', 'cats=*', 'N'),
(109, 'register', 'exe_cat', 'N', 'Сфера деятельности', 'users', 'select', 'Y', 'Y', 'N', 100, 'alter', NULL, NULL, 'list', 'cats=*', 'Y'),
(110, 'ads', 'city', 'N', 'Город', 'content', 'select', 'Y', 'Y', 'N', 100, 'alter', '1,2,3', 'Новосибирск,Бердск,Искитим', NULL, NULL, 'Y'),
(111, 'ads', 'phone', 'N', 'Телефон', 'content', 'text', 'Y', 'Y', 'N', 100, 'alter', NULL, NULL, NULL, NULL, 'Y'),
(112, 'ads', 'email', 'N', 'Email', 'content', 'text', 'Y', 'Y', 'N', 100, 'alter', NULL, NULL, NULL, NULL, 'Y');

-- --------------------------------------------------------

--
-- Структура таблицы `field_value`
--

CREATE TABLE `field_value` (
  `id` int(11) NOT NULL,
  `field_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `element_id` int(11) DEFAULT NULL,
  `iblock` varchar(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `input_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `field_value`
--

INSERT INTO `field_value` (`id`, `field_id`, `value`, `element_id`, `iblock`, `code`, `input_type`) VALUES
(16147, NULL, '2', 8, 'users', 'exe_cat', NULL),
(16148, NULL, '1', 8003, NULL, 'city', NULL),
(16149, NULL, '1', 8004, NULL, 'city', NULL),
(16150, NULL, 'mvlad1991@mail.ru', 8004, NULL, 'email', NULL),
(16151, NULL, '1', 8005, NULL, 'city', NULL),
(16152, NULL, '89134754665', 8005, NULL, 'phone', NULL),
(16153, NULL, 'mvlad1991@mail.ru', 8005, NULL, 'email', NULL),
(16154, NULL, 'Пятков Максим', 8, 'users', 'pred_name', NULL),
(16155, NULL, 'ООО "Sibservice"', 8, 'users', 'name', NULL),
(16156, NULL, 'Занимаемся поддержкой сайта sibservice.info', 8, 'users', 'desc', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `chain_type` varchar(255) DEFAULT NULL,
  `chain_id` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `server_name` varchar(255) DEFAULT NULL,
  `hits` varchar(255) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `type`, `user_id`, `chain_type`, `chain_id`, `path`, `name`, `title`, `server_name`, `hits`, `content_id`) VALUES
(1006, 'images', 8, '', '', 'uploads/user_files/8/images/46e9ac7306966b97c85665c3023f4878.jpeg', '46e9ac7306966b97c85665c3023f4878.jpeg', '', 'searchsiru.temp.swtest.ru', '0', 8005),
(1007, 'docs', 8, '', '', 'uploads/user_files/8/docs/de6d78482737565258f1b686491a5fc6.', 'de6d78482737565258f1b686491a5fc6.', '', 'searchsiru.temp.swtest.ru', '0', 8005),
(1008, 'docs', 8, '', '', 'uploads/user_files/8/docs/de6d78482737565258f1b686491a5fc6.', 'de6d78482737565258f1b686491a5fc6.', '', 'searchsiru.temp.swtest.ru', '0', 8005);

-- --------------------------------------------------------

--
-- Структура таблицы `iblock`
--

CREATE TABLE `iblock` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `iblock`
--

INSERT INTO `iblock` (`id`, `name`, `type`) VALUES
(1, 'user', 'user'),
(2, 'login', 'login'),
(3, 'system', 'system');

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `page_id` varchar(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `pos` varchar(255) DEFAULT NULL,
  `html` varchar(1000) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `temp` varchar(255) NOT NULL DEFAULT 'default',
  `chain` varchar(255) DEFAULT 'N',
  `chain_elements` varchar(255) DEFAULT NULL,
  `confirm_phrase` varchar(255) DEFAULT NULL,
  `reload` int(255) DEFAULT '1',
  `error_phrase` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`, `type`, `page_id`, `desc`, `pos`, `html`, `params`, `module_name`, `temp`, `chain`, `chain_elements`, `confirm_phrase`, `reload`, `error_phrase`) VALUES
(1, 'elem', 'elem', 'any', 'вывод определенных элементов на страницу', 'elem', NULL, NULL, 'elem', 'admin-default', 'N', NULL, NULL, 0, NULL),
(2, 'admin-login', 'login', 'any', NULL, 'admin-login', NULL, NULL, 'login', 'admin-login', 'N', NULL, NULL, 1, NULL),
(3, 'Главное меню', 'menu', 'any', 'Главное меню', 'main-menu', NULL, NULL, 'menu', 'default', 'N', NULL, NULL, 1, NULL),
(4, 'Регистрация', 'register', '1', 'Регистрация', 'pos-register', NULL, NULL, 'register', 'default', 'N', NULL, NULL, 1, NULL),
(5, 'Вход', 'login', 'any', 'Авторизация', 'login', NULL, NULL, 'login', 'default', 'N', NULL, NULL, 1, NULL),
(6, 'Активация аккаунта', 'register', 'any', 'Активация аккаунта при регистрации', 'pos-register-activate', NULL, NULL, 'register', 'activate', 'N', NULL, NULL, 1, NULL),
(7, 'Меню Личного кабинете', 'menu', 'any', 'Меню личного кабинета', 'lk-menu', NULL, NULL, 'menu', 'default', 'N', NULL, NULL, 1, NULL),
(8, 'Левое меню', 'menu', 'any', 'Левое меню', 'left-menu', NULL, NULL, 'menu', 'left-menu', 'Y', '10,11,12', NULL, 1, NULL),
(9, 'Главный контент ЛК', 'content', 'any', 'Главный контент ЛК', 'lk-main', NULL, NULL, 'content', 'lk-main', 'N', NULL, NULL, 1, NULL),
(10, 'Аккаунт', 'menu', 'any', 'меню Аккаунта', 'account-menu', NULL, NULL, 'menu', 'left-menu-etc', 'N', '', NULL, 1, NULL),
(11, 'Помощь', 'menu', 'any', 'меню Помощи', 'help-menu', NULL, NULL, 'menu', 'left-menu-etc', 'N', NULL, NULL, 1, NULL),
(12, 'Другое', 'menu', 'any', 'меню Другое', 'others-menu', NULL, NULL, 'menu', 'left-menu-etc', 'N', NULL, NULL, 1, NULL),
(13, 'Формы сбора информации', 'form', 'any', 'шаблоны форм и их обработка', 'form', NULL, '', 'form', 'default', 'N', NULL, 'Успешное сохранение', 1, NULL),
(14, 'пример html', 'html', 'any', 'пример html модуля', 'html-scope', '<div>\r\nHello <br />\r\n</div>\r\n', NULL, 'html', 'default', 'N', NULL, NULL, 1, NULL),
(23, 'admin-top-menu', 'menu', 'any', NULL, 'admin-top-menu', NULL, NULL, 'menu', 'admin-top-menu', 'N', NULL, NULL, 1, NULL),
(24, 'admin-left-menu', 'menu', 'any', NULL, 'admin-left-menu', NULL, NULL, 'menu', 'admin-left-menu', 'N', NULL, NULL, 1, NULL),
(25, 'admin-form', 'form', 'any', 'админская форма для работы в админке', 'admin-form', NULL, NULL, 'form', 'admin-form', 'N', NULL, 'Сохранение прошло успешно', 1, 'Произошла ошибка, обратитесь к администратору, ой вы и есть администратор. :('),
(26, 'admin-form-fields', 'form', 'any', NULL, 'admin-form-fields', NULL, NULL, 'form', 'admin-form-fields', 'N', NULL, 'Сохранение прошло успешно', 1, 'Произошла ошибка, обратитесь к администратору, ой вы и есть администратор. :('),
(27, 'pagination', 'pagination', 'any', 'Пагинация', 'pagination', NULL, NULL, 'pagination', 'default', 'N', NULL, NULL, 1, NULL),
(28, 'Приветствие на главной странице', 'html', 'any', NULL, 'html-privet-main', '<p>\r\nПриветственный модуль главной страницы\r\n</p>', NULL, 'html', 'default', 'N', NULL, NULL, 1, NULL),
(29, 'user-menu', 'menu', 'any', NULL, 'user-menu', NULL, NULL, 'menu', 'default', 'N', NULL, NULL, 1, NULL),
(30, 'admin-form-users', 'form', 'any', NULL, 'admin-form-users', NULL, NULL, 'form', 'admin-form-users', 'N', NULL, 'Сохранение прошло успешно', 1, 'Произошла ошибка, обратитесь к администратору, ой вы и есть администратор. :('),
(31, 'shortlink', 'shortlink', 'any', NULL, 'shortlink', NULL, NULL, 'shortlink', 'default', 'N', NULL, 'Сохранение прошло успешно', 1, 'Произошла ошибка, обратитесь к администратору, ой вы и есть администратор. :('),
(32, 'Мобильное меню', 'menu', 'any', NULL, 'right-menu', NULL, NULL, 'menu', 'right-menu', 'N', NULL, NULL, 1, NULL),
(33, 'Хлебные крошки', 'breadcrumbs', 'any', 'Хлебные крошки', 'breadcrumbs', NULL, NULL, 'breadcrumbs', 'default', 'N', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `modules_type`
--

CREATE TABLE `modules_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `version_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules_type`
--

INSERT INTO `modules_type` (`id`, `type`, `version`, `version_desc`) VALUES
(1, 'element', '1', NULL),
(2, 'list', '1', NULL),
(3, 'menu', '2', NULL),
(4, 'banner', '1', NULL),
(5, 'search', '2', 'улучшенный поиск с возможностью сохранять поиск при переходе по страницам'),
(6, 'map', '1', NULL),
(7, 'login', '1', NULL),
(8, 'register', '1', NULL),
(9, 'html', '1', NULL),
(10, 'form', '5', NULL),
(11, 'breadcrumbs', '1', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `metakeys` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `index` int(11) NOT NULL DEFAULT '0' COMMENT 'главная ли',
  `active` varchar(11) NOT NULL DEFAULT 'Y' COMMENT 'активна ли',
  `menu_active` varchar(11) NOT NULL DEFAULT 'Y' COMMENT 'показывать ли в меню эту страницу',
  `menu_type` varchar(255) NOT NULL,
  `temp_folder` varchar(255) NOT NULL DEFAULT 'default',
  `menu_name` varchar(255) NOT NULL,
  `template_type` varchar(255) NOT NULL DEFAULT 'default',
  `modules` varchar(1) NOT NULL DEFAULT 'N',
  `alias` varchar(255) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  `content_type` varchar(255) NOT NULL DEFAULT 'N',
  `content_temp` varchar(255) DEFAULT 'default',
  `list_limit` int(3) DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `model`, `title`, `temp`, `metakeys`, `keywords`, `index`, `active`, `menu_active`, `menu_type`, `temp_folder`, `menu_name`, `template_type`, `modules`, `alias`, `permission`, `content_type`, `content_temp`, `list_limit`) VALUES
(1, 'main', 'urlservice', 'Главная', 'main', '', '', 1, 'Y', 'N', 'main-menu', 'default', 'Главная', 'default', 'Y', 'urlservice', 11, 'N', 'default', 10),
(2, 'administrator', 'administrator', 'Административная панель', 'main', '', '', 0, 'Y', 'Y', 'admin-menu', 'administrator', 'Рабочий стол', 'default', 'Y', 'main', 3, 'N', 'default', 10),
(7, 'login', 'login', 'Вход', 'login', '', '', 0, 'Y', 'N', 'main-menu', 'default', 'Вход', 'default', 'N', 'login', 11, 'N', 'default', 10),
(8, 'personal', 'personal', 'Личный кабинет', 'personal', '', '', 0, 'Y', 'N', 'main-menu', 'default', 'Личный кабинет', 'personal', 'N', 'personal', 5, 'N', 'default', 10),
(9, 'register', 'register', 'Регистрация', 'register', '', '', 0, 'Y', 'N', 'main-menu', 'default', 'Регистрация', 'default', 'N', 'register', 11, 'N', 'default', 10),
(11, 'pages', 'administrator', 'Страницы сайта', 'main', '', '', 0, 'Y', 'Y', '', 'administrator', '', 'default', 'N', 'pages', 3, 'list', 'listPages', 10),
(12, 'cats', 'administrator', 'Категории', 'main', '', '', 0, 'Y', 'Y', '', 'administrator', '', 'default', 'N', 'cats', 3, 'N', 'default', 100),
(13, 'modules', 'administrator', 'Модули', 'main', '', '', 0, 'Y', 'Y', '', 'administrator', '', 'default', 'N', 'modules', 3, 'N', 'default', 10),
(14, 'users', 'administrator', 'Пользователи', 'main', '', '', 0, 'Y', 'Y', '', 'administrator', '', 'default', 'N', 'users', 3, 'N', 'default', 10),
(15, 'content', 'administrator', 'Контент', 'main', '', '', 0, 'Y', 'Y', '', 'administrator', '', 'default', 'N', 'content', 3, 'N', 'default', 50),
(16, 'fields', 'administrator', 'Дополнительные поля', 'main', '', '', 0, 'Y', 'Y', '', 'administrator', '', 'default', 'N', 'fields', 3, 'N', 'default', 10),
(21, 'katalog', 'katalog', 'Сервис генерирования укороченных ссылок', 'default', '', '', 0, 'Y', 'Y', 'main-menu', 'default', 'Микросервис', 'default', 'N', 'katalog', 11, 'detail', 'service', 9),
(24, 'busket', 'busket', 'Корзина', 'busket', '', '', 0, 'Y', 'N', '', 'default', '', 'default', 'N', 'busket', 11, 'N', 'default', 10),
(25, 'buys', 'administrator', 'Покупки', 'buys', '', '', 0, 'Y', 'Y', '', 'administrator', '', 'default', 'N', 'buys', 3, 'N', 'default', 10),
(29, 'settings', 'settings', 'Настройка', 'settings', '', '', 0, 'Y', 'Y', '', 'default', '', 'personal', 'N', 'settings', 5, 'N', 'default', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `shortlink`
--

CREATE TABLE `shortlink` (
  `id` int(255) NOT NULL,
  `orig_url` varchar(255) NOT NULL,
  `edit_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shortlink`
--

INSERT INTO `shortlink` (`id`, `orig_url`, `edit_url`) VALUES
(114, 'https://www.google.com/doodles/434th-anniversary-of-the-introduction-of-the-gregorian-calendar/', 'http://searchsiru.temp.swtest.ru/5473'),
(115, 'https://www.google.com/doodles/434th-anniversary-of-the-introduction-of-the-gregorian-calendar/', 'http://searchsiru.temp.swtest.ru/e9ac'),
(116, 'https://www.youtube.com/watch?v=iISqkvzIW8w/', 'http://searchsiru.temp.swtest.ru/f118'),
(117, 'http://a-pb.ru/postroenie-otdela-prodazh/?utm_source=facebook/', 'http://searchsiru.temp.swtest.ru/5d69');

-- --------------------------------------------------------

--
-- Структура таблицы `site_params`
--

CREATE TABLE `site_params` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `site_params`
--

INSERT INTO `site_params` (`id`, `name`, `value`, `type`) VALUES
(1, 'ajax', 'Y', 'ajax'),
(2, 'mail', 'mvlad91@mail.ru', 'main'),
(3, 'sitename', 'Protobox', 'main'),
(4, 'siteactive', 'Y', 'main'),
(5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `active` varchar(255) DEFAULT 'active',
  `status` varchar(255) DEFAULT 'active',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `domen` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT 'registed',
  `permissions` varchar(255) DEFAULT '3',
  `hesh` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NULL DEFAULT NULL,
  `last_online` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sess_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `middle_name`, `password`, `login`, `active`, `status`, `email`, `phone`, `site`, `domen`, `group`, `permissions`, `hesh`, `reg_date`, `last_online`, `sess_id`) VALUES
(7, 'Максим', 'Пятков', 'Владиславович', '2a1dd5bd9f4ff21631577d6f56845d4a', 'admin', 'Y', 'active', 'mvlad91@mail.ru', '89134754665', NULL, 'ilab', '1', '1', '21232f297a57a5a743894a0e4a801fc3', '2015-07-28 15:49:50', '2016-07-11 07:10:51', 'b6e9b028c3687774d28d1e5d09a2fe79'),
(8, 'max', '', '', '0a59126e0b255f8bcb330b13f3027349', 'upsarin', 'Y', 'active', 'mvlad1991@mail.ru', NULL, NULL, NULL, 'registed', '3', 'cafc03e392c08d6d8363d2779b3ff65a', NULL, '2016-10-18 05:09:32', '03d7eb42d96f82af1e12bb11ac397546');

-- --------------------------------------------------------

--
-- Структура таблицы `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `permissions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `permissions`) VALUES
(1, 'admin', '1'),
(2, 'registed', '5'),
(3, 'moderator', '2'),
(4, 'guest', '11'),
(5, 'time-guest', '5'),
(6, 'executor', '5'),
(7, 'customer', '5');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `field_value`
--
ALTER TABLE `field_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `iblock`
--
ALTER TABLE `iblock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `modules_type`
--
ALTER TABLE `modules_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `shortlink`
--
ALTER TABLE `shortlink`
  ADD UNIQUE KEY `ID` (`id`);

--
-- Индексы таблицы `site_params`
--
ALTER TABLE `site_params`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buys`
--
ALTER TABLE `buys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8006;
--
-- AUTO_INCREMENT для таблицы `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT для таблицы `field_value`
--
ALTER TABLE `field_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16157;
--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;
--
-- AUTO_INCREMENT для таблицы `iblock`
--
ALTER TABLE `iblock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `modules_type`
--
ALTER TABLE `modules_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `shortlink`
--
ALTER TABLE `shortlink`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT для таблицы `site_params`
--
ALTER TABLE `site_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
