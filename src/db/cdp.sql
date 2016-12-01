-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 01 Décembre 2016 à 19:39
-- Version du serveur :  5.5.50-0+deb8u1
-- Version de PHP :  5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `membreprojet`
--

CREATE TABLE IF NOT EXISTS `membreprojet` (
`id` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idDeveloppeur` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membreprojet`
--

INSERT INTO `membreprojet` (`id`, `idProjet`, `idDeveloppeur`) VALUES
(3, 3, 1),
(13, 2, 3),
(14, 1, 3),
(15, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
`id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `dateFin` date NOT NULL,
  `urlGitDev` text CHARACTER SET utf8 NOT NULL,
  `urlGitDemo` text CHARACTER SET utf8 NOT NULL,
  `estPublic` tinyint(1) NOT NULL,
  `idProprietaire` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`nom`, `id`, `description`, `dateFin`, `urlGitDev`, `urlGitDemo`, `estPublic`, `idProprietaire`) VALUES
('Projet test', 1, 'Projet test', '2016-12-02', 'http://cdp.antoinegamelin.fr/', 'http://cdp.antoinegamelin.fr/', 0, 1),
('DEMO', 2, 'LA DESCRIPTION', '2016-12-10', 'http://cdp.antoinegamelin.fr/Project/create', 'http://cdp.antoinegamelin.fr/Project/create', 1, 2),
('Scrum ', 3, 'Méthode agile', '2016-12-09', 'fake@github.com', 'fake@github.com', 1, 3),
('projet 1', 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-02-09', 'http://dev.com', 'http://demo.com', 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `sprint`
--

CREATE TABLE IF NOT EXISTS `sprint` (
`id` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sprint`
--

INSERT INTO `sprint` (`id`, `dateDebut`, `dateFin`, `idProjet`) VALUES
(5, '2016-11-16', '2016-12-17', 1),
(6, '2016-11-21', '2016-11-28', 2),
(7, '2016-11-29', '2016-12-02', 2),
(8, '2016-12-01', '2016-12-02', 1),
(9, '2016-12-14', '2016-12-28', 7),
(10, '2016-12-29', '2017-01-11', 7);

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
`id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `etat` set('enCours','nonFait','test','fait') NOT NULL,
  `idUserStory` int(11) DEFAULT NULL,
  `idDeveloppeur` int(11) NOT NULL,
  `idSprint` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`id`, `nom`, `etat`, `idUserStory`, `idDeveloppeur`, `idSprint`) VALUES
(11, 'TÃ¢che 1', 'nonFait', 1, 3, 5),
(12, 'BDD', 'nonFait', NULL, 1, 5),
(13, 'Controller', 'nonFait', NULL, 3, 5),
(14, 'Structure', 'nonFait', NULL, 1, 5),
(15, 'Tache1', 'fait', NULL, 2, 6),
(16, 'test 2', 'nonFait', NULL, 1, 5),
(17, 'test', 'fait', 7, 1, 5),
(18, 'task1', 'fait', 10, 1, 8),
(19, 'drg', 'nonFait', NULL, 1, 8),
(20, 'tache 1', 'fait', 11, 4, 9),
(21, 'tache 3', 'fait', 11, 4, 9),
(22, 'tache 2', 'fait', 11, 4, 9),
(24, 'tache 5', 'nonFait', 14, 4, 9),
(25, 'tache 6', 'nonFait', 14, 4, 9),
(26, 'tache 7', 'nonFait', 14, 4, 9),
(27, 'tache 4', 'nonFait', 14, 4, 9),
(28, 'tache 8', 'nonFait', 15, 4, 9),
(29, 'tache 9', 'nonFait', 15, 4, 9),
(30, 'tache 1', 'fait', 12, 4, 10),
(31, 'tache 3', 'nonFait', 13, 4, 10),
(32, 'tache 2', 'nonFait', 13, 4, 10);

-- --------------------------------------------------------

--
-- Structure de la table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
`id` int(11) NOT NULL,
  `lien` varchar(255) NOT NULL,
  `upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idProjet` int(11) NOT NULL,
  `idUS` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userstory`
--

CREATE TABLE IF NOT EXISTS `userstory` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `chiffrage` int(11) NOT NULL,
  `priorite` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL,
  `numCommit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `userstory`
--

INSERT INTO `userstory` (`id`, `nom`, `description`, `etat`, `chiffrage`, `priorite`, `idProjet`, `idSprint`, `numCommit`) VALUES
(1, 'US1', 'En tant que ...', 1, 1, 1, 1, 5, 'jjjjjjjjj'),
(2, 'US2', 'En tant que ...', 0, 10, 12, 3, NULL, '0'),
(6, 'US2', ' En temps que ... je souhaite ... afin de ...', 1, 4, 5, 1, 5, NULL),
(7, 'us3', ' En temps que ... je souhaite ... afin de ...', 2, 8, 2, 1, 5, NULL),
(8, 'US 1', ' En temps que ... je souhaite ... afin de ...', 0, 11, 1, 2, NULL, '0'),
(10, 'us4', ' En temps que Ã©tudiant je souhaite dÃ©crocher un stage afin de rÃ©ussir mon annÃ©e', 2, 5, 5, 1, 8, NULL),
(11, 'US#1', ' En temps que ... je souhaite ... afin de ...', 2, 5, 1, 7, 9, NULL),
(12, 'US#2', ' En temps que ... je souhaite ... afin de ...', 2, 1, 3, 7, 10, NULL),
(13, 'US#3', ' En temps que ... je souhaite ... afin de ...', 1, 4, 1, 7, 10, NULL),
(14, 'US#4', ' En temps que ... je souhaite ... afin de ...', 1, 3, 2, 7, 9, NULL),
(15, 'US#5', ' En temps que ... je souhaite ... afin de ...', 1, 4, 2, 7, 9, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
`id` int(11) NOT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `motDePasse` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `nom`, `prenom`, `email`, `motDePasse`) VALUES
(1, 'antoine', 'Gamelin', 'antoine', 'antoine.gamelin@etu.u-bordeaux.fr', '9359a4d812173b65a3a0094cd86363e79731a3c2'),
(2, 'DEMO', 'DEMO', 'DEMO', 'demo@demo.fr', '89e495e7941cf9e40e6980d14a16bf023ccd4c91'),
(3, 'lolo', 'Lecoq', 'fabrice', 'fab@hotmail.fr', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d'),
(4, 'aboschet', 'Boschet', 'Anthony', 'anto.bosch@hotmail.fr', '6e1a438cfe5a6c9e2165665f8c2258849ccc43f0');

-- --------------------------------------------------------

--
-- Structure de la table `velocite`
--

CREATE TABLE IF NOT EXISTS `velocite` (
`id` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL,
  `effortAttendu` int(11) NOT NULL,
  `effortFait` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `velocite`
--

INSERT INTO `velocite` (`id`, `idProjet`, `idSprint`, `effortAttendu`, `effortFait`) VALUES
(9, 1, NULL, 18, 0),
(10, 2, NULL, 11, 0),
(11, 3, NULL, 10, 0),
(12, 1, 5, 13, 8),
(13, 1, 8, 10, 5),
(14, 7, NULL, 17, 0),
(15, 7, 9, 12, 5),
(16, 7, 10, 5, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`), ADD KEY `idDeveloppeur` (`idDeveloppeur`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
 ADD PRIMARY KEY (`id`), ADD KEY `proprietaire` (`idProprietaire`);

--
-- Index pour la table `sprint`
--
ALTER TABLE `sprint`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
 ADD PRIMARY KEY (`id`), ADD KEY `idUserStory` (`idUserStory`), ADD KEY `idDeveloppeur` (`idDeveloppeur`), ADD KEY `idSprint` (`idSprint`);

--
-- Index pour la table `tests`
--
ALTER TABLE `tests`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`), ADD KEY `idUS` (`idUS`);

--
-- Index pour la table `userstory`
--
ALTER TABLE `userstory`
 ADD PRIMARY KEY (`id`), ADD KEY `idProjet` (`idProjet`), ADD KEY `idSprint` (`idSprint`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `velocite`
--
ALTER TABLE `velocite`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `sprint`
--
ALTER TABLE `sprint`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `tests`
--
ALTER TABLE `tests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `userstory`
--
ALTER TABLE `userstory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `velocite`
--
ALTER TABLE `velocite`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
ADD CONSTRAINT `membreprojet_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`),
ADD CONSTRAINT `membreprojet_ibfk_2` FOREIGN KEY (`idDeveloppeur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`idProprietaire`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `sprint`
--
ALTER TABLE `sprint`
ADD CONSTRAINT `sprint_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
ADD CONSTRAINT `tache_ibfk_3` FOREIGN KEY (`idSprint`) REFERENCES `sprint` (`id`),
ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`idDeveloppeur`) REFERENCES `utilisateur` (`id`),
ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`idUserStory`) REFERENCES `userstory` (`id`);

--
-- Contraintes pour la table `tests`
--
ALTER TABLE `tests`
ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`idUS`) REFERENCES `userstory` (`id`),
ADD CONSTRAINT `fk_tests_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `userstory`
--
ALTER TABLE `userstory`
ADD CONSTRAINT `userstory_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`),
ADD CONSTRAINT `userstory_ibfk_2` FOREIGN KEY (`idSprint`) REFERENCES `sprint` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
