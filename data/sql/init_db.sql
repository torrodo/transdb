CREATE DATABASE IF NOT EXISTS `transdb`;
USE `transdb`;


/*
 * message domains grouping the translations
 */
DROP TABLE IF EXISTS `message_domain`;

CREATE TABLE `message_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL, 
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT uk_unq_key UNIQUE (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
 * available languages for the translations
 */
DROP TABLE IF EXISTS `message_language`;

CREATE TABLE `message_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(8) NOT NULL, 
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT uk_unq_key UNIQUE (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
 * message keys defining texts going to be translated
 */
DROP TABLE IF EXISTS `message_key`;

CREATE TABLE `message_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL, 
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT uk_unq_key UNIQUE (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/* 
 * translation texts identified by <domain>, <language>, <key>
 */
DROP TABLE IF EXISTS `message_translation`;

CREATE TABLE `message_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_domain_id` int(11) NOT NULL,
  `message_language_id` int(11) NOT NULL,
  `message_key_id` int(11) NOT NULL,
  `message_text` text NOT NULL,  
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT uk_unq_key UNIQUE (`message_domain_id`, `message_language_id`, `message_key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*
 * some test data 
 */

INSERT INTO `message_domain` VALUES 
  (
    1,
    'messages',
    null
  ),
  (
    2,
    'admin',
    null
  );

INSERT INTO `message_language` VALUES 
  (
    1,
    'en',
    null
  ),
  (
    2,
    'de',
    null
  );

INSERT INTO `message_key` VALUES 
  (
    1,
    'site.name',
    null
  ),
  (
    2,
    'site.welcome',
    null
  );

INSERT INTO `message_translation` VALUES 
  (
    1,
    1,
    1,
    1,
    'This is a test page.',
    null
  ),
  (
    2,
    1,
    1,
    2,
    'Welcome to the page.',
    null
  ),
  (
    3,
    2,
    1,
    1,
    'This is an admin test page.',
    null
  ),
  (
    4,
    2,
    1,
    2,
    'Welcome to the admin page.',
    null
  ),
  (
    5,
    1,
    2,
    1,
    'Dies ist eine Testseite.',
    null
  ),
  (
    6,
    1,
    2,
    2,
    'Willkommen auf der Seite.',
    null
  ),
  (
    7,
    2,
    2,
    1,
    'Dies ist eine admin Testseite.',
    null
  ),
  (
    8,
    2,
    2,
    2,
    'Willkommen auf der admin Seite.',
    null
  );