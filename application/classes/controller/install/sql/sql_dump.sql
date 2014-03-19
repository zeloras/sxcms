-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 19 2014 г., 03:26
-- Версия сервера: 5.0.95
-- Версия PHP: 5.4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+04:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Структура таблицы `sx_additional_fields`
--

CREATE TABLE IF NOT EXISTS `sx_additional_fields` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `csv` varchar(255) NOT NULL,
  `category` varchar(1000) NOT NULL,
  `active` int(1) NOT NULL,
  `date` int(13) NOT NULL,
  `update` int(13) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sx_additional_fields_data`
--

CREATE TABLE IF NOT EXISTS `sx_additional_fields_data` (
  `id` int(255) NOT NULL auto_increment,
  `properties_id` int(100) NOT NULL,
  `item_id` int(255) NOT NULL,
  `value` text NOT NULL,
  `date` int(13) NOT NULL,
  `update` int(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Структура таблицы `sx_categorys`
--

CREATE TABLE IF NOT EXISTS `sx_categorys` (
  `id` int(30) NOT NULL auto_increment,
  `parent_id` int(30) NOT NULL,
  `title` varchar(200) character set utf8 NOT NULL,
  `image` varchar(255) character set utf8 NOT NULL,
  `url` varchar(255) character set utf8 NOT NULL,
  `description` text character set utf8 NOT NULL,
  `meta_keywords` varchar(255) character set utf8 NOT NULL,
  `meta_description` varchar(500) character set utf8 NOT NULL,
  `position` int(30) NOT NULL,
  `template` varchar(255) character set utf8 NOT NULL,
  `date` int(12) NOT NULL,
  `update` int(12) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Структура таблицы `sx_comments`
--

CREATE TABLE IF NOT EXISTS `sx_comments` (
  `id` int(11) NOT NULL auto_increment,
  `module` varchar(25) NOT NULL default 'core',
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_site` varchar(250) NOT NULL,
  `item_id` bigint(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` int(11) NOT NULL,
  `status` smallint(1) NOT NULL,
  `agent` varchar(250) NOT NULL,
  `user_ip` varchar(64) NOT NULL,
  `rate` int(11) NOT NULL,
  `text_plus` varchar(500) default NULL,
  `text_minus` varchar(500) default NULL,
  `like` int(11) NOT NULL,
  `disslike` int(11) NOT NULL,
  `parent` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `module` (`module`),
  KEY `item_id` (`item_id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sx_i18n`
--

CREATE TABLE IF NOT EXISTS `sx_i18n` (
  `id` int(200) NOT NULL auto_increment,
  `item_id` int(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `lang` varchar(10) NOT NULL,
  `row` varchar(200) NOT NULL,
  `translate` text NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sx_langs`
--

CREATE TABLE IF NOT EXISTS `sx_langs` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(120) NOT NULL,
  `file` varchar(10) NOT NULL,
  `active` int(1) NOT NULL,
  `default` int(1) NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

--
-- Дамп данных таблицы `sx_langs`
--

INSERT INTO `sx_langs` (`id`, `title`, `file`, `active`, `default`, `date`) VALUES
(1, 'Русский', 'ru', 1, 0, 1394655068),
(2, 'English', 'en', 1, 0, 1394649412);

-- --------------------------------------------------------

--
-- Структура таблицы `sx_menus`
--

CREATE TABLE IF NOT EXISTS `sx_menus` (
  `id` int(30) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `template` varchar(255) NOT NULL,
  `date` int(13) NOT NULL,
  `update` int(13) NOT NULL,
  `class` varchar(255) NOT NULL,
  `parent_class` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Структура таблицы `sx_menus_data`
--

CREATE TABLE IF NOT EXISTS `sx_menus_data` (
  `id` int(30) NOT NULL auto_increment,
  `menu_id` int(30) NOT NULL,
  `icons` varchar(120) NOT NULL,
  `title` varchar(255) NOT NULL,
  `hidden` int(1) NOT NULL,
  `parent_id` int(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `data` text NOT NULL,
  `date` int(13) NOT NULL,
  `classes` varchar(255) NOT NULL,
  `position` int(31) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Структура таблицы `sx_modules`
--

CREATE TABLE IF NOT EXISTS `sx_modules` (
  `id` int(40) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `version` varchar(30) NOT NULL,
  `author` varchar(150) NOT NULL,
  `author_info` text NOT NULL,
  `dir` varchar(255) NOT NULL,
  `position` int(40) NOT NULL,
  `active` int(1) NOT NULL,
  `menu` int(1) NOT NULL,
  `site` int(1) NOT NULL,
  `settings` text NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Структура таблицы `sx_pages`
--

CREATE TABLE IF NOT EXISTS `sx_pages` (
  `id` int(30) NOT NULL auto_increment,
  `title` varchar(200) character set utf8 NOT NULL,
  `short_text` varchar(1000) character set utf8 NOT NULL,
  `text` text character set utf8 NOT NULL,
  `url` varchar(200) character set utf8 NOT NULL,
  `cat_url` varchar(200) character set utf8 NOT NULL,
  `category` int(30) NOT NULL,
  `meta_keywords` varchar(255) character set utf8 NOT NULL,
  `meta_description` varchar(500) character set utf8 NOT NULL,
  `template` varchar(200) NOT NULL,
  `site_template` varchar(200) NOT NULL,
  `author` int(100) NOT NULL,
  `status` int(2) NOT NULL,
  `comment` int(1) NOT NULL,
  `position` int(30) NOT NULL,
  `date` int(12) NOT NULL,
  `post_date` int(13) NOT NULL,
  `update` int(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Структура таблицы `sx_roles`
--

CREATE TABLE IF NOT EXISTS `sx_roles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `name` varchar(32) NOT NULL,
  `access` text NOT NULL,
  `is_admin` int(1) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `sx_roles`
--

INSERT INTO `sx_roles` (`id`, `title`, `name`, `access`, `is_admin`, `description`) VALUES
(1, 'Пользователь', 'login', 'a:23:{i:0;s:2:"11";i:1;s:2:"12";i:2;s:2:"13";i:3;s:2:"14";i:4;s:2:"21";i:5;s:2:"22";i:6;s:2:"23";i:7;s:2:"24";i:8;s:2:"31";i:9;s:2:"32";i:10;s:2:"33";i:11;s:2:"34";i:12;s:2:"41";i:13;s:2:"42";i:14;s:2:"43";i:15;s:2:"44";i:16;s:2:"51";i:17;s:2:"52";i:18;s:2:"53";i:19;s:2:"54";i:20;s:2:"61";i:21;s:2:"62";i:22;s:2:"63";}', 0, 'Login privileges, granted after account confirmation'),
(2, 'Администратор', 'admin', 'a:47:{i:0;s:2:"71";i:1;s:2:"11";i:2;s:2:"12";i:3;s:2:"13";i:4;s:2:"14";i:5;s:2:"21";i:6;s:2:"22";i:7;s:2:"23";i:8;s:2:"24";i:9;s:2:"31";i:10;s:2:"32";i:11;s:2:"33";i:12;s:2:"34";i:13;s:2:"41";i:14;s:2:"42";i:15;s:2:"43";i:16;s:2:"44";i:17;s:2:"51";i:18;s:2:"52";i:19;s:2:"53";i:20;s:2:"54";i:21;s:3:"121";i:22;s:3:"122";i:23;s:3:"123";i:24;s:3:"124";i:25;s:2:"61";i:26;s:2:"62";i:27;s:2:"63";i:28;s:2:"81";i:29;s:2:"82";i:30;s:2:"83";i:31;s:2:"84";i:32;s:2:"91";i:33;s:2:"92";i:34;s:2:"93";i:35;s:2:"94";i:36;s:3:"101";i:37;s:3:"102";i:38;s:3:"103";i:39;s:3:"104";i:40;s:3:"111";i:41;s:3:"112";i:42;s:3:"113";i:43;s:3:"114";i:44;s:20:"feedback_admin_index";i:45;s:23:"feedback_admin_settings";i:46;s:21:"feedback_public_index";}', 1, 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Структура таблицы `sx_roles_users`
--

CREATE TABLE IF NOT EXISTS `sx_roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sx_roles_users`
--

INSERT INTO `sx_roles_users` (`user_id`, `role_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `sx_settings`
--

CREATE TABLE IF NOT EXISTS `sx_settings` (
  `general` text NOT NULL,
  `seo` text NOT NULL,
  `template` text NOT NULL,
  `cloud` text NOT NULL,
  `seo_delete` text NOT NULL,
  `comments` text NOT NULL,
  `other` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sx_settings`
--

INSERT INTO `sx_settings` (`general`, `seo`, `template`, `cloud`, `seo_delete`, `comments`, `other`) VALUES
('a:4:{s:9:"site_name";s:18:"Testo name 1111222";s:12:"disable_site";s:1:"1";s:8:"language";s:2:"ru";s:11:"text_editor";s:5:"elrte";}', 'a:3:{s:9:"site_name";s:15:"Seo site name 1";s:11:"description";s:17:"Seo description 2";s:8:"keywords";s:14:"Seo keywords 3";}', 'N;', 'a:2:{s:6:"yandex";a:2:{s:5:"login";s:0:"";s:8:"password";s:0:"";}s:3:"ftp";a:4:{s:6:"server";s:0:"";s:4:"port";s:0:"";s:5:"login";s:0:"";s:8:"password";s:0:"";}}', '', 'a:9:{s:6:"length";s:4:"1000";s:7:"timeout";s:1:"0";s:4:"user";s:1:"3";s:7:"captcha";s:1:"2";s:13:"captcha_width";s:3:"200";s:14:"captcha_height";s:3:"100";s:14:"captcha_length";s:1:"4";s:6:"status";s:1:"2";s:10:"controller";s:20:"/syscom/post_comment";}', '');

--
-- Структура таблицы `sx_users`
--

CREATE TABLE IF NOT EXISTS `sx_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `email` varchar(254) NOT NULL default '123123',
  `username` varchar(32) NOT NULL default '',
  `password` varchar(64) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(150) NOT NULL,
  `address` varchar(190) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `logins` int(10) unsigned NOT NULL default '0',
  `last_login` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sx_user_tokens`
--

CREATE TABLE IF NOT EXISTS `sx_user_tokens` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Структура таблицы `sx_widgets`
--

CREATE TABLE IF NOT EXISTS `sx_widgets` (
  `id` int(20) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `type` varchar(70) NOT NULL,
  `data` text NOT NULL,
  `module` varchar(500) NOT NULL,
  `method` varchar(150) NOT NULL,
  `settings` text NOT NULL,
  `position` int(20) NOT NULL,
  `active` int(1) NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sx_roles_users`
--
ALTER TABLE `sx_roles_users`
  ADD CONSTRAINT `sx_roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sx_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sx_roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `sx_roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sx_user_tokens`
--
ALTER TABLE `sx_user_tokens`
  ADD CONSTRAINT `sx_user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sx_users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
