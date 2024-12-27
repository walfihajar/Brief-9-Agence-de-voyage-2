-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 27 déc. 2024 à 15:59
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `voyagepoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `id_activite` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `destination` varchar(100) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `place_disponible` int(11) DEFAULT NULL,
  `archive` enum('0','1') DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `typeActivite` enum('vols','hôtels','circuits touristiques') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id_activite`, `titre`, `description`, `destination`, `prix`, `date_debut`, `date_fin`, `place_disponible`, `archive`, `photo`, `typeActivite`) VALUES
(1, 'Veritatis explicabo', 'Velit earum volupta', 'Molestias id velit', 43.00, '1978-03-29', '1974-12-11', NULL, '0', NULL, NULL),
(2, 'Reiciendis autem ut ', 'Consequatur ut illo ', 'Sunt officiis veniam', 11.00, '2002-03-10', '2004-03-09', NULL, '1', NULL, NULL),
(6, 'hajar', 'Voluptates excepteur', 'Sequi provident ven', 96.00, '1994-04-03', '1997-06-07', 49, '1', NULL, NULL),
(8, 'Accusamus itaque mol', 'Sed dignissimos quia', 'Nihil placeat quisq', 91.00, '1987-05-12', '2010-09-01', 24, '0', NULL, NULL),
(9, 'Enim dolore nisi in ', 'Odio laudantium ut ', 'Cupiditate duis exce', 76.00, '2012-09-23', '1973-03-22', 18, '0', NULL, NULL),
(10, 'sara', 'Labore in sit autem ', 'Autem blanditiis num', 63.00, '1983-06-01', '2006-09-11', 12, NULL, NULL, NULL),
(11, 'Laboris voluptatem r', 'Tenetur anim ad et a', 'Tempore nisi quod i', 65.00, '1971-04-03', '1972-06-17', 30, NULL, NULL, NULL),
(12, 'Officiis voluptatem', 'Eveniet sunt elit ', 'Mollit rem velit qua', 65.00, '1983-03-19', '1989-08-22', 13, NULL, NULL, NULL),
(13, 'hajarrrr', 'Voluptas enim ipsa ', 'In iste laudantium ', 17.00, '2015-06-20', '2001-11-04', 52, NULL, NULL, NULL),
(14, 'ffff', 'Quis proident in ne', 'Aut eu sunt quos min', 85.00, '2006-10-28', '1982-07-24', 25, NULL, NULL, NULL),
(15, 'tetst', 'Provident quaerat v', 'Ipsam facere laudant', 94.00, '2020-06-04', '1979-08-20', 71, '0', 'uploads/676eae37a9b88-map1-removebg-preview.png', NULL),
(16, 'test1', 'Repudiandae minus qu', 'Deleniti quibusdam v', 64.00, '2004-04-11', '2006-08-14', 40, '0', 'uploads/676eae486c1a0-Blue & Orange Simple Travel Agency Logo (2).png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_activite` int(11) NOT NULL,
  `statut` enum('En attente','Confirmée','Annulée') NOT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `archive` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` enum('superAdmin','admin','client') DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'superAdmin'),
(2, 'admin'),
(3, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pwd` varchar(150) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `archive` enum('0','1') DEFAULT '0',
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `email`, `pwd`, `telephone`, `adresse`, `date_naissance`, `archive`, `id_role`) VALUES
(1, 'Est in reprehenderi', 'Vel est rem delectu', 'mina@mailinator.com', '$2y$10$OSdgG7J58H3rnLV5.iofI.kzswb2YgfijtXP12S8jy7ZQ.LcZf5tO', '+1 (269) 863-21', 'Omnis irure quia dol', NULL, '1', 3),
(2, 'ous', 'sara', 'sara@gmail.com', '$2y$10$Y6S9B86xAlfa7iS5ESjZu.3L.Le9snBVw7hvWg.nJp.GPFKujLjc2', '+1 (606) 894-32', 'Dolor obcaecati et a', NULL, '1', 3),
(4, 'Non ut quis sit ips', 'Voluptates at dolor ', 'kirexyt@mailinator.com', '$2y$10$KZrUkhAFI8/EtR4azlw5q.F0jvD/BwPUMfvUVneCu0qFXxodzA.O6', '+1 (651) 489-38', 'Quidem id perferend', NULL, '0', 3),
(5, 'Animi nihil exercit', 'Occaecat deleniti la', 'jucinoki@mailinator.com', '$2y$10$UhXDo0Zz7.qmSkr.ZcfkiO/QPwgjNIxr5ZsqeRfmB.QPC2QgRubeG', '+1 (979) 359-47', 'Nihil quidem sed und', NULL, '0', 2),
(6, 'louis', 'Est corrupti delen', 'paci@mailinator.com', '$2y$10$Q8zSykezwxGMe4QtCFPLOeD4Wt4d2ZkP./Ai4qEj3mECO/9Ky5y8q', '+1 (654) 133-44', 'Minus earum aut lore', NULL, '0', 3),
(8, 'Aspernatur qui sed s', 'Facilis quidem molli', 'dita@mailinator.com', '$2y$10$brfHH4FVBdo3HJJNUKszeO1RjLgW5Jq/KyHJ/AlQCkONc1dAu.C5C', '+1 (649) 951-79', 'Perferendis quis dic', NULL, '0', 2),
(10, 'Recusandae Quia qui', 'Rerum facilis eum al', 'vyrasupygy@mailinator.com', '$2y$10$rSskgfPBGSa3lux4sf9dtudmW.YWH2KtNf.zDJuOeZHuiXmx3D9g2', '+1 (565) 115-22', 'In et vel placeat c', NULL, '0', 2),
(11, 'Libero quo consequun', 'Irure aperiam nisi o', 'dawito@mailinator.com', '$2y$10$S.yP4XZ3J.efxAVRPfdxM.oWwJj0wWJykLMyEi2I5B2v1RPB1lSA2', '+1 (276) 467-55', 'Fugiat quas dolorem', NULL, '0', 2),
(13, 'Dolor quisquam bland', 'Asperiores dolorum d', 'camikodula@mailinator.com', '$2y$10$/2jsTdsi1e8QmWuToRDReORSyouuTOroudKeorfSN6syQZ/.x7Mgy', '+1 (731) 173-71', 'Irure minus sed ad v', NULL, '0', 2),
(14, 'Id fugit quia elige', 'Ipsum irure non ten', 'dybuta@mailinator.com', '$2y$10$9hldJ3fOsMIF4JOwBdj2YuyJ2u3AnpdwhL9m3m/UcDKeT0HX2X40W', '+1 (216) 194-22', 'Et eiusmod culpa inc', NULL, '0', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`id_activite`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_activite` (`id_activite`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_activite`) REFERENCES `activite` (`id_activite`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
