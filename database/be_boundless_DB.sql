/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.11-MariaDB : Database - be_boundless
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `about_cms` */

DROP TABLE IF EXISTS `about_cms`;

CREATE TABLE `about_cms` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `var_text` varchar(100) DEFAULT NULL,
  `var_value` longtext DEFAULT NULL,
  `var_show_text` text DEFAULT NULL,
  `has_image` tinyint(4) DEFAULT 0,
  `var_readonly` tinyint(4) DEFAULT 0,
  `is_video` tinyint(4) DEFAULT 0,
  `is_editor` tinyint(4) DEFAULT 0,
  `is_banner` tinyint(4) DEFAULT 0,
  `is_active` tinyint(4) DEFAULT 1,
  `is_featured` tinyint(4) DEFAULT 1,
  `is_config` tinyint(4) DEFAULT 1,
  `is_deleted` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `about_cms` */

insert  into `about_cms`(`id`,`var_text`,`var_value`,`var_show_text`,`has_image`,`var_readonly`,`is_video`,`is_editor`,`is_banner`,`is_active`,`is_featured`,`is_config`,`is_deleted`,`created_at`,`updated_at`) values 
(1,'abdout_us','About Us\r\n','About Us',0,1,0,0,0,1,1,1,0,'2023-06-05 21:30:09','0000-00-00 00:00:00'),
(3,'short_description','<p class=\"sub-p\">Pakistan\'s online market place for people to search, compare, discover and book trip tours and travel experiences across Pakistan.</p>\r\n                            <p class=\"sub-p\">You can search and look trips from our listing or you can mail us at <a href=\"mailto:beboundless@gmail.com\"> beboundless@gmail.com</a>\'to customize yout trip by your own choices and we provide you a best of us!</p>\r\n                            <p class=\"sub-p\">Pakistan\'s online market place for people to search, compare, discover and book trip tours and travel experiences across Pakistan.</p>\r\n                            <p class=\"sub-p\">You can search and look trips from our listing or you can mail us at <a href=\"mailto:beboundless@gmail.com\"> beboundless@gmail.com</a>\'to customize yout trip by your own choices and we provide you a best of us!</p>','Short Description',0,0,0,1,0,1,1,1,0,'2023-06-05 21:18:25','0000-00-00 00:00:00'),
(4,'description','<p class=\"sub-p\">Pakistan\'s online market place for people to searc\r\n                                h, compare, discover and book trip tours and travel experiences across Pakistan. \r\n                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore voluptates, praesentium facere unde earu\r\n                                m, qui omnis quod eaque iusto \r\n                                porro nesciunt facilis vel assumenda nihil quisquam ut nisi culpa illum!\r\n                                Voluptatum molestiae laudanti\r\n                                um similique voluptate rerum! Fuga, amet? Aliquam quibusdam explicabo eligendi architecto error nemo\r\n                                \r\n                                fuga suscipit\r\n                                 commodi distinctio, \r\n                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam aspernatur, \r\n                                veniam eos incidunt earum reprehenderit doloribus saepe voluptate a eveniet debit\r\n                                is enim perferendis rem sed corporis illo, vero error culpa?\r\n                                Similique necessitatibus nam, rem optio ex voluptatibus architecto nulla libero minus nihil tempore! Facere expedita veritatis volupta\r\n                                \r\n                                s at ea\r\n                                que inventore dignissimos dolor ipsa quam hic, error laborum voluptate similique soluta.\r\n\r\n                                Fuga modi deleniti soluta animi quasi asperiores ut nobis. Hic neque reprehenderit ad, ducimus accusantium voluptatibus totam, quas dign\r\n                                \r\n                                issimos ex ipsa odit omnis sapiente ipsam aspernatur! Beatae eius corrupti error?\r\n                                Voluptatem placeat pariatur distinctio rem, neque dolore veniam quis tempore illo similique do\r\n                                loribus ipsum. Itaque aliquid dignissimos veniam quasi perferendis neque? Ea sed eaque non, facere ut voluptate reiciendis eius. harum, \r\n                                molestias nulla voluptas saepe, deserunt cum? Ea voluptatem eius tempore!\r\n                                Quidem totam iste doloremque esse similique deserunt culpa architecto voluptas cum obcaecati facilis optio natus nostrum labore mo\r\n                                di fugit sequi velit aperiam, non quam vitae iusto numquam. Reprehenderit, eligendi vel!\r\n                                Dolores fuga praesentium temporibus, nihil quia velit vero laborum veritatis. Maxime sit aspernatur consectetur ullam quasi assumen\r\n\r\n                                da similique, velit harum exercitationem aut sequi quam dolorem ratione atque! Qui, minima quo.\r\n                                Praesentium veniam, vero repellendus vitae quis debitis quas est corporis ipsam quisquam officiis placeat cupiditate repellat reprehenderit deleniti error? Iusto nesciunt laudantium amet commodi reiciendis veritatis similique aperiam in. Quo!\r\n                            </p>\r\n                            <p class=\"sub-p\">You can search and look trips from our listing or you can mail us at<a href=\"mailto:beboundless@gmail.com\">beboundless@gmail.com</a>\'to customize yout trip by your own choices and we provide you a best of us!</p>','Description',0,0,0,1,0,1,0,1,0,'2023-06-05 21:17:03','0000-00-00 00:00:00'),
(5,'image','images/uploads/CMS/168598421546298-image.png','Image',1,0,0,0,0,1,1,1,0,'2023-06-05 21:23:21','0000-00-00 00:00:00');

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin@project.com','$2y$10$m40Otd6tiR/DYZ/mYj1HZOkocFvsFqb9M3Vz1aze9jf3kw4j1lkKu','KmlDrrixzdcaokaAdiedEqJOo4KXv2HBXgk7RcO6T08dvnU6PC0TvRpzGPJs','2019-03-28 16:43:17','2021-12-16 15:50:39');

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `btitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bSlug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcaption` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bdiscription` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcats` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bauthor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bImage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bFeatured` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blogs` */

