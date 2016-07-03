-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-07-03 08:05:31
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tolowan`
--

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `nid` int(11) NOT NULL,
  `pid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `created` int(11) NOT NULL,
  `changed` int(11) NOT NULL,
  `love` int(10) DEFAULT '0',
  `body` text NOT NULL,
  `contentModel` varchar(32) DEFAULT 'comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `state` int(1) DEFAULT '1',
  `content_type` varchar(10) NOT NULL,
  `access` int(1) DEFAULT '1',
  `md5` varchar(64) DEFAULT '',
  `name` varchar(80) DEFAULT '',
  `description` text,
  `path` varchar(60) NOT NULL,
  `changed` int(11) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `node`
--

CREATE TABLE `node` (
  `id` int(11) NOT NULL,
  `state` int(1) DEFAULT '1' COMMENT '文章是否被标记为删除状态',
  `contentModel` varchar(32) NOT NULL COMMENT '文章类型',
  `created` int(11) NOT NULL COMMENT '文章创建时间',
  `changed` int(11) NOT NULL COMMENT '文章最新更改时间',
  `uid` int(11) DEFAULT '0' COMMENT '文章作者',
  `comment` int(1) DEFAULT '0' COMMENT '文章是否开启评论',
  `top` int(1) DEFAULT '0' COMMENT '文章被标记为置顶，1为置顶，0为不制定',
  `essence` int(1) DEFAULT '0' COMMENT '标记为精华，1为精华，0则不是',
  `hot` tinyint(1) DEFAULT '0',
  `love` int(11) DEFAULT '0',
  `browse` int(11) DEFAULT '0',
  `comment_num` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `node_field_body`
--

CREATE TABLE `node_field_body` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` text NOT NULL,
  `full_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `node_field_cat`
--

CREATE TABLE `node_field_cat` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `node_field_images`
--

CREATE TABLE `node_field_images` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `node_field_tags`
--

CREATE TABLE `node_field_tags` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `node_field_title`
--

CREATE TABLE `node_field_title` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `full_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `data` text NOT NULL,
  `runtime` int(11) DEFAULT NULL,
  `state` int(1) NOT NULL,
  `error` text,
  `weight` int(11) DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `term`
--

CREATE TABLE `term` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `widget` int(11) DEFAULT '10',
  `other` text,
  `contentModel` varchar(32) NOT NULL,
  `attach` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(11) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` bigint(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `active` int(1) DEFAULT '0',
  `email_validate` tinyint(1) DEFAULT '0',
  `phone_validate` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `created`, `active`, `email_validate`, `phone_validate`) VALUES
(1, '管蠡园', 'admin@admin.com', 888888, '$2a$08$EOLgsVKDSqXJdLpqd5Vkre.PCEAW4DlZZZ/1LTFIvyjSXvEjSgIAy', 1467525643, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_field_roles`
--

CREATE TABLE `user_field_roles` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` varchar(30) NOT NULL,
  `created` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_field_roles`
--

INSERT INTO `user_field_roles` (`id`, `eid`, `value`, `created`, `state`) VALUES
(1, 1, 'user', 1467525643, 1),
(2, 1, 'admin', 1467525643, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nid` (`nid`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `node`
--
ALTER TABLE `node`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`contentModel`,`uid`);

--
-- Indexes for table `node_field_body`
--
ALTER TABLE `node_field_body`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`eid`);
ALTER TABLE `node_field_body` ADD FULLTEXT KEY `full_text` (`full_text`);

--
-- Indexes for table `node_field_cat`
--
ALTER TABLE `node_field_cat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eid` (`eid`),
  ADD KEY `value` (`value`);

--
-- Indexes for table `node_field_images`
--
ALTER TABLE `node_field_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `node_field_tags`
--
ALTER TABLE `node_field_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`eid`),
  ADD KEY `value` (`value`);

--
-- Indexes for table `node_field_title`
--
ALTER TABLE `node_field_title`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eid` (`eid`);
ALTER TABLE `node_field_title` ADD FULLTEXT KEY `full_text` (`full_text`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `type` (`contentModel`),
  ADD KEY `name_2` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`email`,`phone`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `user_field_roles`
--
ALTER TABLE `user_field_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid_2` (`eid`,`value`),
  ADD KEY `uid` (`eid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `node`
--
ALTER TABLE `node`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `node_field_body`
--
ALTER TABLE `node_field_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `node_field_cat`
--
ALTER TABLE `node_field_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `node_field_images`
--
ALTER TABLE `node_field_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `node_field_tags`
--
ALTER TABLE `node_field_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `node_field_title`
--
ALTER TABLE `node_field_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `term`
--
ALTER TABLE `term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `user_field_roles`
--
ALTER TABLE `user_field_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
