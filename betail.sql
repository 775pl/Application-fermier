-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 07 nov. 2024 à 21:39
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
-- Base de données : `betail`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price_ht` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `photos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id`, `name`, `age`, `type`, `breed`, `description`, `price_ht`, `status`, `photos`) VALUES
(22, 'Mrs. Opal Williamson Sr.', 3, 'chien', 'labrador', 'Consequatur qui iste libero consequuntur reiciendis aliquid facilis. Non possimus unde qui architecto. Cumque vero omnis et ut.', 642, 'en vente', 'https://via.placeholder.com/640x480.png/008822?text=animals+dolor'),
(23, 'Miss Mckayla Howe', 4, 'chien', 'labrador', 'Ut molestias aut non ratione commodi incidunt. Repellendus voluptatem ut sequi et et impedit natus. Tenetur explicabo ut illo sint quod.', 814.91, 'Adopted', 'https://via.placeholder.com/640x480.png/00ff22?text=animals+id'),
(24, 'Toney Pouros', 14, 'cochon', 'pottok', 'Voluptatem quibusdam odio sapiente assumenda aliquid accusamus. Quis suscipit laudantium non. Laudantium nulla eius culpa sed nam velit.', 759.33, 'Available', 'https://via.placeholder.com/640x480.png/0055aa?text=animals+sed'),
(25, 'Bridie Feest', 11, 'brebis', 'solognotes', 'Laborum id dolor nobis non. Saepe cum omnis ut tenetur.', 279.82, 'Available', 'https://via.placeholder.com/640x480.png/003355?text=animals+excepturi'),
(26, 'Mikayla O\'Conner', 10, 'chien', 'labrador', 'Sapiente unde ut et est eaque id. Dolorum illo explicabo quod velit. Sed temporibus itaque corrupti hic voluptatem ut tenetur ea.', 65.58, 'Available', 'https://via.placeholder.com/640x480.png/00aaee?text=animals+nam'),
(27, 'Carolina Abbott Sr.', 10, 'cheval', 'irish cob', 'Cum temporibus suscipit laborum qui quo. Incidunt excepturi qui reprehenderit vitae sint et earum. Inventore quibusdam quibusdam consequuntur atque similique. Quis odit eos quasi. Rerum mollitia consequatur molestiae sit quia repellendus.', 405.75, 'Available', 'https://via.placeholder.com/640x480.png/00ee55?text=animals+corrupti'),
(28, 'Darrell Prohaska', 4, 'cheval', 'frison', 'Esse eum accusantium deserunt. At amet sint aut tenetur. Quam est mollitia illo quos assumenda fugiat nihil.', 604.31, 'Adopted', 'https://via.placeholder.com/640x480.png/00ee88?text=animals+molestias'),
(29, 'Barbara Emard', 8, 'brebis', 'solognotes', 'Tempora repudiandae autem et quis commodi. Totam accusantium culpa aliquam qui exercitationem maxime. Consequatur vel eum esse et quae voluptatum quia. Ut autem nesciunt tempore. Adipisci voluptatem quia debitis et incidunt perspiciatis.', 355.82, 'Available', 'https://via.placeholder.com/640x480.png/006688?text=animals+ea'),
(30, 'Hope Crist III', 15, 'chien', 'labrador', 'Ea est reprehenderit ullam ut maiores. Et vel officia incidunt ut deleniti molestiae placeat. Vel delectus non ut illo distinctio in velit et.', 731.68, 'Available', 'https://via.placeholder.com/640x480.png/00ccaa?text=animals+exercitationem'),
(32, 'Valentin', 22, 'chien', 'labrador', 'qd', 23, 'en vente', ''),
(34, 'Valentin', 22, 'chien', 'labrador', 's', 1, 'en vente', '');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
