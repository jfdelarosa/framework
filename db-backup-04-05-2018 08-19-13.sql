DROP TABLE IF EXISTS aauth_group_to_group;

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) unsigned NOT NULL,
  `subgroup_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS aauth_groups;

CREATE TABLE `aauth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO aauth_groups VALUES("1","Admin","Super Admin Group"),
("2","Public","Public Access Group"),
("3","Default","Default Access Group");



DROP TABLE IF EXISTS aauth_login_attempts;

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO aauth_login_attempts VALUES("8","127.0.0.1","2018-05-01 22:43:07","8");



DROP TABLE IF EXISTS aauth_perm_to_group;

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS aauth_perm_to_user;

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS aauth_perms;

CREATE TABLE `aauth_perms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO aauth_perms VALUES("1","ver_usuarios",""),
("2","agregar_usuarios",""),
("3","editar_usuarios",""),
("4","ver_permisos",""),
("5","editar_permisos","");



DROP TABLE IF EXISTS aauth_pms;

CREATE TABLE `aauth_pms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS aauth_user_to_group;

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO aauth_user_to_group VALUES("1","1"),
("1","3"),
("2","3"),
("3","3"),
("4","3");



DROP TABLE IF EXISTS aauth_user_variables;

CREATE TABLE `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS aauth_users;

CREATE TABLE `aauth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO aauth_users VALUES("1","admin@example.com","dd5073c93fb477a167fd69072e95455834acd93df8fed41a2c468c45b394bfe3","Admin","0","2018-05-04 06:28:01","2018-05-04 06:28:01","","","","","","","127.0.0.1"),
("2","asd@asd.com","896b0e441633742362d0db17733aa31a2344b539c7b2be6409c54704e9fe85fc","test","0","","","2018-04-18 13:01:07","","","","","",""),
("3","my@user.com","21a0bea8543db5ab9607001ec5afaed3fa63e179e55428bbfc9ebf23f452a973","myuser","0","","","2018-04-18 13:16:12","","","","","",""),
("4","correo@asd.com","c1f03765054fc4083a07476a0b4f6a03a6d1189505917ff1fa952268683a44c5","uname","0","","","2018-04-18 13:17:02","","","","","","");



DROP TABLE IF EXISTS configs;

