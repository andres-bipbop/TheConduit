-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 15, 2026 alle 06:56
-- Versione del server: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Versione PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_pellegrinelliandres5ie`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `app_arguments`
--

CREATE TABLE `app_arguments` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_arguments`
--

INSERT INTO `app_arguments` (`id`, `name`, `area`) VALUES
(1, 'Culture', 'Humanistic'),
(2, 'History', 'Humanistic'),
(3, 'Philosophy', 'Humanistic'),
(4, 'Literature', 'Humanistic'),
(5, 'Poetry', 'Humanistic'),
(6, 'Language', 'Humanistic'),
(7, 'Archaeology', 'Humanistic'),
(8, 'Ancient culture', 'Humanistic'),
(9, 'Ancient languages', 'Humanistic'),
(10, 'Eastern culture', 'Humanistic'),
(11, 'Religion', 'Humanistic'),
(12, 'Eastern religion', 'Humanistic'),
(13, 'Sociology', 'Society and Current Affairs'),
(14, 'Psychology', 'Society and Current Affairs'),
(15, 'Politics', 'Society and Current Affairs'),
(16, 'Communication', 'Society and Current Affairs'),
(17, 'Media', 'Society and Current Affairs'),
(18, 'Environment', 'Society and Current Affairs'),
(19, 'Education', 'Society and Current Affairs'),
(20, 'Social issues', 'Society and Current Affairs'),
(21, 'Economics', 'Society and Current Affairs'),
(22, 'Finance', 'Society and Current Affairs'),
(23, 'Debates', 'Society and Current Affairs'),
(24, 'News', 'Society and Current Affairs'),
(25, 'Career', 'Life & Health'),
(26, 'Mental health', 'Life & Health'),
(27, 'Personal growth', 'Life & Health'),
(28, 'Experiences', 'Life & Health'),
(29, 'Visual arts', 'Creativity & Art'),
(30, 'Music', 'Creativity & Art'),
(31, 'Music theory', 'Creativity & Art'),
(32, 'Cinema', 'Creativity & Art'),
(33, 'Contemporary', 'Creativity & Art'),
(34, 'Film theory & criticism', 'Creativity & Art'),
(35, 'Photography', 'Creativity & Art'),
(36, 'Design', 'Creativity & Art'),
(37, 'Digital design', 'Creativity & Art'),
(38, 'Industrial design', 'Creativity & Art'),
(39, 'Performative art', 'Creativity & Art'),
(40, 'Architecture', 'Creativity & Art'),
(41, 'Theater', 'Creativity & Art'),
(42, 'Artificial Intelligence', 'Technology'),
(43, 'Computer Science', 'Technology'),
(44, 'Robotics & Automation', 'Technology'),
(45, 'Cyber security', 'Tecnology'),
(46, 'Startups', 'Technology'),
(47, 'Green technology', 'Technology'),
(48, 'Electronics', 'Technology'),
(49, 'Physics', 'Science'),
(50, 'Chemistry', 'Science'),
(51, 'Biology', 'Science'),
(52, 'Earth', 'Science'),
(53, 'Neuroscience', 'Science'),
(54, 'Biotechnology', 'Science'),
(55, 'Astronomy', 'Science'),
(56, 'Astrophysics', 'Science'),
(57, 'Materials', 'Science'),
(58, 'Maths', 'Science'),
(59, 'Zoology', 'Science');

-- --------------------------------------------------------

--
-- Struttura della tabella `app_comments`
--

CREATE TABLE `app_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `sentAt` date NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `app_comments_response`
--

CREATE TABLE `app_comments_response` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `sentAt` date NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `app_discussions`
--

CREATE TABLE `app_discussions` (
  `id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(800) NOT NULL,
  `participants_n` int(11) NOT NULL,
  `openedAt` datetime NOT NULL,
  `likes` int(11) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `app_followers`
--

CREATE TABLE `app_followers` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `followedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_followers`
--

