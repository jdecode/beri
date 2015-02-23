
CREATE TABLE `documents` (
`id` INT( 8 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 255 ) NOT NULL ,
`filename` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`file_type` VARCHAR( 16 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`status` INT( 4 ) NOT NULL ,
`downloaded_count` INT( 8 ) UNSIGNED NOT NULL ,
`document_connection` INT( 4 ) UNSIGNED NOT NULL ,
`connector_link` INT( 8 ) UNSIGNED NOT NULL ,
`modified` INT( 10 ) UNSIGNED NOT NULL ,
`created` INT( 10 ) UNSIGNED NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE `documents` CHANGE `filename` `filename` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `file_type` `file_type` VARCHAR( 128 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
