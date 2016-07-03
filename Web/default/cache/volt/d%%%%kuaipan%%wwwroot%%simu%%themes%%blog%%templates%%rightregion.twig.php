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
