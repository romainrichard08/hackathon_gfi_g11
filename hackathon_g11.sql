-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 26 Avril 2017 à 12:10
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hackathon_g11`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidats`
--

CREATE TABLE `candidats` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `cv` varchar(45) DEFAULT NULL,
  `lettre_motiv` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `score_candidat` varchar(45) DEFAULT NULL,
  `id_offres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `label` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `competences`
--

INSERT INTO `competences` (`id`, `label`) VALUES
(1, 'Javascript'),
(2, 'PHP'),
(3, 'Java'),
(4, 'C#'),
(5, 'NodeJs'),
(6, 'Ruby'),
(7, 'Ruby on Rails'),
(8, 'Symfony'),
(9, 'Zend'),
(10, 'AngularJS'),
(11, 'AngularJS 2'),
(12, 'Bootstrap'),
(13, 'CSS'),
(14, 'HTML 5'),
(15, 'Vue.js'),
(16, 'Express'),
(17, 'C++'),
(18, 'C'),
(19, 'JavaEE'),
(20, 'Meteor.js'),
(21, 'Sass'),
(22, 'Typescript'),
(23, 'ASP.NET'),
(24, 'VB.NET'),
(25, 'Codeigniter'),
(26, 'Objective-C'),
(27, 'Swift'),
(28, 'Go'),
(29, 'React'),
(30, 'RxJs');

-- --------------------------------------------------------

--
-- Structure de la table `competences_offre`
--

CREATE TABLE `competences_offre` (
  `id` int(11) NOT NULL,
  `id_competences` int(11) NOT NULL,
  `id_offres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `metier` varchar(45) DEFAULT NULL,
  `contrat` varchar(45) DEFAULT NULL,
  `departement` varchar(45) DEFAULT NULL,
  `profil` varchar(45) DEFAULT NULL,
  `entite` varchar(45) DEFAULT NULL,
  `experience_min` int(2) DEFAULT NULL,
  `id_test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(45) DEFAULT NULL,
  `reponse` varchar(45) DEFAULT NULL,
  `id_tests` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `score_mini` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `candidats`
--
ALTER TABLE `candidats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_candidat_offre1_idx` (`id_offres`);

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competences_offre`
--
ALTER TABLE `competences_offre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_competence_offre_competence1_idx` (`id_competences`),
  ADD KEY `fk_competence_offre_offre1_idx` (`id_offres`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_offre_test1_idx` (`id_test`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_test1_idx` (`id_tests`);

--
-- Index pour la table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `candidats`
--
ALTER TABLE `candidats`
  ADD CONSTRAINT `fk_candidat_offre1` FOREIGN KEY (`id_offres`) REFERENCES `offres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `competences_offre`
--
ALTER TABLE `competences_offre`
  ADD CONSTRAINT `fk_competence_offre_competence1` FOREIGN KEY (`id_competences`) REFERENCES `competences` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_competence_offre_offre1` FOREIGN KEY (`id_offres`) REFERENCES `offres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `fk_offre_test1` FOREIGN KEY (`id_test`) REFERENCES `tests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_question_test1` FOREIGN KEY (`id_tests`) REFERENCES `tests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
