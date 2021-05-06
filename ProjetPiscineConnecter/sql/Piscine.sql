-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 22 avr. 2021 à 20:19
-- Version du serveur :  10.3.25-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Piscine`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Objet` varchar(255) NOT NULL,
  `Demande` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ValeursCapteurs`
--

CREATE TABLE `ValeursCapteurs` (
  `id` int(11) NOT NULL,
  `pH` float(10,0) NOT NULL COMMENT 'valeurs ph',
  `Température` decimal(10,2) NOT NULL COMMENT 'valeurs temperature',
  `Turbidité` decimal(11,2) NOT NULL COMMENT 'valeur turbidité',
  `Date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'date de mesure'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ValeursCapteurs`
--

INSERT INTO `ValeursCapteurs` (`id`, `pH`, `Température`, `Turbidité`, `Date`) VALUES
(1, 5, '18.78', '181.33', '2021-04-14 17:15:08'),
(2, 2, '11.92', '234.93', '2021-04-14 17:15:10'),
(3, 4, '44.82', '35.55', '2021-04-14 17:15:12'),
(4, 9, '41.28', '186.42', '2021-04-14 17:15:13'),
(5, 7, '17.97', '89.22', '2021-04-14 17:15:14'),
(6, 11, '16.90', '63.31', '2021-04-21 12:45:07'),
(7, 3, '13.42', '215.20', '2021-04-21 12:45:08'),
(8, 14, '30.12', '118.11', '2021-04-21 12:45:09'),
(9, 5, '26.56', '18.97', '2021-04-21 12:45:10'),
(10, 4, '43.01', '418.74', '2021-04-21 12:45:11'),
(11, 13, '16.18', '223.43', '2021-04-21 12:45:13'),
(12, 5, '32.65', '374.15', '2021-04-21 12:45:14'),
(13, 5, '32.65', '374.15', '2021-04-21 12:45:14');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ValeursCapteurs`
--
ALTER TABLE `ValeursCapteurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ValeursCapteurs`
--
ALTER TABLE `ValeursCapteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;