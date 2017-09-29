-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 02:15 AM
-- Server version: 5.5.55
-- PHP Version: 5.4.45-0+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `WebDiP2016x012`
--

-- --------------------------------------------------------

--
-- Table structure for table `akcija`
--

CREATE TABLE IF NOT EXISTS `akcija` (
  `id_akcija` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_akcije` varchar(45) DEFAULT NULL,
  `opis_akcije` varchar(200) DEFAULT NULL,
  `broj_bodova` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_akcija`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `akcija`
--

INSERT INTO `akcija` (`id_akcija`, `naziv_akcije`, `opis_akcije`, `broj_bodova`) VALUES
(1, 'Registriraj se!', 'Korisnik se treba registrirati i aktivirati svoj account', 20),
(2, 'Ulogiraj se!', 'Korisnik se treba ulogirati', 10),
(3, 'Pogledaj usluge!', 'Korisnik treba pregledati sve usluge koje su ponudene', 20),
(4, 'Rezerviraj se!', 'Korisnik se treba rezervirati za odre?enu uslugu', 50),
(5, 'Pogledaj video kupona!', 'Korisnik treba pogledati video nekog kupona', 20),
(6, 'Pro?itaj pdf', 'Korisnik treba pro?itati pdf nekog kupona', 30),
(7, 'kupnja kupona', 'Korisnik treba kupiti neki kupon', 25),
(8, 'Dodavanje u kosaricu', 'Korisnik treba dodati kupon u kosaricu', 15);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik_rada`
--

CREATE TABLE IF NOT EXISTS `dnevnik_rada` (
  `id_dnevnik` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime NOT NULL,
  `opis` text NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  PRIMARY KEY (`id_dnevnik`),
  KEY `korisnik_id` (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `dnevnik_rada`
--

INSERT INTO `dnevnik_rada` (`id_dnevnik`, `datum`, `opis`, `korisnik_id`) VALUES
(1, '2017-06-12 02:06:56', 'Login', 62),
(2, '2017-06-12 02:43:55', 'Korisnik je dodao u košaricu', 50),
(3, '2017-06-12 02:43:58', 'Korisnik je odabrao kupon', 50),
(4, '2017-06-12 02:53:30', 'Administrator je otklju?ao korisnika', 3),
(5, '2017-06-12 02:53:32', 'Administrator je zaklju?ao korisnika', 3),
(6, '2017-06-12 01:52:33', 'Administrator je zaklju?ao korisnika', 3),
(7, '2017-06-12 01:52:34', 'Administrator je otklju?ao korisnika', 3),
(8, '2017-06-12 01:52:39', 'Administrator je zaklju?ao korisnika', 3),
(9, '2017-06-12 01:52:40', 'Administrator je otklju?ao korisnika', 3),
(10, '2017-06-12 02:03:25', 'Administrator je otklju?ao korisnika', 3),
(11, '2017-06-12 02:03:26', 'Administrator je zaklju?ao korisnika', 3),
(12, '2017-06-12 02:03:29', 'Administrator je zaklju?ao korisnika', 3),
(13, '2017-06-12 02:03:29', 'Administrator je otklju?ao korisnika', 3),
(14, '2017-06-12 02:15:39', 'Administrator je zaklju?ao korisnika', 3),
(15, '2017-06-12 02:15:40', 'Administrator je otklju?ao korisnika', 3),
(16, '2017-06-12 06:45:35', 'Login', 62),
(17, '2017-06-12 09:17:16', 'Administrator je zaklju?ao korisnika', 3),
(18, '2017-06-12 09:17:17', 'Administrator je otklju?ao korisnika', 3),
(19, '2017-06-13 02:19:27', 'Login', 62),
(20, '2017-06-13 02:20:22', 'Login', 62),
(21, '2017-06-13 02:20:57', 'Login', 62),
(22, '2017-06-13 11:49:02', 'Korisnik je blokiran', 63),
(23, '2017-06-13 12:13:36', 'Login', 65),
(24, '2017-06-13 12:27:52', 'Login', 65),
(25, '2017-06-13 12:35:58', 'Login', 3),
(26, '2017-06-13 12:41:39', 'Login', 3),
(27, '2017-06-13 01:00:28', 'Login', 62),
(28, '2017-06-13 01:02:05', 'Login', 62),
(29, '2017-06-13 01:02:55', 'Login', 62),
(30, '2017-06-13 01:03:58', 'Login', 62),
(31, '2017-06-13 01:05:49', 'Login', 62),
(32, '2017-06-13 01:06:59', 'Login', 62),
(33, '2017-06-13 01:08:22', 'Login', 62),
(34, '2017-06-13 01:10:18', 'Login', 62),
(35, '2017-06-13 01:11:44', 'Login', 62),
(36, '2017-06-13 01:16:40', 'Korisnik je dodao u košaricu', 62),
(37, '2017-06-13 01:17:10', 'Korisnik je dodao u košaricu', 62),
(38, '2017-06-13 01:17:13', 'Korisnik je dodao u košaricu', 62),
(39, '2017-06-13 01:17:15', 'Korisnik je dodao u košaricu', 62),
(40, '2017-06-13 01:17:16', 'Korisnik je dodao u košaricu', 62),
(41, '2017-06-13 01:18:09', 'Korisnik je dodao u košaricu', 62),
(42, '2017-06-13 01:20:01', 'Korisnik je dodao u košaricu', 62),
(43, '2017-06-13 01:20:05', 'Korisnik je dodao u košaricu', 62),
(44, '2017-06-13 01:22:12', 'Korisnik je dodao u košaricu', 62),
(45, '2017-06-13 01:22:21', 'Korisnik je odabrao kupon', 62),
(46, '2017-06-13 01:22:46', 'Korisnik je dodao u košaricu', 62),
(47, '2017-06-13 01:22:57', 'Korisnik je dodao u košaricu', 62),
(48, '2017-06-13 01:23:00', 'Korisnik je odabrao kupon', 62),
(49, '2017-06-13 01:39:13', 'Korisnik je dodao u košaricu', 62),
(50, '2017-06-13 01:56:41', 'Administrator je otklju?ao korisnika', 3),
(51, '2017-06-13 01:56:42', 'Administrator je zaklju?ao korisnika', 3),
(52, '2017-06-13 02:51:08', 'Login', 3),
(53, '2017-06-13 03:14:36', 'Login', 55),
(54, '2017-06-13 03:32:47', 'Login', 3),
(55, '2017-06-13 04:23:52', 'Login', 57),
(56, '2017-06-13 05:42:15', 'Login', 62),
(57, '2017-06-13 05:42:25', 'Korisnik je dodao u košaricu', 62),
(58, '2017-06-13 05:42:35', 'Korisnik je odabrao kupon', 62),
(59, '2017-06-13 05:44:18', 'Korisnik je dodao u košaricu', 62),
(60, '2017-06-13 05:44:21', 'Korisnik je dodao u košaricu', 62),
(61, '2017-06-13 05:45:10', 'Korisnik je odabrao kupon', 62),
(62, '2017-06-13 05:45:10', 'Korisnik je odabrao kupon', 62),
(63, '2017-06-13 05:45:54', 'Korisnik je dodao u košaricu', 62),
(64, '2017-06-13 05:46:02', 'Korisnik je odabrao kupon', 62),
(65, '2017-06-13 05:48:04', 'Korisnik je dodao u košaricu', 62),
(66, '2017-06-13 05:48:09', 'Korisnik je dodao u košaricu', 62),
(67, '2017-06-13 05:48:14', 'Korisnik je odabrao kupon', 62),
(68, '2017-06-13 05:48:14', 'Korisnik je odabrao kupon', 62),
(69, '2017-06-13 05:51:13', 'Korisnik je dodao u košaricu', 62),
(70, '2017-06-13 05:51:16', 'Korisnik je odabrao kupon', 62),
(71, '2017-06-13 05:53:52', 'Korisnik je dodao u košaricu', 62),
(72, '2017-06-13 05:53:59', 'Korisnik je odabrao kupon', 62),
(73, '2017-06-13 05:57:33', 'Login', 3),
(74, '2017-06-13 06:16:44', 'Korisnik je dodao u košaricu', 3),
(75, '2017-06-13 06:16:56', 'Korisnik je odabrao kupon', 3),
(76, '2017-06-13 08:17:16', 'Login', 3),
(77, '2017-06-13 08:17:21', 'Korisnik je dodao u košaricu', 3),
(78, '2017-06-13 08:17:26', 'Korisnik je dodao u košaricu', 3),
(79, '2017-06-13 08:17:28', 'Korisnik je odabrao kupon', 3),
(80, '2017-06-13 10:40:38', 'Login', 69),
(81, '2017-06-13 10:41:25', 'Korisnik je dodao u košaricu', 69),
(82, '2017-06-13 10:41:28', 'Korisnik je dodao u košaricu', 69),
(83, '2017-06-13 10:41:42', 'Korisnik je dodao u košaricu', 69),
(84, '2017-06-13 10:42:31', 'Korisnik je odabrao kupon', 69),
(85, '2017-06-13 10:42:31', 'Korisnik je odabrao kupon', 69),
(86, '2017-06-13 10:42:31', 'Korisnik je odabrao kupon', 69),
(87, '2017-06-13 10:43:11', 'Korisnik je dodao u košaricu', 69),
(88, '2017-06-13 10:43:13', 'Korisnik je dodao u košaricu', 69),
(89, '2017-06-13 10:43:15', 'Korisnik je odabrao kupon', 69),
(90, '2017-06-13 10:43:15', 'Korisnik je odabrao kupon', 69),
(91, '2017-06-13 10:43:30', 'Login', 3),
(92, '2017-06-13 10:45:52', 'Login', 3),
(93, '2017-06-13 11:40:39', 'Login', 62),
(94, '2017-06-13 11:42:31', 'Login', 62),
(95, '2017-06-13 11:47:16', 'Login', 62);

-- --------------------------------------------------------

--
-- Table structure for table `izgled_stranice`
--

CREATE TABLE IF NOT EXISTS `izgled_stranice` (
  `id_izgled_stranice` int(11) NOT NULL AUTO_INCREMENT,
  `boja` varchar(45) DEFAULT NULL,
  `font` varchar(45) DEFAULT NULL,
  `naslov` varchar(45) DEFAULT NULL,
  `kategorije_usluga_id_kategorije_usluga` int(11) NOT NULL,
  PRIMARY KEY (`id_izgled_stranice`),
  KEY `fk_izgled_stranice_kategorije_usluga1_idx` (`kategorije_usluga_id_kategorije_usluga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kategorije_usluga`
--

CREATE TABLE IF NOT EXISTS `kategorije_usluga` (
  `id_kategorije_usluga` int(10) NOT NULL AUTO_INCREMENT,
  `naziv_vrste_usluge` varchar(45) DEFAULT NULL,
  `Korsinik_id_korsinik` int(10) NOT NULL,
  PRIMARY KEY (`id_kategorije_usluga`),
  KEY `fk_vrsta_usluge_Korsinik1_idx` (`Korsinik_id_korsinik`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `kategorije_usluga`
--

INSERT INTO `kategorije_usluga` (`id_kategorije_usluga`, `naziv_vrste_usluge`, `Korsinik_id_korsinik`) VALUES
(1, 'Frizer', 55),
(2, 'Masaza', 56),
(3, 'Sauna', 57),
(4, 'Sminkanje', 57),
(5, 'Depilacija', 56),
(6, 'Savjeti za sminkanje', 56),
(7, 'Dekorator', 56);

-- --------------------------------------------------------

--
-- Table structure for table `kod_za_kupon`
--

CREATE TABLE IF NOT EXISTS `kod_za_kupon` (
  `id_kod` int(11) NOT NULL AUTO_INCREMENT,
  `generirani_kod` varchar(25) NOT NULL,
  `kupon_id` int(11) NOT NULL,
  PRIMARY KEY (`id_kod`),
  KEY `kupon_id` (`kupon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `kod_za_kupon`
--

INSERT INTO `kod_za_kupon` (`id_kod`, `generirani_kod`, `kupon_id`) VALUES
(1, 'z2EMqxDu5gYPCaf4NXH9', 2),
(2, 'VIuI0maswohp5dlyQR9l', 4),
(3, 'LzzVR9MKp61lPv3PReho', 6),
(4, 'NU3KKKpyDY8er9xGjfze', 2),
(5, '8qgfLScZkLJ6jtIKEFzR', 2),
(6, 'tK6XD1kvDLUMcb1X3eXo', 4),
(7, 'yvQjKnmXcnebEPCGr9Fd', 2),
(8, 'n6879WTTGn2yALtizSs1', 6),
(9, 'sgxHOHOWIWGpz8UTFmKv', 6),
(10, 'yvX5HGqNUSlScXaC8t2k', 2),
(11, '6PsBrmXe8rGHwuqObd8Y', 2),
(12, 'RRy7dyWyHQzOF1p7onlw', 4),
(13, 'O2dkwE8IRgGI8fQmOMUw', 6),
(14, 'kYw6y8576AchsxaJ1rpR', 2),
(15, '536PrTAm6j5rhByPKDXR', 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id_korisnik` int(10) NOT NULL AUTO_INCREMENT,
  `lozinka` varchar(45) NOT NULL,
  `krptirana_lozinka` varchar(45) DEFAULT NULL,
  `ime` varchar(45) DEFAULT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `korisnickoime` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `adresa` varchar(45) DEFAULT NULL,
  `kontakt` varchar(45) DEFAULT NULL,
  `tip_korisinika_tip_korisnika_id` int(11) NOT NULL,
  `status_korisnickog_racuna_id_status_korisnickog_racuna` int(11) DEFAULT NULL,
  `dvorazinska_prijava` int(1) DEFAULT NULL,
  `aktivacijski_token` varchar(45) DEFAULT NULL,
  `broj_pogresaka` int(11) DEFAULT NULL,
  `datum_registracije` datetime DEFAULT NULL,
  PRIMARY KEY (`id_korisnik`),
  KEY `fk_Korsinik_tip_korisinika1_idx` (`tip_korisinika_tip_korisnika_id`),
  KEY `fk_Korisnik_status_korisnickog_racuna1_idx` (`status_korisnickog_racuna_id_status_korisnickog_racuna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `lozinka`, `krptirana_lozinka`, `ime`, `prezime`, `korisnickoime`, `email`, `adresa`, `kontakt`, `tip_korisinika_tip_korisnika_id`, `status_korisnickog_racuna_id_status_korisnickog_racuna`, `dvorazinska_prijava`, `aktivacijski_token`, `broj_pogresaka`, `datum_registracije`) VALUES
(3, '12345678', '12345678', 'Josip', 'Bijelic', 'josbijeli', 'josbijeli@foi.hr', 'Vjekoslava Spincica 26', '997659922', 1, 1, 1, '4bc569c6d9d2e3375653205621e36080b0f2d2be', 7, '2017-05-25 13:48:25'),
(50, 'G27bNQao8S', 'e07fa73b5d2a961372a59d74a8bad17279f5477f', 'Mia', 'Simunic', 'msimunic', 'msimunic@foi.hr', 'Vjekoslava Špin?i?a 26', '997457755', 4, 3, 1, '70ccbfdde33dcb70ee8225fd064d49444bc7486a', 10, '2017-06-01 05:52:58'),
(55, 'moderator1', NULL, 'Ivan', 'Petric', 'ivapetric', 'ivapetric@foi.hr', 'Ulica Brijestova 22', '922321133', 2, 1, NULL, NULL, NULL, '2017-06-08 14:45:26'),
(56, 'moderator2', NULL, 'Marko', 'Maric', 'marmar', 'marmar@gmail.com', 'Glavna Ulica 11', '998427744', 2, 1, NULL, NULL, NULL, '2017-06-16 15:44:30'),
(57, 'moderator3', NULL, 'Marina', 'Janjic', 'marjanj', 'marjanj@net.hr', 'Gunduliceva 3', '998579452', 2, 1, NULL, NULL, NULL, '2017-06-14 11:40:17'),
(60, 'lozinka123AA', 'ed29242ba04c3266eba91af08571563f5d66d516', 'Ime', 'Prezime', 'Primjer', 'puko@dnsdeer.com', 'Primjer 22', '997452993', 4, 1, 1, '74bbe5b0996a70186fbea4e1f4bdca3963e876d9', 0, '2017-06-06 05:13:04'),
(61, 'PUKO123aa', 'f9f99140e4bfe24b564dc4fc1590511a7c3d2c0b', 'Petar', 'Kresimir', 'puko123', 'puko@dnsdeer.com', 'Centar Grada 12', '997457755', 4, 1, 1, 'dc6c32e04a175ba9324478176fd5da9884672106', 1, '2017-06-08 08:48:59'),
(62, 'Lozinka123L', '99d4093a98624ef22a55fe0a39cc684ad2a6bcb7', 'Ime', 'Prezime', 'KorisnickoIme', 'sizecem@getapet.net', 'Adresa 123', '994752883', 4, 1, 0, NULL, 7, '2017-06-08 09:01:02'),
(63, 'lozinka123', '3e795a30002ea1949f10b327c8131bb289b25ef8', 'Darko', 'Bumbar', 'darbumb', 'sizecem@getapet.net', 'Nad lipom 35', '997284992', 4, 3, 1, NULL, 0, '2017-06-13 11:46:32'),
(64, 'MarkoPer123', 'e64ebd66f60f7e3c1186939735e9e6d0427b7ce9', 'Marko', 'Peranovic', 'marper', 'cesifap@micsocks.net', 'Ulica 12', '928342211', 4, 1, 1, '89417f0698ad16ab8a09bbfc09556fab0e9fa8ac', 2, '2017-06-13 11:55:05'),
(65, 'IvanBijeli123', '4d0af935d3f4f26b2ee61d3d339cf802866df584', 'Ivan', 'Bijeli?', 'ivanbij', 'wujutanuka@refurhost.com', 'Andrije Hebranga 2c', '998237521', 4, 1, 1, '7a88037d3c2f38130ef08171cdf7ae04c9202359', 0, '2017-06-13 12:10:41'),
(66, 'DuroGluh123', 'bcd833767b0c41691ab421819804837c2591bfd1', 'Duro', 'Gluhakovi?', 'durogluh', 'losuguj@dnsdeer.com', 'Radiceva 9', '992336544', 4, 1, 0, NULL, 0, '2017-06-13 07:34:44'),
(67, 'bodaVK1982', '74df2866e6a9171d4f201ea51e24a53e6cf60479', 'Bogdan', 'Pavic', 'bodavk', 'darusolok@micsocks.net', 'zrnata Ulica 22', '992312342', 4, 2, 0, NULL, 0, '2017-06-13 07:46:08'),
(68, 'aaAA1982', 'feb5ecf09b68d1971bf9aeb1b8b624be87b26993', 'Mario', 'Popovi?', 'marpop', 'huhujebama@ucylu.com', 'Ulica 12', '932383322', 4, 2, 0, NULL, 0, '2017-06-13 07:59:02'),
(69, '123QWEasd', '2707c21cd6e3204c5645724efa79e7f0af1aa29f', 'Bogdan', 'Erdelji', 'bogerdelj', 'bogerdelj@foi.hr', 'Kralja Zvonimira 4', '995100828', 4, 1, 1, '1e9086032e284de35169cd19a5585621983ec996', 0, '2017-06-13 10:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `kosarica`
--

CREATE TABLE IF NOT EXISTS `kosarica` (
  `Korsinik_id_korsinik` int(10) NOT NULL,
  `kupon_id_kupon` int(11) NOT NULL,
  PRIMARY KEY (`Korsinik_id_korsinik`,`kupon_id_kupon`),
  KEY `fk_kosrarica_kupon1_idx` (`kupon_id_kupon`),
  KEY `Korsinik_id_korsinik` (`Korsinik_id_korsinik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kupon`
--

CREATE TABLE IF NOT EXISTS `kupon` (
  `id_kupon` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_kupona` varchar(45) DEFAULT NULL,
  `pdf` blob,
  `video` varchar(45) DEFAULT NULL,
  `slika` blob NOT NULL,
  `datum_aktivacije` datetime DEFAULT NULL,
  `datum_deaktivacije` datetime DEFAULT NULL,
  `potrebni_bodovi` varchar(45) DEFAULT NULL,
  `kategorija_id` int(10) NOT NULL,
  PRIMARY KEY (`id_kupon`),
  KEY `kategorija_id` (`kategorija_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `kupon`
--

INSERT INTO `kupon` (`id_kupon`, `naziv_kupona`, `pdf`, `video`, `slika`, `datum_aktivacije`, `datum_deaktivacije`, `potrebni_bodovi`, `kategorija_id`) VALUES
(1, 'Kupon za masazu', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, '2017-06-05 11:00:00', '2017-06-12 00:00:00', '30', 1),
(2, 'Popust za masazu', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, '2017-06-03 11:00:00', '2017-07-10 11:00:00', '15', 2),
(3, 'Kupon za saunu', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, '2017-05-25 11:00:00', '2017-06-02 11:00:00', '20', 3),
(4, 'Popust za saunu', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, '2017-05-09 11:00:00', '2017-06-16 11:00:00', '10', 4),
(5, 'Kupon za musko sisanje', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, '2017-07-19 11:00:00', '2017-08-22 11:00:00', '30', 1),
(6, 'Kupon za zensko sisanje', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, '2017-06-05 11:00:00', '2017-06-16 11:00:00', '20', 1),
(11, 'Kupon za djecije sisanje', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, '2017-06-14 11:00:00', '2017-06-21 11:00:00', '25', 1),
(12, 'Kupon za cjelokupno sisanje', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, NULL, NULL, NULL, 1),
(13, 'Kupon za saunu', NULL, NULL, 0x89504e470d0a1a0a0000000d49484452000000c8000000c808030000009a865eac0000001b504c5445cccccc000000b2b2b27f7f7f4c4c4c191919666666999999333333a37aef5d000001e34944415478daedd64992e24010445165a472b8ff89bb05b43c31e1c6a23a4cb5f86f55e506e18426d800000000000000000000000000000000000000000000000000e0b78b884fb14b7f6761dd5b39b41e6b1cbd7d498d9b0a472b529577a5dda4c64d85b5aceafb80d634c2a44662a19fbbd7d8b6a88f57c7331d8f371ef163d430a9714be1d0c5770caecb9f3a82d3a4ce6d857aedfe2c5bdf358fe36652e3e6c238dfd79fe75175dda417fbd824f6f4423ff7dcfe129bf4cdbe5ec8d1ca4c2cf4c679a65b294df9f19f49af13b449e80a4f29f4fa79f2b4bc0e8c4bafcfd6a13d7a5ea1a7db295e474ad74b31a9d9447be4147a7a4698b96152b389f6482bf48eea7136f4cb848fa9d9a46a8fa4426fd7fe3f3940fa0dd2b30bfd8dd7e2c773b549cf2efc3e5613744fba54249a9e5d69857eacaaf5dcd303dca46e0f8dcb2ff463b5bc5a4ceaf6d83530a7d0df766dac816af4f030a9688faeef93f44289a9cbf5f2db41e35c2ada43df276985a67ac68747bc3a9a49ed1eda24af50d437e31fa5af735f8f61d5a4760f6d9256285a7a3197bbafb4395bd1e975e9fb227dfdc82d720bbfcfdd76651a605289d637a92db20bbfcfddc67c256313931af7164a8cbf5ceae51402000000000000000000000000000000000000000000000000ffd91fe9a81073eddc38ad0000000049454e44ae426082, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `napravio_akciju`
--

CREATE TABLE IF NOT EXISTS `napravio_akciju` (
  `akcija_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  PRIMARY KEY (`akcija_id`,`korisnik_id`),
  KEY `vk_korisnik_idx` (`korisnik_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `napravio_akciju`
--

INSERT INTO `napravio_akciju` (`akcija_id`, `korisnik_id`) VALUES
(3, 3),
(7, 3),
(8, 3),
(2, 50),
(3, 50),
(5, 50),
(2, 55),
(3, 55),
(2, 57),
(3, 57),
(2, 62),
(3, 62),
(7, 62),
(8, 62),
(3, 69),
(7, 69),
(8, 69);

-- --------------------------------------------------------

--
-- Table structure for table `potroseni_bodovi`
--

CREATE TABLE IF NOT EXISTS `potroseni_bodovi` (
  `Korisnik_id` int(10) NOT NULL,
  `kupon_id` int(11) NOT NULL,
  PRIMARY KEY (`kupon_id`,`Korisnik_id`),
  KEY `fk_potroseni_bodovi_Korisnik1_idx` (`Korisnik_id`),
  KEY `fk_potroseni_bodovi_kupon1_idx` (`kupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `potroseni_bodovi`
--

INSERT INTO `potroseni_bodovi` (`Korisnik_id`, `kupon_id`) VALUES
(3, 2),
(3, 6),
(62, 2),
(62, 4),
(62, 6),
(69, 2),
(69, 4),
(69, 6);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE IF NOT EXISTS `rezervacija` (
  `id_rezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `rezervirani_datum` datetime NOT NULL,
  `usluga_id_usluge` int(11) NOT NULL,
  `Korsinik_id_korsinik` int(10) NOT NULL,
  `stanje_rezervacije_id_stanje_rezervacije` int(11) NOT NULL,
  PRIMARY KEY (`id_rezervacija`),
  KEY `fk_rezervacija_usluga1_idx` (`usluga_id_usluge`),
  KEY `fk_rezervacija_Korsinik1_idx` (`Korsinik_id_korsinik`),
  KEY `fk_rezervacija_stanje_rezervacije1_idx` (`stanje_rezervacije_id_stanje_rezervacije`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 KEY_BLOCK_SIZE=1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stanje_rezervacije`
--

CREATE TABLE IF NOT EXISTS `stanje_rezervacije` (
  `id_stanje_rezervacije` int(11) NOT NULL AUTO_INCREMENT,
  `stanje` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stanje_rezervacije`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `status_korisnickog_racuna`
--

CREATE TABLE IF NOT EXISTS `status_korisnickog_racuna` (
  `id_status_korisnickog_racuna` int(11) NOT NULL AUTO_INCREMENT,
  `status_korisnickog_racuna` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_status_korisnickog_racuna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status_korisnickog_racuna`
--

INSERT INTO `status_korisnickog_racuna` (`id_status_korisnickog_racuna`, `status_korisnickog_racuna`) VALUES
(1, 'Aktivan'),
(2, 'Neaktivan'),
(3, 'Blokiran');

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE IF NOT EXISTS `tip_korisnika` (
  `tip_korisnika_id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `opis_korisnika` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`tip_korisnika_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`tip_korisnika_id`, `naziv`, `opis_korisnika`) VALUES
(1, 'Administrator', 'Sve ovlasti'),
(2, 'Moderator', 'Neke ovlasti'),
(4, 'RegistriraniKorisnik', 'Obican Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `usluga`
--

CREATE TABLE IF NOT EXISTS `usluga` (
  `id_usluge` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_usluga` varchar(45) DEFAULT NULL,
  `opis_usluge` varchar(200) DEFAULT NULL,
  `cijena_usluge` int(11) DEFAULT NULL,
  `broj_prodaje_usluge` int(11) DEFAULT NULL,
  `vrijeme_trajanja` int(11) DEFAULT NULL,
  `vrsta_usluge_id_usluga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usluge`),
  KEY `fk_usluga_vrsta_usluge1_idx` (`vrsta_usluge_id_usluga`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `usluga`
--

INSERT INTO `usluga` (`id_usluge`, `naziv_usluga`, `opis_usluge`, `cijena_usluge`, `broj_prodaje_usluge`, `vrijeme_trajanja`, `vrsta_usluge_id_usluga`) VALUES
(1, 'Muško šišanje', 'Šišanje muškaraca', 25, 0, 15, 1),
(2, 'Žensko šišanje', 'Šišanje žena', 70, 0, 60, 1),
(3, 'Dje?ije šišanje', 'Šišanje djece', 20, 0, 20, 1),
(4, 'Classic masaža', 'Klasik masaža s uljem', 50, 0, 45, 2),
(5, 'Masaža s kamenjem', 'Masaža s vru?im kamenjem i uljem', 60, 0, 45, 2),
(6, 'Double masaža', 'Dvosatna masaža', 80, 0, 120, 2),
(7, 'Javna sauna', 'Sauna u grupi', 30, 0, 50, 3),
(8, 'Privatna sauna', 'Samostalno provodenje vremena u sauni', 60, 0, 50, 3),
(9, 'Šminkanje obrva', 'Uredivanje obrva', 20, 0, 20, 4),
(10, 'Cjelokupno šminkanje', 'šminkanje cijelog lica', 70, 0, 100, 4),
(11, 'Pedikura', 'Pedikura noktiju', 25, NULL, 30, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD CONSTRAINT `dnevnik_rada_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id_korisnik`);

--
-- Constraints for table `izgled_stranice`
--
ALTER TABLE `izgled_stranice`
  ADD CONSTRAINT `fk_izgled_stranice_kategorije_usluga1` FOREIGN KEY (`kategorije_usluga_id_kategorije_usluga`) REFERENCES `kategorije_usluga` (`id_kategorije_usluga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kategorije_usluga`
--
ALTER TABLE `kategorije_usluga`
  ADD CONSTRAINT `fk_vrsta_usluge_Korsinik1` FOREIGN KEY (`Korsinik_id_korsinik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kod_za_kupon`
--
ALTER TABLE `kod_za_kupon`
  ADD CONSTRAINT `kod_za_kupon_ibfk_1` FOREIGN KEY (`kupon_id`) REFERENCES `kupon` (`id_kupon`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_Korisnik_status_korisnickog_racuna1` FOREIGN KEY (`status_korisnickog_racuna_id_status_korisnickog_racuna`) REFERENCES `status_korisnickog_racuna` (`id_status_korisnickog_racuna`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Korsinik_tip_korisinika1` FOREIGN KEY (`tip_korisinika_tip_korisnika_id`) REFERENCES `tip_korisnika` (`tip_korisnika_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kosarica`
--
ALTER TABLE `kosarica`
  ADD CONSTRAINT `fk_kosrarica_Korsinik1` FOREIGN KEY (`Korsinik_id_korsinik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kosrarica_kupon1` FOREIGN KEY (`kupon_id_kupon`) REFERENCES `kupon` (`id_kupon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kupon`
--
ALTER TABLE `kupon`
  ADD CONSTRAINT `kupon_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorije_usluga` (`id_kategorije_usluga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `napravio_akciju`
--
ALTER TABLE `napravio_akciju`
  ADD CONSTRAINT `vk_akcija` FOREIGN KEY (`akcija_id`) REFERENCES `akcija` (`id_akcija`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vk_korisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `potroseni_bodovi`
--
ALTER TABLE `potroseni_bodovi`
  ADD CONSTRAINT `fk_potroseni_bodovi_Korisnik1` FOREIGN KEY (`Korisnik_id`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_potroseni_bodovi_kupon1` FOREIGN KEY (`kupon_id`) REFERENCES `kupon` (`id_kupon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fk_rezervacija_usluga1` FOREIGN KEY (`usluga_id_usluge`) REFERENCES `usluga` (`id_usluge`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_Korsinik1` FOREIGN KEY (`Korsinik_id_korsinik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacija_stanje_rezervacije1` FOREIGN KEY (`stanje_rezervacije_id_stanje_rezervacije`) REFERENCES `stanje_rezervacije` (`id_stanje_rezervacije`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usluga`
--
ALTER TABLE `usluga`
  ADD CONSTRAINT `fk_usluga_vrsta_usluge1` FOREIGN KEY (`vrsta_usluge_id_usluga`) REFERENCES `kategorije_usluga` (`id_kategorije_usluga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
