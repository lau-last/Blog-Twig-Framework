-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 28 juin 2023 à 18:22
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `framework`
--
CREATE
DATABASE IF NOT EXISTS `framework` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE
`framework`;
-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article`
(
    `id`      int(11) NOT NULL,
    `user_id` int(11) DEFAULT NULL,
    `title`   varchar(255) NOT NULL,
    `head`    text         NOT NULL,
    `content` text         NOT NULL,
    `date`    datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `user_id`, `title`, `head`, `content`, `date`)
VALUES (1, 1, 'Futurama', 'Bender, I didn\'t know you liked cooking. That\'s so cute.',
        'Yeah, lots of people did. Or a guy who burns down a bar for the insurance money! Yep, I remember. They came in last at the Olympics, then retired to promote alcoholic beverages! What are you hacking off? Is it my torso?! \'It is!\' My precious torso!\r\n\r\nUm, is this the boring, peaceful kind of taking to the streets? Michelle, I don\'t regret this,
        but I both rue and lament it. Bender, hurry! This fuel\'s expensive! Also, we\'re dying! Soon enough. Of all the friends I\'ve had… you\'re the first.', '2023-06-28 20:12:20'),
(2, 1, 'Doctor Who', 'No, I\'ll fix it. I\' m good at fixing rot.Call me the Rotmeister.No, I\'m the Doctor. Don\' t
        call me the Rotmeister.', ' I am the Doctor, and you are the Daleks ! It\'s a fez. I wear a fez now. Fezes are cool. I hate yogurt. It\'
        s just stuff with bits in.I hate yogurt.It\'s just stuff with bits in. I hate yogurt. It\' s just stuff with
        bits in.\r\n\r\nDid I mention we have comfy chairs ? * Insistently * Bow ties are cool ! Come on Amy, I\'m a normal bloke, tell me what normal blokes do! It\'
        s art ! A statement on modern society, \'Oh Ain\' t Modern Society Awful ? \'!', '2023-06-28 20:13:16'),
       (3, 1, 'Dexter',
        'I\'m thinking two circus clowns dancing. You?', 'I\'m really more an apartment person. I\'ve lived in darkness a long time. Over the years my eyes adjusted until the dark became my world and I could see. I\'m real proud of you for coming, bro. I know you hate funerals.\r\n\r\nRorschach would say you have a hard time relating to others. I love Halloween. The one time of year when everyone wears a mask … not just me. Rorschach would say you have a hard time relating to others.',
        '2023-06-28 20:13:48'),
       (4, 1, 'Lorem Ipsum',
        'Ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.',
        'Corrupti quos dolores et quas molestias excepturi sint occaecati. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, id est laborum et dolorum fuga. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.\r\n\r\nNam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Do eiusmod tempor incididunt ut labore et dolore magna aliqua. Animi, id est laborum et dolorum fuga.',
        '2023-06-28 20:14:43');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment`
(
    `id`         int(11) NOT NULL,
    `user_id`    int(11) DEFAULT NULL,
    `article_id` int(11) DEFAULT NULL,
    `content`    text     NOT NULL,
    `date`       datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `validation` enum('valid','invalid') NOT NULL DEFAULT 'invalid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `article_id`, `content`, `date`, `validation`)
VALUES (1, 2, 3, 'I love Dexter !!', '2023-06-28 20:16:48', 'valid'),
       (2, 2, 4, 'What is that ??', '2023-06-28 20:17:13', 'valid'),
       (3, 3, 3, 'OMG !!!', '2023-06-28 20:19:02', 'valid'),
       (4, 3, 2, 'Witch Doctor ?', '2023-06-28 20:19:50', 'valid');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user`
(
    `id`              int(11) NOT NULL,
    `name`            varchar(255) NOT NULL,
    `password`        varchar(255) NOT NULL,
    `email`           varchar(255) NOT NULL,
    `role`            enum('user','admin') NOT NULL DEFAULT 'user',
    `date`            datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `token`           varchar(255) NOT NULL,
    `expiration_date` int(11) NOT NULL,
    `validation`      enum('valid','invalid') NOT NULL DEFAULT 'invalid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `role`, `date`, `token`, `expiration_date`, `validation`)
VALUES (1, 'laurent', '$2y$10$zqeeDTA1HibzQP1Zss4sHetMgnMzBUBAY8Dba4eoicZTlHy5oHtMS', 'laurent@gmail.com', 'admin',
        '2023-06-28 20:09:58', '16be49e5de9c8108f3f1bab18ae23bffa08ab806821795e41223ec58e688d7b7', 1687979398, 'valid'),
       (2, 'aurélie', '$2y$10$.G60kjj3E5.PYFO0w5rR9uyeSTrj6TnJrNZs7VFhdsrdxGUDtXMGm', 'aurelie@gmail.com', 'user',
        '2023-06-28 20:15:22', 'adaac6c912156e25f025f8f69ffa94ede2e640d5d7f5bc077fc58b4718a5a708', 1687979722, 'valid'),
       (3, 'sandrine', '$2y$10$ekvyq2KiE2QJRjBCNBl9muyQvR1tXuR5qkR0Z.bRRMMkTBjaUDNpe', 'sandrine@gmail.com', 'user',
        '2023-06-28 20:17:59', 'c6481814579424462045b927dbafd0ebf4ef7261ce7780e018a757854580cd2b', 1687979879, 'valid');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
    ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
    ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
