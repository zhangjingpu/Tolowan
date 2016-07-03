<footer>
    <div class="main-footer">
        <div class="container">
            <div class="row footrow">
                <div class="col-md-3">
                    <div class="widget catebox">
                        <h4 class="title">分类目录</h4>
                        <ul class="box category clearfix">
                            <?php foreach (termList(15, 'cat') as $item) { ?>
                            <li class="cat-item cat-item-2"><a href="<?php echo $this->url->get(array('for' => 'term', 'id' => $item->id, 'page' => 1)); ?>" ><?php echo $item->name; ?></a></li>
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
                                <li><a href='<?php echo $this->url->get(array('for' => 'term', 'id' => $item->id, 'page' => 1)); ?>' title='<?php echo $item->name; ?>' class='wordpress'><?php echo $item->name; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget linkbox">
                        <h4 class="title">友情链接</h4>
                        <div class="box friend-links clearfix">
                            <?php echo $this->view->r(menuRender('blogroll')); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="widget contactbox">
                        <h4 class="title">联系我们</h4>
                        <ul class="contact-us clearfix">
                            <li><a href="tencent://message/?uin=1453767261&amp;Meu=yes">
                                    <i class="fa fa-qq"></i><?php echo $coreConfig->tel; ?></a></li>
                            <li><a href="/"><i class="fa fa-weibo"></i><?php echo $coreConfig->name; ?></a></li>
                            <li>
                                <a href="http://jq.qq.com/?_wv=1027&k=2EkiiEz" title="web技术交流群"><i class="fa fa-users"></i><?php echo $coreConfig->email; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="copyright">
                    <span>Copyright &copy; <a href="http://vinceok.com"><?php echo $coreConfig->name; ?></a>&nbsp;&nbsp;</span>
                    <span><?php echo $coreConfig->icp; ?></span>
                    <!-- <span class="hidden-xs">Theme by <a href="http://www.loobo.me">主题笔记</a> & <a href="http://vinceok.com">醉清风博客</a></span> -->
                    <a href="tencent://message/?uin=1453767261&Site=121ask.com&Meu=yes" class="kefu pull-right hidden-xs"><i class="fa fa-qq"></i>在线联系我</a>
                </div>
            </div>
        </div>
    </div>
</footer>