INSERT INTO `app_followers` (`follower_id`, `followed_id`, `followedAt`) VALUES
(1, 3, '2026-05-14 17:01:08'),
(3, 1, '2026-05-14 17:01:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `app_members`
--

CREATE TABLE `app_members` (
  `user_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `joinedAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_members`
--

INSERT INTO `app_members` (`user_id`, `space_id`, `role_id`, `joinedAt`) VALUES
(1, 1, 1, '0000-00-00'),
(3, 1, 2, '0000-00-00'),
(3, 2, 4, '2026-03-15'),
(4, 1, 1, '0000-00-00'),
(5, 1, 3, '0000-00-00'),
(6, 1, 3, '0000-00-00'),
(7, 1, 2, '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura della tabella `app_permissions`
--

CREATE TABLE `app_permissions` (
  `title` varchar(32) NOT NULL,
  `description` varchar(150) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_permissions`
--

INSERT INTO `app_permissions` (`title`, `description`, `permission_id`) VALUES
('Publish post', 'Allows the user to publish posts in the posts section', 1),
('View Members', 'Allows the user to view all the members of the Space.', 2),
('Delete any post', 'Allows the user to remove any post from the posts section', 3),
('Delete any comment', 'Allows the user to remove any comment from any post', 4),
('Create invite link', 'Allows the user to create an invite link if the Space is private', 5),
('Ban members', 'Allows the user to ban members from the Space', 6),
('Edit Space settings', 'Allows the user to modify the Space settings', 7),
('Manage roles', 'Allows the user to assign or revoke roles', 8),
('Delete Space', 'Allows the user to delete the Space', 9),
('View Space', 'Allows the user to view all the content of the Space.', 10),
('Comment', 'Allows the user to comment on posts or discussions', 11),
('Open discussion', 'Allows the user to open new discussions', 12),
('No permissions', 'A permission given to banned users', 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `app_posts`
--

CREATE TABLE `app_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `postedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `mediaFile_1` text DEFAULT NULL,
  `mediaFile_2` text DEFAULT NULL,
  `mediaFile_3` text DEFAULT NULL,
  `mediaFile_4` text DEFAULT NULL,
  `mediaFile_5` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_posts`
--

INSERT INTO `app_posts` (`id`, `user_id`, `title`, `description`, `postedAt`, `likes`, `views`, `mediaFile_1`, `mediaFile_2`, `mediaFile_3`, `mediaFile_4`, `mediaFile_5`) VALUES
(1, 5, 'test', 'test', '2026-03-15 23:48:22', 4, 0, '', '', '', '', ''),
(11, 3, 'KJ', 'UH', '2026-05-14 23:07:32', 0, 0, 'uploads/users/3/posts/post_6a0655b4de340.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `app_posts_arguments`
--

CREATE TABLE `app_posts_arguments` (
  `post_id` int(11) NOT NULL,
  `argument_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_posts_arguments`
--

INSERT INTO `app_posts_arguments` (`post_id`, `argument_id`) VALUES
(1, 32),
(1, 41);

-- --------------------------------------------------------

--
-- Struttura della tabella `app_post_in_spaces`
--

CREATE TABLE `app_post_in_spaces` (
  `space_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_post_in_spaces`
--

INSERT INTO `app_post_in_spaces` (`space_id`, `post_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `app_roles`
--

CREATE TABLE `app_roles` (
  `title` char(32) NOT NULL,
  `description` char(150) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_roles`
--

INSERT INTO `app_roles` (`title`, `description`, `role_id`) VALUES
('Member', 'The standard user with standard permissions', 1),
('Admin', 'A powerful role that has access to almost all permissions', 2),
('Publisher User', 'A user allowed to publish Posts.', 3),
('Owner', 'The owner of the space. He has control over everything.', 4),
('Moderator', 'A role with moderation permissions enabled', 5),
('Banned', 'A member with no permissions.', 6),
('Restricted', 'A user who can only view posts or discussions but can\'t partecipate in them.', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `app_role_composition`
--

CREATE TABLE `app_role_composition` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_role_composition`
--

INSERT INTO `app_role_composition` (`role_id`, `permission_id`) VALUES
(1, 10),
(1, 11),
(1, 12),
(2, 2),
(2, 5),
(2, 7),
(2, 8),
(3, 1),
(4, 9),
(5, 2),
(5, 3),
(5, 4),
(5, 6),
(6, 13),
(7, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `app_spaces`
--

CREATE TABLE `app_spaces` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `icon_url` text NOT NULL,
  `banner_url` text NOT NULL,
  `description` varchar(150) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_spaces`
--

INSERT INTO `app_spaces` (`id`, `name`, `icon_url`, `banner_url`, `description`, `createdAt`) VALUES
(1, 'The News', '', '', 'Just the news.', '2025-12-28'),
(2, 'Popping bubbles', '', '', 'Fashion, design and trends, discovered.', '2026-03-15'),
(9, 'DigitalAI', '', '', 'We write about what\'s hot in Technology, with a focus on AI', '2026-05-13');

-- --------------------------------------------------------

--
-- Struttura della tabella `app_spaces_arguments`
--

CREATE TABLE `app_spaces_arguments` (
  `space_id` int(11) NOT NULL,
  `argument_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `username` char(32) NOT NULL,
  `name` char(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(97) NOT NULL,
  `validationCode` char(6) NOT NULL,
  `status` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_users`
--

INSERT INTO `app_users` (`id`, `username`, `name`, `email`, `password`, `validationCode`, `status`) VALUES
(1, 'Bisio', 'Claudio Bisio', 'pellegrinelli.andres.studente@itispaleocapa.it', '73d069a1742f25fc6eafe83ad3f6397e.3c642b30f7e734e7a90a1360a30ed139ca2c24524fc55927441626eda5b6e814', '', 'active'),
(3, 'cocco', 'cocco', 'pellegrinelli.andres.studente@itispaleocapa.it', 'e4f411caaa9bfeb49e222a1e662196d9.a772f025bebbaa25ac309213e657996869c339e6a17fdd5a0f4d21b529ff7dfd', '', 'active'),
(4, 'ErPupone', 'Francesco Totti', 'pellegrinelli.andres.studente@itispaleocapa.it', '6fae59e772a7a4d14544d187304eb4bc.009dc8bbb07154d23870618f2e1a19c28a3a4f321ba8aa7c634be3977834fd99', '', 'active'),
(5, 'Fabione64', 'Fabio Fazio', 'pellegrinelli.andres.studente@itispaleocapa.it', '1f3b7fb293e3220ef9166c5e5d96e428.fa6ded5605dad2f8b686ad4f4297fe38127eeb51265e20f2bcf4306db7bc0999', '', 'active'),
(6, 'QuellaColVocione', 'Maria De Filippi', 'pellegrinelli.andres.studente@itispaleocapa.it', 'df7ca2e4db232277d9e75e4e865ff858.0d80042ad14fcf3852eec3475b1ec728bd3a2ecdc43bf0dad40b450b15cef36d', '', 'active'),
(7, 'StupratoreSeriale', 'Alfonso Signorini', 'villa.davideousmane.studente@itispaleocapa.it', 'f9d76dab8eb1d1dfaeeebd6460679c00.41f0d6fa53e3ecaccef4aec56a7750acb4845482fbbd338912f4a6e5a268b2f1', '964172', 'pending');

-- --------------------------------------------------------

--
-- Struttura della tabella `app_users_arguments`
--

CREATE TABLE `app_users_arguments` (
  `user_id` int(11) NOT NULL,
  `argument_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `app_users_arguments`
--

INSERT INTO `app_users_arguments` (`user_id`, `argument_id`) VALUES
(3, 5),
(3, 32),
(3, 41);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getActiveUsers`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getActiveUsers` (
`username` char(32)
,`name` char(32)
,`role` char(32)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getCommentReplies`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getCommentReplies` (
`post_id` int(11)
,`parent_comment_id` int(11)
,`reply_id` int(11)
,`content` varchar(500)
,`sentAt` date
,`likes` int(11)
,`author_id` int(11)
,`username` char(32)
,`author_name` char(32)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getCommentsByPost`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getCommentsByPost` (
`post_id` int(11)
,`comment_id` int(11)
,`content` varchar(500)
,`sentAt` date
,`likes` int(11)
,`author_id` int(11)
,`username` char(32)
,`author_name` char(32)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getCustomPosts`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getCustomPosts` (
`postId` int(11)
,`postTitle` varchar(30)
,`postDescription` varchar(500)
,`postDate` datetime
,`postLikes` int(11)
,`postViews` int(11)
,`matchCount` bigint(21)
,`spaceId` int(11)
,`spaceName` varchar(32)
,`authorId` int(11)
,`authorName` char(32)
,`user_id` int(11)
,`totalComments` bigint(22)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getFollowedFeed`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getFollowedFeed` (
`user_id` int(11)
,`post_id` int(11)
,`title` varchar(30)
,`description` varchar(500)
,`postedAt` datetime
,`likes` int(11)
,`views` int(11)
,`username` char(32)
,`match_score` bigint(21)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getMembers`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getMembers` (
`user_id` int(11)
,`username` char(32)
,`role` char(32)
,`joinedAt` date
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getMembersBySpace`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getMembersBySpace` (
`space_id` int(11)
,`user_id` int(11)
,`username` char(32)
,`role` char(32)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getPersonalizedFeed`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getPersonalizedFeed` (
`user_id` int(11)
,`post_id` int(11)
,`title` varchar(30)
,`description` varchar(500)
,`postedAt` datetime
,`likes` int(11)
,`views` int(11)
,`username` char(32)
,`match_score` bigint(21)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getPostsBySpace`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getPostsBySpace` (
`space_id` int(11)
,`space_name` varchar(32)
,`post_id` int(11)
,`title` varchar(30)
,`description` varchar(500)
,`postedAt` datetime
,`likes` int(11)
,`views` int(11)
,`author_id` int(11)
,`author_username` char(32)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getPostsByUser`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getPostsByUser` (
`userId` int(11)
,`username` char(32)
,`authorName` char(32)
,`postId` int(11)
,`postTitle` varchar(30)
,`postDescription` varchar(500)
,`postDate` datetime
,`postLikes` int(11)
,`postViews` int(11)
,`mediaFile_1` text
,`mediaFile_2` text
,`mediaFile_3` text
,`mediaFile_4` text
,`mediaFile_5` text
,`authorId` int(11)
,`spaceId` int(11)
,`spaceName` varchar(32)
,`totalComments` bigint(22)
);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `app_arguments`
--
ALTER TABLE `app_arguments`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `app_comments`
--
ALTER TABLE `app_comments`
  ADD PRIMARY KEY (`id`,`post_id`,`author`),
  ADD KEY `postId` (`post_id`),
  ADD KEY `user_id` (`author`);

--
-- Indici per le tabelle `app_comments_response`
--
ALTER TABLE `app_comments_response`
  ADD PRIMARY KEY (`id`,`post_id`,`comment_id`,`author`),
  ADD KEY `postId` (`post_id`),
  ADD KEY `user_id` (`author`),
  ADD KEY `response_with_comment` (`comment_id`);

--
-- Indici per le tabelle `app_discussions`
--
ALTER TABLE `app_discussions`
  ADD PRIMARY KEY (`id`,`space_id`,`author`),
  ADD KEY `discussion_with_space` (`space_id`),
  ADD KEY `discussion_with_user` (`author`);

--
-- Indici per le tabelle `app_followers`
--
ALTER TABLE `app_followers`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD KEY `followed_id` (`followed_id`);

--
-- Indici per le tabelle `app_members`
--
ALTER TABLE `app_members`
  ADD PRIMARY KEY (`user_id`,`space_id`,`role_id`),
  ADD KEY `member_space` (`space_id`),
  ADD KEY `member_role` (`role_id`);

--
-- Indici per le tabelle `app_permissions`
--
ALTER TABLE `app_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indici per le tabelle `app_posts`
--
ALTER TABLE `app_posts`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `userId` (`user_id`);

--
-- Indici per le tabelle `app_posts_arguments`
--
ALTER TABLE `app_posts_arguments`
  ADD PRIMARY KEY (`post_id`,`argument_id`),
  ADD KEY `posts_with_arguments` (`argument_id`);

--
-- Indici per le tabelle `app_post_in_spaces`
--
ALTER TABLE `app_post_in_spaces`
  ADD PRIMARY KEY (`space_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indici per le tabelle `app_roles`
--
ALTER TABLE `app_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indici per le tabelle `app_role_composition`
--
ALTER TABLE `app_role_composition`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indici per le tabelle `app_spaces`
--
ALTER TABLE `app_spaces`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `app_spaces_arguments`
--
ALTER TABLE `app_spaces_arguments`
  ADD PRIMARY KEY (`space_id`,`argument_id`),
  ADD KEY `spaces_with_arguments` (`argument_id`);

--
-- Indici per le tabelle `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `app_users_arguments`
--
ALTER TABLE `app_users_arguments`
  ADD PRIMARY KEY (`user_id`,`argument_id`),
  ADD KEY `users_with_arguments` (`argument_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `app_arguments`
--
ALTER TABLE `app_arguments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT per la tabella `app_comments`
--
ALTER TABLE `app_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `app_comments_response`
--
ALTER TABLE `app_comments_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `app_discussions`
--
ALTER TABLE `app_discussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `app_permissions`
--
ALTER TABLE `app_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `app_posts`
--
ALTER TABLE `app_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `app_roles`
--
ALTER TABLE `app_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `app_spaces`
--
ALTER TABLE `app_spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

-- --------------------------------------------------------

--
-- Struttura per vista `getActiveUsers`
--
DROP TABLE IF EXISTS `getActiveUsers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getActiveUsers`  AS SELECT `u`.`username` AS `username`, `u`.`name` AS `name`, `r`.`title` AS `role` FROM ((`app_users` `u` join `app_members` `m` on(`u`.`id` = `m`.`user_id`)) join `app_roles` `r` on(`m`.`role_id` = `r`.`role_id`)) WHERE `u`.`status` = 'active' ;

-- --------------------------------------------------------

--
-- Struttura per vista `getCommentReplies`
--
DROP TABLE IF EXISTS `getCommentReplies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getCommentReplies`  AS SELECT `r`.`post_id` AS `post_id`, `r`.`comment_id` AS `parent_comment_id`, `r`.`id` AS `reply_id`, `r`.`content` AS `content`, `r`.`sentAt` AS `sentAt`, `r`.`likes` AS `likes`, `u`.`id` AS `author_id`, `u`.`username` AS `username`, `u`.`name` AS `author_name` FROM (`app_comments_response` `r` join `app_users` `u` on(`r`.`author` = `u`.`id`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `getCommentsByPost`
--
DROP TABLE IF EXISTS `getCommentsByPost`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getCommentsByPost`  AS SELECT `c`.`post_id` AS `post_id`, `c`.`id` AS `comment_id`, `c`.`content` AS `content`, `c`.`sentAt` AS `sentAt`, `c`.`likes` AS `likes`, `u`.`id` AS `author_id`, `u`.`username` AS `username`, `u`.`name` AS `author_name` FROM (`app_comments` `c` join `app_users` `u` on(`c`.`author` = `u`.`id`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `getCustomPosts`
--
DROP TABLE IF EXISTS `getCustomPosts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getCustomPosts`  AS SELECT `p`.`id` AS `postId`, `p`.`title` AS `postTitle`, `p`.`description` AS `postDescription`, `p`.`postedAt` AS `postDate`, `p`.`likes` AS `postLikes`, `p`.`views` AS `postViews`, count(distinct `ua`.`argument_id`) AS `matchCount`, `s`.`id` AS `spaceId`, `s`.`name` AS `spaceName`, `u`.`id` AS `authorId`, `u`.`name` AS `authorName`, `ua`.`user_id` AS `user_id`, (select count(0) from `app_comments` where `app_comments`.`post_id` = `p`.`id`) + (select count(0) from `app_comments_response` where `app_comments_response`.`post_id` = `p`.`id`) AS `totalComments` FROM ((((`app_posts` `p` join `app_posts_arguments` `pa` on(`p`.`id` = `pa`.`post_id`)) join `app_users_arguments` `ua` on(`pa`.`argument_id` = `ua`.`argument_id`)) left join `app_spaces` `s` on(`p`.`id` = `s`.`id`)) left join `app_users` `u` on(`p`.`user_id` = `u`.`id`)) GROUP BY `p`.`id`, `p`.`title`, `p`.`description`, `p`.`postedAt`, `p`.`likes`, `p`.`views`, `s`.`id`, `s`.`name`, `u`.`id`, `u`.`name`, `ua`.`user_id` ;

-- --------------------------------------------------------

--
-- Struttura per vista `getFollowedFeed`
--
DROP TABLE IF EXISTS `getFollowedFeed`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getFollowedFeed`  AS SELECT `ua`.`user_id` AS `user_id`, `p`.`id` AS `post_id`, `p`.`title` AS `title`, `p`.`description` AS `description`, `p`.`postedAt` AS `postedAt`, `p`.`likes` AS `likes`, `p`.`views` AS `views`, `u`.`username` AS `username`, count(0) AS `match_score` FROM ((((`app_users_arguments` `ua` join `app_followers` `f` on(`f`.`follower_id` = `ua`.`user_id`)) join `app_posts` `p` on(`p`.`user_id` = `f`.`followed_id`)) join `app_posts_arguments` `pa` on(`pa`.`post_id` = `p`.`id`)) join `app_users` `u` on(`u`.`id` = `p`.`user_id`)) WHERE `p`.`user_id` <> `ua`.`user_id` GROUP BY `ua`.`user_id`, `p`.`id` ;

-- --------------------------------------------------------

--
-- Struttura per vista `getMembers`
--
DROP TABLE IF EXISTS `getMembers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getMembers`  AS SELECT `u`.`id` AS `user_id`, `u`.`username` AS `username`, `r`.`title` AS `role`, `m`.`joinedAt` AS `joinedAt` FROM ((`app_members` `m` join `app_users` `u` on(`m`.`user_id` = `u`.`id`)) join `app_roles` `r` on(`m`.`role_id` = `r`.`role_id`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `getMembersBySpace`
--
DROP TABLE IF EXISTS `getMembersBySpace`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getMembersBySpace`  AS SELECT `m`.`space_id` AS `space_id`, `u`.`id` AS `user_id`, `u`.`username` AS `username`, `r`.`title` AS `role` FROM ((`app_members` `m` join `app_users` `u` on(`m`.`user_id` = `u`.`id`)) join `app_roles` `r` on(`m`.`role_id` = `r`.`role_id`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `getPersonalizedFeed`
--
DROP TABLE IF EXISTS `getPersonalizedFeed`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getPersonalizedFeed`  AS SELECT `ua`.`user_id` AS `user_id`, `p`.`id` AS `post_id`, `p`.`title` AS `title`, `p`.`description` AS `description`, `p`.`postedAt` AS `postedAt`, `p`.`likes` AS `likes`, `p`.`views` AS `views`, `u`.`username` AS `username`, count(0) AS `match_score` FROM (((`app_users_arguments` `ua` join `app_posts_arguments` `pa` on(`ua`.`argument_id` = `pa`.`argument_id`)) join `app_posts` `p` on(`pa`.`post_id` = `p`.`id`)) join `app_users` `u` on(`p`.`user_id` = `u`.`id`)) WHERE `p`.`user_id` <> `ua`.`user_id` GROUP BY `ua`.`user_id`, `p`.`id` ;

-- --------------------------------------------------------

--
-- Struttura per vista `getPostsBySpace`
--
DROP TABLE IF EXISTS `getPostsBySpace`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getPostsBySpace`  AS SELECT `s`.`id` AS `space_id`, `s`.`name` AS `space_name`, `p`.`id` AS `post_id`, `p`.`title` AS `title`, `p`.`description` AS `description`, `p`.`postedAt` AS `postedAt`, `p`.`likes` AS `likes`, `p`.`views` AS `views`, `u`.`id` AS `author_id`, `u`.`username` AS `author_username` FROM (((`app_post_in_spaces` `ps` join `app_spaces` `s` on(`ps`.`space_id` = `s`.`id`)) join `app_posts` `p` on(`ps`.`post_id` = `p`.`id`)) join `app_users` `u` on(`p`.`user_id` = `u`.`id`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `getPostsByUser`
--
DROP TABLE IF EXISTS `getPostsByUser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_andres`@`localhost` SQL SECURITY DEFINER VIEW `getPostsByUser`  AS SELECT `p`.`user_id` AS `userId`, `u`.`username` AS `username`, `u`.`name` AS `authorName`, `p`.`id` AS `postId`, `p`.`title` AS `postTitle`, `p`.`description` AS `postDescription`, `p`.`postedAt` AS `postDate`, `p`.`likes` AS `postLikes`, `p`.`views` AS `postViews`, `p`.`mediaFile_1` AS `mediaFile_1`, `p`.`mediaFile_2` AS `mediaFile_2`, `p`.`mediaFile_3` AS `mediaFile_3`, `p`.`mediaFile_4` AS `mediaFile_4`, `p`.`mediaFile_5` AS `mediaFile_5`, `u`.`id` AS `authorId`, `s`.`id` AS `spaceId`, `s`.`name` AS `spaceName`, (select count(0) from `app_comments` where `app_comments`.`post_id` = `p`.`id`) + (select count(0) from `app_comments_response` where `app_comments_response`.`post_id` = `p`.`id`) AS `totalComments` FROM ((`app_posts` `p` join `app_users` `u` on(`p`.`user_id` = `u`.`id`)) left join `app_spaces` `s` on(`p`.`id` = `s`.`id`)) GROUP BY `p`.`id`, `p`.`user_id`, `u`.`username`, `u`.`name`, `p`.`title`, `p`.`description`, `p`.`postedAt`, `p`.`likes`, `p`.`views`, `p`.`mediaFile_1`, `p`.`mediaFile_2`, `p`.`mediaFile_3`, `p`.`mediaFile_4`, `p`.`mediaFile_5`, `u`.`id`, `s`.`id`, `s`.`name` ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `app_comments`
--
ALTER TABLE `app_comments`
  ADD CONSTRAINT `postId` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`author`) REFERENCES `app_users` (`id`);

--
-- Limiti per la tabella `app_comments_response`
--
ALTER TABLE `app_comments_response`
  ADD CONSTRAINT `response_with_comment` FOREIGN KEY (`comment_id`) REFERENCES `app_comments` (`id`),
  ADD CONSTRAINT `response_with_post` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`),
  ADD CONSTRAINT `response_with_user` FOREIGN KEY (`author`) REFERENCES `app_users` (`id`);

--
-- Limiti per la tabella `app_discussions`
--
ALTER TABLE `app_discussions`
  ADD CONSTRAINT `discussion_with_space` FOREIGN KEY (`space_id`) REFERENCES `app_spaces` (`id`),
  ADD CONSTRAINT `discussion_with_user` FOREIGN KEY (`author`) REFERENCES `app_users` (`id`);

--
-- Limiti per la tabella `app_followers`
--
ALTER TABLE `app_followers`
  ADD CONSTRAINT `app_followers_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_followers_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `app_members`
--
ALTER TABLE `app_members`
  ADD CONSTRAINT `member_role` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`role_id`),
  ADD CONSTRAINT `member_space` FOREIGN KEY (`space_id`) REFERENCES `app_spaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_user_id` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `app_posts`
--
ALTER TABLE `app_posts`
  ADD CONSTRAINT `userId` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`);

--
-- Limiti per la tabella `app_posts_arguments`
--
ALTER TABLE `app_posts_arguments`
  ADD CONSTRAINT `Posts_id` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`),
  ADD CONSTRAINT `posts_with_arguments` FOREIGN KEY (`argument_id`) REFERENCES `app_arguments` (`id`);

--
-- Limiti per la tabella `app_post_in_spaces`
--
ALTER TABLE `app_post_in_spaces`
  ADD CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`),
  ADD CONSTRAINT `space_id` FOREIGN KEY (`space_id`) REFERENCES `app_spaces` (`id`);

--
-- Limiti per la tabella `app_role_composition`
--
ALTER TABLE `app_role_composition`
  ADD CONSTRAINT `permission_id` FOREIGN KEY (`permission_id`) REFERENCES `app_permissions` (`permission_id`),
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`role_id`);

--
-- Limiti per la tabella `app_spaces_arguments`
--
ALTER TABLE `app_spaces_arguments`
  ADD CONSTRAINT `Spaces_Id` FOREIGN KEY (`space_id`) REFERENCES `app_spaces` (`id`),
  ADD CONSTRAINT `spaces_with_arguments` FOREIGN KEY (`argument_id`) REFERENCES `app_arguments` (`id`);

--
-- Limiti per la tabella `app_users_arguments`
--
ALTER TABLE `app_users_arguments`
  ADD CONSTRAINT `user-id` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`),
  ADD CONSTRAINT `users_with_arguments` FOREIGN KEY (`argument_id`) REFERENCES `app_arguments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
