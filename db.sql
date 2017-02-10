CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_author` int(11) NOT NULL,
  `text` text CHARACTER SET latin1 NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `login` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(30) CHARACTER SET latin1 NOT NULL,
  `date` int(11) NOT NULL,
  `token` text,
  `token_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
