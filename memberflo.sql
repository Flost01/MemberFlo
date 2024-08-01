-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2024 at 01:16 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memberflo`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `project_id`, `user_id`, `message`, `timestamp`, `image_path`) VALUES
(33, 1, 10, '😵‍💫', '2024-08-01 08:19:24', ''),
(34, 1, 8, 'un pb?', '2024-08-01 08:19:38', '');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_his` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_his`, `description`, `create_at`) VALUES
(10, 'Le status de la tache Faire la maquette du projet a ete modifier a En cours par le chef', '2024-07-24 10:00:57'),
(11, 'Le status de la tache Faire la maquette du projet a ete modifier a Effectuée par le chef', '2024-07-24 10:02:30'),
(12, 'Le status de la tache Etablir un cahier des charges a ete modifier a En cours par Hans BEKE', '2024-07-24 10:04:01'),
(14, 'L utilisateur Ange Florinda TIANI a modifie son profil', '2024-07-24 14:15:52'),
(15, 'Le status de la tache Faire les userstories du projet a ete modifier a En cours par Franck Lauren', '2024-07-24 14:17:56'),
(16, 'L utilisateur Ange Florinda TIANI a modifie son profil', '2024-07-26 10:28:50'),
(17, 'L utilisateur Florinda TIANI a modifie son profil', '2024-07-26 10:28:59'),
(18, 'Le status de la tache Presentation globale du projet a ete modifier a En cours par le chef', '2024-07-26 10:30:30'),
(19, 'L utilisateur Ange Florinda TIANI a modifie son profil', '2024-07-26 13:13:29'),
(20, 'L utilisateur Florinda TIANI a modifie son profil', '2024-07-27 09:10:17'),
(21, 'Le status de la tache faire une etude financiere du projet a ete modifier a En cours par Hans BEKE', '2024-07-29 10:48:21'),
(22, 'L utilisateur Franck Lauren KOUMEDON a modifie son profil', '2024-07-29 13:17:28'),
(23, 'L utilisateur Franck Lauren a modifie son profil', '2024-07-29 13:22:05'),
(24, 'L utilisateur Jean Bernard TOUKAM a modifie son profil', '2024-07-30 09:02:58'),
(25, 'Le status de la tache presentation global du projet a ete modifier a En cours par Franck Lauren', '2024-08-01 09:00:15'),
(26, 'Le status de la tache presentation global du projet a ete modifier a Effectuée par Franck Lauren', '2024-08-01 09:06:04'),
(27, 'Le status de la tache presentation global du projet a ete modifier a En cours par Franck Lauren', '2024-08-01 09:17:22'),
(28, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a En cours par Franck Lauren', '2024-08-01 12:30:38'),
(29, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a Effectuée par le chef', '2024-08-01 12:30:57'),
(30, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a En cours par Franck Lauren', '2024-08-01 12:32:20'),
(31, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a Effectuée par le chef', '2024-08-01 12:35:01'),
(32, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a En cours par le chef', '2024-08-01 12:37:37'),
(33, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a Effectuée par Franck Lauren', '2024-08-01 12:37:52'),
(34, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a En cours par le chef', '2024-08-01 13:00:24'),
(35, 'Le status de la tache Etablir un plan financier a ete modifier a En cours par Jean Bernard TOUKAM', '2024-08-01 13:13:32'),
(36, 'Le status de la tache Etude de faisabiite du projet a ete modifier a En cours par le chef', '2024-08-01 13:14:52'),
(37, 'Le status de la tache Etude de faisabiite du projet a ete modifier a Effectuée par le chef', '2024-08-01 13:14:55'),
(38, 'Le status de la tache Etablir un plan financier a ete modifier a Effectuée par Jean Bernard TOUKAM', '2024-08-01 13:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id_notif` int NOT NULL,
  `texte` varchar(255) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id_notif`, `texte`, `user_id`) VALUES
(7, 'Vous avez une nouvelle tâche: qwertyuiop[fghjkl', 10),
(14, 'Vous avez une nouvelle tâche: qwertyuiopghjkl', 10),
(15, 'Le status de la tache qwertyuiop[fghjkl a ete modifier a En cours par le chef', 10),
(16, 'Vous avez une nouvelle tâche: Faire une analyse detaillee du projet', 11),
(17, 'Vous avez une nouvelle tâche: Etablir un plan financier', 12),
(18, 'Vous avez une nouvelle tâche: Analyse du comportement des clients', 10),
(19, 'Vous avez une nouvelle tâche: Ressortir les differents userstory', 11),
(20, 'Vous avez une nouvelle tâche: Faire le cahier des charcges du projet', 12),
(21, 'Le status de la tache Etablir un plan financier a ete modifier a En cours par Jean Bernard TOUKAM', 8),
(22, 'Vous avez une nouvelle tâche: presentation detailler du projet', 11),
(23, 'Vous avez une nouvelle tâche: Etude de faisabiite du projet', 10),
(24, 'Le status de la tache Etude de faisabiite du projet a ete modifier a En cours par le chef', 10),
(25, 'Le status de la tache Etude de faisabiite du projet a ete modifier a Effectuée par le chef', 10),
(26, 'Le status de la tache Etablir un plan financier a ete modifier a Effectuée par Jean Bernard TOUKAM', 8);

-- --------------------------------------------------------

--
-- Table structure for table `projets`
--

CREATE TABLE `projets` (
  `id_projet` int NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projets`
