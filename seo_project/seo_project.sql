-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Бер 20 2012 р., 16:57
-- Версія сервера: 5.1.61
-- Версія PHP: 5.3.2-1ubuntu4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `seo_project`
--

-- --------------------------------------------------------

--
-- Структура таблиці `subdomain`
--

CREATE TABLE IF NOT EXISTS `subdomain` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) NOT NULL,
  `trade_id` int(11) DEFAULT NULL,
  `subtrade` text NOT NULL,
  `subdomain` varchar(255) DEFAULT NULL,
  `subdomaincontent` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Дамп даних таблиці `subdomain`
--


-- --------------------------------------------------------

--
-- Структура таблиці `trade`
--

CREATE TABLE IF NOT EXISTS `trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trade` varchar(255) NOT NULL,
  `metatitle` text NOT NULL,
  `metakeywords` text NOT NULL,
  `metadescription` text NOT NULL,
  `tradecontent` text NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Дамп даних таблиці `trade`
--

INSERT INTO `trade` (`id`, `trade`, `metatitle`, `metakeywords`, `metadescription`, `tradecontent`, `img1`, `img2`, `img3`) VALUES
(1, 'roofing', 'title about %company%, %trade% and %subtrade1%, %subtrade2%, %subtrade3%', 'my k', 'my d', '<p>Some body about %trade% with pictures</p>\n<p><img src="%img1%" alt="" /> <img src="%img2%" alt="" /> <img src="%img3%" alt="" /></p>', '9545e855f532b27df6bacd42bd66a28e.jpeg', 'ae74c6121bd06d6b57cf86b2fa80e96c.jpeg', '8b82e53cabdf4f0d5289601ac0c47860.jpeg'),
(2, 'siding', '', '', '', '', '', '', ''),
(3, 'doors', '', '', '', '', '', '', ''),
(4, 'windows', '%city% (%state%) %trade% contractor - %universaltitle%', '%trade%, %sub-trades%, %city%, %state%, %universalkeywords%', '%universaldescription%', '<h1 class="mission">%trade% - %sub-trades%</h1>\n<p>&nbsp;</p>\n<p class="content"><strong>%city% (%state%) %trade% - %company%</strong> is able to get the <strong>%trade%</strong> job done professionally and cost effectively. We have been repairing <strong>residential and commercial %trade% in the %city% (%state%) area</strong> for more than 15 years. We work on <strong>%trade%, %sub-trades%</strong>. We are a premier <strong>%trade% contractor</strong> in the city of %city%, %state%. <br /><br /> %universalcontent% <br /><br /></p>', '', '', ''),
(5, 'remodel', '', 'edgerton, Blue Springs %trade%, %maincity% %trade%,Lee''s Summit %trade%,kitchen %trade%,Remodeling,bathroom Remodel,Remodel pictures,remodel contractor,home remodel,Independence Remodel,Remodel contractor,Cabinet Remodel,basement remodel,Remodel', '', '', '', '', ''),
(6, 'flooring', '', '', '', '', '', '', ''),
(7, 'gutters', '', '', '', '', '', '', ''),
(8, 'painting', '', '', '', '', '', '', ''),
(9, 'landscaping', '', '', '', '', '', '', ''),
(10, 't3', '%city% (%state%) %trade% contractor - %universaltitle%', '%trade%, %sub-trades%, %city%, %state%, %universalkeywords%', '%trade% contractor in %city% (%state%) contractor in %trade% - %sub-trades% - %company%', '<p><strong>%city% (%state%) %trade% - %company%</strong> is able to get the <strong>%trade%</strong> job done professionally and cost effectively. We have been repairing <strong>residential and commercial %trade% in the %city% (%state%) area</strong> for more than 15 years. We work on <strong>%trade%, %sub-trades%</strong>. We are a premier <strong>%trade% contractor</strong> in the city of %city%, %state%. <br /><br /></p>', '', '', ''),
(11, 'lll', '%city% (%state%) %trade% contractor - %universaltitle%', '%trade%, %sub-trades%, %city%, %state%, %universalkeywords%', '%trade% contractor in %city% (%state%) contractor in %trade% - %sub-trades% - %company%', '<p><strong>%city% (%state%) %trade% - %company%</strong> is able to get the <strong>%trade%</strong> job done professionally and cost effectively. We have been repairing <strong>residential and commercial %trade% in the %city% (%state%) area</strong> for more than 15 years. We work on <strong>%trade%, %sub-trades%</strong>. We are a premier <strong>%trade% contractor</strong> in the city of %city%, %state%. <br /><br /></p>', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `universal`
--

CREATE TABLE IF NOT EXISTS `universal` (
  `id` varchar(256) NOT NULL DEFAULT '',
  `_value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `universal`
--

INSERT INTO `universal` (`id`, `_value`) VALUES
('company', 'Total Renovation group'),
('domain', 'TotalRenovationGroup.com'),
('maincity', 'Kansas City Metro Area'),
('pagetitle', '%trade% -  %company% - %maincity%''s  Professional Contractor specialized in %trade%, Commercial and Residential %trades%, etc. Insured, Bonded, more than 10 years experience providing quality works in %maincity% including %cities%.'),
('templatetitle', '%city% (%state%) %trade% contractor - %universaltitle%'),
('templatekeywords', '%trade%, %sub-trades%, %city%, %state%, %universalkeywords%'),
('templatedescription', '%trade% contractor in %city% (%state%) contractor in %trade% - %sub-trades% - %company%'),
('templatecontent', '<strong>%city%  (%state%)   %trade% - %company%</strong> is able to get the <strong>%trade%</strong> job done professionally and cost effectively.    We have been repairing <strong>residential and commercial %trade% in the %city% (%state%) area</strong> for more than 15 years.  We work on <strong>%trade%, %sub-trades%</strong>.  We are a premier <strong>%trade% contractor</strong> in the city of %city%, %state%.\r\n    <br /><br />');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'yp', '1');
