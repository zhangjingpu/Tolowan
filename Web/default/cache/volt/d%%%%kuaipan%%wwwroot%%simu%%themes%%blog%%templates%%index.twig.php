<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <title><?= $title ?> </title>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="/themes/blog/style.css"/>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <meta name="keywords" content="<?= $coreConfig->indexDescription ?>"/>
    <meta name="description" content="<?= $coreConfig->indexKeywords ?>"/>
    
</head>
<body>

<!-- banner -->
<div class="banner" style="background: url(/themes/blog/images/banner3.jpg);">
    <!-- header -->
    <div class="header container">
        <!--个人信息-->
        <div class="row">
            <div class="col-md-12">
                <div class="personInfo">
                    <div class="logo">
                        <a href="/">
                            <img src="<?= $coreConfig->logo ?>" alt="logo">
                        </a>
                    </div>
                    <div class="logoTheme">
                        <h1><?= $coreConfig->name ?></h1>
                        <h3><?= $coreConfig->description ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav id="navigation" class="col-md-12 hidden-xs">
        <?= $this->view->r(menuRender('main')) ?>
    </nav>
</div>
<!--文章列表-->
<div class="articleList container">
    <div class="row">
        <div class="col-md-8">
            <?= $this->getContent() ?>
            
    <!--single article-->
    <?php foreach (entity_list('node', ['limit' => 10]) as $item) { ?>
        <div class="article">
            <div class="articleHeader">
                <h1 class="articleTitle">
                    <a href="<?= $this->url->get(['for' => 'node', 'id' => $item->id]) ?>"><?= $item->title ?></a>
                </h1>
            </div>
            <div class="articleBody clearfix">
                <!--缩略图-->
                <div class="articleThumb">
                    <a href="<?= $this->url->get(['for' => 'node', 'id' => $item->id]) ?>">
                        <img src="<?php if (isset($item->images) && $item->images) { ?><?= $item->images ?><?php } else { ?>/themes/blog/images/<?= rand(1, 11) ?>.jpg<?php } ?>" alt="<?= $item->title ?>" class="wp-post-image" width="400" height="200"/>
                    </a>
                </div>
                <!--摘要-->
                <div class="articleFeed">
                    <p><?= $item->body ?></p>
                </div>
            </div>
            <div class="articleFooter clearfix">
                <ul class="articleStatu">
                    <li><i class="fa fa-calendar"></i><?= timeTran($item->changed) ?></li>
                    <li><i class="fa fa-eye"></i><?= $item->browse ?>次浏览</li>
                    <li>
                        <i class="fa fa-folder-o"></i>
                        <?php if (isset($item->cat) && $item->cat) { ?>
                            <a href="<?= $this->url->get(['for' => 'term', 'id' => $item->term->id, 'page' => 1]) ?>" rel="category tag"><?= $item->term->name ?></a>
                        <?php } ?>
                    </li>
                </ul>
                <a href="<?= $this->url->get(['for' => 'node', 'id' => $item->id]) ?>" class="btn btn-readmore btn-info btn-md">阅读更多</a>
            </div>
        </div>
        <!--single article-->
    <?php } ?>

        </div>
        <div class="col-md-4 right-region">
            
    <section class="widget">
    <div style="background-color:#262627; background-image:url(/themes/blog/images/bj.jpg);background-size:100% "
            class="widget-tops" id="user-tool">
        <h4 style=" color:#fff">
            <?php if ($this->user->isLogin() === false) { ?>
                需要登录才能进入会员中心
            <?php } else { ?>
                <?= $this->user->name ?>，现在是早上。
                <a href="<?= $this->url->get(['for' => 'logout']) ?>">登出</a>
            <?php } ?>
        </h4>
        <p>
            <?php if ($this->user->isLogin() !== true) { ?>
                <a class="btn btn-primary signin-loader" href="<?= $this->url->get(['for' => 'login']) ?>">立即登录</a>
                <a class="btn btn-default signup-loader" href="<?= $this->url->get(['for' => 'register']) ?>">现在注册</a>
            <?php } else { ?>
                <a class="btn btn-primary signin-loader" href="<?= $this->url->get(['for' => 'userManager']) ?>">用户中心</a>
                <?php if ($this->user->isAdmin() == true) { ?>
                    <a class="btn btn-default signup-loader" href="<?= $this->url->get(['for' => 'adminFrame']) ?>">管理后台</a>
                <?php } ?>
            <?php } ?>
        </p>
    </div>
</section>
<section id="search-2" class="widget widget_search">
    <?= $this->view->r(formRender('search.searchForm')) ?>
