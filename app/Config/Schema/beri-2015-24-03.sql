ALTER TABLE `documents` CHANGE `filename` `filename` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
CHANGE `file_type` `file_type` VARCHAR( 128 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
CHANGE `downloaded_count` `downloaded_count` INT( 8 ) UNSIGNED NULL DEFAULT '0';


