CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` text CHARACTER SET utf8,
  `email` text CHARACTER SET utf8,
  `pass` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;