</section>
<section class="widget">
    <h3 class="widget-title"><span class="cat">最新文章</span></h3>
    <div class="list-group node-list">
         <?php foreach (entity_list('node', ['limit' => 7]) as $item) { ?>
        <a target="_blank" title="<?= $item->title ?>" href="<?= $this->url->get(['for' => 'node', 'id' => $item->id]) ?>">
            <div class="time">
                <span class="r"><?= date('d', $item->changed) ?></span>/
                <span class="y"><?= date('m', $item->changed) ?>月</span>
            </div>
            <div class="node"><?= $item->title ?></div>
        </a>
    <?php } ?>
    </div>
</section>
<section class="widget">
    <h3 class="widget-title"><span class="cat">最近评论</span></h3>
    <div class="list-group comment-list">
         <?php foreach (entity_list('comment', ['limit' => 7]) as $item) { ?>
        <a target="_blank" title="<?= $item->node->title ?>" href="<?= $this->url->get(['for' => 'node', 'id' => $item->nid]) ?>">
            <img alt="<?= $item->user->name ?>"
                    src="http://vince.qiniudn.com/wp-content/uploads/2016/04/Screenshot.png?imageView2/2/w/400/h/200">
            <p><strong><?= $item->user->name ?>：</strong><?= $item->body ?></p>
        </a>
    <?php } ?>
    </div>
</section>
<section class="widget">
    <h3 class="widget-title"><span class="cat">分类导航</span></h3>
    <div class="term-list">
         <?php foreach (termList(15) as $item) { ?>
        <a target="_blank" title="<?= $item->name ?>" href="<?= $this->url->get(['for' => 'term', 'id' => $item->id, 'page' => 1]) ?>"><?= $item->name ?></a>
        <?php } ?>
    </div>
</section>


        </div>
    </div>
</div>
<!--footer-->
<footer>
    <div class="main-footer">
        <div class="container">
            <div class="row footrow">
                <div class="col-md-3">
                    <div class="widget catebox">
                        <h4 class="title">分类目录</h4>
                        <ul class="box category clearfix">
                            <?php foreach (termList(15, 'cat') as $item) { ?>
                            <li class="cat-item cat-item-2"><a href="<?= $this->url->get(['for' => 'term', 'id' => $item->id, 'page' => 1]) ?>" ><?= $item->name ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget tagbox">
                        <h4 class="title">文章标签</h4>
                        <div class="box tags clearfix">
                            <ul class="post_tags">
                                <?php foreach (termList(15, 'tags') as $item) { ?>
                                <li><a href='<?= $this->url->get(['for' => 'term', 'id' => $item->id, 'page' => 1]) ?>' title='<?= $item->name ?>' class='wordpress'><?= $item->name ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget linkbox">
                        <h4 class="title">友情链接</h4>
                        <div class="box friend-links clearfix">
                            <?= $this->view->r(menuRender('blogroll')) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="widget contactbox">
                        <h4 class="title">联系我们</h4>
                        <ul class="contact-us clearfix">
                            <li><a href="tencent://message/?uin=1453767261&amp;Meu=yes">
                                    <i class="fa fa-qq"></i><?= $coreConfig->tel ?></a></li>
                            <li><a href="/"><i class="fa fa-weibo"></i><?= $coreConfig->name ?></a></li>
                            <li>
                                <a href="http://jq.qq.com/?_wv=1027&k=2EkiiEz" title="web技术交流群"><i class="fa fa-users"></i><?= $coreConfig->email ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="copyright">
                    <span>Copyright &copy; <a href="http://vinceok.com"><?= $coreConfig->name ?></a>&nbsp;&nbsp;</span>
                    <span><?= $coreConfig->icp ?></span>
                    <!-- <span class="hidden-xs">Theme by <a href="http://www.loobo.me">主题笔记</a> & <a href="http://vinceok.com">醉清风博客</a></span> -->
                    <a href="tencent://message/?uin=1453767261&Site=121ask.com&Meu=yes" class="kefu pull-right hidden-xs"><i class="fa fa-qq"></i>在线联系我</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<a class="to-top">
    <span class="topicon"><i class="fa fa-angle-up"></i></span>
    <span class="toptext">Top</span>
</a>

<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="/themes/blog/js/jquery.toTop.min.js"></script>
<script src="/themes/blog/js/menu.js"></script>
<?= $this->assets->output(null, null, 'footer') ?>
<script>
    $('.to-top').toTop({
        position: false,
        offset: 1000,
    });
</script>

</body>

</html>