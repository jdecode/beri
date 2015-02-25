CREATE TABLE `beri`.`threads` (
`id` INT( 8 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 8 ) NOT NULL ,
`document_added` INT( 2 ) NOT NULL ,
`document_id` INT( 8 ) NOT NULL ,
`type` INT( 4 ) NOT NULL ,
`type_link` INT( 8 ) NOT NULL ,
`post` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`status` INT( 4 ) NOT NULL ,
`modified` INT( 10 ) UNSIGNED NOT NULL ,
`created` INT( 10 ) UNSIGNED NOT NULL
) ENGINE = MYISAM ;

