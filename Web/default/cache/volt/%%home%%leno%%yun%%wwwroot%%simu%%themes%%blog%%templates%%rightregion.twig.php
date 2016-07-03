<section class="widget">
    <div style="background-color:#262627; background-image:url(/themes/blog/images/bj.jpg);background-size:100% "
            class="widget-tops" id="user-tool">
        <h4 style=" color:#fff">
            <?php if ($this->user->isLogin() === false) { ?>
                需要登录才能进入会员中心
            <?php } else { ?>
                <?php echo $this->user->name; ?>，现在是早上。
                <a href="<?php echo $this->url->get(array('for' => 'logout')); ?>">登出</a>
            <?php } ?>
        </h4>
        <p>
            <?php if ($this->user->isLogin() !== true) { ?>
                <a class="btn btn-primary signin-loader" href="<?php echo $this->url->get(array('for' => 'login')); ?>">立即登录</a>
                <a class="btn btn-default signup-loader" href="<?php echo $this->url->get(array('for' => 'register')); ?>">现在注册</a>
            <?php } else { ?>
                <a class="btn btn-primary signin-loader" href="<?php echo $this->url->get(array('for' => 'userManager')); ?>">用户中心</a>
                <?php if ($this->user->isAdmin() == true) { ?>
                    <a class="btn btn-default signup-loader" href="<?php echo $this->url->get(array('for' => 'adminFrame')); ?>">管理后台</a>
                <?php } ?>
            <?php } ?>
        </p>
    </div>
</section>
<section id="search-2" class="widget widget_search">
    <?php echo $this->view->r(formRender('search.searchForm')); ?>
</section>
<section class="widget">
    <h3 class="widget-title"><span class="cat">最新文章</span></h3>
    <div class="list-group node-list">
         <?php foreach (entity_list('node', array('limit' => 7)) as $item) { ?>
        <a target="_blank" title="<?php echo $item->title; ?>" href="<?php echo $this->url->get(array('for' => 'node', 'id' => $item->id)); ?>">
            <div class="time">
                <span class="r"><?php echo date('d', $item->changed); ?></span>/
                <span class="y"><?php echo date('m', $item->changed); ?>月</span>
            </div>
            <div class="node"><?php echo $item->title; ?></div>
        </a>
    <?php } ?>
    </div>
</section>
<section class="widget">
    <h3 class="widget-title"><span class="cat">最近评论</span></h3>
    <div class="list-group comment-list">
         <?php foreach (entity_list('comment', array('limit' => 7)) as $item) { ?>
        <a target="_blank" title="<?php echo $item->node->title; ?>" href="<?php echo $this->url->get(array('for' => 'node', 'id' => $item->nid)); ?>">
            <img alt="<?php echo $item->user->name; ?>"
                    src="http://vince.qiniudn.com/wp-content/uploads/2016/04/Screenshot.png?imageView2/2/w/400/h/200">
            <p><strong><?php echo $item->user->name; ?>：</strong><?php echo $item->body; ?></p>
        </a>
    <?php } ?>
    </div>
</section>
<section class="widget">
    <h3 class="widget-title"><span class="cat">分类导航</span></h3>
    <div class="term-list">
         <?php foreach (termList(15) as $item) { ?>
        <a target="_blank" title="<?php echo $item->name; ?>" href="<?php echo $this->url->get(array('for' => 'term', 'id' => $item->id, 'page' => 1)); ?>"><?php echo $item->name; ?></a>
        <?php } ?>
    </div>
</section>
