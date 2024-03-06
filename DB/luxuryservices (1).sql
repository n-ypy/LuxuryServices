-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 06, 2024 at 11:25 PM
-- Server version: 10.10.3-MariaDB-1:10.10.3+maria~ubu2204-log
-- PHP Version: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luxuryservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notes`
--

CREATE TABLE `admin_notes` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notes`
--

INSERT INTO `admin_notes` (`id`, `content`, `updated_at`, `created_at`) VALUES
(16, 'This is a test.', NULL, '2024-03-06 21:51:09'),
(17, 'Just a test.', NULL, '2024-03-06 21:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `job_offer_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `candidate_id`, `job_offer_id`, `status_id`, `created_at`, `updated_at`) VALUES
(10, 8, 17, 2, '2024-03-06 21:48:20', NULL),
(11, 8, 16, 2, '2024-03-06 21:48:24', NULL),
(12, 8, 15, 2, '2024-03-06 21:48:28', NULL),
(13, 8, 12, 2, '2024-03-06 21:48:32', NULL),
(14, 10, 11, 2, '2024-03-06 22:31:25', NULL),
(15, 10, 13, 2, '2024-03-06 22:31:27', NULL),
(16, 10, 12, 2, '2024-03-06 22:31:30', NULL),
(17, 10, 17, 2, '2024-03-06 22:31:32', NULL),
(18, 10, 15, 2, '2024-03-06 22:31:35', NULL),
(19, 10, 14, 2, '2024-03-06 22:31:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_status`
--

CREATE TABLE `application_status` (
  `id` int(11) NOT NULL,
  `status_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_status`
--

INSERT INTO `application_status` (`id`, `status_value`) VALUES
(1, 'Accepted'),
(2, 'Pending'),
(3, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `passport_file_id` int(11) DEFAULT NULL,
  `curriculum_vitae_id` int(11) DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT NULL,
  `job_category_id` int(11) DEFAULT NULL,
  `experience_id` int(11) DEFAULT NULL,
  `notes_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `adress` longtext DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `is_passport_valid` tinyint(1) DEFAULT NULL,
  `current_location` longtext DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` longtext DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `user_id`, `gender_id`, `passport_file_id`, `curriculum_vitae_id`, `profile_picture_id`, `job_category_id`, `experience_id`, `notes_id`, `first_name`, `last_name`, `adress`, `country`, `nationality`, `is_passport_valid`, `current_location`, `date_of_birth`, `place_of_birth`, `is_available`, `short_description`, `created_at`) VALUES
(8, 9, 2, 13, 14, 15, 4, 5, NULL, 'Sandra', 'Clegg', 'Homosassa Springs', 'SE', 'French', 1, 'FL 34448', '1985-11-01', 'Cusco, South Africa', 1, 'Working as admin at LuxuryServices...', '2024-03-06 21:45:27'),
(10, 11, 1, 16, 17, 18, 5, 2, NULL, 'Theodore', 'Liu', '3064 Edgewood Avenue Fresno', 'BH', 'French', 1, 'CA 93722', '1995-12-01', 'Lyon, France', 1, 'Hi', '2024-03-06 22:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `status_id`, `first_name`, `last_name`, `email`, `phone_number`, `content`, `created_at`) VALUES
(1, 2, 'Michel', 'Robert', 'eb@gmail.com', '0616838383', 'Message', '2023-09-29 22:35:14'),
(2, 2, 'Theodore', 'Liu', 'Theodore@Liu.com', '0612121212', 'Hi,', '2024-03-06 22:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_status`
--

CREATE TABLE `contact_status` (
  `id` int(11) NOT NULL,
  `status_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_status`
--

INSERT INTO `contact_status` (`id`, `status_value`) VALUES
(1, 'Processed'),
(2, 'Pending'),
(3, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `notes_id` int(11) DEFAULT NULL,
  `company_name` varchar(100) NOT NULL,
  `activity_type` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `contact_phone_number` varchar(16) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `notes_id`, `company_name`, `activity_type`, `contact_name`, `position`, `contact_phone_number`, `contact_email`, `created_at`) VALUES
(2, 17, 'FastServices', 'Services', 'Mr EVGENII BUSYGIN', 'CEO', '0612121212', 'ebusy9@gmail.com', '2023-10-02 02:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230927190907', '2023-09-27 19:09:33', 1415),
('DoctrineMigrations\\Version20231002132410', '2023-10-02 16:26:20', 127),
('DoctrineMigrations\\Version20231002182024', '2023-10-02 18:20:32', 82),
('DoctrineMigrations\\Version20231002190156', '2023-10-02 19:04:27', 29),
('DoctrineMigrations\\Version20231004174752', '2023-10-04 18:19:19', 193);

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `experience_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `experience_value`) VALUES
(1, '0 - 6 month'),
(2, '6 month - 1 year'),
(3, '1 - 2 years'),
(4, '2+ years'),
(5, '5+ years'),
(6, '10+ years');

-- --------------------------------------------------------

--
-- Table structure for table `gender_list`
--

CREATE TABLE `gender_list` (
  `id` int(11) NOT NULL,
  `gender_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gender_list`
--

INSERT INTO `gender_list` (`id`, `gender_value`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `id` int(11) NOT NULL,
  `category_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `category_value`) VALUES
(1, 'Commercial'),
(2, 'Retail sales'),
(3, 'Creative'),
(4, 'Technology'),
(5, 'Marketing & PR'),
(6, 'Fashion & luxury'),
(7, 'Management & HR');

-- --------------------------------------------------------

--
-- Table structure for table `job_offer`
--

CREATE TABLE `job_offer` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `notes_id` int(11) DEFAULT NULL,
  `job_type_id` int(11) NOT NULL,
  `job_category_id` int(11) NOT NULL,
  `reference` varchar(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `location` longtext NOT NULL,
  `closing_date` date NOT NULL,
  `salary` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `description` longtext NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_offer`
--

INSERT INTO `job_offer` (`id`, `customer_id`, `notes_id`, `job_type_id`, `job_category_id`, `reference`, `is_active`, `job_title`, `location`, `closing_date`, `salary`, `created_at`, `updated_at`, `description`, `position`) VALUES
(11, 2, 16, 2, 1, '#COM267295', 1, 'Keyce Academy', '4515541', '2023-10-27', 899589, '2023-10-02 17:21:35', '2024-03-06 21:51:09', '<p>Keyce Academy Caraïbes recrute en Martinique : Plusieurs professeurs en informatique en developpement et maitrise des systèmes et réseaux. Vous êtes une pointure dans votre domaine de compétence. Ils seront formés sur les thématiques suivantes : PROFIL : · Maitrise des algorithmes · Langage C · PHP · Python · Tchnologies web · AWS · CCA1 (ITN) · CCNA2 (SRWE) · Linux · Java · BDD Technologies · CLOUD · Cybersécurité · Modélisation Vous disposez d’une expérience réussie sur l’animation de formation diplômante. Vous êtes reconnu(e) pour vos compétences dans le domaine. Vous aimez transmettre votre savoir et disposez de qualités humaines telles que la pédagogie, le sens du contact et la capacité à fédérer un groupe et de les faire évoluer. Vous êtes en veille permanente sur les tendances du marché et êtes force de proposition afin d’actualiser les contenus pédagogiques.</p>', 'Commercial'),
(12, 2, NULL, 1, 4, '#TEC270332', 1, 'Web Dev Teacher', 'Roanne', '2026-11-02', 21600, '2023-10-02 18:12:12', '2023-10-02 18:25:53', 'Keyce Academy Caraïbes recrute en Martinique :\r\n\r\nPlusieurs professeurs en informatique en developpement et maitrise des systèmes et réseaux.\r\n\r\nVous êtes une pointure dans votre domaine de compétence.\r\n\r\nIls seront formés sur les thématiques suivantes :\r\n\r\nPROFIL :\r\n\r\n· Maitrise des algorithmes\r\n\r\n· Langage C\r\n\r\n· PHP\r\n\r\n· Python\r\n\r\n· Tchnologies web\r\n\r\n· AWS\r\n\r\n· CCA1 (ITN)\r\n\r\n· CCNA2 (SRWE)\r\n\r\n· Linux\r\n\r\n· Java\r\n\r\n· BDD Technologies\r\n\r\n· CLOUD\r\n\r\n· Cybersécurité\r\n\r\n· Modélisation\r\n\r\nVous disposez d’une expérience réussie sur l’animation de formation diplômante.\r\n\r\nVous êtes reconnu(e) pour vos compétences dans le domaine.\r\n\r\nVous aimez transmettre votre savoir et disposez de qualités humaines telles que la pédagogie, le sens du contact et la capacité à fédérer un groupe et de les faire évoluer. Vous êtes en veille permanente sur les tendances du marché et êtes force de proposition afin d’actualiser les contenus pédagogiques.', ''),
(13, 2, NULL, 2, 2, '#RET271087', 1, 'Retailer', 'Paris', '2023-12-14', 46587, '2023-10-02 18:24:47', '2023-10-02 18:24:50', 'Avez-vous envie de rejoindre l\'enseigne Histoire d\'or qui rend l\'univers de la bijouterie accessible à tous ? Souhaitez-vous travailler pour l\'une des enseignes préférées des Français ? Savez-vous que c\'est dans notre ADN de partager nos réussites avec nos collaborateurs ? Intégrer Histoire d\'or c\'est : Prendre part à une aventure collective au côté de managers inspirants Intégrer une enseigne présente sur la France entière Découvrir notre univers à travers l\'un de nos 350 points de vente Être au côté de chaque client derrière lequel se cache une belle histoire C\'est également rejoindre une entreprise aux valeurs fortes : Exigence, Esprit d\'équipe, Simplicité, Engagement, Audace Nos valeurs sont le fondement de notre réussite et sont partagées par l\'ensemble de nos collaborateurs ! Un métier passion Devenir Conseiller de vente c\'est : Devenir l\'ambassadeur d\'Histoire d\'or Faire un métier alliant goût du service et exigence Evoluer au sein d\'un environnement raffiné qui rend le luxe accessible à tous Votre quotidien chez nous ! Des journées riches et diversifiées au cœur de la bijouterie et de l\'horlogerie : Une écoute et des attentions particulières pour vos clients Une vente personnalisée pour les accompagner lors de moments précieux comme les mariages ou les anniversaires La responsabilité de la mise en avant des produits au travers du merchandising La gestion de la tenue du magasin (propreté, rangement...) Votre profil & vos atouts pour réussir Vous êtes curieux, dynamique et possédé(e) un attrait pour la vente Vous avez un goût immodéré pour les challenges et les défis Vous êtes doté(e) d\'une aisance relationnelle et avez le contact facile Vous êtes attiré(e) par l\'univers de la mode, la beauté dont les nouvelles tendances n\'ont aucun secret pour vous ! Vous êtes capable de sortir de votre zone de confort et savez faire preuve d\'audace. Et demain ? Au sein de notre entreprise, nous avons à cœur de faire grandir nos collaborateurs. De nombreuses perspectives d\'évolution s\'offrent à vous que ce soit au sein de nos 350 points de vente ou auprès de nos équipes siège. Conditions du poste Horaires liés à l\'activité du magasin répartis sur 35h Nos magasins sont présents dans les centres commerciaux et en centre-ville ce qui induit le travail les week-ends et les jours fériés selon la zone géographique. Chez Histoire d\'or afin de compléter votre rémunération fixe nous avons mis en place un système de variable pour partager nos réussites avec l\'ensemble de nos collaborateurs (variable mensuelle, intéressement, participation) ! Osez l\'univers de la bijouterie et rejoignez-nous pour devenir Conseiller de vente ! Au-delà de votre cv, c\'est votre personnalité qui fera la différence !', ''),
(14, 2, NULL, 3, 5, '#MAR271487', 1, 'Manager Economic Brands', 'New York', '2023-10-19', 67458, '2023-10-02 18:31:27', '2023-10-02 18:31:59', 'Leading the hospitality revolution, Accor is more than a hotel group. With luxury to economy, homestays to resorts, we are a holistic ecosystem of 40 brands in 110 countries, Talent and Solutions, ready to engage with the future’s endless possibilities.\r\n\r\nAccor has an offer to bring new life to the way you live, work, play and do business with a personalized guest experience.\r\n\r\n\r\n\r\nWe are looking for an ambitious Economic Brands - Experience (ibis Styles & Greet)\r\n\r\nto join our Global Brand & Marketing Team. This is an exciting role supporting the development of these major economic brands.\r\n\r\n\r\n\r\nReporting to VP Global Brand Experience - Economic Brands, the Manager will play an integral role within the Global Brand & Marketing organisation developing and launching culturally relevant experiences that are conscious, and drive brand desirability, relevance, and preference.\r\n\r\n\r\n\r\nThe Manager in close collaboration with communication, design, compliance regional and transversal teams (e.g., loyalty, digital, sponsorships & partnerships, Talents & Culture…) will be responsible for driving workstreams related to defining and executing brand experience, signature experiences, product strategy and operating standards.\r\n\r\n\r\n\r\nWhat we value as a brand team :\r\n\r\n\r\n\r\nWe are all about building brands with a purpose, putting cultural relevancy at the heart.\r\nOur role is to make our brands a canvas of collective creativity that is co-created with our communities.\r\nWith our kind hearts we bring richness and relevancy to all our stakeholders.\r\nWe harness our diverse backgrounds to create experiences that put people and community at the core of our strategy.\r\nWe believe in progressing and thriving as a diverse collective of open-minded individuals.\r\nWe are all about consistency but love a little bit of grey – as this is where huge leaps happen.\r\nWe are progressive and humble, consciously building a path to an inclusive future for all.', ''),
(15, 2, NULL, 4, 3, '#CRE271651', 1, 'Photograph', 'Toulouse', '2024-06-27', 19500, '2023-10-02 18:34:11', '2023-10-02 18:34:19', 'Synergie, mettons nos énergies en commun. Fort d\'une présence dans 17 pays, avec 800 agences d\'emploi et de 5 000 collaborateurs, le Groupe Synergie, 1er groupe français de services en Ressources Humaines, vous accompagne dans votre carrière professionnelle : recrutement CDD-CDI, intérim, formation et conseil RH. Depuis notre origine, nous nous différencions par nos valeurs, notre sens de l\'engagement et notre capacité à apporter des solutions concrètes aux clients, candidats et intérimaires.\r\n\r\n\r\nVous souhaitez vivre une expérience unique au coeur d\'une entreprise mondialement connue pour son parc d\'attraction, cette offre vous est destinée !!\r\n\r\n\r\nAfin d\'effectuer de futures missions ponctuelles (week-end, semaine et/ou vacances scolaires),à l\'occasion de l\'organisation d\'évènements exceptionnels et temporaires, nous recherchons des photographes.\r\n\r\n\r\nCes postes s\'adressent à des candidats majeurs ou assimilés, compte tenu des horaires de nuit pratiqués et de la réglementation du travail protégeant les jeunes travailleurs.\r\n\r\n\r\nVous disposez d\'un book et vous souhaitez travailler dans le milieu du loisir ce poste est fait pour vous !', ''),
(16, 2, NULL, 5, 6, '#FAS271806', 1, 'Model', 'Milan', '2025-03-12', 69000, '2023-10-02 18:36:46', '2023-10-02 18:36:48', 'Armand Thiery est un acteur historique de la mode masculine. Fondée en 1841, la marque a depuis développé son expertise dans le prêt-à-porter féminin.\r\n\r\nAvec un réseau de plus de 585 magasins et des ouvertures chaque année, une présence en France, Belgique, Luxembourg et Monaco, ainsi que 3 sites Internet,\r\n\r\nArmand Thiery, Toscane et Edji ont su se positionner comme des marques partenaires de leurs clients.\r\n\r\nAu Sein De Notre Bureau D\'Achat Femme Et Directement Rattachée à La Cheffe De Produit Maille, Vous Aurez Pour Missions\r\nRéaliser les dossiers techniques (les dessins techniques, les barèmes de mesures),\r\nAssurer la mise au point des modèles et participer activement aux essayages avec notre mannequin cabine,\r\nContrôler les prototypes et les têtes de série adressés par nos fournisseurs : vérification de la qualité, des mesures, du bien-aller des produits et de leurs conformités par rapport au dossiers techniques,\r\nAccompagner les fournisseurs dans la mise au point produit afin de répondre aux exigences du cahier des charges.\r\nDe formation supérieure en modélisme, vous disposez d\'une expérience réussie de 3 ans au minimum sur un poste similaire.', ''),
(17, 2, NULL, 1, 7, '#MAN272047', 1, 'Manager M/W', 'Le Coteau', '2027-10-02', 66600, '2023-10-02 18:40:47', '2023-10-02 19:24:41', '<p><strong>GoodNews</strong> est une start-up spécialisée dans le café et les boissons fonctionnelles dont l\'objectif est d\'offrir à la population des habitudes saines grâce à un café de qualité, des compléments alimentaires et un environnement durable. Nous nous identifions une jeune communauté d\'amoureux de la marque avec une bonne mission, un produit innovant et sain, des amoureux du partage et de la vie avec le sourire.&nbsp;<br>Nous avons actuellement plus de 25 magasins à Barcelone, Madrid et Paris, avec un projet d\'expansion dans les principales villes d\'Europe pour les prochaines années.&nbsp;<br>Nous sommes en croissance constante et c\'est pour cela que nous recherchons des personnes qui s\'identifient à nos valeurs et à nos objectifs, qui sont désireuses de révolutionner le monde du café, dans une perspective durable et avec un impact positif. Mais surtout, et c\'est le plus important, nous recherchons des personnes authentiques avec une bonne ambiance. Nous recherchons un Store Manager pour gérer nos points de vente à Paris.</p>', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `id` int(11) NOT NULL,
  `type_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`id`, `type_value`) VALUES
(1, 'Full time'),
(2, 'Part time'),
(3, 'Temporary'),
(4, 'Freelance'),
(5, 'Seasonal');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `url`, `created_at`) VALUES
(13, '/passport/image-65e8e495f06dd.png', '2024-03-06 21:48:05'),
(14, '/cv/image-65e8e495f0a97.png', '2024-03-06 21:48:05'),
(15, '/profile_picture/image-65e8e495f0935.png', '2024-03-06 21:48:05'),
(16, '/passport/image-65e8eeb268e82.png', '2024-03-06 22:31:14'),
(17, '/cv/image-65e8eeb26915c.png', '2024-03-06 22:31:14'),
(18, '/profile_picture/image-65e8eeb268fed.png', '2024-03-06 22:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_active`) VALUES
(9, 'admin@ls.com', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$x9Ox.kRn.NqwqqYSZhqfaOcgq9.u0ubKntuHJq6SnnXjnmP2II3k6', 1),
(11, 'candidate@ls.com', '[\"ROLE_USER\"]', '$2y$13$SsneYnEO5q2Emes.pZlC/.WKifPBRgDQZfS34aptoETzH2RcfTcsC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notes`
--
ALTER TABLE `admin_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A45BDDC191BD8781` (`candidate_id`),
  ADD KEY `IDX_A45BDDC13481D195` (`job_offer_id`),
  ADD KEY `IDX_A45BDDC16BF700BD` (`status_id`);

--
-- Indexes for table `application_status`
--
ALTER TABLE `application_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C8B28E44A76ED395` (`user_id`),
  ADD UNIQUE KEY `UNIQ_C8B28E44631C839D` (`passport_file_id`),
  ADD UNIQUE KEY `UNIQ_C8B28E444AF29A35` (`curriculum_vitae_id`),
  ADD UNIQUE KEY `UNIQ_C8B28E44292E8AE2` (`profile_picture_id`),
  ADD UNIQUE KEY `UNIQ_C8B28E44FC56F556` (`notes_id`),
  ADD KEY `IDX_C8B28E44708A0E0` (`gender_id`),
  ADD KEY `IDX_C8B28E44712A86AB` (`job_category_id`),
  ADD KEY `IDX_C8B28E4446E90E27` (`experience_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4C62E6386BF700BD` (`status_id`);

--
-- Indexes for table `contact_status`
--
ALTER TABLE `contact_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_81398E09FC56F556` (`notes_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender_list`
--
ALTER TABLE `gender_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_offer`
--
ALTER TABLE `job_offer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_288A3A4EFC56F556` (`notes_id`),
  ADD KEY `IDX_288A3A4E9395C3F3` (`customer_id`),
  ADD KEY `IDX_288A3A4E5FA33B08` (`job_type_id`),
  ADD KEY `IDX_288A3A4E712A86AB` (`job_category_id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notes`
--
ALTER TABLE `admin_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `application_status`
--
ALTER TABLE `application_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_status`
--
ALTER TABLE `contact_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gender_list`
--
ALTER TABLE `gender_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_offer`
--
ALTER TABLE `job_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `FK_A45BDDC13481D195` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offer` (`id`),
  ADD CONSTRAINT `FK_A45BDDC16BF700BD` FOREIGN KEY (`status_id`) REFERENCES `application_status` (`id`),
  ADD CONSTRAINT `FK_A45BDDC191BD8781` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`id`);

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `FK_C8B28E44292E8AE2` FOREIGN KEY (`profile_picture_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_C8B28E4446E90E27` FOREIGN KEY (`experience_id`) REFERENCES `experience` (`id`),
  ADD CONSTRAINT `FK_C8B28E444AF29A35` FOREIGN KEY (`curriculum_vitae_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_C8B28E44631C839D` FOREIGN KEY (`passport_file_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `FK_C8B28E44708A0E0` FOREIGN KEY (`gender_id`) REFERENCES `gender_list` (`id`),
  ADD CONSTRAINT `FK_C8B28E44712A86AB` FOREIGN KEY (`job_category_id`) REFERENCES `job_category` (`id`),
  ADD CONSTRAINT `FK_C8B28E44A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_C8B28E44FC56F556` FOREIGN KEY (`notes_id`) REFERENCES `admin_notes` (`id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E6386BF700BD` FOREIGN KEY (`status_id`) REFERENCES `contact_status` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_81398E09FC56F556` FOREIGN KEY (`notes_id`) REFERENCES `admin_notes` (`id`);

--
-- Constraints for table `job_offer`
--
ALTER TABLE `job_offer`
  ADD CONSTRAINT `FK_288A3A4E5FA33B08` FOREIGN KEY (`job_type_id`) REFERENCES `job_type` (`id`),
  ADD CONSTRAINT `FK_288A3A4E712A86AB` FOREIGN KEY (`job_category_id`) REFERENCES `job_category` (`id`),
  ADD CONSTRAINT `FK_288A3A4E9395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_288A3A4EFC56F556` FOREIGN KEY (`notes_id`) REFERENCES `admin_notes` (`id`);

--
-- Constraints for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
