
-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES(1, 'Fashion', '2014-06-01 00:35:07', '2014-05-31 09:34:33');
INSERT INTO `categories` VALUES(2, 'Electronics', '2014-06-01 00:35:07', '2014-05-31 09:34:33');
INSERT INTO `categories` VALUES(3, 'Motors', '2014-06-01 00:35:07', '2014-05-31 09:34:54');
