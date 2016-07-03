<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <small><?php echo $description; ?></small>
        <a href="<?php echo $this->request->getURI(); ?>" data-target="#main" class="label label-success arrowed"><i
                    class="fa fa-refresh"></i>&#12288;刷新页面</a>
    </h1> 
        <ol class="breadcrumb">
            <li><a data-target="#main" href="<?php echo $this->url->get(array('for' => 'adminIndex')); ?>"><i class="fa fa-dashboard"></i>首页</a></li>
            <?php foreach ($breadcrumb as $item) { ?> <?php if (isset($item['href'])) { ?>
                <li><a data-target="#main" href="<?php echo $this->url->get($item['href']); ?>"><?php echo $item['name']; ?></a></li>
            <?php } else { ?>
                <li class="active"><?php echo $item['name']; ?></li>
            <?php } ?> <?php } ?>
        </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12"><?php echo $this->getContent(); ?></div>
        <?php echo $this->view->r($content); ?>
    </div>
</section>
<?php echo $this->assets->output(null, null, 'footer'); ?>