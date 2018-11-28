CREATE TABLE `users` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`email`  varchar(255) NULL ,
`name`  varchar(50) NULL ,
`password`  varchar(50) NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=COMPACT
;