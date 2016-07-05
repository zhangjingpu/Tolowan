-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-05 13:27:12
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

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

--
-- 转存表中的数据 `node`
--

INSERT INTO `node` (`id`, `state`, `contentModel`, `created`, `changed`, `uid`, `comment`, `top`, `essence`, `hot`, `love`, `browse`, `comment_num`) VALUES
(2, 1, 'article', 1467638278, 1467638278, 0, 0, 0, 0, 0, 0, 0, 0);

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

--
-- 转存表中的数据 `node_field_body`
--

INSERT INTO `node_field_body` (`id`, `eid`, `value`, `full_text`) VALUES
(2, 2, '<p>Tolowan</p>\n\n<p>是基于Phalcon开发的内容管理系统。ps：现在程序并未完善，仅供把玩，请勿用于生产环境 特性：</p>\n\n<blockquote>\n<ul>\n	<li>继承Phalcon框架全功能</li>\n	<li>多网站支持，异站点用户文件、同网站私有/共有网站隔离</li>\n	<li>强大的个性化环境，每个用户可以对网站内容和表现形式进行个性化设置</li>\n	<li>基于用户角色、模块、角色的权限控制系统，当然，您也可以通过回调函数进行更精细控制</li>\n	<li>提供的站内搜索系统原生支持全文搜索。</li>\n	<li>使用volt编写主题模板，类twig语法，单比twig更高效</li>\n	<li>Tolowan提供的实体管理、字段管理、表单管理、模型管理等机制，可以大大缩减二次开发的难度和所需时间</li>\n</ul>\n</blockquote>\n\n<hr />\n<h2>安装phalcon</h2>\n\n<p>前往phalcon官网按步骤安装phalcon扩展：<a href="https://phalconphp.com/zh/download">https://phalconphp.com/zh/download</a></p>\n\n<h2>安装Tolowan</h2>\n\n<p>下载安装包解压至web目录</p>\n\n<h3>1. 修改site.php文件</h3>\n\n<p>编辑siteroot/Web/site.php文件，将需要绑定的域名根据文件中格式录入</p>\n\n<h3>2. 复制public目录</h3>\n\n<p>例如在第一步中，我们录入的域名为：baidu.com -&gt; Baidu ,我们则需要将siteroot/public目录复制为siteroot/Baidu 注意：首字母必须未大写</p>\n\n<h3>3. 复制site/default目录</h3>\n\n<p>例如在第一步中，我们录入的域名为：baidu.com -&gt; Baidu ,我们则需要将siteroot/Web/default目录复制为siteroot/Web/Baidu 注意：首字母必须未大写</p>\n\n<h3>4. 绑定域名</h3>\n\n<p>根据上文设置，以apache服务器为例，需要进行如下设置</p>\n\n<pre>\n\nDocumentRoot siteroot/Baidu\nServerName baidu.com\n\n</pre>\n\n<blockquote>\n<p>注：其中上文中siteroot为程序目录所在地址，QQ交流群：574199144</p>\n</blockquote>\n', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `node_field_cat`
--

CREATE TABLE `node_field_cat` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `node_field_cat`
--

INSERT INTO `node_field_cat` (`id`, `eid`, `value`) VALUES
(2, 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `node_field_images`
--

CREATE TABLE `node_field_images` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `node_field_images`
--

INSERT INTO `node_field_images` (`id`, `eid`, `value`) VALUES
(1, 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `node_field_tags`
--

CREATE TABLE `node_field_tags` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `node_field_tags`
--

INSERT INTO `node_field_tags` (`id`, `eid`, `value`) VALUES
(2, 2, 3);

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

--
-- 转存表中的数据 `node_field_title`
--

INSERT INTO `node_field_title` (`id`, `eid`, `value`, `full_text`) VALUES
(2, 2, '欢迎使用Tolowan', NULL);

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

--
-- 转存表中的数据 `term`
--

INSERT INTO `term` (`id`, `name`, `description`, `parent`, `widget`, `other`, `contentModel`, `attach`) VALUES
(1, '未分类', '未分类', 0, 10, NULL, 'cat', NULL),
(3, 'phalcon', 'phalcon', 0, 10, NULL, 'tags', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `node_field_body`
--
ALTER TABLE `node_field_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `node_field_cat`
--
ALTER TABLE `node_field_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `node_field_images`
--
ALTER TABLE `node_field_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `node_field_tags`
--
ALTER TABLE `node_field_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `node_field_title`
--
ALTER TABLE `node_field_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `term`
--
ALTER TABLE `term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