insert  into `blogs`(`Id`,`btitle`,`bSlug`,`bcaption`,`bdiscription`,`bcats`,`btags`,`bauthor`,`bImage`,`thumb`,`bFeatured`,`created_at`,`updated_at`) values 
(15,'Malam Jabba','malam-jabba','Malam Jabba (also Maalam Jabba, Urdu: مالم جبہ) is a Hill Station and ski resort in the Hindu Kush mountain range nearly 40 km ......','<div>Malam Jabba (also Maalam Jabba, Urdu: مالم جبہ) is a Hill Station and ski resort in the Hindu Kush mountain range nearly 40 km from Saidu Sharif in Swat Valley, Khyber Pakhtunkhwa Province of Pakistan. It is 314 km from Islamabad and 51 km from Saidu Sharif Airport.</div>','','malam,jabba,mountain','Gems Expert','images/uploads/productsImg/168598036112252-malam-jabba.JPG','images/uploads/productsImg/thumbnail/168598036112252-malam-jabba.JPG',0,'2023-06-05 08:40:50','2023-06-06 12:49:54'),
(16,'Neelum District','neelum-district','he Neelum District (also spelled Neelam District, Urdu: ضلع نیلم‎), is the northernmost of the 10 districts of Pakistan\'','<div>The Neelum District (also spelled Neelam District, Urdu: ضلع نیلم‎), is the northernmost of the 10 districts of Pakistan\'s dependent territory of Azad Kashmir. Taking up the larger part of the Neelam Valley, the district has a population of 191,000 (as of 2017)[2]and was badly affected by the 2005 Kashmir earthquake.&lt;/p&gt;</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div>','','neelum','Gems Expert','images/uploads/productsImg/168595454046528-neelum-district.jpg','images/uploads/productsImg/thumbnail/168595454046528-neelum-district.jpg',0,'2023-06-05 08:42:20','2023-06-06 12:48:37'),
(17,'Ayubia National Park','ayubia-national-park','Ayubia (Urdu: ایوبیہ‎), is a protected area of 3,312 hectares (33 km2)[1] located in Abbottabad DistrictPakistan.','<div>Ayubia National Park (Urdu: ایوبیہ ملی باغ‎), also known as Ayubia (Urdu: ایوبیہ‎), is a protected area of 3,312 hectares (33 km2)[1] located in Abbottabad District, Khyber Pakhtunkhwa province, Pakistan. It was declared a national park in 1984.[2] Ayubia was named after Muhammad Ayub Khan (1958–1969), second President of Pakistan.</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>','','ayubia,national,pakistan,travel,mountain','Gems Expert','images/uploads/productsImg/168595464830726-ayubia-national-park.jpg','images/uploads/productsImg/thumbnail/168595464830726-ayubia-national-park.jpg',0,'2023-06-05 08:44:08','2023-06-06 12:48:35'),
(18,'Kund Malir','kund-malir','Kund Malir\' is a beach in Balochistan','<div>Kund Malir\' is a beach in Balochistan, Pakistan located in Hingol National Park, about 150 kilometres (93 mi) from Zero-Point on Makran Coastal Highway.[2] It is located 236.8 kilometres (147.1 mi) west of Karachi, the largest city of Pakistan</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>','','kund_malir,beach,balochistan,pakistan,travel','Gems Expert','images/uploads/productsImg/168595476519462-kund-malir.jpg','images/uploads/productsImg/thumbnail/168595476519462-kund-malir.jpg',0,'2023-06-05 08:46:05','2023-06-06 18:35:40'),
(19,'Saiful Muluk','saiful-muluk','Saiful Muluk (Urdu: جھیل سیف الملوک‎) is a mountainous lake located at the northern end of the Kaghan Valley.','<div>Saiful Muluk (Urdu: جھیل سیف الملوک‎) is a mountainous lake located at the northern end of the Kaghan Valley, near the town of Naran in the Saiful Muluk National Park. At an elevation of 3,224 m (10,578 feet) above sea level, the lake is located above the tree line, and is one of the highest lakes in Pakistan.</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div>','','saiful_maluk,kaghan,pakistan,northen,travel','Gems Expert','images/uploads/productsImg/168595485416847-saiful-muluk.jpg','images/uploads/productsImg/thumbnail/168595485416847-saiful-muluk.jpg',0,'2023-06-05 08:47:34','2023-06-06 18:35:38'),
(20,'Hunza Valley','hunza-valley','Hunza is a mountainous valley in the autonomous Gilgit-Baltistan region of Pakistan','Hunza (Burushaski: ہنزو‎, Wakhi: \"shina\") is a mountainous valley in the autonomous Gilgit-Baltistan region of Pakistan. Hunza is situated in the northern part of Gilgit-Baltistan, Pakistan, bordering with Khyber Pakhtunkhwa to the west and the Xinjiang region of China to the north-east.','','hunza,valley,pakistan,travel,kpk,gilgit','Gems Expert','images/uploads/productsImg/168595495773077-hunza-valley.jpg','images/uploads/productsImg/thumbnail/168595495773077-hunza-valley.jpg',0,'2023-06-05 08:49:17','2023-06-06 18:35:35'),
(21,'The Quaid-e-Azam House','the-quaid-e-azam-house','The Quaid-e-Azam House, also known as Flagstaff House, is a museum.','<div>The Quaid-e-Azam House, also known as Flagstaff House, is a museum dedicated to the personal life of Muhammad Ali Jinnah, the founder of Pakistan. Located in Karachi, Sindh, Pakistan, it was designed by British architect Moses Somake.</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div>','','#quaid-e-azamq,quetta,museum,pakistan,independence,travel','Gems Expert','images/uploads/productsImg/168595528187371-the-quaid-e-azam-house.jpg','images/uploads/productsImg/thumbnail/168595528187371-the-quaid-e-azam-house.jpg',1,'2023-06-05 08:54:41','2023-06-05 08:56:27'),
(22,'Minar-e-Pakistan','minar-e-pakistan','Minar-e-Pakistan is a national monument located in Lahore, Pakistan.','<div>Minar-e-Pakistan (Urdu: مینارِ پاکستان) is a national monument located in Lahore, Pakistan. The tower was built between 1960 and 1968 on the site where the All-India Muslim League passed the Lahore Resolution on 23 March 1940 - the first official call for a separate and independent homeland</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>','','minare-pakistan,pakistan,lahore,travel,monument,23-march','Gems Expert','images/uploads/productsImg/168595537842482-minar-e-pakistan.jpg','images/uploads/productsImg/thumbnail/168595537842482-minar-e-pakistan.jpg',1,'2023-06-05 08:56:18','2023-06-05 08:56:29'),
(23,'The Faisal Mosque','the-faisal-mosque','The Faisal Mosque (Urdu: فیصل مسجد , romanized: faisal masjid) is a mosque in Islamabad, Pakistan.....','<p><span style=\"text-align: center;\">The Faisal Mosque (Urdu: فیصل مسجد , romanized: faisal masjid) is a mosque in Islamabad, Pakistan. Upon completion it was the largest mosque in the world; it is currently the fifth largest mosque in the world and the largest in South Asia. It is located on the foothills of Margalla Hills in Islamabad.</span></p>','','mosque,faisal,masjid','Gems Expert','images/uploads/productsImg/168605591294304-the-faisal-mosque.jpg','images/uploads/productsImg/thumbnail/168605591294304-the-faisal-mosque.jpg',1,'2023-06-06 12:51:53','2023-06-06 12:51:53');

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `contacts` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `faqs` */

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `Id` int(15) NOT NULL AUTO_INCREMENT,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `faqActive` tinyint(4) DEFAULT 1,
  `isVideo` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `faqs` */

