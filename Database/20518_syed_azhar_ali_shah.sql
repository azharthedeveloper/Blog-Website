/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - 20518_syed_azhar_ali_shah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`20518_syed_azhar_ali_shah` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `20518_syed_azhar_ali_shah`;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blog_title` varchar(200) NOT NULL,
  `posts_per_page` int(11) NOT NULL,
  `blog_background_image` text NOT NULL,
  `blog_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `blog` */

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`posts_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(1,1,'Cricket Mania',3,'1695704883_ajay-parthasarathy-I27kjbkwlAo-unsplash.jpg','Active','2023-09-15 12:36:37','2023-09-26 10:12:27'),
(2,1,'Muscle Hub',3,'1695704959_victor-freitas-WvDYdXDzkhs-unsplash.jpg','Inactive','2023-09-15 10:21:59','2023-09-26 10:12:09'),
(3,1,'Meat Island',3,'1695704973_lily-banse--YHSwy6uqvk-unsplash.jpg','Active','2023-09-15 12:41:45','2023-09-26 10:11:46'),
(4,1,'Tourism',3,'1694581532_ivan-nieto--RB_vGPpaeY-unsplash.jpg','Active','2023-09-15 12:40:54','2023-09-26 10:11:31'),
(5,12,'Health Mania',3,'1695709942_candra-winata-CYOFvtpOIpU-unsplash.jpg','Active','2023-09-21 09:57:51','2023-09-26 11:32:22'),
(6,12,'Music',3,'1695452607_wes-hicks-MEL-jJnm7RQ-unsplash.jpg','Active','2023-09-23 12:03:27','2023-09-26 11:32:02'),
(7,1,'Farming',3,'1695705075_avinash-kumar-OvUAL6Vx3uY-unsplash.jpg','Inactive','2023-09-25 10:11:51','2023-09-26 10:25:04'),
(8,12,'Entertainment Arc',3,'1695710151_danny-howe-bn-D2bCvpik-unsplash.jpg','Active','2023-09-26 11:35:51',NULL);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(200) NOT NULL,
  `category_description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_title`,`category_description`,`status`,`created_at`,`updated_at`) values 
(1,'Tech','an educational institution specializing in technology or applied sciences','Active','2023-09-13 11:49:49','2023-09-13 11:49:49'),
(2,'Travel','Travel is the movement of people between distant geographical locations. Travel can be done by foot, bicycle, automobile, train, boat, bus, airplane, ship or other means, with or without luggage, and can be one way or round trip.','Active','2023-09-13 11:49:51','2023-09-13 11:49:51'),
(3,'Lifestyle','Lifestyle is the interests, opinions, behaviours, and behavioural orientations of an individual, group, or culture.','Active','2023-09-13 11:49:21','2023-09-13 11:49:21'),
(4,'Fashion','Fashion is a term used interchangeably to describe the creation of clothing, footwear, accessories, cosmetics, and jewellery of different cultural aesthetics and their mix and match into outfits that depict distinctive ways of dressing as signifiers of social status, self-expression, and group belonging.','Active','2023-09-13 11:49:22','2023-09-13 11:49:22'),
(5,'Beauty','Beauty is commonly described as a feature of objects that makes these objects pleasurable to perceive. Such objects include landscapes, sunsets, humans and works of art. Beauty, together with art and taste, is the main subject of aesthetics, one of the major branches of philosophy.','Active','2023-09-13 11:49:41','2023-09-13 11:49:41'),
(6,'Health','n common usage and medicine, health, according to the World Health Organization, is \"a state of complete physical, mental and social well-being and not merely the absence of disease and infirmity\". A variety of definitions have been used for different purposes over time.','Active','2023-09-13 11:49:42','2023-09-13 11:49:42'),
(7,'Fitness','Physical fitness is a state of health and well-being and, more specifically, the ability to perform aspects of sports, occupations and daily activities. Physical fitness is generally achieved through proper nutrition, moderate-vigorous physical exercise, and sufficient rest along with a formal recovery plan.','Inactive','2023-09-13 11:48:09','2023-09-13 11:48:09'),
(8,'Business','Business is the practice of making ones living or making money by producing or buying and selling products.','Inactive','2023-09-13 11:47:46','2023-09-13 11:47:46'),
(9,'Education','Education is the transmission of knowledge, skills, and character traits. There are many debates about its precise definition, for example, about which aims it tries to achieve. A further issue is whether part of the meaning of education is that the change in the student is an improvement.','Active','2023-09-13 11:49:14','2023-09-13 11:49:14'),
(10,'Food and Recipe','A recipe is a set of instructions that describes how to prepare or make something, especially a dish of prepared food. A sub-recipe or subrecipe is a recipe for an ingredient that will be called for in the instructions for the main recipe.','Active','2023-09-13 11:49:12','2023-09-13 11:49:12'),
(11,'Music','Music is generally defined as the art of arranging sound to create some combination of form, harmony, melody, rhythm, or otherwise expressive content. Definitions of music vary depending on culture, though it is an aspect of all human societies and a cultural universal.','Active','2023-09-13 11:49:02','2023-09-13 11:49:02'),
(12,'Automotive','A car, or an automobile, is a motor vehicle with wheels. Most definitions of cars say that they run primarily on roads, seat one to eight people, have four wheels, and mainly transport people, not cargo.','Active','2023-09-13 11:49:00','2023-09-13 11:49:00'),
(13,'Automobile','A car, or an automobile, is a motor vehicle with wheels. Most definitions of cars say that they run primarily on roads, seat one to eight people, have four wheels, and mainly transport people, not cargo.','Active','2023-09-13 11:48:56','2023-09-13 11:48:56'),
(14,'Marketing','Marketing is the process of exploring, creating, and delivering value to meet the needs of a target market in terms of goods and services.','Active','2023-09-13 11:49:28','2023-09-13 11:49:28'),
(15,'Finance','Finance is the study and discipline of money, currency and capital assets. It is related to, but not synonymous with economics, which is the study of production, distribution, and consumption of money, assets, goods and services.','Active','2023-09-13 11:48:51','2023-09-13 11:48:51'),
(16,'Sports','An activity involving physical exertion and skill in which an individual or team competes against another or others for entertainment.','Active','2023-09-13 11:48:50','2023-09-13 11:48:50'),
(17,'Entertainment','Entertainment is a form of activity that holds the attention and interest of an audience or gives pleasure and delight. It can be an idea or a task, but it is more likely to be one of the activities or events that have developed over thousands of years specifically for the purpose of keeping an audiences attention.','Active','2023-09-13 11:48:46','2023-09-13 11:48:46'),
(18,'Productivity','Productivity is the efficiency of production of goods or services expressed by some measure. Measurements of productivity are often expressed as a ratio of an aggregate output to a single input or an aggregate input used in a production process, i.e. output per','Active','2023-09-13 11:48:41','2023-09-13 11:48:41'),
(19,'Hobbies','A hobby is considered to be a regular activity that is done for enjoyment, typically during ones leisure time. Hobbies include collecting themed items and objects, engaging in creative and artistic pursuits, playing sports, or pursuing other amusements.','Active','2023-09-13 11:48:36','2023-09-13 11:48:36'),
(20,'Parenting','Parenting or child rearing promotes and supports the physical, emotional, social, spiritual and cognitive development of a child from infancy to adulthood. Parenting refers to the intricacies of raising a child and not exclusively for a biological relationship.','Active','2023-09-13 11:48:31','2023-09-13 11:48:31'),
(21,'Pets','A pet, or companion animal, is an animal kept primarily for a persons company or entertainment rather than as a working animal, livestock, or a laboratory animal.','Active','2023-09-14 10:08:49','2023-09-23 13:19:26'),
(22,'Photography','Photography is the art, application, and practice of creating images by recording light, either electronically by means of an image sensor, or chemically by means of a light-sensitive material such as photographic film.','Active','2023-09-15 09:29:29','2023-09-26 10:33:46'),
(23,'Wrestling','Wrestling is a martial art and combat sport that involves grappling with an opponent and striving to obtain a position of advantage through different throws or techniques, within a given ruleset.','Active','2023-09-23 12:03:53','2023-09-26 10:33:25'),
(24,'Accessories','a thing which can be added to something else in order to make it more useful, versatile, or attractive.','Active','2023-09-25 09:44:46','2023-09-26 10:32:45'),
(25,'Books','A book is a medium for recording information in the form of writing or images, typically composed of many pages bound together and protected by a cover. It can also be a handwritten or printed work of fiction or nonfiction, usually on sheets of paper fastened or bound together within covers.','Active','2023-09-25 09:47:07','2023-09-26 10:32:02'),
(26,'Literature','Literature is any collection of written work, but it is also used more narrowly for writings specifically considered to be an art form, especially prose, fiction, drama, poetry, and including both print and digital writing.','Inactive','2023-09-25 09:47:40','2023-09-26 10:31:26'),
(27,'Yoga','Yoga is a group of physical, mental, and spiritual practices or disciplines which originated in ancient India and aim to control and still the mind, recognizing a detached witness-consciousness untouched by the mind and mundane suffering.','Inactive','2023-09-25 09:50:21','2023-09-26 10:30:30'),
(28,'Crops','A crop is a plant that can be grown and harvested extensively for profit or subsistence. When the plants of the same kind are cultivated at one place on a large scale, it is called a crop. Most crops are cultivated in agriculture or hydroponics.','Active','2023-09-26 10:26:32','2023-09-26 10:26:38');

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `feedback` */

insert  into `feedback`(`feedback_id`,`user_id`,`name`,`email`,`feedback`,`created_at`) values 
(1,8,'Rowaiba Khan','rowaiba12@gmail.com','You have a very nice Website','2023-09-19 12:28:56'),
(2,9,'Rameez Ali','rameez12@gmail.com','Good User Experience','2023-09-19 12:29:50'),
(3,16,'Mahira Khan','mahirakhan12@gmail.com','The Sliders are really good','2023-09-19 12:30:46'),
(4,18,'Kareem Ali','kareem546@gmail.com','Please Fix the bugs','2023-09-19 12:31:44'),
(5,NULL,'Waqar Haider','waqar12@gmail.com','Design is good','2023-09-19 12:32:38'),
(6,NULL,'Mubashir','mubashir12@gmail.com','The Server Speed is impressive','2023-09-19 12:33:19'),
(7,NULL,'Zubair Ali','zubairali12@gmail.com','Nice Website','2023-09-20 10:50:33'),
(8,5,'Ali Ahmed Khan','alik12@gmail.com','Really Good','2023-09-20 10:52:38'),
(9,5,'Ali Ahmed Khan','alik12@gmail.com','Good Experience with You','2023-09-20 11:42:59'),
(10,5,'Ali Ahmed Khan','alik12@gmail.com','Hey Yoo','2023-09-21 13:03:14'),
(11,5,'Ali Ahmed Khan','alik12@gmail.com','hey yoo','2023-09-21 13:04:14'),
(12,1,'Azhar Syed','as3614851@gmail.com','helloo world','2023-09-23 11:56:34'),
(13,1,'Azhar Syed','as3614851@gmail.com','hello world','2023-09-23 11:57:09'),
(14,26,'Ali Ahmed Soomro','alias12@gmail.com','The Lorem ipsum text is derived from sections 1.10.32 and 1.10.33 of Cicero&#039;s De finibus bonorum et malorum.[7][8] The physical source may have been the 1914 Loeb Classical Library edition of De finibus, where the Latin text, presented on the left-hand (even) pages, breaks off on page 34 with &quot;Neque porro quisquam est qui do-&quot; and continues on page 36 with &quot;lorem ipsum ...&quot;, suggesting that the galley type of that page was mixed up to make the dummy text seen today.[1]\r\n\r\nThe discovery of the text&#039;s origin is attributed to Richard McClintock, a Latin scholar at Hampden–Sydney College. McClintock connected Lorem ipsum to Cicero&#039;s writing sometime before 1982 while searching for instances of the Latin word consectetur, which was rarely used in classical literature.[2] McClintock first published his discovery in a 1994 letter to the editor of Before &amp; After magazine,[9] contesting the editor&#039;s earlier claim that Lorem ipsum held no meaning.[2] ','2023-09-25 12:19:26');

/*Table structure for table `following_blog` */

DROP TABLE IF EXISTS `following_blog`;

CREATE TABLE `following_blog` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) NOT NULL,
  `blog_following_id` int(11) NOT NULL,
  `follow_status` enum('Followed','Unfollowed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `user_id` (`follower_id`),
  KEY `blog_id` (`blog_following_id`),
  CONSTRAINT `following_blog_ibfk_2` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`),
  CONSTRAINT `following_blog_ibfk_3` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `following_blog` */

