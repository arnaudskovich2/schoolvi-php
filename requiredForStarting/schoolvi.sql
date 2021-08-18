-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 10 août 2021 à 21:47
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP : 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id16581058_schoolvi_data`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `identifier` varchar(100) NOT NULL,
  `code` text NOT NULL,
  `alias` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `annales`
--

CREATE TABLE `annales` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `mat` varchar(500) NOT NULL,
  `serie` varchar(35) NOT NULL,
  `classe` varchar(35) NOT NULL,
  `download` varchar(200) NOT NULL,
  `f_name` varchar(200) NOT NULL,
  `by` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `mat` varchar(500) NOT NULL,
  `serie` varchar(35) NOT NULL,
  `classe` varchar(35) NOT NULL,
  `download` varchar(200) NOT NULL,
  `f_name` varchar(200) NOT NULL,
  `by` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `downloads`
--

CREATE TABLE `downloads` (
  `user_id` varchar(10) NOT NULL,
  `downloads` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `epreuves`
--

CREATE TABLE `epreuves` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `mat` varchar(500) NOT NULL,
  `serie` varchar(35) NOT NULL,
  `classe` varchar(35) NOT NULL,
  `type` varchar(300) NOT NULL DEFAULT 'Inconnu',
  `download` varchar(200) NOT NULL,
  `f_name` varchar(200) NOT NULL,
  `by` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `classe` varchar(6) NOT NULL,
  `serie` varchar(2) NOT NULL,
  `state` text NOT NULL,
  `school` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reset` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifier` (`identifier`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Index pour la table `annales`
--
ALTER TABLE `annales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_name` (`f_name`),
  ADD UNIQUE KEY `download` (`download`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_name` (`f_name`),
  ADD UNIQUE KEY `download` (`download`);

--
-- Index pour la table `downloads`
--
ALTER TABLE `downloads`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Index pour la table `epreuves`
--
ALTER TABLE `epreuves`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_name` (`f_name`),
  ADD UNIQUE KEY `download` (`download`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `annales`
--
ALTER TABLE `annales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `epreuves`
--
ALTER TABLE `epreuves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