insert  into `faqs`(`Id`,`question`,`answer`,`faqActive`,`isVideo`,`created_at`,`updated_at`) values 
(1,'How do I make booking?','You can make bookings through Credit card/Debit card and via wire transfer. Please make sure you authorize you transaction from you bank beforehand.',1,0,'2023-06-05 17:52:24','2023-06-05 17:52:24'),
(2,'Can I pay cash on the day of the trip.','Due to nature of the trip or activity you are selecting, we require payment upfront and in advance.',1,0,'2023-06-05 17:57:14','2023-06-05 17:57:18'),
(3,'Can I make a tetative booking without paying?','Unfortunately, this is not an option since our tour operators invest resources according to the number of people whoe have confirmed their spots in any particular activity.',1,0,'2023-06-05 17:57:47','2023-06-05 17:57:47'),
(4,'What is refund policy in case of cancellation?','Varies across tours. Will be explained in detail on trip notes.',1,0,'2023-06-05 17:58:15','2023-06-05 17:58:15');

/*Table structure for table `m_flags` */

DROP TABLE IF EXISTS `m_flags`;

CREATE TABLE `m_flags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag_type` varchar(100) NOT NULL,
  `flag_value` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `flag_additionalText` text DEFAULT NULL,
  `has_image` varchar(1) DEFAULT '0',
  `is_active` varchar(1) DEFAULT '1',
  `is_config` varchar(1) DEFAULT '0',
  `flag_show_text` text DEFAULT NULL,
  `is_featured` int(11) DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1966 DEFAULT CHARSET=utf8;