insert  into `following_blog`(`follow_id`,`follower_id`,`blog_following_id`,`follow_status`,`created_at`,`updated_at`) values 
(1,5,3,'Unfollowed','2023-09-20 12:29:29','2023-09-21 13:01:37'),
(2,5,1,'Followed','2023-09-20 12:36:18','2023-09-23 12:31:25'),
(3,5,5,'Followed','2023-09-21 10:06:20','2023-09-23 12:28:20'),
(4,5,6,'Followed','2023-09-23 12:23:31','2023-09-23 12:23:49'),
(5,5,4,'Followed','2023-09-25 10:31:33',NULL),
(6,26,6,'Unfollowed','2023-09-25 12:24:54','2023-09-25 12:25:58'),
(7,26,5,'Followed','2023-09-25 12:25:11','2023-09-25 12:25:16'),
(8,26,4,'Followed','2023-09-25 12:25:21',NULL);

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` varchar(250) NOT NULL,
  `post_description` text NOT NULL,
  `featured_img` text NOT NULL,
  `is_comment_allowed` enum('Yes','No') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post` */

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_img`,`is_comment_allowed`,`status`,`created_at`,`updated_at`) values 
(1,4,'Post Title 1','Post Summary 1','{post_description}','1694847811_jefferson-santos-fCEJGBzAkrU-unsplash.jpg','Yes','Inactive','2023-09-16 12:03:31','2023-09-25 10:10:45'),
(2,3,'Pizza','a dish of Italian origin, consisting of a flat round base of dough baked with a topping of tomatoes and cheese, typically with added meat, fish, or vegetables.','Pizza is a dish of Italian origin consisting of a usually round, flat base of leavened wheat-based dough topped with tomatoes, cheese, and often various other ingredients, which is then baked at a high temperature, traditionally in a wood-fired oven.','1695707556_thomas-tucker-MNtag_eXMKw-unsplash.jpg','Yes','Inactive','2023-09-16 12:21:35','2023-09-26 10:52:36'),
(3,1,'Post Title 3','Post Summary 3','{post_description}','1694849408_jefferson-santos-fCEJGBzAkrU-unsplash.jpg','Yes','Inactive','2023-09-16 12:30:08','2023-09-25 10:10:52'),
(4,1,'Post Title 4','Post Title 4','{post_description}','1694850028_jefferson-santos-fCEJGBzAkrU-unsplash.jpg','Yes','Active','2023-09-16 12:40:28',NULL),
(5,1,'Post Title 5','Post Summary 5','Post Description','1694850156_wes-hicks-MEL-jJnm7RQ-unsplash.jpg','Yes','Active','2023-09-16 12:42:36','2023-09-18 11:45:59'),
(6,3,'Fries','French fries, chips, finger chips, french-fried potatoes, or simply fries, are batonnet or allumette-cut deep-fried potatoes of disputed origin from Belgium or France. They are prepared by cutting potatoes into even strips, drying them, and frying th','French fries are served hot, either soft or crispy, and are generally eaten as part of lunch or dinner or by themselves as a snack, and they commonly appear on the menus of diners, fast food restaurants, pubs, and bars. They are often salted and may be served with ketchup, vinegar, mayonnaise, tomato sauce, or other local specialities. Fries can be topped more heavily, as in the dishes of poutine, loaded fries or chili cheese fries. French fries can be made from sweet potatoes instead of potatoes. A baked variant, oven fries, uses less or no oil.','1695707422_spencer-davis-dxTBgnHZ8ZE-unsplash.jpg','Yes','Active','2023-09-18 09:33:48','2023-09-26 10:50:22'),
(7,5,'Post Demo Title 1','Post Demo Summary 1','Post Demo Description 1','1695272368_jefferson-santos-fCEJGBzAkrU-unsplash.jpg','Yes','Inactive','2023-09-21 09:59:28','2023-09-26 11:32:43'),
(8,5,'Post Demo Title 2','Post Demo Summary 2','Post Demo Description 2','1695272450_wes-hicks-MEL-jJnm7RQ-unsplash.jpg','Yes','Inactive','2023-09-21 10:00:50','2023-09-26 11:32:40'),
(9,5,'Post Demo Title 3','Post Demo Summary 3','Post Demo Description 3','1695272535_jefferson-santos-fCEJGBzAkrU-unsplash.jpg','No','Active','2023-09-21 10:02:15','2023-09-23 13:07:35'),
(10,5,'Post Demo Title 4','Post Demo Summary 4','Post Demo Description 4','1695272616_wes-hicks-MEL-jJnm7RQ-unsplash.jpg','Yes','Active','2023-09-21 10:03:36','2023-09-23 13:07:31'),
(11,6,'Post Demo Title 5','Post Demo Summary 5','Post Demo Description 5','1695272668_wes-hicks-MEL-jJnm7RQ-unsplash.jpg','Yes','Active','2023-09-21 10:04:28','2023-09-23 12:26:11'),
(12,1,'bfhbslsm','jbjhfbdkjsnfbxjdhv','jxhcsdbhjvfbsjhs','1695452272_jefferson-santos-fCEJGBzAkrU-unsplash.jpg','Yes','Active','2023-09-23 11:57:52',NULL),
(13,5,'Lorem Post 1','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','1695710034_victor-freitas-WvDYdXDzkhs-unsplash.jpg','Yes','Active','2023-09-23 12:06:01','2023-09-26 11:33:54'),
(14,4,'Ubud Tourists Heaven','he town of Ubud, in the uplands of Bali, Indonesia, is known as a center for traditional crafts and dance.','The Tegallang rice terrace is famous for its scenic landscape, where travellers to Ubud often stop by for snapshots of an iconic Balinese view. Bali’s traditional, centuries-old cooperative irrigation system (known as subak) has created some of the most beautiful terraced landscapes in Southeast Asia, and this valley is a great example.\r\n\r\nThe quaint village of Pakudui is close to the Tegallang rice terrace. You can find a variety of ornamental woodwork and various carvings of mythical figures. Many souvenir stalls line the ledge of Tegallang, where you can pick up some gifts before continuing your journey to Ubud’s main centre.','1695707923_frans-daniels-a8uNGJ-3MOU-unsplash.jpg','No','Active','2023-09-25 09:54:45','2023-09-26 10:58:43'),
(15,3,'Hamburger','A hamburger, or simply burger, is a sandwich consisting of fillings usually a patty of ground meat, typically beef placed inside a sliced bun or bread roll.','Hamburgers are often served with cheese, lettuce, tomato, onion, pickles, bacon, or chilis; condiments such as ketchup, mustard, mayonnaise, relish, or a &quot;special sauce&quot;, often a variation of Thousand Island dressing; and are frequently placed on sesame seed buns. A hamburger patty topped with cheese is called a cheeseburger.\r\n\r\nHamburgers are typically sold at fast-food restaurants, diners, and other restaurants. There are many international and regional variations of hamburger. Some of the largest multinational fast-food chains have a burger as one of their core products: McDonald&#039;s Big Mac and Burger King&#039;s Whopper have become global icons of American culture.[','1695707280_junior-reis-48YwNFr2UmE-unsplash.jpg','Yes','Active','2023-09-25 09:56:09','2023-09-26 10:48:00'),
(16,3,'Pasta','Pasta is a type of food typically made from an unleavened dough of wheat flour mixed with water or eggs, and formed into sheets or other shapes, then cooked by boiling or baking.','Pastas are divided into two broad categories: dried (pasta secca) and fresh (pasta fresca). Most dried pasta is produced commercially via an extrusion process, although it can be produced at home. Fresh pasta is traditionally produced by hand, sometimes with the aid of simple machines. Fresh pastas available in grocery stores are produced commercially by large-scale machines.\r\n\r\nBoth dried and fresh pastas come in a number of shapes and varieties, with 310 specific forms known by over 1,300 documented names. In Italy, the names of specific pasta shapes or types often vary by locale. For example, the pasta form cavatelli is known by 28 different names depending upon the town and region. Common forms of pasta include long and short shapes, tubes, flat shapes or sheets, miniature shapes for soup, those meant to be filled or stuffed, and specialty or decorative shapes.','1695619755_wes-hicks-MEL-jJnm7RQ-unsplash.jpg','No','Active','2023-09-25 10:29:15','2023-09-26 10:45:55'),
(17,8,'Festivities','t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#039;Content here, content here&#039;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#039;lorem ipsum&#039; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n','1695710312_jason-leung-Xaanw0s0pMk-unsplash.jpg','Yes','Active','2023-09-26 11:38:32',NULL);

/*Table structure for table `post_attachment` */

DROP TABLE IF EXISTS `post_attachment`;

CREATE TABLE `post_attachment` (
  `post_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `attachment_title` varchar(200) NOT NULL,
  `attachment_path` varchar(200) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_attachment_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_attachment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_attachment` */

insert  into `post_attachment`(`post_attachment_id`,`post_id`,`attachment_title`,`attachment_path`,`status`,`created_at`,`updated_at`) values 
(1,2,'Text 2','Post_Attachments/1694848896_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-16 12:21:36',NULL),
(2,2,'PPT 2','Post_Attachments/1694848896_Ajax (Day-1).pptx','Active','2023-09-16 12:21:36',NULL),
(3,3,'Text File 1','Post_Attachments/1694849409_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-16 12:30:09','2023-09-19 10:53:03'),
(4,3,'PPT File 1','Post_Attachments/1694849410_Ajax (Day-1).pptx','Active','2023-09-16 12:30:10','2023-09-19 10:52:55'),
(5,3,'Zip File 1','Post_Attachments/1694849410_20518_Syed_Azhar_Ali_Shah(1).zip','Active','2023-09-16 12:30:10',NULL),
(6,6,'Texting File','Post_Attachments/1695105935_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-19 11:45:35','2023-09-19 11:45:49'),
(7,6,'Power Point Presentation','Post_Attachments/1695105935_Ajax (Day-1).pptx','Active','2023-09-19 11:45:35',NULL),
(8,7,'Demo Text','Post_Attachments/1695272368_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-21 09:59:28',NULL),
(9,8,'Demo Text 2','Post_Attachments/1695272451_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-21 10:00:51',NULL),
(10,9,'Demo Text File 3','Post_Attachments/1695272535_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-21 10:02:15',NULL),
(11,9,'Demo PPT File 1','Post_Attachments/1695272535_Ajax (Day-1).pptx','Active','2023-09-21 10:02:15',NULL),
(12,10,'Demo Text File 4','Post_Attachments/1695272616_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-21 10:03:36','2023-09-21 10:05:20'),
(13,13,'Zip File','Post_Attachments/1695452762_Online_Blogging_Application_New.zip','Inactive','2023-09-23 12:06:02','2023-09-23 12:10:31'),
(14,13,'Testing File','Post_Attachments/1695453050_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-23 12:10:50',NULL),
(15,15,'Text File','Post_Attachments/1695617769_20518_Syed_Azhar_Ali_Shah(1).txt','Active','2023-09-25 09:56:09',NULL),
(16,15,'Zip File','Post_Attachments/1695617769_20518_Syed_Azhar_Ali_Shah.zip','Inactive','2023-09-25 09:56:09','2023-09-25 10:24:48'),
(17,15,'PPT','Post_Attachments/1695619504_1695272535_Ajax (Day-1).pptx','Active','2023-09-25 10:25:04',NULL);

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `category_post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_post_id`),
  KEY `category_id` (`category_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_category` */

insert  into `post_category`(`category_post_id`,`post_id`,`category_id`,`status`,`created_at`,`updated_at`) values 
(1,1,2,'Active','2023-09-16 12:03:31',NULL),
(2,1,3,'Active','2023-09-16 12:03:32',NULL),
(3,2,3,'Active','2023-09-16 12:21:35','2023-09-26 10:51:59'),
(4,2,10,'Active','2023-09-16 12:21:36','2023-09-26 10:51:52'),
(5,2,17,'Inactive','2023-09-16 12:21:36','2023-09-26 10:51:45'),
(6,3,6,'Active','2023-09-16 12:30:08',NULL),
(7,3,16,'Active','2023-09-16 12:30:08',NULL),
(8,3,17,'Active','2023-09-16 12:30:08',NULL),
(9,4,2,'Active','2023-09-16 12:40:28',NULL),
(10,4,6,'Active','2023-09-16 12:40:29',NULL),
(11,4,16,'Active','2023-09-16 12:40:29',NULL),
(12,5,1,'Inactive','2023-09-16 12:42:36','2023-09-19 10:07:52'),
(13,5,6,'Active','2023-09-16 12:42:37','2023-09-18 13:17:54'),
(14,5,14,'Inactive','2023-09-16 12:42:37','2023-09-19 09:17:31'),
(15,5,15,'Active','2023-09-16 12:42:37',NULL),
(16,5,16,'Active','2023-09-16 12:42:37',NULL),
(17,6,11,'Inactive','2023-09-18 09:33:49','2023-09-19 09:16:59'),
(18,6,1,'Inactive','2023-09-19 10:06:46','2023-09-19 10:07:26'),
(19,6,5,'Inactive','2023-09-19 10:06:46','2023-09-26 10:50:42'),
(20,6,20,'Inactive','2023-09-19 10:06:46','2023-09-26 10:50:45'),
(21,6,2,'Inactive','2023-09-19 10:07:37','2023-09-26 10:50:49'),
(22,6,3,'Active','2023-09-19 10:07:37',NULL),
(23,5,4,'Active','2023-09-19 10:08:01',NULL),
(24,5,9,'Active','2023-09-19 10:08:01',NULL),
(25,7,3,'Active','2023-09-21 09:59:28',NULL),
(26,7,6,'Active','2023-09-21 09:59:28',NULL),
(27,7,16,'Active','2023-09-21 09:59:28',NULL),
(28,8,5,'Active','2023-09-21 10:00:50',NULL),
(29,8,14,'Active','2023-09-21 10:00:51',NULL),
(30,9,4,'Active','2023-09-21 10:02:15',NULL),
(31,9,17,'Active','2023-09-21 10:02:15',NULL),
(32,10,10,'Active','2023-09-21 10:03:36','2023-09-21 10:05:09'),
(33,10,20,'Active','2023-09-21 10:03:36',NULL),
(34,11,18,'Active','2023-09-21 10:04:28',NULL),
(35,11,5,'Active','2023-09-21 13:17:11','2023-09-21 13:17:20'),
(36,12,5,'Active','2023-09-23 11:57:53',NULL),
(37,13,23,'Inactive','2023-09-23 12:06:02','2023-09-23 12:10:10'),
(38,13,2,'Active','2023-09-23 12:10:21',NULL),
(39,13,5,'Active','2023-09-23 12:10:22',NULL),
(40,13,6,'Active','2023-09-23 12:10:22',NULL),
(41,14,3,'Active','2023-09-25 09:54:45','2023-09-26 10:59:03'),
(42,14,26,'Inactive','2023-09-25 09:54:45','2023-09-26 10:58:55'),
(43,14,27,'Inactive','2023-09-25 09:54:45','2023-09-26 10:58:57'),
(44,15,26,'Inactive','2023-09-25 09:56:09','2023-09-26 10:48:08'),
(45,15,27,'Inactive','2023-09-25 09:56:09','2023-09-25 10:05:28'),
(46,16,26,'Inactive','2023-09-25 10:29:15','2023-09-26 10:43:54'),
(47,16,27,'Inactive','2023-09-25 10:29:16','2023-09-26 10:43:58'),
(48,16,3,'Active','2023-09-26 10:44:41',NULL),
(49,16,10,'Active','2023-09-26 10:44:41',NULL),
(50,16,19,'Active','2023-09-26 10:44:41',NULL),
(51,15,6,'Active','2023-09-26 10:48:30',NULL),
(52,15,10,'Active','2023-09-26 10:48:31',NULL),
(53,15,19,'Active','2023-09-26 10:48:31',NULL),
(54,6,10,'Active','2023-09-26 10:50:56',NULL),
(55,14,2,'Active','2023-09-26 10:59:26',NULL),
(56,14,17,'Active','2023-09-26 10:59:26',NULL),
(57,14,22,'Active','2023-09-26 10:59:26',NULL),
(58,17,2,'Active','2023-09-26 11:38:32',NULL),
(59,17,17,'Active','2023-09-26 11:38:32',NULL),
(60,17,22,'Active','2023-09-26 11:38:32',NULL);

/*Table structure for table `post_comment` */

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  CONSTRAINT `post_comment_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  CONSTRAINT `post_comment_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_comment` */

