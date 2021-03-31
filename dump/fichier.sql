-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u1
-- https://www.phpmyadmin.net/
--
-- Client :  mysql.info.unicaen.fr:3306
-- Généré le :  Mer 31 Mars 2021 à 07:29
-- Version du serveur :  10.1.44-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `secret` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blocked` int(11) NOT NULL DEFAULT '0',
  `IBAN` text NOT NULL,
  `expiration` text NOT NULL,
  `CVC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `secret`, `creation_date`, `blocked`, `IBAN`, `expiration`, `CVC`) VALUES
(1, 'merilmiangouila@gmail.com', 'ad4ebad5f22ebf141bdcb9fb9cd1806ddcccb1cd97645', '0483190c3c242b88debb37b1cbfa7c53f92013b016171511221617151122', '2021-03-31 02:38:42', 0, 'ok', '05/04', 365);

-- --------------------------------------------------------

--

-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


  -- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
