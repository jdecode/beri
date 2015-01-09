
CREATE TABLE IF NOT EXISTS `award_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `company` varchar(256) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `skype` varchar(32) NOT NULL,
  `google` varchar(32) NOT NULL,
  `yahoo` varchar(32) NOT NULL,
  `hotmail` varchar(32) NOT NULL,
  `modifed` bigint(10) NOT NULL,
  `created` bigint(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(8) unsigned NOT NULL,
  `type` int(2) unsigned NOT NULL DEFAULT '1' COMMENT '1 => login, 2 => logout',
  `timestamp` int(10) unsigned NOT NULL,
  `modified` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `user_id`, `type`, `timestamp`, `modified`, `created`) VALUES
(14, 2, 1, 1358777474, 1358777474, 1358777474),
(15, 2, 2, 1358777499, 1358777499, 1358777499),
(16, 2, 1, 1358777527, 1358777527, 1358777527),
(17, 2, 2, 1358777535, 1358777535, 1358777535),
(18, 2, 1, 1358777617, 1358777617, 1358777617),
(19, 2, 2, 1358777633, 1358777633, 1358777633),
(20, 2, 1, 1358777706, 1358777706, 1358777706),
(21, 2, 2, 1358777728, 1358777728, 1358777728),
(22, 2, 1, 1358828019, 1358828019, 1358828019),
(23, 2, 2, 1358829911, 1358829911, 1358829911),
(24, 2, 1, 1358827019, 1358829938, 1358829938),
(25, 2, 2, 1358920868, 1358920868, 1358920868),
(26, 2, 1, 1358920873, 1358920873, 1358920873),
(27, 2, 2, 1359435135, 1359435136, 1359435136),
(28, 2, 1, 1359435143, 1359435143, 1359435143),
(29, 2, 2, 1359529962, 1359529962, 1359529962),
(30, 2, 1, 1363776690, 1363776690, 1363776690),
(31, 2, 2, 1364301433, 1364301433, 1364301433),
(32, 2, 1, 1364301437, 1364301437, 1364301437),
(34, 2, 2, 1364473340, 1364473340, 1364473340),
(35, 2, 1, 1364473359, 1364473359, 1364473359),
(36, 2, 2, 1404821581, 1404821581, 1404821581),
(37, 2, 1, 1404821591, 1404821591, 1404821591),
(38, 2, 2, 1404821602, 1404821602, 1404821602),
(39, 2, 1, 1405008706, 1405008706, 1405008706),
(40, 2, 2, 1405008713, 1405008713, 1405008713),
(41, 2, 1, 1405008938, 1405008938, 1405008938),
(42, 2, 2, 1405333083, 1405333083, 1405333083),
(43, 2, 1, 1405333087, 1405333087, 1405333087),
(44, 2, 2, 1407258924, 1407258924, 1407258924),
(45, 2, 1, 1407258962, 1407258962, 1407258962),
(46, 2, 2, 1407427617, 1407427617, 1407427617),
(47, 2, 1, 1408249649, 1408249649, 1408249649),
(50, 2, 2, 1418033270, 1418033270, 1418033270),
(51, 2, 1, 1418033754, 1418033754, 1418033754),
(53, 2, 2, 1418101476, 1418101476, 1418101476),
(54, 2, 1, 1418101496, 1418101496, 1418101496),
(55, 2, 2, 1418116047, 1418116047, 1418116047),
(56, 2, 1, 1418116056, 1418116056, 1418116056),
(57, 2, 2, 1418116107, 1418116107, 1418116107),
(58, 2, 1, 1418116171, 1418116171, 1418116171),
(59, 2, 2, 1418116196, 1418116196, 1418116196),
(60, 2, 1, 1418116204, 1418116204, 1418116204),
(61, 2, 2, 1418118855, 1418118855, 1418118855),
(62, 2, 1, 1418365113, 1418365113, 1418365113),
(63, 2, 2, 1419243813, 1419243813, 1419243813),
(64, 2, 1, 1419243822, 1419243822, 1419243822),
(65, 2, 2, 1419243826, 1419243826, 1419243826),
(66, 2, 1, 1419316528, 1419316528, 1419316528),
(67, 2, 2, 1420792911, 1420792911, 1420792911),
(68, 2, 1, 1420792913, 1420792913, 1420792913),
(69, 2, 2, 1420792915, 1420792915, 1420792915);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `active` int(2) unsigned NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `active`) VALUES
(1, 'Admin', 1),
(2, 'Manager', 1),
(3, 'User', 1),
(4, 'Sales', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(16) NOT NULL,
  `link` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `budget_amount` decimal(16,2) NOT NULL,
  `budget_text` varchar(150) NOT NULL DEFAULT '$0',
  `posted_on` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `published_date` varchar(128) NOT NULL,
  `source` int(4) NOT NULL COMMENT 'array( 	1 => ''oDesk'', 2 => ''Elance'',3=>"private")',
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '1=>Open bid, 2 => Placed, 3 => declined, 4 => Response received, 5 => Project start',
  `reply` text NOT NULL,
  `active` int(3) NOT NULL DEFAULT '1',
  `deleted` int(3) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1=>default,2=>private',
  `modified` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lead_categories`