/*Data for the table `m_flags` */

insert  into `m_flags`(`id`,`flag_type`,`flag_value`,`created_at`,`updated_at`,`flag_additionalText`,`has_image`,`is_active`,`is_config`,`flag_show_text`,`is_featured`,`is_deleted`,`user_id`) values 
(59,'PHONE','03032167370','2023-06-06 18:56:03','0000-00-00 00:00:00','03032167370','0','1','1','Phone',0,0,0),
(123,'COMPANY','Be-Boundless','2023-06-04 21:53:00','0000-00-00 00:00:00','Be-Boundless','0','1','1','Company',0,0,0),
(218,'COMPANYEMAIL','info@be-boundless.com','2023-06-06 18:55:57','0000-00-00 00:00:00','info@be-boundless.com','0','1','1','Email',0,0,0),
(499,'CURRENTHEME','orange','2023-06-12 23:37:52','2023-06-12 18:37:52','orange','0','1','1','Theme Option',0,0,0),
(519,'ADDRESS','36 block, abc road karachi','2023-06-04 22:11:59','0000-00-00 00:00:00','36 block, abc road karachi','0','1','1','Address',0,0,0),
(682,'FACEBOOK','#','2023-06-12 23:48:32','0000-00-00 00:00:00','#','0','1','1','Facebook',0,0,0),
(1960,'GOOGLE','#','2023-06-04 21:51:14','0000-00-00 00:00:00','#','0','1','1','Twitter',0,0,0),
(1961,'INSTAGRAM','#','2022-04-20 14:48:11','0000-00-00 00:00:00','#','0','1','1','Instagram',0,0,0),
(1962,'YOUTUBE','#','2022-04-20 14:48:13','0000-00-00 00:00:00','#','0','1','1','Youtube',0,0,0),
(1964,'LATITUDE','24.860966','2022-04-20 14:48:13','0000-00-00 00:00:00','24.860966','0','1','1','LATITUDE',0,0,0),
(1965,'LONGITUDE','66.990501','2023-06-04 22:11:31','0000-00-00 00:00:00','66.990501','0','1','1','LONGITUDE',0,0,0);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2021_10_28_170909_create_product_table',2),
(6,'2021_10_28_193612_create_products_table',3),
(7,'2021_10_28_193845_create_brand_table',4),
(8,'2021_10_28_193952_create_category_table',4),
(9,'2021_10_28_194046_create_product_images_table',4),
(10,'2021_10_28_194253_create_cart_table',4),
(11,'2021_11_01_172416_create_cart_table',5),
(12,'2021_11_01_185242_create_user_wish_list_table',6),
(13,'2021_11_02_154200_create_orders_table',7),
(14,'2021_11_02_155309_create_orderdetails_table',7),
(15,'2021_11_02_160714_create_coupons_table',8),
(16,'2021_11_09_151505_create_admins_table',9),
(17,'2021_11_29_144842_contact',10),
(18,'2021_11_30_203955_create_blog_table',11),
(19,'2021_12_03_172021_create_testimonial_table',12);

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pSlug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noOfDays` int(15) DEFAULT NULL,
  `pDescription` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pBookingId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pPrice` float NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pImage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pActive` tinyint(1) NOT NULL,
  `pFeatured` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `packages` */

insert  into `packages`(`Id`,`pName`,`pSlug`,`noOfDays`,`pDescription`,`pBookingId`,`pPrice`,`discount`,`pImage`,`thumb`,`pActive`,`pFeatured`,`created_at`,`updated_at`) values 
(15,'Trip to Hunza Valley','trip-to-hunza-valley',4,'<p class=\"slide-p\"><i class=\"fa fa-map-marker\">Starting Location: Islamabad&nbsp; covering all the visiting places also</i></p>','bb144',35000,'0','images/uploads/packagesImg/168659531571732-trip-to-hunza-valley.jpg','images/uploads/packagesImg/thumbnail/168659531571732-trip-to-hunza-valley.jpg',1,1,'2022-09-12 23:29:57','2023-06-06 16:08:06'),
(16,'Trip to Naran, Kagan Valley','trip-to-naran-kagan-valley',4,'<p class=\"slide-p\"><i class=\"fa fa-map-marker\">Starting Location: Islamabad</i></p>','bb123',12000,'0','images/uploads/packagesImg/168659539290886-trip-to-naran-kagan-valley.jpg','images/uploads/packagesImg/thumbnail/168659539290886-trip-to-naran-kagan-valley.jpg',1,1,'2022-09-12 23:29:57','2023-06-06 16:08:20'),
(18,'Trip to Aubia Top','trip-to-aubia-top',5,'<p class=\"slide-p\"><i class=\"fa fa-map-marker\">Starting Location: Islamabad</i></p>','bb133',35000,'0','images/uploads/packagesImg/168607217540290-trip-to-aubia-top.jpg','images/uploads/packagesImg/thumbnail/168607217540290-trip-to-aubia-top.jpg',1,1,'2023-06-06 17:22:56','2023-06-06 17:22:56'),
(19,'Trip to Kund Malir','trip-to-kund-malir',2,'<p>Starting Location Karachi</p>','bb155',12000,'2','images/uploads/packagesImg/168607233939413-trip-to-kund-malir.jpg','images/uploads/packagesImg/thumbnail/168607233939413-trip-to-kund-malir.jpg',1,1,'2023-06-06 17:25:39','2023-06-06 17:25:39'),
(20,'Trip to Malam Jabba','trip-to-malam-jabba',4,'<p class=\"slide-p\"><i class=\"fa fa-map-marker\">Starting Location: Islamabad</i></p>','bb166',40000,'20','images/uploads/packagesImg/168607250377291-trip-to-malam-jabba.JPG','images/uploads/packagesImg/thumbnail/168607250377291-trip-to-malam-jabba.JPG',1,1,'2023-06-06 17:28:23','2023-06-06 17:28:23'),
(21,'Whole tour Islamabad','whole-tour-islamabad',7,'<p class=\"slide-p\"><i class=\"fa fa-map-marker\">Starting Location: Islamabad</i></p>','bb177',45000,'0','images/uploads/packagesImg/168607272554205-whole-tour-islamabad.jpg','images/uploads/packagesImg/thumbnail/168607272554205-whole-tour-islamabad.jpg',1,1,'2023-06-06 17:32:05','2023-06-06 17:32:05');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('tonnettafy8ba205fe@outlook.com','$2y$10$md8cIPExxsW.Bmd9TNMRVesJn3DfbfmQfcVyew0wzNd1ta/Gw2Nz2','2022-08-15 21:37:36'),
('uelysiag1u97lu80@outlook.com','$2y$10$HW2w0A4byiSmHKniQqau2eEV.vEWx/yoXQjg.uLL7lEaVvloDpK/u','2022-08-24 02:59:29'),
('oanela4sai0oma014@outlook.com','$2y$10$n4IxLMQP0L7AlTdwCK1aWuS1UyYiD97LzSMjuHCmgm/XS/dLuxAMC','2022-09-01 18:26:10'),
('rlorea289z7ujir@outlook.com','$2y$10$W2ze8y30UJPjLdaklOP3ru.id0WA7Yj8VD4jG5Xjl7OdJwHGhgzxa','2022-09-17 05:52:24'),
('dayloneu1i1715p31@outlook.com','$2y$10$wsdlpo96bJ.LUaaIcWG/QehnJ80RAIQaamjldNJ1aAg2NXH/4uGqi','2022-09-26 07:53:44');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `reservations` */

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bookingId` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pId` int(15) DEFAULT NULL,
  `userId` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickupAddress` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destinationAddress` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noOfPassengers` int(15) DEFAULT NULL,
  `noOfDays` int(15) DEFAULT NULL,
  `additionalMsg` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentMethod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departureDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `returnDate` timestamp NULL DEFAULT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `reservations` */

