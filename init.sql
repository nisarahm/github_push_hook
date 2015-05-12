CREATE TABLE `EVENTSTABLE` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event` varchar(20) NOT NULL DEFAULT '',
  `payload` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `PUSHESTABLE` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `repository` varchar(30) NOT NULL DEFAULT '',
  `github_user` varchar(30) NOT NULL DEFAULT '',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commit` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `commit` (`commit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