--

CREATE TABLE IF NOT EXISTS `lead_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lead_views`
--

CREATE TABLE IF NOT EXISTS `lead_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT '2' COMMENT '1=viewed,2=not view',
  `bid_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `project_id` int(8) unsigned NOT NULL,
  `status` int(8) unsigned NOT NULL,
  `created` bigint(16) unsigned NOT NULL,
  `modified` bigint(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(8) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(16) NOT NULL,
  `status` int(2) unsigned NOT NULL,
  `created` bigint(16) unsigned NOT NULL,
  `modified` bigint(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sprints`
--

CREATE TABLE IF NOT EXISTS `sprints` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `project_id` int(8) unsigned NOT NULL,
  `status` int(2) unsigned NOT NULL,
  `created` bigint(16) unsigned NOT NULL,
  `modified` bigint(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sprints_tasks`
--

CREATE TABLE IF NOT EXISTS `sprints_tasks` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `sprint_id` int(8) unsigned NOT NULL,
  `task_id` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `module_id` int(8) unsigned NOT NULL,
  `user_id` int(8) unsigned NOT NULL,
  `hours_allocated` varchar(4) NOT NULL,
  `status` int(2) unsigned NOT NULL,
  `created` bigint(16) unsigned NOT NULL,
  `modified` bigint(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks_users`
--

CREATE TABLE IF NOT EXISTS `tasks_users` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(8) unsigned NOT NULL,
  `user_id` int(8) unsigned NOT NULL,
  `hours` float unsigned NOT NULL,
  `status` int(4) NOT NULL DEFAULT '1',
  `created` bigint(16) unsigned NOT NULL,
  `modified` bigint(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(8) unsigned NOT NULL DEFAULT '3' COMMENT '1 => Admin, 2 => Manager, 3 => User,4=>Sale',
  `email` varchar(64) NOT NULL,
  `password` varchar(40) NOT NULL,
  `forgot_password_hash` varchar(40) NOT NULL,
  `remember_me_cookie_hash` varchar(40) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `dob` int(10) unsigned NOT NULL,
  `gender` int(2) unsigned NOT NULL DEFAULT '1',
  `avatar` varchar(45) NOT NULL,
  `active` int(2) unsigned NOT NULL,
  `modified` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `email`, `password`, `forgot_password_hash`, `remember_me_cookie_hash`, `first_name`, `last_name`, `dob`, `gender`, `avatar`, `active`, `modified`, `created`) VALUES
(1, 1, 'admin@admin.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', '', '', 'Admin', '', 0, 1, 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 0, 0),
(2, 4, 'jdecode@gmail.com', 'b08947f8be862c4106279c4efad4b9e37adb8078', '', '', 'Jagdeep', 'Singh', 0, 1, '', 0, 1358766438, 1358766438);