insert  into `post_comment`(`comment_id`,`user_id`,`post_id`,`comment`,`status`,`created_at`,`updated_at`) values 
(1,5,5,'Nice Post','Active','2023-09-18 13:22:51','2023-09-19 12:59:02'),
(2,5,9,'Nice Post','Active','2023-09-21 12:44:01','2023-09-21 12:48:45'),
(3,5,7,'Nice paragraph','Active','2023-09-21 13:11:44','2023-09-21 13:11:58'),
(4,5,10,'demo comment','Active','2023-09-21 13:16:10','2023-09-21 13:16:22'),
(5,5,13,'hey nice!','Active','2023-09-23 12:09:09','2023-09-23 12:09:17'),
(6,5,13,'good post','Active','2023-09-23 12:29:14','2023-09-23 12:30:45'),
(7,5,15,'hello','Active','2023-09-25 10:07:24','2023-09-25 10:26:17'),
(8,26,15,'nice','Active','2023-09-25 12:17:00','2023-09-25 12:17:19'),
(9,28,17,'Nice Post','Active','2023-09-26 11:39:18','2023-09-26 11:39:26'),
(10,28,11,'Nice Post','Active','2023-09-26 11:40:23','2023-09-26 11:40:40');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_type`,`status`) values 
(1,'Admin','Active'),
(2,'User','Active');

/*Table structure for table `theme_setting` */

DROP TABLE IF EXISTS `theme_setting`;

CREATE TABLE `theme_setting` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`theme_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `theme_setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `theme_setting` */

insert  into `theme_setting`(`theme_id`,`user_id`,`setting_key`,`setting_value`,`status`,`created_at`,`updated_at`) values 
(1,12,'post_title_color','#000000','Active','2023-09-22 11:49:57','2023-09-23 13:15:42'),
(2,12,'post_background_color','#ffffff','Active','2023-09-22 11:49:57','2023-09-23 13:15:43'),
(3,12,'post_title_font_size','20px','Active','2023-09-22 11:49:57','2023-09-23 13:15:43'),
(4,12,'post_font_style','normal','Active','2023-09-22 11:49:58','2023-09-23 13:15:43'),
(5,12,'post_font_weight','normal','Active','2023-09-22 11:49:58','2023-09-23 13:15:43'),
(6,5,'post_title_color','#000000','Active','2023-09-23 09:31:40','2023-09-25 10:40:20'),
(7,5,'post_background_color','#ffffff','Active','2023-09-23 09:31:40','2023-09-25 10:40:20'),
(8,5,'post_title_font_size','20px','Active','2023-09-23 09:31:40','2023-09-25 10:40:20'),
(9,5,'post_font_style','normal','Active','2023-09-23 09:31:41','2023-09-25 10:40:20'),
(10,5,'post_font_weight','normal','Active','2023-09-23 09:31:41','2023-09-25 10:40:20'),
(11,7,'post_title_color','#000000','Active','2023-09-23 10:57:03','2023-09-23 11:34:33'),
(12,7,'post_background_color','#ffffff','Active','2023-09-23 10:57:03','2023-09-23 11:34:33'),
(13,7,'post_title_font_size','20px','Active','2023-09-23 10:57:03','2023-09-23 11:34:33'),
(14,7,'post_font_style','normal','Active','2023-09-23 10:57:03','2023-09-23 11:34:33'),
(15,7,'post_font_weight','normal','Active','2023-09-23 10:57:03','2023-09-23 11:34:33'),
(16,8,'post_title_color','#004080','Active','2023-09-23 12:01:37',NULL),
(17,8,'post_background_color','#ffffff','Active','2023-09-23 12:01:37',NULL),
(18,8,'post_title_font_size','20px','Active','2023-09-23 12:01:37',NULL),
(19,8,'post_font_style','normal','Active','2023-09-23 12:01:37',NULL),
(20,8,'post_font_weight','normal','Active','2023-09-23 12:01:37',NULL),
(21,1,'post_title_color','#000000','Active','2023-09-23 13:21:15','2023-09-25 13:17:55'),
(22,1,'post_background_color','#ffffff','Active','2023-09-23 13:21:15','2023-09-25 13:17:55'),
(23,1,'post_title_font_size','20px','Active','2023-09-23 13:21:15','2023-09-25 13:17:56'),
(24,1,'post_font_style','normal','Active','2023-09-23 13:21:15','2023-09-25 13:17:58'),
(25,1,'post_font_weight','normal','Active','2023-09-23 13:21:15','2023-09-25 13:17:58'),
(26,26,'post_title_color','#000000','Active','2023-09-25 12:10:56','2023-09-25 12:11:49'),
(27,26,'post_background_color','#ffffff','Active','2023-09-25 12:10:56','2023-09-25 12:11:49'),
(28,26,'post_title_font_size','20px','Active','2023-09-25 12:10:57','2023-09-25 12:11:49'),
(29,26,'post_font_style','normal','Active','2023-09-25 12:10:57','2023-09-25 12:11:49'),
(30,26,'post_font_weight','normal','Active','2023-09-25 12:10:57','2023-09-25 12:11:50');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT 2,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `profile_img` text NOT NULL,
  `home_town` varchar(200) NOT NULL,
  `approval` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`profile_img`,`home_town`,`approval`,`status`,`created_at`,`updated_at`) values 
(1,1,'Azhar','Syed','as3614851@gmail.com','azhar','Male','2001-06-10','1695704841_pngtree-business-male-icon-vector-png-image_916468.jpg','Hyderabad, Sindh','Approved','Active','2023-09-14 13:21:32','2023-09-26 10:07:21'),
(2,2,'Aju','Bhai','ajubhai4312@gmail.com','azhar123','Male','1999-08-18','1694191066_1.png','Karachi, Sindh','Pending','Inactive','2023-09-08 21:37:46',NULL),
(3,2,'Roshan','Laghari','syedazharalishah824@gmail.com','roshan123','Male','2001-08-10','1694192303_3.png','Karachi, Sindh','Pending','Inactive','2023-09-08 22:01:57',NULL),
(4,2,'Aleena','Qureshi','azhardummy1@gmail.com','aleena123','Female','2002-11-25','1694192536_4.png','Hyderabad, Karachi','Pending','Inactive','2023-09-08 22:02:16',NULL),
(5,2,'Ali Ahmed','Khan','alik12@gmail.com','alikhan12','Male','1996-05-11','1695620541_147144.png','Sukkur, Sindh','Approved','Active','2023-09-14 13:27:24','2023-09-25 10:42:21'),
(7,2,'Noshad','Khushk','noshad12@gmail.com','noshad123','Male','1993-12-16','1694233633_user.jpg','Hyderabad, Sindh','Approved','Active','2023-09-14 13:10:29','2023-09-23 11:49:27'),
(8,2,'Rowaiba','Khan','rowaiba12@gmail.com','rowaiba123','Female','2003-11-09','1694233775_user.jpg','Karachi, Sindh','Approved','Active','2023-09-14 13:23:02','2023-09-23 11:49:17'),
(9,2,'Rameez','Ali','rameez12@gmail.com','rameez123','Male','1993-12-16','1694243992_user.jpg','Karachi, Sindh','Approved','Active','2023-09-11 09:38:56','2023-09-23 11:49:13'),
(10,2,'Samina','Khan','samina12@gmail.com','samina123','Female','1996-05-11','1694578921_user.jpg','Karachi, Sindh','Approved','Active','2023-09-14 13:03:42','2023-09-23 11:49:12'),
(11,2,'Samina','Khan','samina14@gmail.com','samina123','Female','1996-05-11','1694406720_user.jpg','Karachi, Sindh','Approved','Active','2023-09-11 09:37:46','2023-09-23 11:49:10'),
(12,1,'zameer','hisbani','zameer@gmail.com','zameer','Male','1999-08-06','1695456255_147144.png','Sukkur, Sindh','Approved','Active','2023-09-15 10:21:43','2023-09-23 13:04:15'),
(13,2,'Daniyal','Qureshi','daniyal12@gmail.com','daniyal123','Male','2000-11-24','1694407339_user.jpg','Karachi, Sindh','Rejected','Inactive','2023-09-11 09:44:46','2023-09-23 11:49:07'),
(14,2,'Muhammad','Sharjeel','sharjeel12@gmail.com','sharjeel123','Male','1996-05-11','1694407566_user.jpg','Karachi, Sindh','Rejected','Inactive','2023-09-15 12:38:37','2023-09-23 11:49:05'),
(15,2,'Aisha','Samoo','aisha12@gmail.com','aisha123','Female','2003-09-14','1694677471_user.jpg','Larkana, Sindh','Rejected','Inactive','2023-09-14 12:44:53','2023-09-23 11:49:04'),
(16,2,'Mahira','Khan','mahirakhan12@gmail.com','dummy_4513','Female','1993-12-16','1694752691_beautiful-woman-avatar-character-icon-free-vector.jpg','Lahore, Punjab','Approved','Active','2023-09-15 10:21:34','2023-09-23 11:49:02'),
(17,2,'Kashan','Jatoi','kashan12@gmail.com','kashan123','Male','1999-08-06','1694753567_147144.png','Mehar, Sindh','Approved','Active','2023-09-15 12:39:22','2023-09-26 09:41:03'),
(18,1,'Kareem','Ali','kareem546@gmail.com','kareem123','Male','2000-11-24','1694759548_images.png','Multan, Punjab','Approved','Active','2023-09-15 12:28:23','2023-09-23 11:48:56'),
(19,1,'Ubaidullah','Bhutto','ubaidullah12@gmail.com','ubaid123','Male','1993-12-16','1695454541_Cartoon-Pic-Ideas-for-DP-Profile11.png','Matiari, Sindh','Approved','Active','2023-09-23 11:39:57','2023-09-23 12:35:41'),
(20,2,'Manzoor','Shah','manzoor12@gmail.com','dummy_4656','Male','1993-12-16','1695451309_images.png','Matiari, Sindh','Rejected','Inactive','2023-09-23 11:41:49','2023-09-23 11:48:34'),
(21,2,'Manzoor','Shah','manzoor123@gmail.com','manzoor12','Male','1993-12-16','1695451385_images.png','Matiari, Sindh','Approved','Active','2023-09-23 11:43:05','2023-09-23 11:52:39'),
(22,1,'Saifullah','Khan','saifullah12@gmail.com','dummy_5481','Male','2000-11-24','1695451872_images.png','Hyderabad, Sindh','Approved','Active','2023-09-23 11:51:12','2023-09-25 12:13:45'),
(24,2,'Rameeza','Arain','rameeza12@gmail.com','rameeza123','Female','1998-03-08','1695616137_Cartoon-Pic-Ideas-for-DP-Profile11.png','Karachi, Sindh','Approved','Active','2023-09-25 09:28:57','2023-09-25 09:42:29'),
(25,2,'Aleesha','Rana','aleesha123@gmail.com','aleesha123','Female','1996-08-17','1695616740_Cartoon-Pic-Ideas-for-DP-Profile11.png','Lahore, Punjab','Rejected','Inactive','2023-09-25 09:39:00','2023-09-25 10:08:54'),
(26,2,'Ali Ahmed','Soomro','alias12@gmail.com','aliahmed123','Male','1994-08-15','1695628377_images.png','Dadu, Sindh','Approved','Active','2023-09-25 12:04:03','2023-09-25 12:53:11'),
(27,2,'Muhammad Younis','Khan','muhammadyunis1@gmail.com','yunis123','Male','1991-11-08','1695706476_3052.png_860.png','Peshawar, Pakistan','Approved','Active','2023-09-26 10:16:10','2023-09-26 10:34:36'),
(28,2,'Babar Ali','Khan','babar12@gmail.com','babar123','Male','1986-05-19','1695705795_Untitled.png','Lahore, Punjab','Approved','Active','2023-09-26 10:19:56','2023-09-26 10:23:15');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
