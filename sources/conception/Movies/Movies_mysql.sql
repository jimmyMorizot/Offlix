-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `casting`;
CREATE TABLE `casting` (
  `movie_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `role` varchar(100) NOT NULL,
  `credit_order` tinyint(3) unsigned NOT NULL
  -- AUCUNE PRIMARY KEY
  -- AUCUNE CLE ETRANGERE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `casting`;
INSERT INTO `casting` (`movie_id`, `person_id`, `role`, `credit_order`) VALUES
(14,	14,	'Julie',	5),
(1,	7,	'Thomas',	8),
(2,	15,	'Hortense',	4),
(16,	20,	'Zoé',	8),
(8,	20,	'Anaïs',	7),
(13,	13,	'Bertrand',	5),
(12,	18,	'Frédéric',	8),
(20,	16,	'Christophe',	4),
(16,	2,	'Jules',	3),
(15,	9,	'Christine',	2),
(11,	12,	'Alfred',	5),
(12,	18,	'David',	2),
(5,	4,	'Margot',	5),
(3,	16,	'Lucas',	2),
(15,	9,	'Noël',	6),
(13,	8,	'Mathilde',	3),
(16,	4,	'Aurélie',	9),
(8,	4,	'Joseph',	9),
(6,	4,	'Virginie',	3),
(19,	17,	'Timothée',	8),
(20,	9,	'Étienne',	5),
(16,	14,	'Paul',	3),
(12,	7,	'Alexandria',	1),
(16,	8,	'Noël',	2),
(17,	16,	'Martine',	6),
(20,	14,	'Joseph',	5),
(16,	1,	'Manon',	4),
(2,	12,	'Nathalie',	9),
(10,	6,	'Claudine',	8),
(15,	13,	'Thibault',	6),
(5,	8,	'Daniel',	7),
(18,	20,	'Michel',	2),
(5,	6,	'Adrien',	6),
(13,	4,	'Maurice',	8),
(14,	2,	'Henri',	2),
(16,	6,	'Jean',	9),
(9,	13,	'Madeleine',	2),
(19,	7,	'Véronique',	8),
(8,	13,	'Gilbert',	7),
(16,	16,	'Lucy',	3),
(2,	14,	'Danielle',	10),
(16,	20,	'Camille',	5),
(15,	6,	'Thibaut',	4),
(5,	13,	'Corinne',	2),
(7,	1,	'Adélaïde',	1),
(5,	3,	'Dominique',	2),
(11,	18,	'Françoise',	10),
(17,	6,	'Éric',	3),
(13,	1,	'Marine',	8),
(14,	6,	'Susanne',	7),
(2,	20,	'Lucas',	6),
(6,	6,	'Virginie',	4),
(14,	12,	'Margaret',	2),
(13,	16,	'Chantal',	4),
(7,	11,	'Jérôme',	3),
(7,	8,	'Eugène',	1),
(15,	5,	'Marcel',	10),
(13,	1,	'Aimée',	2),
(20,	20,	'Catherine',	7),
(9,	20,	'Maryse',	4),
(12,	12,	'Vincent',	4),
(2,	5,	'Louis',	5),
(4,	9,	'Alex',	9),
(6,	4,	'Margot',	10),
(12,	13,	'Anne',	7),
(7,	4,	'David',	8),
(10,	15,	'Eugène',	1),
(19,	1,	'Christine',	6),
(5,	7,	'Franck',	1),
(18,	18,	'Georges',	7),
(18,	4,	'Philippine',	6),
(4,	1,	'Lucas',	9),
(8,	17,	'Paulette',	4),
(9,	7,	'Manon',	2),
(6,	17,	'Alexandre',	10),
(1,	5,	'Agnès',	7),
(13,	15,	'Honoré',	4),
(12,	1,	'Lucas',	9),
(3,	12,	'Tristan',	9),
(17,	12,	'Manon',	9),
(10,	9,	'Bertrand',	8),
(5,	7,	'Denis',	3),
(11,	18,	'Andrée',	10),
(20,	2,	'Jean',	4),
(5,	2,	'Anastasie',	5),
(20,	14,	'Arnaude',	3),
(20,	1,	'Roger',	10),
(5,	8,	'Grégoire',	8),
(19,	7,	'Margaud',	5),
(1,	9,	'Alfred',	1),
(13,	18,	'Grégoire',	3),
(19,	9,	'Michelle',	7),
(4,	2,	'Timothée',	1),
(18,	19,	'Gabriel',	1),
(3,	9,	'Timothée',	9),
(7,	19,	'Emmanuel',	8),
(8,	9,	'Éric',	1),
(4,	4,	'Arthur',	2),
(20,	14,	'Nath',	3);

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `genre`;
INSERT INTO `genre` (`id`, `name`) VALUES
(1,	'Science-fiction'),
(2,	'Film de vampires'),
(3,	'Masala'),
(4,	'Film autobiographique'),
(5,	'Cinéma amateur'),
(6,	'Film érotique'),
(7,	'Film fantastique'),
(8,	'Americana'),
(9,	'Portrait'),
(10,	'Film historique'),
(11,	'Film de cape et d\'épée'),
(12,	'Chanbara'),
(13,	'Film de super-héros'),
(14,	'Film à sketches'),
(15,	'Art vidéo'),
(16,	'Film policier'),
(17,	'Film d\'horreur'),
(18,	'Sérial'),
(19,	'Docufiction'),
(20,	'Péplum');

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `duration` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `movie`;
INSERT INTO `movie` (`id`, `title`, `release_date`, `duration`) VALUES
(1,	'Epic Movie',	'1992-12-21',	224),
(2,	'The Jungle Book',	'2010-01-27',	21),
(3,	'Pirates of the Caribbean: Dead Mans Chest',	'2021-10-27',	231),
(4,	'Honey, I Shrunk the Kids',	'1991-10-16',	249),
(5,	'Ted',	'1970-02-19',	255),
(6,	'Bride Wars',	'1982-04-01',	26),
(7,	'Forrest Gump',	'1981-12-20',	100),
(8,	'The Breakfast Club',	'2014-08-22',	219),
(9,	'The Mummy',	'1967-07-14',	236),
(10,	'The Love Guru',	'1999-07-10',	255),
(11,	'The Fantastic Four',	'2011-03-02',	204),
(12,	'Shutter Island',	'2014-01-12',	255),
(13,	'How to Train Your Dragon (2010)',	'1964-09-14',	94),
(14,	'In the Name of the Father',	'1974-06-22',	152),
(15,	'Crazy, Stupid, Love.',	'1980-12-30',	255),
(16,	'Doctor Dolittle',	'2019-07-01',	255),
(17,	'Jurassic Park',	'2002-09-08',	155),
(18,	'Primal Fear',	'1989-03-29',	186),
(19,	'The Strangers',	'1976-08-09',	94),
(20,	'Wreck It Ralph',	'1978-06-09',	212);

DROP TABLE IF EXISTS `movie_genre`;
CREATE TABLE `movie_genre` (
  `movie_id` int(10) unsigned NOT NULL,
  `genre_id` int(10) unsigned NOT NULL,

  PRIMARY KEY (`movie_id`,`genre_id`),

  KEY `genre_id` (`genre_id`),
  KEY `movie_id` (`movie_id`),

  FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `movie_genre`;
INSERT INTO `movie_genre` (`movie_id`, `genre_id`) VALUES
(3,	1),
(12,	2),
(8,	4),
(11,	4),
(7,	5),
(3,	6),
(5,	6),
(16,	6),
(15,	7),
(10,	8),
(13,	9),
(10,	10),
(18,	10),
(5,	11),
(19,	11),
(20,	11),
(6,	12),
(9,	12),
(12,	12),
(14,	12),
(20,	12),
(2,	14),
(4,	15),
(1,	16),
(17,	16),
(18,	16),
(7,	17),
(2,	18),
(8,	19),
(12,	19),
(14,	20);

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birth_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `person`;
INSERT INTO `person` (`id`, `firstname`, `lastname`, `birth_date`) VALUES
(1,	'Émile',	'Mahe',	'1956-01-22 16:22:29'),
(2,	'Monique',	'Gilles',	'1997-12-24 06:50:34'),
(3,	'Josette',	'Bernier',	'1997-12-10 01:37:01'),
(4,	'Christophe',	'Ledoux',	'1963-11-20 12:27:30'),
(5,	'Isaac',	'Roger',	'1961-01-23 19:56:02'),
(6,	'Alix',	'Pages',	'1979-07-28 05:25:45'),
(7,	'Marc',	'Chretien',	'2006-10-09 23:48:03'),
(8,	'Jeannine',	'Vallee',	'2018-03-19 07:30:10'),
(9,	'Patrick',	'Allain',	'2021-05-21 08:47:56'),
(10,	'Michèle',	'Voisin',	'1999-06-15 18:20:52'),
(11,	'Arnaude',	'Jacques',	'2004-06-23 08:40:14'),
(12,	'Victoire',	'Berger',	'1983-06-28 03:27:28'),
(13,	'Robert',	'Goncalves',	'2006-03-02 17:31:55'),
(14,	'Denis',	'Lambert',	'1991-10-15 14:09:33'),
(15,	'Laurence',	'Jacob',	'1953-10-27 03:49:38'),
(16,	'Frédéric',	'Philippe',	'2016-03-31 03:45:56'),
(17,	'Alix',	'Maillot',	'1987-08-04 04:16:54'),
(18,	'Sophie',	'Huet',	'1953-12-08 04:54:37'),
(19,	'Gilles',	'Imbert',	'1983-10-06 14:26:44'),
(20,	'Benoît',	'Roux',	'2003-12-27 02:17:29');

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL,
  `published_date` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `movie_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `review`;
INSERT INTO `review` (`id`, `content`, `rating`, `published_date`, `user_id`, `movie_id`) VALUES
(1,	'Fuga sit quia corporis est. Ipsum dolore in ex quis enim necessitatibus saepe at. Cum placeat soluta omnis quia repudiandae assumenda ducimus.',	5,	'2012-12-01 03:37:26',	20,	13),
(2,	'Non quas eaque molestias. Aspernatur quia id qui optio architecto recusandae aperiam atque. Placeat veritatis quos necessitatibus quaerat. Mollitia est exercitationem iste ut odit saepe est quaerat.',	4,	'2016-05-29 05:49:27',	2,	3),
(3,	'Hic saepe voluptatem quidem exercitationem optio consequatur perspiciatis. Sint aut autem dolor pariatur quia aliquam. Iure dolor quo voluptate rerum. Labore perferendis tempora est quibusdam et.',	2,	'2014-07-20 05:53:17',	19,	3),
(4,	'Nobis pariatur inventore ipsa rem alias et. Ut nesciunt tenetur aliquam velit. Earum saepe in aliquid aut dolorum quam. Est maxime praesentium officiis eum aliquam.',	4,	'2019-10-06 18:48:30',	7,	20),
(5,	'Et qui recusandae odio fuga. Ut qui cum possimus officiis. Iusto amet et consectetur aut tempore. Corrupti sint dolorum qui in velit et cupiditate.',	1,	'2018-07-07 22:11:10',	15,	2),
(6,	'In rerum sequi dolor qui aut. Nisi dolor rerum officiis delectus et ad. Numquam rem perspiciatis ut quia quod reprehenderit.',	4,	'2021-07-23 23:22:03',	17,	2),
(7,	'Earum optio vel ut soluta. Consequuntur aliquid saepe harum sit. Temporibus ratione et dolores.',	4,	'2021-08-04 12:11:18',	15,	1),
(8,	'Enim unde quo possimus itaque repudiandae ut. Quia id qui perspiciatis aut. Quisquam est non pariatur corrupti impedit. Sint harum voluptatibus laborum eius illum.',	2,	'2016-07-19 07:43:36',	6,	9),
(9,	'Sit vero nesciunt nesciunt consequuntur illo quaerat inventore. Nihil quia eos debitis numquam. Accusamus accusamus explicabo asperiores magnam est in.',	2,	'2016-09-07 12:20:00',	14,	18),
(10,	'Quisquam blanditiis dolore ullam. Hic maiores aut officia consectetur. Dignissimos quidem voluptates est. Aut ut molestiae officia consectetur optio. Accusamus quia quia consequuntur optio.',	5,	'2017-09-30 21:59:25',	8,	18),
(11,	'Incidunt tenetur facere libero eum. Quis cupiditate et dolor rem voluptatum.',	1,	'2020-02-28 06:40:54',	5,	12),
(12,	'Alias fugit voluptatibus accusamus odit. Sunt sequi est explicabo voluptatem in fugit. Optio vel possimus at voluptatum rerum voluptatem. Porro porro laborum blanditiis et eligendi velit non.',	3,	'2018-02-17 23:23:51',	14,	17),
(13,	'Laboriosam ut hic ab error. Officiis qui dolorum maxime beatae nam.',	4,	'2018-06-07 17:29:11',	4,	18),
(14,	'Debitis voluptatem ullam dolores enim. Modi odio quia esse aperiam qui odit. Tempora incidunt labore velit repellat vitae.',	5,	'2012-12-12 07:47:28',	18,	10),
(15,	'Praesentium amet omnis asperiores aut. Aliquam ut quis eos molestiae. Eligendi voluptatem porro non sint est. Deserunt explicabo ratione facilis quod quasi voluptas.',	4,	'2019-08-30 23:27:52',	4,	11),
(16,	'Molestias dolor doloremque ut accusamus voluptatem. Similique quos fugiat vel eum amet corrupti odit neque. Debitis labore nam excepturi magni quis.',	5,	'2021-11-17 22:24:13',	5,	12),
(17,	'Tenetur velit nam magni quae rem. Quo quisquam sunt at sit voluptatem aliquid. Hic eum modi nemo vitae et et perferendis a. Sint voluptatum dolor eos veniam mollitia.',	3,	'2020-11-23 23:12:25',	3,	5),
(18,	'Laboriosam deleniti veritatis quo assumenda. Magni est quidem mollitia facere. In laborum eum ex voluptatem perspiciatis autem. Incidunt et vel consequatur est repellendus ipsam ad eum.',	5,	'2017-02-23 08:42:52',	15,	17),
(19,	'Nihil est eum quam consequatur deleniti qui fugiat. Beatae adipisci temporibus veniam repellendus odio aperiam. Ab laborum aut et in non doloremque.',	4,	'2018-02-02 21:55:18',	17,	4),
(20,	'At ut ut atque illo. Autem ut odit et qui dicta pariatur ipsa. Ea rem autem consequuntur consequuntur dolorum corrupti.',	3,	'2013-02-23 08:17:42',	6,	9),
(21,	'Eaque minima voluptas necessitatibus corrupti eaque ea. Cum non iure dolor sequi. Asperiores beatae saepe vel in optio veniam nihil. Quo deserunt ullam quam qui.',	3,	'2020-12-13 01:43:37',	2,	6),
(22,	'Fuga cum placeat occaecati quo temporibus. Suscipit expedita inventore aspernatur quia. Error qui quisquam voluptas deleniti. Eveniet dolorem ipsa praesentium iusto omnis tempora voluptate.',	4,	'2015-12-31 17:45:00',	8,	20),
(23,	'Facere repellat adipisci est. Facere et a et rerum id et nobis quia. Laudantium est quia aut et ullam reprehenderit. Impedit praesentium quam et voluptas.',	3,	'2016-03-31 06:23:01',	1,	19),
(24,	'Ex qui sapiente nam harum cupiditate. Eveniet et voluptatem ut sapiente labore. Aut voluptas natus quo sed. Atque ex et nulla omnis accusantium.',	4,	'2013-05-18 01:11:50',	1,	19),
(25,	'Vel voluptate quisquam sunt. Optio natus accusamus est. Nesciunt sed iste saepe consectetur est eaque. Ipsum vitae sunt magni voluptas voluptas a corporis.',	4,	'2020-05-11 09:09:34',	7,	16),
(26,	'Aut eligendi ipsam tempore officiis. Nemo cumque assumenda reiciendis qui error eligendi sint. Rerum enim natus quae aut excepturi corrupti. Similique expedita nisi ab consectetur.',	5,	'2013-12-09 19:19:18',	20,	8),
(27,	'Sunt enim ullam aut facilis necessitatibus corporis delectus. Deserunt optio fugiat possimus veritatis quo sed. Aperiam maxime suscipit quia esse. Amet voluptas corporis sed id.',	2,	'2019-10-22 09:20:35',	8,	7),
(28,	'Laborum earum aut dolor. Quaerat labore assumenda distinctio tempora numquam quia et iusto. Sint asperiores veniam quos eum ut nostrum. Assumenda natus eos laudantium et laudantium sint blanditiis.',	5,	'2014-10-01 11:13:23',	7,	20),
(29,	'Deleniti est at autem non cupiditate natus vitae. Quod ut sunt dolores velit architecto sit nulla numquam. Nemo aut rerum sit aperiam aut qui quod.',	2,	'2017-03-05 05:56:14',	1,	7),
(30,	'Pariatur architecto voluptatum aut eveniet. Fuga et autem reprehenderit quia dolore sunt vel. Id labore blanditiis voluptas sit nihil. Ut vero qui minima sapiente.',	2,	'2021-11-29 08:31:16',	20,	14),
(31,	'Reiciendis aut quo rem culpa veritatis sequi consequatur. Non dolor perferendis voluptatem et veritatis. Quidem in in repellendus blanditiis mollitia et modi maxime.',	4,	'2021-11-08 07:48:07',	4,	16),
(32,	'Eligendi dolorum ab magni sit voluptates maiores officiis. Modi voluptas aut quos. Quo est temporibus non itaque. Ad voluptates et sapiente et sapiente ut nihil et.',	2,	'2018-11-18 03:18:03',	7,	17),
(33,	'Unde et quae voluptatum nostrum aut assumenda. Eaque et distinctio veritatis amet.',	2,	'2012-07-14 14:57:43',	10,	3),
(34,	'Animi rerum tenetur nesciunt a quaerat saepe. Et explicabo pariatur cupiditate accusantium et.',	5,	'2015-02-20 20:12:50',	8,	3),
(35,	'Quisquam excepturi doloribus autem quis laborum. Corrupti quos quam rerum esse corrupti veniam laborum. Aut est consequatur nostrum quaerat voluptatem.',	1,	'2017-01-29 02:54:55',	9,	1),
(36,	'Sapiente aperiam rerum veniam similique provident officiis. Vel quidem tenetur vel ut et. Fugit unde et hic eaque dolorem. Voluptatibus quam voluptatum asperiores recusandae.',	1,	'2019-07-25 20:12:00',	11,	12),
(37,	'Numquam corrupti odit quam iusto exercitationem beatae sed. Magnam dolorem corrupti velit aut molestiae.',	5,	'2021-07-26 19:20:26',	12,	12),
(38,	'Aut maxime occaecati veritatis. Ut possimus repudiandae quis qui. Et corrupti distinctio et et sit.',	2,	'2017-07-15 07:28:46',	18,	10),
(39,	'Adipisci optio nam impedit quae adipisci. Harum labore nam tempora ab eos necessitatibus. Magnam quidem sint magni culpa ipsa harum est magni. Optio tempore in asperiores ipsum iusto ut nobis fugit.',	2,	'2017-12-21 21:55:14',	20,	1),
(40,	'Amet provident dolor explicabo aut. Eum nesciunt qui voluptas accusamus quos soluta blanditiis. Harum ad at quisquam vero impedit quaerat corrupti. Accusantium dolor aut dicta nobis qui autem optio.',	3,	'2015-02-28 07:31:45',	19,	12),
(41,	'Quos qui voluptatem sunt quo et autem officiis. Dolore aut qui et magni. Distinctio quas at est deserunt pariatur dolorem ut. Molestias molestiae maxime fugiat amet illum ratione.',	2,	'2020-10-29 11:42:32',	2,	16),
(42,	'Quam qui non dolorem eaque. Aliquid rem placeat itaque incidunt necessitatibus iste enim ratione. Temporibus enim consequatur ad quia et est et.',	4,	'2012-11-24 17:19:18',	2,	18),
(43,	'Reprehenderit accusamus necessitatibus voluptatem omnis harum. Asperiores nemo atque deleniti sit.',	2,	'2013-02-28 12:33:26',	14,	4),
(44,	'Ea blanditiis unde esse dolor quis est beatae. Vel recusandae eaque corrupti quae eveniet. Porro itaque temporibus eaque iure enim minus et.',	2,	'2016-04-21 15:01:59',	1,	2),
(45,	'Nobis voluptatem et ab eos. Ad commodi commodi dolorum ipsa voluptas. Eveniet enim maxime accusamus pariatur est eligendi. Unde quo voluptatum minus rerum.',	5,	'2012-02-27 02:34:07',	18,	16),
(46,	'Et saepe maxime est quas. Nostrum unde aut qui aperiam molestiae vel. Voluptas sit quo fugiat velit sunt assumenda tempore dolor. Eum nihil excepturi dolorem voluptatem quos.',	3,	'2013-08-15 08:28:39',	20,	20),
(47,	'Nam consequuntur odio laborum. Aut voluptas animi omnis et rem totam explicabo a. Quo non nobis est dolor ratione.',	1,	'2018-10-11 12:01:22',	4,	18),
(48,	'Voluptas quod laborum commodi ut laudantium. Rerum sed deleniti et ut facilis enim. Labore sunt pariatur officiis fuga autem. Adipisci est ad sunt dolorem.',	5,	'2016-05-23 21:50:40',	3,	19),
(49,	'Delectus est libero nesciunt. Mollitia reprehenderit explicabo est magnam alias consequuntur quia. Labore alias pariatur sed aspernatur cum. Optio blanditiis beatae aliquid architecto aut tempore.',	4,	'2017-09-30 21:07:02',	6,	2),
(50,	'Nulla dicta ea perspiciatis quis. Eligendi est unde tenetur consequuntur excepturi fuga aut. Consequatur quae dignissimos ad minus aliquid quam. Ea et quos molestias illum sit non pariatur.',	5,	'2019-03-21 18:04:09',	15,	11),
(51,	'Tempore alias deleniti aut totam. Quis culpa quam beatae facere. A modi numquam vel autem quidem deserunt veritatis. Fugit quibusdam alias id nam ullam.',	5,	'2021-02-16 06:30:27',	6,	11),
(52,	'Incidunt voluptatibus suscipit officia sunt. Est sunt quia libero laudantium similique. Est ut aut nemo voluptatem porro quidem dignissimos expedita.',	2,	'2016-10-07 13:00:12',	14,	11),
(53,	'Ab alias rem optio accusamus sit. Et sit aut repellat sapiente magnam. Et eos atque rerum omnis itaque reprehenderit.',	2,	'2020-05-26 22:13:31',	16,	1),
(54,	'Quis non sapiente ipsum laborum ut dolore. Perspiciatis asperiores iure esse doloremque nobis odio. Asperiores laudantium molestiae modi alias in.',	2,	'2018-02-01 08:57:47',	12,	17),
(55,	'Illo beatae praesentium corrupti ab recusandae. Quasi ab commodi est optio est aperiam est saepe.',	3,	'2018-11-03 03:18:12',	20,	2),
(56,	'Ut occaecati aliquam et enim similique. At dolorem quae beatae ad odio. Officiis quaerat sequi eveniet.',	4,	'2021-06-19 07:05:23',	4,	7),
(57,	'Perspiciatis non quidem eum nulla. Harum quaerat delectus ea esse. Quos sit est quam voluptas perferendis molestias.',	2,	'2021-01-18 02:39:03',	17,	5),
(58,	'Minus qui tenetur excepturi quia. Vero aliquam at occaecati porro suscipit beatae hic. Labore ut autem aut omnis dolorem provident.',	5,	'2014-05-03 14:43:05',	10,	10),
(59,	'Veniam quisquam voluptatibus unde ut voluptas. Ipsam laboriosam et tenetur. Deleniti sunt sunt voluptatem. Ut porro ullam vel.',	1,	'2020-10-13 17:59:35',	4,	19),
(60,	'Quis et deleniti nulla nesciunt. Eos velit repellat laboriosam dolore maiores. Quisquam earum eos saepe ipsa quidem.',	3,	'2017-06-01 14:23:33',	10,	9);

DROP TABLE IF EXISTS `season`;
CREATE TABLE `season` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `episodes_count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `movie_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `season`;
INSERT INTO `season` (`id`, `number`, `episodes_count`, `movie_id`) VALUES
(1,	1,	6,	1),
(2,	2,	10,	1),
(3,	3,	6,	1),
(4,	4,	10,	1),
(5,	5,	10,	1),
(6,	6,	8,	1),
(7,	7,	8,	1),
(8,	1,	7,	3),
(9,	2,	8,	3),
(10,	3,	10,	3),
(11,	4,	9,	3),
(12,	5,	6,	3),
(13,	1,	6,	5),
(14,	2,	7,	5),
(15,	3,	6,	5),
(16,	4,	6,	5),
(17,	1,	9,	7),
(18,	2,	6,	7),
(19,	3,	6,	7),
(20,	4,	6,	7),
(21,	5,	6,	7),
(22,	6,	7,	7),
(23,	1,	10,	9),
(24,	2,	7,	9),
(25,	3,	8,	9),
(26,	4,	10,	9),
(27,	1,	8,	11),
(28,	2,	9,	11),
(29,	3,	7,	11),
(30,	4,	7,	11),
(31,	5,	7,	11),
(32,	1,	10,	13),
(33,	2,	6,	13),
(34,	3,	6,	13),
(35,	4,	10,	13),
(36,	5,	6,	13),
(37,	6,	6,	13),
(38,	1,	6,	15),
(39,	2,	7,	15),
(40,	3,	7,	15),
(41,	4,	6,	15),
(42,	5,	8,	15),
(43,	1,	8,	17),
(44,	2,	6,	17),
(45,	3,	9,	17),
(46,	4,	10,	17);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE `user`;
INSERT INTO `user` (`id`, `email`, `nickname`) VALUES
(1,	'astrid60@leconte.org',	'Gabrielle'),
(2,	'lorraine.rey@hotmail.fr',	'Alain'),
(3,	'roger81@orange.fr',	'Louise'),
(4,	'guibert.denise@lacombe.com',	'Margaud'),
(5,	'schmitt.anouk@perrin.com',	'Océane'),
(6,	'edouard.adam@hotmail.fr',	'Gilbert'),
(7,	'etienne.emile@cordier.com',	'Julien'),
(8,	'gtexier@briand.fr',	'Benoît'),
(9,	'bernard38@seguin.org',	'Vincent'),
(10,	'gilbert38@club-internet.fr',	'Patrick'),
(11,	'lefebvre.dorothee@free.fr',	'Roger'),
(12,	'iolivier@sfr.fr',	'Olivier'),
(13,	'nguyen.adele@bouvet.com',	'Roger'),
(14,	'martin.lucas@live.com',	'Inès'),
(15,	'coulon.nicolas@jacquot.fr',	'Olivier'),
(16,	'brunet.eleonore@paul.fr',	'Anaïs'),
(17,	'xlaine@thierry.com',	'Jacques'),
(18,	'bertrand.lorraine@verdier.com',	'Lorraine'),
(19,	'jgauthier@live.com',	'Anne'),
(20,	'francoise91@girard.com',	'Louise');

-- 2021-12-01 16:37:49