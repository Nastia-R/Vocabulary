CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `word` text NOT NULL,
  `descr` text NOT NULL,
  `trans` text NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;