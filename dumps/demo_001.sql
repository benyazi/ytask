-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: ytask_main
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `history_log`
--

DROP TABLE IF EXISTS `history_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `action` mediumtext COLLATE utf8_unicode_ci,
  `action_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `meta` text COLLATE utf8_unicode_ci,
  `history_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `history_log_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_log_ibfk_3` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_log_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_log`
--

LOCK TABLES `history_log` WRITE;
/*!40000 ALTER TABLE `history_log` DISABLE KEYS */;
INSERT INTO `history_log` VALUES (1,NULL,1,69,'In issue updated rows:</br>','update',NULL,'2015-12-16 18:48:22'),(2,NULL,1,69,'In issue updated rows:</br><strong>status2</strong> updated <strong>INPROGRESS</strong> &rarr; <strong>RESOLVED</strong></br>','update',NULL,'2015-12-16 18:48:36'),(3,NULL,1,67,'In issue updated rows:</br><strong>dateDue</strong> updated <strong>17.12.2015 01:01:28</strong> &rarr; <strong>17.12.2015 23:00:00</strong></br>','update',NULL,'2015-12-16 19:22:24'),(4,NULL,1,67,'In issue updated rows:</br><strong>dateDue</strong> updated <strong>17.12.2015 23:00:00</strong> &rarr; <strong>18.12.2015 23:00:00</strong></br>','update',NULL,'2015-12-16 19:23:06'),(5,NULL,1,67,'In issue updated rows:</br><strong>dateDue</strong> updated <strong>18.12.2015 23:00:00</strong> &rarr; <strong>19.12.2015 23:00:00</strong></br>','update',NULL,'2015-12-16 19:25:18'),(6,NULL,1,67,'In issue updated rows:</br><strong>dateDue</strong> updated <strong>19.12.2015 23:00:00</strong> &rarr; <strong>18.12.2015 23:00:00</strong></br>','update',NULL,'2015-12-16 19:30:25'),(7,NULL,1,70,'Created issue.','create',NULL,'2015-12-16 19:34:25'),(8,NULL,1,60,'Updated issue.','update',NULL,'2015-12-16 20:01:22'),(9,NULL,1,70,'In issue updated rows:</br><strong>priority</strong> updated <strong>LOW</strong> &rarr; <strong>LOWEST</strong></br>','update',NULL,'2015-12-16 20:02:33'),(10,NULL,1,60,'In issue updated rows:</br><strong>dateDue</strong> updated <strong></strong> &rarr; <strong>30.12.2015 23:00:00</strong></br><strong>userAssigned</strong> updated <strong></strong> &rarr; <strong>Админ</strong></br>','update',NULL,'2015-12-16 20:03:30'),(11,NULL,1,71,'Created issue.','create',NULL,'2015-12-16 20:09:39'),(12,NULL,1,66,'In issue updated rows:</br><strong>userAssigned</strong> updated <strong></strong> &rarr; <strong>Админ</strong></br>','update',NULL,'2015-12-16 20:31:20'),(13,NULL,1,72,'Created issue.','create',NULL,'2015-12-16 20:31:41'),(14,NULL,1,60,'In issue updated rows:</br><strong>status2</strong> updated <strong>OPEN</strong> &rarr; <strong>RESOLVED</strong></br>','update',NULL,'2015-12-16 21:03:40'),(15,NULL,1,72,'In issue updated rows:</br><strong>userAssigned</strong> updated <strong></strong> &rarr; <strong>Админ</strong></br>','update',NULL,'2015-12-16 21:04:03'),(16,NULL,1,73,'Created issue.','create',NULL,'2015-12-16 21:06:27'),(17,NULL,1,74,'Created issue.','create',NULL,'2015-12-16 21:38:58');
/*!40000 ALTER TABLE `history_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_priority`
--

DROP TABLE IF EXISTS `issue_priority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'priority.png',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actived` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_priority`
--

LOCK TABLES `issue_priority` WRITE;
/*!40000 ALTER TABLE `issue_priority` DISABLE KEYS */;
INSERT INTO `issue_priority` VALUES (1,'HIGHEST','angle-double-up','VERYVERY highest issue','Y'),(2,'HIGH','angle-up',NULL,'Y'),(3,'MEDIUM','arrows-h',NULL,'Y'),(4,'LOW','angle-down','angle-down','Y'),(5,'LOWEST','angle-double-down',NULL,'Y');
/*!40000 ALTER TABLE `issue_priority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_resolutions`
--

DROP TABLE IF EXISTS `issue_resolutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_resolutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'issue.png',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actived` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_resolutions`
--

LOCK TABLES `issue_resolutions` WRITE;
/*!40000 ALTER TABLE `issue_resolutions` DISABLE KEYS */;
INSERT INTO `issue_resolutions` VALUES (1,'FIXED','fixed.png','Fixed issue','Y'),(2,'WONTFIX','wontfix.png','I wont fix this','Y'),(3,'DUPLICATE','duplicate.png','This issue duplicate other issue','Y'),(4,'INCOMPLETE','incomplete.png','I need more info','Y'),(5,'CANNOTREPRODUCE','cannotreproduce.png','Я хз что да как, не могу повторить','Y'),(6,'WONTDO','wontdo.png','Не буду делать, ниннннада','Y');
/*!40000 ALTER TABLE `issue_resolutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_statuses`
--

DROP TABLE IF EXISTS `issue_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'issue.png',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(7) COLLATE utf8_unicode_ci DEFAULT '#EEEEEE',
  `actived` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_statuses`
--

LOCK TABLES `issue_statuses` WRITE;
/*!40000 ALTER TABLE `issue_statuses` DISABLE KEYS */;
INSERT INTO `issue_statuses` VALUES (1,'OPEN','open.png','New issue','#EEEEEE','Y'),(2,'INPROGRESS','inprogress.png','In work','#EEEEEE','Y'),(3,'RESOLVED','resolved.png','End work, need test','#EEEEEE','Y'),(4,'REOPENED','reopened.png','Need more work','#EEEEEE','Y'),(5,'CLOSED','closed.png','Finish him','#EEEEEE','Y');
/*!40000 ALTER TABLE `issue_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_types`
--

DROP TABLE IF EXISTS `issue_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'issue.png',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actived` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_types`
--

LOCK TABLES `issue_types` WRITE;
/*!40000 ALTER TABLE `issue_types` DISABLE KEYS */;
INSERT INTO `issue_types` VALUES (1,'BUG','bug.png','Bug in project','Y'),(2,'TASK','task.png','Simple task','Y'),(3,'FEATURE','feature.png','New feature','Y'),(4,'IMPROVEMENT','improvement.png','Modification old featuries','Y');
/*!40000 ALTER TABLE `issue_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
INSERT INTO `lists` VALUES (1,'TODO','To do'),(2,'INPROGRESS','In progress'),(3,'TESTING','Testing'),(4,'DONE','Done');
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediateka`
--

DROP TABLE IF EXISTS `mediateka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mediateka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('img','doc','audio','xls','txt') DEFAULT 'img',
  `title` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mime` varchar(100) DEFAULT NULL,
  `meta` tinytext,
  `create_user` int(11) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `create_user` (`create_user`),
  CONSTRAINT `mediateka_ibfk_1` FOREIGN KEY (`create_user`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediateka`
--

LOCK TABLES `mediateka` WRITE;
/*!40000 ALTER TABLE `mediateka` DISABLE KEYS */;
/*!40000 ALTER TABLE `mediateka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones`
--

DROP TABLE IF EXISTS `phones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) COLLATE utf32_unicode_ci DEFAULT NULL,
  `type` varchar(25) COLLATE utf32_unicode_ci NOT NULL DEFAULT 'mobile',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones`
--

LOCK TABLES `phones` WRITE;
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_dayplan`
--

DROP TABLE IF EXISTS `project_dayplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_dayplan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `date_plan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `issue_id` (`issue_id`),
  CONSTRAINT `project_dayplan_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_dayplan_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_dayplan`
--

LOCK TABLES `project_dayplan` WRITE;
/*!40000 ALTER TABLE `project_dayplan` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_dayplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_users`
--

DROP TABLE IF EXISTS `project_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `project_users_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_users`
--

LOCK TABLES `project_users` WRITE;
/*!40000 ALTER TABLE `project_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `date_create` datetime DEFAULT NULL,
  `visibled` int(1) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (13,'IMS03 - Информационно-медицинская система','IMS',NULL,'2015-12-01 19:05:30',1,0),(14,'HungryCat - игра про котэ','HCAT','Проект игры про котейку','2015-12-17 03:37:09',1,0);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sprints`
--

DROP TABLE IF EXISTS `sprints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sprints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  `status` enum('CREATE','START','END') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'CREATE',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `sprints_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sprints`
--

LOCK TABLES `sprints` WRITE;
/*!40000 ALTER TABLE `sprints` DISABLE KEYS */;
/*!40000 ALTER TABLE `sprints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_comments`
--

DROP TABLE IF EXISTS `task_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `task_comments_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_comments`
--

LOCK TABLES `task_comments` WRITE;
/*!40000 ALTER TABLE `task_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_files`
--

DROP TABLE IF EXISTS `task_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `task_files_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_files_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `mediateka` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_files`
--

LOCK TABLES `task_files` WRITE;
/*!40000 ALTER TABLE `task_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_users`
--

DROP TABLE IF EXISTS `task_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `task_users_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_users`
--

LOCK TABLES `task_users` WRITE;
/*!40000 ALTER TABLE `task_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_due` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `date_closed` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `user_create` int(11) DEFAULT NULL,
  `user_assigned` int(11) DEFAULT NULL,
  `sprint_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `resolution_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `status` enum('NEW','ASSIGNED','INPROGRESS','COMPLETED','CLOSED') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NEW',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_create` (`user_create`),
  KEY `status_id` (`status_id`),
  KEY `type_id` (`type_id`),
  KEY `resolution_id` (`resolution_id`),
  KEY `priority_id` (`priority_id`),
  KEY `sprint_id` (`sprint_id`),
  KEY `user_assigned` (`user_assigned`),
  CONSTRAINT `tasks_ibfk_11` FOREIGN KEY (`user_assigned`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_10` FOREIGN KEY (`user_create`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `issue_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_5` FOREIGN KEY (`resolution_id`) REFERENCES `issue_resolutions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_6` FOREIGN KEY (`priority_id`) REFERENCES `issue_priority` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_8` FOREIGN KEY (`sprint_id`) REFERENCES `sprints` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_ibfk_9` FOREIGN KEY (`status_id`) REFERENCES `issue_statuses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (60,'IMS-1',13,'Тестовая задача 11','Тестовая <b>задача</b>','2015-12-16 21:03:40','2015-12-30 17:00:00',NULL,1,1,NULL,3,2,NULL,3,'NEW',0),(66,'IMS-2',13,'Новая задача','Описание задачи','2015-12-16 20:31:20',NULL,NULL,NULL,1,NULL,3,2,NULL,4,'NEW',0),(67,'IMS-3',13,'Тестовая задача 3','Описание задачи','2015-12-16 19:30:25','2015-12-18 17:00:00',NULL,NULL,1,NULL,2,2,NULL,4,'NEW',0),(68,'IMS-4',13,'Еще одна тестовая задача','Тетсетететете тет тет&nbsp;','2015-12-16 18:34:26',NULL,NULL,NULL,1,NULL,5,2,NULL,2,'NEW',0),(69,'IMS-5',13,'Исправить баг','Описание данного бага','2015-12-16 18:48:36',NULL,NULL,NULL,1,NULL,3,1,NULL,3,'NEW',0),(70,'IMS-6',13,'Проверяем функционал','Описание задачи','2015-12-16 20:02:33','2015-12-26 17:00:00',NULL,NULL,1,NULL,1,1,NULL,5,'NEW',0),(71,'IMS-7',13,'Ntcn',NULL,'2015-12-16 20:09:38','2015-12-23 17:00:00',NULL,NULL,NULL,NULL,1,1,NULL,1,'NEW',0),(72,'IMS-8',13,'Тестируемс',NULL,'2015-12-16 21:04:03',NULL,NULL,NULL,1,NULL,1,1,NULL,1,'NEW',0),(73,'IMS-9',13,'Тест юзет криэтид',NULL,'2015-12-16 21:06:27',NULL,NULL,1,NULL,NULL,1,1,NULL,1,'NEW',0),(74,'HCAT-1',14,'Создать анимацию Птички','Создать несколько кадров анимации птички.&nbsp;','2015-12-16 21:38:57',NULL,NULL,1,NULL,NULL,1,2,NULL,3,'NEW',0);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `phone_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  KEY `phone_id` (`phone_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'adminuser','adminuser','Админ','benjamin.yazi@gmail.com','benjamin.yazi@gmail.com',1,'9kk11xym61c84swccog084gwsswwws4','$2y$13$9kk11xym61c84swccog08uD8jPr7MV126OWJ1cOisaq8TbDEFXHT2','2015-12-16 22:47:38',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-17  3:54:14
