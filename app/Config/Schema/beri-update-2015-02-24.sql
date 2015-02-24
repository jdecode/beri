CREATE TABLE `comments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `type` int(11) NOT NULL,
 `type_connection` int(11) NOT NULL,
 `comment` text NOT NULL,
 `created` int(11) NOT NULL,
 `modified` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