--

INSERT INTO `projets` (`id_projet`, `nom_projet`, `description`, `create_at`) VALUES
(1, 'Application de gestion des patient', 'mise en place d\'une application qui permet de gerer les patients d\'un hopital', '2024-07-22'),
(3, 'Plateforme agropastorale', 'Mise en place d\'une application qui permet de mettre en relation tous les acteurs du secteur agropastorale', '2024-07-22'),
(5, 'Application de gestion client', 'Mise en place d\'un CRM pour une entreprise', '2024-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `id_tache` int NOT NULL,
  `nom_tache` varchar(255) NOT NULL,
  `create_at` date NOT NULL,
  `delai` date NOT NULL,
  `id` int NOT NULL,
  `id_projet` int NOT NULL,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Enregistrée'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`id_tache`, `nom_tache`, `create_at`, `delai`, `id`, `id_projet`, `statut`) VALUES
(23, 'qwertyuiop[fghjkl', '2024-08-01', '2024-08-23', 10, 1, 'En cours'),
(24, 'qwertyuiopghjkl', '2024-08-01', '2024-08-11', 10, 3, 'Enregistrée'),
(25, 'Faire une analyse detaillee du projet', '2024-08-01', '2024-08-11', 11, 1, 'Enregistrée'),
(26, 'Etablir un plan financier', '2024-08-01', '2024-08-17', 12, 1, 'Effectuée'),
(27, 'Analyse du comportement des clients', '2024-08-01', '2024-08-08', 10, 5, 'Enregistrée'),
(28, 'Ressortir les differents userstory', '2024-08-01', '2024-08-18', 11, 5, 'Enregistrée'),
(29, 'Faire le cahier des charcges du projet', '2024-08-01', '2024-08-16', 12, 5, 'Enregistrée'),
(30, 'presentation detailler du projet', '2024-08-01', '2024-08-10', 11, 3, 'Enregistrée'),
(31, 'Etude de faisabiite du projet', '2024-08-01', '2024-08-17', 10, 3, 'Effectuée');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(8, 'Florinda TIANI', 'tianiflorinda@gmail.com', '$2y$10$kMoQTGiCd.hKy/LEEq9QFu5dPXuzit0TzkwpZ0s5Cnq0zsRyACSFi', 'chef'),
(10, 'Franck Lauren', 'lauren@gmail.com', '$2y$10$.Pc9lhj3MFkXQWqH3b9sDuqzBz6D4az0pThmsjCiWJiJuwGldPkxe', 'member'),
(11, 'Hans BEKE', 'hans@gmail.com', '$2y$10$VEGH4MX3Bre/JVSRvlN/ueGJMcoWfsUE9mR.MIOi0s0cGdusFZgu.', 'member'),
(12, 'Jean Bernard TOUKAM', 'jb@gmail.com', '$2y$10$.9cXbWsLxxsjvGT61up2GOUiptZKu2jPXKJPHcwkjnovhxPJcgiti', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_c` (`user_id`),
  ADD KEY `fk_projet_c` (`project_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_his`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `fk_user_n` (`user_id`);

--
-- Indexes for table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projet`);

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id_tache`),
  ADD KEY `fk_user` (`id`),
  ADD KEY `fk_projet` (`id_projet`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_his` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projet` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `id_tache` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_projet_c` FOREIGN KEY (`project_id`) REFERENCES `projets` (`id_projet`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_user_c` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_user_n` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `fk_projet` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id_projet`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