CREATE TABLE `configs` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_title` varchar(100) COLLATE utf8_bin NOT NULL,
  `config_description` varchar(255) COLLATE utf8_bin NOT NULL,
  `config_email` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




DROP TABLE IF EXISTS pages;

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `page_created_by` int(11) NOT NULL,
  `page_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_edited_by` int(11) NOT NULL,
  `page_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `page_slug` varchar(255) COLLATE utf8_bin NOT NULL,
  `page_content` text COLLATE utf8_bin NOT NULL,
  `page_status` int(11) NOT NULL DEFAULT '1',
  `page_edited_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`),
  KEY `pages_users` (`page_created_by`),
  KEY `page_edited_by` (`page_edited_by`),
  CONSTRAINT `pages_users` FOREIGN KEY (`page_created_by`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO pages VALUES("3","2018-03-25 06:02:17","1","2018-03-25 14:02:17","1","Prueba jeje xd","prueba-jeje-xd","Contenido\nde\nprueba.","1","3"),
("4","2018-04-02 21:42:54","1","2018-04-03 04:42:54","1","hola mundo :)","hola-mundo-","{\"data\":[]}","1","2"),
("5","2018-03-26 04:22:22","1","2018-03-26 12:22:22","1","Hola","hola","{\"data\":[{\"type\":\"heading\",\"data\":{\"text\":\"Titulo de la pagina<br>\",\"isHtml\":true}},{\"type\":\"text\",\"data\":{\"text\":\"<p>Hola mundo xdd<br></p>\",\"isHtml\":true}}]}","1","3"),
("6","2018-04-02 21:32:00","1","2018-03-27 17:54:36","0","heey","heey","{\"data\":[{\"type\":\"heading\",\"data\":{\"text\":\"asd<br>\",\"isHtml\":true}}]}","1","0"),
("7","2018-04-03 10:53:27","1","2018-04-01 17:29:03","0","heeeey","holax","{\"data\":[{\"type\":\"text\",\"data\":{\"text\":\"<p>hola mundo<br></p>\",\"isHtml\":true}}]}","1","0"),
("8","2018-04-02 21:40:44","1","2018-04-02 21:05:46","1","Pagina con contenido","pagina-con-contenido","{\"data\":[{\"type\":\"text\",\"data\":{\"text\":\"<p>asdasd<br></p>\",\"isHtml\":true}}]}","1","1"),
("9","2018-04-02 21:32:27","1","2018-04-02 21:16:53","0","new","new","{\"data\":[{\"type\":\"text\",\"data\":{\"text\":\"<p>hola mundo<br></p>\",\"isHtml\":true}}]}","1","0"),
("10","2018-04-20 02:31:04","1","2018-04-20 09:31:04","0","qwerty","qwerty","{\"data\":[{\"type\":\"text\",\"data\":{\"text\":\"adios mundo\\n\",\"isHtml\":true}},{\"type\":\"columns\",\"data\":{\"columns\":[{\"width\":3,\"blocks\":[{\"type\":\"heading\",\"data\":{\"heading\":\"h1\",\"text\":\"Titulo 1\\n\"}},{\"type\":\"text\",\"data\":{\"text\":\"hola\\n\"}}]},{\"width\":9,\"blocks\":[{\"type\":\"heading\",\"data\":{\"heading\":\"h1\",\"text\":\"Titulo 2\\n\"}},{\"type\":\"text\",\"data\":{\"text\":\"mundo\\n\"}}]}],\"preset\":\"columns-3-9\"}}]}","1","8");



DROP TABLE IF EXISTS roles_permisos;

CREATE TABLE `roles_permisos` (
  `rp_id` int(11) NOT NULL AUTO_INCREMENT,
  `permiso_id` int(11) NOT NULL,
  PRIMARY KEY (`rp_id`),
  KEY `permisos_roles_permisos` (`permiso_id`),
  CONSTRAINT `permisos_roles_permisos` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`permiso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO roles_permisos VALUES("1","1");



DROP TABLE IF EXISTS test;

CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `texto` varchar(50) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

INSERT INTO test VALUES("1","2018-03-25 03:23:41","asdsddd"),
("2","2018-03-25 03:22:51","asdad"),
("3","2018-03-25 03:25:09","rw"),
("4","2018-03-25 03:25:24","aa"),
("5","2018-03-25 03:25:53","hola"),
("6","2018-03-25 03:26:34","hola"),
("7","2018-03-25 03:26:35","hasdasdola"),
("8","2018-03-25 03:26:35","hol12312ea"),
("9","2018-03-25 03:26:35","holyrjrya"),
("10","2018-03-25 03:26:35","holsd fsd fsdfa"),
("11","2018-03-25 03:26:35","h6rh 5h 56h ola"),
("12","2018-03-25 03:26:35","hol h65hrh6 a"),
("13","2018-03-25 03:26:35","hola"),
("14","2018-03-25 03:26:35","hasdasdola"),
("15","2018-03-25 03:26:35","hol12312ea"),
("16","2018-03-25 03:26:35","holyrjrya"),
("17","2018-03-25 03:26:35","holsd fsd fsdfa"),
("18","2018-03-25 03:26:35","h6rh 5h 56h ola"),
("19","2018-03-25 03:26:36","hol h65hrh6 a"),
("20","2018-03-25 03:26:36","hola"),
("21","2018-03-25 03:26:36","hasdasdola"),
("22","2018-03-25 03:26:36","hol12312ea"),
("23","2018-03-25 03:26:36","holyrjrya"),
("24","2018-03-25 03:26:36","holsd fsd fsdfa"),
("25","2018-03-25 03:26:36","h6rh 5h 56h ola"),
("26","2018-03-25 03:26:36","hol h65hrh6 a"),
("27","2018-03-25 03:26:36","hola"),
("28","2018-03-25 03:26:36","hasdasdola"),
("29","2018-03-25 03:26:36","hol12312ea"),
("30","2018-03-25 03:26:36","holyrjrya"),
("31","2018-03-25 03:26:36","holsd fsd fsdfa"),
("32","2018-03-25 03:26:36","h6rh 5h 56h ola"),
("33","2018-03-25 03:26:36","hol h65hrh6 a"),
("34","2018-03-25 03:26:36","hola"),
("35","2018-03-25 03:26:36","hasdasdola"),
("36","2018-03-25 03:26:37","hol12312ea"),
("37","2018-03-25 03:26:37","holyrjrya"),
("38","2018-03-25 03:26:37","holsd fsd fsdfa"),
("39","2018-03-25 03:26:37","h6rh 5h 56h ola"),
("40","2018-03-25 03:26:37","hol h65hrh6 a"),
("41","2018-03-25 03:26:37","hola"),
("42","2018-03-25 03:26:37","hasdasdola"),
("43","2018-03-25 03:26:37","hol12312ea"),
("44","2018-03-25 03:26:37","holyrjrya"),
("45","2018-03-25 03:26:37","holsd fsd fsdfa"),
("46","2018-03-25 03:26:37","h6rh 5h 56h ola"),
("47","2018-03-25 03:26:37","hol h65hrh6 a"),
("48","2018-03-25 03:26:37","hola"),
("49","2018-03-25 03:26:37","hasdasdola"),
("50","2018-03-25 03:26:37","hol12312ea"),
("51","2018-03-25 03:26:37","holyrjrya"),
("52","2018-03-25 03:26:37","holsd fsd fsdfa"),
("53","2018-03-25 03:26:38","h6rh 5h 56h ola"),
("54","2018-03-25 03:26:38","hol h65hrh6 a");



DROP TABLE IF EXISTS user_attributes;

CREATE TABLE `user_attributes` (
  `attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




DROP TABLE IF EXISTS views;

CREATE TABLE `views` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `view_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `view_page` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




