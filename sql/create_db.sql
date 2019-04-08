CREATE DATABASE IF NOT EXISTS eam_consultores CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE eam_consultores;

CREATE TABLE IF NOT EXISTS users(
  ID          INT(5) UNSIGNED AUTO_INCREMENT NOT NULL,
  First_name  VARCHAR(100) NOT NULL,
  Last_name   VARCHAR(100),
  Email       VARCHAR(100) NOT NULL,
  Password    TEXT NOT NULL,
  Date        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_users PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS content(
  ID                        INT(5) UNSIGNED AUTO_INCREMENT NOT NULL,
  landing_subtitle          VARCHAR(100),
  about_description         TEXT NOT NULL,
  social_media_links        VARCHAR(255) NOT NULL,
  service_contabilidad      VARCHAR(150) NOT NULL, 
  service_administracion    VARCHAR(150) NOT NULL,
  service_reclutamiento     VARCHAR(150) NOT NULL,
  portfolio_titles          VARCHAR(255) NOT NULL,
  portfolio_subtitles       VARCHAR(50) NOT NULL,
  portfolio_descriptions    VARCHAR(255) NOT NULL,
  portfolio_links           VARCHAR(255) NOT NULL,
  portfolio_images          LONGBLOB NOT NULL,
  CONSTRAINT pk_content PRIMARY KEY(ID)
)ENGINE='InnoDB';