<section class="content-header">
    <h1>
        <?= $title ?>
        <small><?= $description ?></small>
        <a href="<?= $this->request->getURI() ?>" data-target="#main" class="label label-success arrowed"><i
                    class="fa fa-refresh"></i>&#12288;刷新页面</a>
    </h1> 
        <ol class="breadcrumb">
            <li><a data-target="#main" href="<?= $this->url->get(['for' => 'adminIndex']) ?>"><i class="fa fa-dashboard"></i>首页</a></li>
            <?php foreach ($breadcrumb as $item) { ?> <?php if (isset($item['href'])) { ?>
                <li><a data-target="#main" href="<?= $this->url->get($item['href']) ?>"><?= $item['name'] ?></a></li>
            <?php } else { ?>
                <li class="active"><?= $item['name'] ?></li>
            <?php } ?> <?php } ?>
        </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12"><?= $this->getContent() ?></div>
        <?= $this->view->r($content) ?>
    </div>
</section>
<?= $this->assets->output(null, null, 'footer') ?>