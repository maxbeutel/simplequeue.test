CREATE DATABASE queue_test CHARSET utf8;
 
CREATE TABLE `queue_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `message` blob,
  `process_id` tinyint(3) NOT NULL,
  `started` datetime DEFAULT NULL,
  `retry_count` tinyint(3) DEFAULT '0',
  `state` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET=utf8;