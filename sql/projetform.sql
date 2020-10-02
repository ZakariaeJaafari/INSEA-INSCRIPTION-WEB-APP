-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 03:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetform`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `token` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `matricule` int(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `cycle` varchar(100) NOT NULL,
  `filiere` varchar(30) NOT NULL,
  `niveau` varchar(30) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(30) NOT NULL,
  `date_insc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `email`, `verified`, `token`, `password`, `matricule`, `nom`, `prenom`, `cycle`, `filiere`, `niveau`, `date_naissance`, `sexe`, `date_insc`) VALUES
(38, 'zakariae.jaafari98@gmail.com', 1, '2d687d20b45081525a94d63cf7d89241e04f1b02b170cf1b9f0dfaab5ce3597381d74a454ab3e0ac233474ba862e10ad388a', '$2y$10$U9I43Q0x/wNElE3.x0Oor.x4Uin20LUUqZ3mJ1nywXIQ70NY4Xypu', 234, 'jaafari', 'Zakariae', 'Cycle ingénieurs d’Etat', 'Statistique-Economie Appliquée', '1ere Annee', '2020-07-04', 'Homme', '2020-07-05'),
(39, 'dzekroos2@gmail.com', 1, '9aa62ca3ce47aece9eedee1f5195e2b06574b5ac288ccdb56ca2fd7876026712657665a9c18da949eb58be2306fe44815991', '$2y$10$01D4NSS3XZdwlIBToaHu8OwV6nnvmnabRWA/vFuJSBVXpazVX/W6K', 564, 'jaafari', 'zack', 'Cycle ingénieurs d’Etat', 'Statistique-Economie Appliquée', '2eme Annee', '2020-07-04', 'Homme', '2020-07-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
