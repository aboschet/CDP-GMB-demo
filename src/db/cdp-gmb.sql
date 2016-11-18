-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 25 Octobre 2016 à 14:36
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cdp-gmb`
--

-- --------------------------------------------------------

--
-- Structure de la table `membreprojet`
--

CREATE TABLE `membreprojet` (
  `id` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idDeveloppeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `dateFin` date NOT NULL,
  `urlGitDev` text CHARACTER SET utf8 NOT NULL,
  `urlGitDemo` text CHARACTER SET utf8 NOT NULL,
  `estPublic` tinyint(1) NOT NULL,
  `idProprietaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sprint`
--

CREATE TABLE `sprint` (
  `id` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `etat` set('enCours','nonFait','test','fait') NOT NULL,
  `idUserStory` int(11) NOT NULL,
  `idDeveloppeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userstory`
--

CREATE TABLE `userstory` (
  `id` int(11) NOT NULL,
  `nom` text CHARACTER SET utf8 NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `chiffrage` int(11) NOT NULL,
  `priorite` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `motDePasse` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjet` (`idProjet`),
  ADD KEY `idDeveloppeur` (`idDeveloppeur`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proprietaire` (`idProprietaire`);

--
-- Index pour la table `sprint`
--
ALTER TABLE `sprint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjet` (`idProjet`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUserStory` (`idUserStory`),
  ADD KEY `idDeveloppeur` (`idDeveloppeur`);

--
-- Index pour la table `userstory`
--
ALTER TABLE `userstory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjet` (`idProjet`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membreprojet`
--
ALTER TABLE `membreprojet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sprint`
--
ALTER TABLE `sprint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `userstory`
--
ALTER TABLE `userstory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`idDeveloppeur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`idUserStory`) REFERENCES `userstory` (`id`);

--
-- Contraintes pour la table `userstory`
--
ALTER TABLE `userstory`
  ADD CONSTRAINT `userstory_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
