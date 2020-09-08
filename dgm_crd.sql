-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2020 at 03:04 PM
-- Server version: 10.3.22-MariaDB-1
-- PHP Version: 7.3.15-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dgm_crd`
--

-- --------------------------------------------------------

--
-- Table structure for table `dm`
--

CREATE TABLE `dm` (
  `id_dm` int(11) NOT NULL,
  `situation_famille` varchar(13) DEFAULT NULL,
  `division` varchar(30) DEFAULT NULL,
  `direction` varchar(40) DEFAULT NULL,
  `unite` varchar(30) DEFAULT NULL,
  `service` varchar(35) DEFAULT NULL,
  `activite` varchar(35) DEFAULT NULL,
  `atelier` varchar(40) DEFAULT NULL,
  `maladie_gen` varchar(50) DEFAULT NULL,
  `maladie_prof` varchar(50) DEFAULT NULL,
  `maladie_carc` varchar(120) DEFAULT NULL,
  `interventions` varchar(45) DEFAULT NULL,
  `affectations` varchar(50) DEFAULT NULL,
  `intoxications` varchar(55) DEFAULT NULL,
  `accidents` varchar(44) DEFAULT NULL,
  `collateraux` varchar(45) DEFAULT NULL,
  `conjoints` varchar(50) DEFAULT NULL,
  `observation` longtext DEFAULT NULL,
  `archivier_dm` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dm`
--

INSERT INTO `dm` (`id_dm`, `situation_famille`, `division`, `direction`, `unite`, `service`, `activite`, `atelier`, `maladie_gen`, `maladie_prof`, `maladie_carc`, `interventions`, `affectations`, `intoxications`, `accidents`, `collateraux`, `conjoints`, `observation`, `archivier_dm`, `deleted`) VALUES
(18, 'celibataire', 'CRD', 'D-INFO', '1', 'prof', 'activiti', 'at', 'gen', 'prof', 'carc', 'interv', 'affection', 'intoxucation', 'accident', 'collateraux', 'conjoint', 'observation', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL,
  `nom_patient` varchar(32) DEFAULT NULL,
  `prenom_patient` varchar(32) DEFAULT NULL,
  `datenais_patient` date DEFAULT NULL,
  `lieunais_patient` varchar(40) DEFAULT NULL,
  `sexe_patient` varchar(6) DEFAULT NULL,
  `adresse_patient` varchar(50) DEFAULT NULL,
  `tel_patient` varchar(14) DEFAULT NULL,
  `id_dm` int(11) DEFAULT NULL,
  `archivier_patient` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom_patient`, `prenom_patient`, `datenais_patient`, `lieunais_patient`, `sexe_patient`, `adresse_patient`, `tel_patient`, `id_dm`, `archivier_patient`, `deleted`) VALUES
(10, 'bonoraz', 'Chahinaz', '2020-12-19', 'alger', 'Homme', 'adr chahinaz', '0664110000', 18, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE `rdv` (
  `id_rdv` int(11) NOT NULL,
  `date_rdv` datetime NOT NULL,
  `id_patient` int(8) NOT NULL,
  `archivier_rdv` tinyint(1) NOT NULL DEFAULT 0,
  `id_medecin` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rdv`
--

INSERT INTO `rdv` (`id_rdv`, `date_rdv`, `id_patient`, `archivier_rdv`, `id_medecin`) VALUES
(9, '2020-11-30 12:00:00', 10, 0, 11),
(10, '2020-09-30 12:00:00', 10, 0, 11),
(11, '2020-09-06 12:00:00', 10, 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(55) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `profil_nom` varchar(50) DEFAULT NULL,
  `profil_prenom` varchar(50) DEFAULT NULL,
  `profil_type` varchar(20) DEFAULT 'assistante',
  `profil_tel` varchar(14) DEFAULT NULL,
  `profil_sexe` varchar(2) DEFAULT 'm',
  `profil_adresse` varchar(60) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `profil_nom`, `profil_prenom`, `profil_type`, `profil_tel`, `profil_sexe`, `profil_adresse`, `password`, `deleted`, `active`) VALUES
(1, 'admin', 'Admin', 'Admin', 'administrateur', '0544112233', 'm', 'adm adrs', '$2y$10$pqpgV9A6eXysrVQdOyop2u18bbVobxWWn2llSNBqrXcI/1b1rfA4u', 0, 1),
(10, 'sec', 'sec', 'sec', 'assistante', '0544112233', 'f', 'sec adresse', '$2y$10$r/Gzar/4AdtcHX.T.HInPOz9.IsN4GDSAIkRVecNfIZo2Jb7e3uvW', 0, 1),
(11, 'dr', 'Abdo', 'Dr', 'medecin', '0775000000', 'm', 'Djanet rue 142s', '$2y$10$fAUHRT2bdYf9DvZBS8die.VNQul9TkItP1YnJbBU3NzA86XyIJ9rm', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visite`
--

CREATE TABLE `visite` (
  `id_visite` int(10) NOT NULL,
  `date_visite` datetime DEFAULT current_timestamp(),
  `id_patient` int(10) DEFAULT NULL,
  `id_medecin` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visite`
--

INSERT INTO `visite` (`id_visite`, `date_visite`, `id_patient`, `id_medecin`) VALUES
(12, '2020-09-06 12:20:38', 11, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dm`
--
ALTER TABLE `dm`
  ADD PRIMARY KEY (`id_dm`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Indexes for table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`id_rdv`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id_visite`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dm`
--
ALTER TABLE `dm`
  MODIFY `id_dm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `id_rdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `visite`
--
ALTER TABLE `visite`
  MODIFY `id_visite` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