/*Table structure for table `studios` */

DROP TABLE IF EXISTS `studios`;

CREATE TABLE `studios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `orgImg` varchar(250) DEFAULT NULL,
  `sImage` varchar(250) DEFAULT NULL,
  `thumb` varchar(250) DEFAULT NULL,
  `sActive` tinyint(4) NOT NULL DEFAULT 1,
  `sFeatured` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

/*Data for the table `studios` */

insert  into `studios`(`Id`,`orgImg`,`sImage`,`thumb`,`sActive`,`sFeatured`,`created_at`,`updated_at`) values 
(48,'/images/uploads/gallery/original/168589593368532.jpg','images/uploads/gallery/168589593216621.jpg','images/uploads/gallery/thumbnail/168589593216621.jpg',1,1,'2023-06-04 16:25:33','2023-06-04 16:25:33'),
(49,'/images/uploads/gallery/original/168589593355065.jpeg','images/uploads/gallery/168589593349636.jpeg','images/uploads/gallery/thumbnail/168589593349636.jpeg',1,1,'2023-06-04 16:25:33','2023-06-04 16:25:33'),
(50,'/images/uploads/gallery/original/168589593430470.jpg','images/uploads/gallery/168589593466088.jpg','images/uploads/gallery/thumbnail/168589593466088.jpg',1,1,'2023-06-04 16:25:34','2023-06-04 16:25:34'),
(51,'/images/uploads/gallery/original/168589593559962.jpeg','images/uploads/gallery/168589593515059.jpeg','images/uploads/gallery/thumbnail/168589593515059.jpeg',1,1,'2023-06-04 16:25:35','2023-06-04 16:25:35'),
(52,'/images/uploads/gallery/original/168589593693170.jpg','images/uploads/gallery/168589593674580.jpg','images/uploads/gallery/thumbnail/168589593674580.jpg',1,1,'2023-06-04 16:25:36','2023-06-04 16:25:36'),
(53,'/images/uploads/gallery/original/168589593731864.jpg','images/uploads/gallery/168589593791108.jpg','images/uploads/gallery/thumbnail/168589593791108.jpg',1,1,'2023-06-04 16:25:37','2023-06-04 16:25:37'),
(54,'/images/uploads/gallery/original/168589593843754.jpg','images/uploads/gallery/168589593881257.jpg','images/uploads/gallery/thumbnail/168589593881257.jpg',1,1,'2023-06-04 16:25:38','2023-06-04 16:25:38'),
(55,'/images/uploads/gallery/original/168589594095454.png','images/uploads/gallery/168589593995252.png','images/uploads/gallery/thumbnail/168589593995252.png',1,1,'2023-06-04 16:25:40','2023-06-04 16:25:40'),
(57,'/images/uploads/gallery/original/168589594245705.jpg','images/uploads/gallery/168589594193991.jpg','images/uploads/gallery/thumbnail/168589594193991.jpg',1,1,'2023-06-04 16:25:42','2023-06-04 16:25:42'),
(58,NULL,'images/uploads/gallery/168589601717506--.jpg','images/uploads/gallery/thumbnail/168589601717506--.jpg',0,0,'2023-06-04 16:26:57','2023-06-04 16:27:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
