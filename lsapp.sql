-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 mei 2019 om 10:37
-- Serverversie: 10.1.31-MariaDB
-- PHP-versie: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsapp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `achievements`
--

CREATE TABLE `achievements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `achievements_title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievements_description` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievements_img` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `achievements`
--

INSERT INTO `achievements` (`id`, `achievements_title`, `achievements_description`, `achievements_img`) VALUES
(19, 'Duim medaille brons', 'Een medaille met een duim, brons.', 'duim_medaille_brons_1556098098.png'),
(20, 'Duim medaille zilvere', 'Een medaille met een duim, zilver.', 'duim_medaille_zilver_1556098115.png'),
(21, 'Duim medaille goud', 'Een medaille met een duim, goud.', 'duim_medaille_goud_1556098137.png'),
(22, 'Duim beker brons', 'Een beker met een duim, brons.', 'duim_beker_brons_1556098153.png'),
(23, 'Duim beker zilver', 'Een beker met een duim, zilver.', 'duim_beker_zilver_1556098166.png'),
(24, 'Duim beker goud', 'Een beker met een duim, goud.', 'duim_beker_goud_1556098179.png'),
(28, 'Medaille brons', 'Een normale simpele medaille, brons.', 'normaal_medaille_brons_1556098275.png'),
(29, 'Medaille zilver', 'Een normale simpele medaille, zilver.', 'normaal_medaille_zilver_1556098314.png'),
(30, 'Medaille goud', 'Een normale simpele medaille, goud.', 'normaal_medaille_goud_1556098331.png'),
(31, 'Beker brons', 'Een normale simpele beker, brons.', 'normaal_beker_brons_1556098353.png'),
(32, 'Beker zilver', 'Een normale simpele beker, zilver.', 'normaal_beker_zilver_1556109135.png'),
(33, 'Beker goud', 'Een normale simpele beker, goud.', 'normaal_beker_goud_1556109146.png'),
(34, 'Ster medaille brons', 'Een ster medaille voor echte sterren, brons', 'ster_medaille_brons_1556098402.png'),
(35, 'Ster medaille zilver', 'Een ster medaille voor echte sterren, zilver', 'ster_medaille_zilver_1556098414.png'),
(36, 'Ster medaille goud', 'Een ster medaille voor echte sterren, goud', 'ster_medaille_goud_1556098426.png'),
(37, 'Ster beker brons', 'Een ster beker voor echte sterren, brons', 'ster_beker_brons_1556098442.png'),
(38, 'Ster beker zilver', 'Een ster beker voor echte sterren, zilver', 'ster_beker_zilver_1556098458.png'),
(39, 'Ster beker goud', 'Een ster beker voor echte sterren, goud', 'ster_beker_goud_1556098473.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `achievements_users`
--

CREATE TABLE `achievements_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `achievement_title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievement_description` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievement_img` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievement_client` int(11) NOT NULL,
  `achievement_subject` varchar(265) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievement_subjectid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` bigint(20) UNSIGNED NOT NULL,
  `feedback_client` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_mentor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_description` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_role` int(11) NOT NULL,
  `feedback_onid` int(11) NOT NULL,
  `feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `icons`
--

CREATE TABLE `icons` (
  `icon_id` bigint(20) UNSIGNED NOT NULL,
  `icon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `icons`
--

INSERT INTO `icons` (`icon_id`, `icon_code`, `icon_name`) VALUES
(1, 'f2b9', 'Adres boek'),
(2, 'f5d1', 'Appel'),
(4, 'f6e2', 'Geest'),
(6, 'f24e', 'Weegschaal'),
(8, 'f559', 'Award'),
(9, 'f0f3', 'Bel'),
(10, 'f236', 'Bed'),
(11, 'f02d', 'Boek'),
(12, 'f466', 'Box'),
(13, 'f206', 'Fiets'),
(14, 'f64a', 'Werktijden'),
(15, 'f073', 'Kalender'),
(16, 'f0a1', 'Megafoon'),
(17, 'f030', 'Camera'),
(18, 'f017', 'Klok'),
(20, 'f0f4', 'Koffie'),
(21, 'f075', 'Praatwolk'),
(22, 'f4ad', 'Praatwolk-1'),
(23, 'f562', 'Bel'),
(24, 'f108', 'Computer'),
(25, 'f0e0', 'Envelop'),
(26, 'f578', 'Vis'),
(27, 'f19d', 'Afstuderen'),
(28, 'f118', 'Lach'),
(29, 'f5b8', 'Lach - 1'),
(30, 'f005', 'Ster'),
(31, 'f164', 'Duim omhoog'),
(32, 'f091', 'Beker'),
(33, 'f500', 'Gebruikers'),
(34, 'f0c0', 'Gebruikers - 1'),
(35, 'f0b1', 'Koffer'),
(36, 'f024', 'Vlag'),
(37, 'f0b2', 'Pijlen'),
(38, 'f002', 'Vergrootglas'),
(39, 'f007', 'Gebruiker'),
(40, 'f508', 'Gebruiker met das'),
(41, 'f5fc', 'Laptop code'),
(42, 'f5ce', 'Wijnglas'),
(43, 'f1bb', 'Boom'),
(44, 'f291', 'Winkelmandje'),
(45, 'f290', 'Winkeltas'),
(46, 'f4d7', 'Route'),
(47, 'f53f', 'Pallet'),
(48, 'f3c9', 'Microfoon'),
(49, 'f1e3', 'Voetbal'),
(50, 'f1e3', 'Voetbal-1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `learning_goals`
--

CREATE TABLE `learning_goals` (
  `learning_id` bigint(20) UNSIGNED NOT NULL,
  `learning_category` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `learning_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `learning_icon` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learning_role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learning_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `learning_finished` int(11) DEFAULT NULL,
  `learning_finish` int(11) NOT NULL,
  `learning_feedback` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `learning_feedbackIcon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_25_192341_create_posts_table', 1),
(4, '2019_03_26_123331_add_user_id_to_posts', 2),
(10, '2019_03_27_094505_create_learning_goals_table', 3),
(11, '2019_03_27_095308_create_learning_goals_has_achievements_table', 3),
(12, '2019_03_27_095526_create_feedback_table', 3),
(13, '2019_03_27_100304_create_achievements_table', 3),
(14, '2019_03_27_115616_drop_user_table', 4),
(15, '2019_03_27_115705_drop_users_table', 5),
(16, '2019_03_27_120256_create_users_table', 6),
(18, '2019_03_28_092407_create_users_table', 7),
(19, '2019_04_09_110503_create_icons_table', 8),
(20, '2019_04_12_132911_create_template_goals_table', 9),
(21, '2019_04_17_135415_create_achievements_users_table', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `template_goals`
--

CREATE TABLE `template_goals` (
  `template_id` bigint(20) UNSIGNED NOT NULL,
  `template_category` int(11) DEFAULT NULL,
  `template_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_finish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `template_goals`
--

INSERT INTO `template_goals` (`template_id`, `template_category`, `template_name`, `template_icon`, `template_role`, `template_description`, `template_finish`) VALUES
(20, NULL, 'Dagindeling', 'f017', 'Hoofdleerdoel', NULL, 1),
(21, NULL, 'Weekstructuur', 'f073', 'Hoofdleerdoel', NULL, 1),
(22, NULL, 'Werkritme', 'f64a', 'Hoofdleerdoel', NULL, 1),
(23, NULL, 'Dag- en nachtritme', 'f236', 'Hoofdleerdoel', NULL, 1),
(24, NULL, 'Werknemersvaardigheden ontwikkelen', 'f0b1', 'Hoofdleerdoel', NULL, 1),
(25, NULL, 'Werknemersvaardigheden in kaart brengen', 'f24e', 'Hoofdleerdoel', NULL, 1),
(26, NULL, 'Communicatieve vaardigheden verbeteren', 'f0a1', 'Hoofdleerdoel', NULL, 1),
(27, NULL, 'Belastbaarheid onderzoeken in uren', 'f017', 'Hoofdleerdoel', NULL, 0),
(28, NULL, 'Belastbaarheid onderzoeken in taken en werkdruk', 'f002', 'Hoofdleerdoel', NULL, 0),
(29, NULL, 'Zelfstandigheid vergroten', 'f508', 'Hoofdleerdoel', NULL, 0),
(30, NULL, 'Zelfvertrouwen vergroten', 'f007', 'Hoofdleerdoel', NULL, 0),
(31, NULL, 'Oriënteren op de arbeidsmarkt', 'f0b1', 'Hoofdleerdoel', NULL, 0),
(32, NULL, 'ICT kennis vergroten', 'f108', 'Hoofdleerdoel', NULL, 0),
(33, NULL, 'Richting ICT op basis van vaardigheden en interesses', 'f5fc', 'Hoofdleerdoel', NULL, 0),
(34, NULL, 'Bar werkzaamheden', 'f5ce', 'Hoofdleerdoel', NULL, 0),
(35, NULL, 'Bediening werkzaamheden', 'f5ce', 'Hoofdleerdoel', NULL, 0),
(36, NULL, 'Keuken werkzaamheden', 'f562', 'Hoofdleerdoel', NULL, 0),
(37, 24, 'Afspraken nakomen', 'f0b1', 'Subleerdoel', 'Met afspraken nakomen bedoelen we dat je optijd komt op werk, de huisregels, persoonlijke verzorging en afmelden indien je ziek bent.', 1),
(38, 24, 'Samenwerken & collegialiteit', 'f0b1', 'Subleerdoel', 'Je kunt goed samenwerken met je collega\'s aan projecten. Verder ben je open en eerlijk tegen je collega\'s en is er een goede werksfeer op de werkvloer.', 1),
(39, 24, 'Gevoel voor arbeidsverhoudingen', 'f0b1', 'Subleerdoel', 'Werken is niet alleen maar leuk maar ook echt werken. Je moet het balans vinden tussen de gezelligheid met je collega\'s en werken.', 1),
(40, 26, 'Tijdig afmelden bij ziekte.', 'f0a1', 'Subleerdoel', 'Het kan voorkomen dat je ziek bent. Meld dit optijd aan de leidinggevende.', 1),
(41, 26, 'Tijdig op de juiste manier vrij vragen.', 'f0a1', 'Subleerdoel', 'Iedereen wil een keer vrij zijn voor bepaalde activiteiten. Als je een keer vrij wilt zijn moet je dit op de juiste manier doen.', 1),
(42, 26, 'Hulp vragen', 'f0a1', 'Subleerdoel', 'Als je ergens mee zit of ergens niet uit komt vraag dan om hulp bij je leidinggevende of een van je collega\'s.', 1),
(43, 26, 'Gesprekken voeren met werkbegeleiders', 'f0a1', 'Subleerdoel', 'Er zullen gesprekken gevoerd worden met de werkbegeleiders. Zorg ervoor dat deze gesprekken plaats vinden.', 1),
(44, 26, 'Gesprekken voeren met collega’s', 'f0a1', 'Subleerdoel', 'Een goede werksfeer kan beginnen met gesprekken met collega\'s.', 1),
(45, 26, 'Contact leggen met klanten', 'f0a1', 'Subleerdoel', 'Het is erg belangrijk dat je contact hebt met klanten. Dit kan bijvoorbeeld via de mail of telefonisch (1 op 1).', 1),
(46, 30, 'Taken toevoegen', 'f007', 'Subleerdoel', 'Deze taken heb een opbouw qua niveau en/of een verantwoordelijkheid.', 0),
(47, 30, 'Bewust worden', 'f007', 'Subleerdoel', 'Bewust worden van de dagelijkse taken die goed uitgevoerd worden.', 0),
(48, 31, 'Kwaliteiten en interesses', 'f0b1', 'Subleerdoel', 'Om jezelf goed te oriënteren is het belangrijk dat je weet waar je kwaliteiten en interesses liggen.', 0),
(49, 31, 'Beroepen', 'f0b1', 'Subleerdoel', 'Welke beroepen zijn er nu precies te vinden in jouw interessegebieden?', 0),
(50, 31, 'Banenkansen en mogelijkheden', 'f0b1', 'Subleerdoel', 'Nagaan welke banenkansen en mogelijkheden er zijn.', 0),
(51, 31, 'Randvoorwaarden bij een baan', 'f0b1', 'Subleerdoel', 'Nagaan welke randvoorwaarden belangrijk zijn bij een baan.', 0),
(52, 34, 'Bar aanvullen', 'f5ce', 'Subleerdoel', 'Dranken kunnen opraken, deze moeten ook weer worden aangevuld.', 0),
(53, 34, 'Koude dranken bereiden.', 'f5ce', 'Subleerdoel', 'Je zult bestellingen krijgen met koude dranken. Deze moet je kennen en kunnen maken/pakken.', 0),
(54, 34, 'Diverse koffies bereiden', 'f5ce', 'Subleerdoel', 'Mensen drinken ook diverse koffies, deze moet je allemaal kennen en kunnen bereiden.', 0),
(55, 35, 'Tafels indekken', 'f5ce', 'Subleerdoel', 'In een restaurant worden alle tafels ingedekt volgens een bepaalde manier. Deze manier moet jij ook kunnen.', 0),
(56, 35, 'Gasten ontvangen', 'f5ce', 'Subleerdoel', 'Ontvang gasten op een vriendelijke manier zodat ze zich direct op hun gemak voelen.', 0),
(57, 35, 'Bestelling opnemen', 'f5ce', 'Subleerdoel', 'Je zult gasten moeten opnemen wat ze willen eten en drinken.', 0),
(58, 35, 'Serveren van drankjes', 'f5ce', 'Subleerdoel', 'Als de dranken gemaakt zijn is het aan jouw de taak om ze te brengen naar de gasten', 0),
(59, 35, 'Serveren van lunchgerechten', 'f5ce', 'Subleerdoel', 'Als de gerechten gemaakt zijn door de koks is het aan jouw de taak om deze te brengen naar de juiste tafel.', 0),
(60, 36, 'Lunchgerechten bereiden', 'f562', 'Subleerdoel', 'Als er bonnen zijn is het aan jouw de taak om de juiste lunchgerechten zoals sandwiches en salades te bereiden.', 0),
(61, 36, 'Snijtechnieken', 'f562', 'Subleerdoel', 'Er zijn verschillende manieren om te snijden. Leer deze verschillende technieken.', 0),
(62, 36, 'HACCP', 'f562', 'Subleerdoel', 'Kennis vergroten over HACCP (hygiëne richtlijnen).', 0),
(63, 36, 'Bereiden van soepen en sauzen', 'f562', 'Subleerdoel', 'Je bent in staat om verschillende soepen en sauzen te bereiden.', 0),
(64, 36, 'Het bereiden van aardappelgerechten', 'f562', 'Subleerdoel', 'Je weet welke aardappelgerechten er zijn en je kunt deze ook bereiden op de juiste manier.', 0),
(65, 36, 'Het bereiden van vis- en vlees gerechten', 'f562', 'Subleerdoel', 'Op de kaart staan verschillende vis- en vlees gerechten. Je kunt deze gerechten bereiden voor de gasten.', 0),
(66, 36, 'Het bereiden van desserts', 'f562', 'Subleerdoel', 'Gasten sluiten meestal of met een dessert. Deze desserts kun jij bereiden.', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_activationcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_endgoal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_mentor` int(11) DEFAULT NULL,
  `user_activated` int(11) NOT NULL,
  `user_feedback` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `user_role`, `user_activationcode`, `user_endgoal`, `user_mentor`, `user_activated`, `user_feedback`) VALUES
(49, 'Silvia', '$2y$10$aY0.TS1SP3.CASf8Q4ktL.Sx6R0cEc9PSjJNvFIaHAoqIsr/Z7gKW', NULL, '2019-04-26 07:25:51', '2019-04-26 07:27:06', 'mentor', '9bajLM65', NULL, NULL, 1, NULL),
(50, 'Neeltje', '$2y$10$gzczTj..mWjPEDIqNiD7Fu0UYbsb36gsUKZDYEynq./9UuYJ.K8wW', NULL, '2019-04-26 07:26:16', '2019-04-26 07:28:13', 'mentor', 'iyWcmNDi', NULL, NULL, 1, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `achievements_users`
--
ALTER TABLE `achievements_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexen voor tabel `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`icon_id`);

--
-- Indexen voor tabel `learning_goals`
--
ALTER TABLE `learning_goals`
  ADD PRIMARY KEY (`learning_id`);

--
-- Indexen voor tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexen voor tabel `template_goals`
--
ALTER TABLE `template_goals`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `achievements_users`
--
ALTER TABLE `achievements_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `icons`
--
ALTER TABLE `icons`
  MODIFY `icon_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT voor een tabel `learning_goals`
--
ALTER TABLE `learning_goals`
  MODIFY `learning_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT voor een tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `template_goals`
--
ALTER TABLE `template_goals`
  MODIFY `template_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
