#The DB is created with UTF 8 encoding
CREATE DATABASE IF NOT EXISTS eam_consultores CHARACTER SET utf8 COLLATE utf8_unicode_ci;

#The DB created is used
USE eam_consultores;

#The users table is created here
CREATE TABLE IF NOT EXISTS users(
  ID          INT(5) UNSIGNED AUTO_INCREMENT NOT NULL,
  First_name  VARCHAR(100) NOT NULL,
  Last_name   VARCHAR(100),
  Email       VARCHAR(100) NOT NULL,
  Password    TEXT NOT NULL,
  Date        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_users PRIMARY KEY(ID)
)ENGINE='InnoDB';

#The content table is created here and is linked to users ID
CREATE TABLE IF NOT EXISTS content(
  ID                        INT(5) UNSIGNED AUTO_INCREMENT NOT NULL,
  User_id                   INT(5) UNSIGNED NOT NULL,
  landing_subtitle          VARCHAR(255),
  about_description         TEXT NOT NULL,
  social_media_links        TEXT NOT NULL,
  services_description      TEXT NOT NULL,
  portfolio_titles          TEXT NOT NULL,
  portfolio_subtitles       TEXT NOT NULL,
  portfolio_descriptions    TEXT NOT NULL,
  portfolio_links           TEXT NOT NULL,
  about_image_type_1        TEXT NOT NULL,
  portfolio_image_type_1    TEXT NOT NULL,
  portfolio_image_type_2    TEXT NOT NULL,
  portfolio_image_type_3    TEXT NOT NULL,
  about_image_file_1        LONGBLOB NOT NULL,
  portfolio_image_file_1    LONGBLOB NOT NULL,
  portfolio_image_file_2    LONGBLOB NOT NULL,
  portfolio_image_file_3    LONGBLOB NOT NULL,
  CONSTRAINT pk_content PRIMARY KEY(ID),
  CONSTRAINT fk_content_user FOREIGN KEY(User_id) REFERENCES users(ID)
)ENGINE='InnoDB';