-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 20 Mai 2013 à 01:53
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `TDFNS`
--

-- --------------------------------------------------------

--
-- Structure de la table `donnees_administration`
--

CREATE TABLE `donnees_administration` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `donnees_administration`
--

INSERT INTO `donnees_administration` VALUES(1, 'paragraphe_bienvenue', 'Test	<h2>Présentation</h2>\r\n	\r\n	<p style="text-indent:40px;">\r\n		Enfants du mékong est un ...\r\n	</p>\r\n	\r\n	<p style="text-indent:40px;">\r\n		Suite à une <a href="http://defidumekong24hvelo.alvarum.net" target="_blank">épopée de 24h entre Lyon et Marseille</a>, nos 5 gaillards ont voulu rendre cet évènement national, et faire participer toutes les écoles à un tour de France complet.\r\n	</p>\r\n	<p style="text-indent:40px;"> \r\n		N''importe quel étudiant peut participer à ce gigantesque relais.\r\n	</p>\r\n	<p style="text-indent:40px;"> \r\n		Ce sont 4000km que ces braves étudiants vont parcourir en quelque jours, sous forme d''un relais : 200 heures de velo ! Il suffira que 4 étudiants de l''étape précédente arrivent pour valider le tronçon. \r\n	</p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `organisation`
--

INSERT INTO `organisation` VALUES(1, 2);
INSERT INTO `organisation` VALUES(1, 3);
INSERT INTO `organisation` VALUES(1, 4);
INSERT INTO `organisation` VALUES(1, 5);
INSERT INTO `organisation` VALUES(1, 6);
INSERT INTO `organisation` VALUES(5, 1);
INSERT INTO `organisation` VALUES(9, 12);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_etape` int(11) NOT NULL,
  `emplacement` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `photos`
--


-- --------------------------------------------------------

--
-- Structure de la table `troncon`
--

CREATE TABLE `troncon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `ville_depart` varchar(100) NOT NULL,
  `ville_arrivee` varchar(100) NOT NULL,
  `distance` int(11) NOT NULL,
  `temps_route` text NOT NULL,
  `denivele` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `troncon`
--

INSERT INTO `troncon` VALUES(1, '2013-10-25 08:00:00', '2013-10-26 08:00:00', 'Lyon', 'Marseille', 434, '22 heures et 35 minutes', 1048);
INSERT INTO `troncon` VALUES(2, '2013-10-26 08:00:00', '2013-10-27 08:00:00', 'Marseille', 'Toulouse', 484, '23 heures et 15 minutes', 1329);
INSERT INTO `troncon` VALUES(3, '2013-10-27 08:00:00', '2013-10-28 08:00:00', 'Toulouse', 'Bordeaux', 532, '25 heures et 10 minutes', 841);
INSERT INTO `troncon` VALUES(4, '2013-10-28 08:00:00', '2013-10-29 08:00:00', 'Bordeaux', 'Nantes', 395, '22 heures et 50 minutes', 450);
INSERT INTO `troncon` VALUES(5, '2013-10-29 08:00:00', '2013-10-30 08:00:00', 'Nantes', 'Brest', 412, '23 heures et 30 minutes', 320);
INSERT INTO `troncon` VALUES(6, '2013-10-30 08:00:00', '2013-10-31 08:00:00', 'Brest', 'Caen', 493, '27 heures et 45 minutes', 570);
INSERT INTO `troncon` VALUES(7, '2013-10-31 08:00:00', '2013-11-01 08:00:00', 'Caen', 'Lille', 409, '24 heures et 5 minutes', 800);
INSERT INTO `troncon` VALUES(8, '2013-11-01 08:00:00', '2013-11-02 08:00:00', 'Lille', 'Metz', 385, '22 heures et 25 minutes', 605);
INSERT INTO `troncon` VALUES(9, '2013-11-02 08:00:00', '2013-11-03 08:00:00', 'Metz', 'Besançon', 410, '22 heures et 55 minutes', 1539);
INSERT INTO `troncon` VALUES(10, '2013-11-03 08:00:00', '2013-11-04 08:00:00', 'Besançon', 'Lyon', 295, '19 heures et 5 minutes', 1960);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse1` int(4) NOT NULL,
  `adresse2` varchar(100) NOT NULL,
  `adresse3` int(5) NOT NULL,
  `adresse4` varchar(100) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `ecole` text NOT NULL,
  `avatar` text NOT NULL,
  `page_collecte` varchar(255) NOT NULL,
  `equipe` varchar(255) NOT NULL DEFAULT 'aucune',
  `page_equipe` varchar(255) NOT NULL,
  `rang` int(1) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` VALUES(1, 'Pierre-Arnaud', 'Destremau', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1991-09-02', 'p.a.destremau@gmail.com', 31, 'rue Saussure', 75017, 'Paris', '0667319365', 'Ecole Centrale Nantes', 'img/profils/1.png', '', 'aucune', '', 1);
INSERT INTO `users` VALUES(2, 'Augustin', 'Destremau', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1993-05-06', 'augustin.destremau@gmail.com', 0, '', 0, '', '0612121212', 'Ecole EM Lyon', 'img/profils/2.png', '', 'aucune', '', 1);
INSERT INTO `users` VALUES(3, 'Geoffroy', 'Delort Laval', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1993-01-01', 'geoffroy.d-l@gmail.com', 0, '', 0, '', '0612121212', 'Ecole EM Lyon', 'img/profils/3.png', '', 'aucune', '', 1);
INSERT INTO `users` VALUES(4, 'Joseph', 'de Chateauvieux', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1992-03-03', 'joseph2c@gmail.com', 0, '', 0, '', '0612121212', 'Ecole EM Lyon', 'img/profils/4.png', '', 'aucune', '', 1);
INSERT INTO `users` VALUES(5, 'Thibault', 'Arbonel', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1993-01-01', 'thibault.arbonel@gmail.com', 0, '', 0, '', '0612121212', 'Ecole EM Lyon', 'img/profils/5.png', '', 'aucune', '', 1);
INSERT INTO `users` VALUES(6, 'Tanguy', 'Petetin', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1993-01-01', 'tanguy.petetin@gmail.com', 0, '', 0, '', '0612121212', 'Ecole EM Lyon', 'img/profils/6.png', '', 'aucune', '', 1);
INSERT INTO `users` VALUES(7, 'Geoffroy', 'Montalivet', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1994-09-20', 'pierre---arnaud.destremau@eleves.ec-nantes.fr', 0, '', 0, '', '0612121212', 'Ecole qlmfqsdlkfh', '', 'equipe_1', 'equipe_1', 'page_geoffroy', 2);
INSERT INTO `users` VALUES(8, 'Grégoire', 'Carmilet', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1993-04-10', '2@gmail.com', 0, '', 0, '', '0667319365', 'Ecole qdsf', '', 'equipe_1', 'equipe_1', 'page_grégoire', 3);
INSERT INTO `users` VALUES(9, 'Thomas', 'Pasquet', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1992-11-26', '4@gmail.com', 0, '', 0, '', '0612121212', 'Ecole qsdf', '', 'equipe_2', 'equipe_2', 'page_thomas', 2);
INSERT INTO `users` VALUES(10, 'Laurent', 'de Ruquet', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1994-12-05', '5@gmail.com', 0, '', 0, '', '0612121212', 'Ecqdlfuhk', '', 'equipe_2', 'equipe_2', 'page_laurent', 3);
INSERT INTO `users` VALUES(11, 'Edouard', 'de Malsherbe', 'bb8062e9d794e1f1288680e4039299cab78c737d', '1993-02-02', '3@gmail.com', 0, '', 0, '', '0612121212', 'Ecqldskjfh', '', 'equipe_1', 'equipe_1', 'page_edouard', 3);
INSERT INTO `users` VALUES(12, 'toto', 'zo', 'bb8062e9d794e1f1288680e4039299cab78c737d', '0000-00-00', 'toto@gmail.com', 0, '', 0, '', '0612121212', 'Ecole qlksfhqlksjhf', '', 'http://defidumekong-tourdefrance-nonstop.alvarum.net/pierre-arnauddestremau', 'coucoucestmoi', 'http://defidumekong-tourdefrance-nonstop.alvarum.net/pierre-arnauddestremau', 2);
