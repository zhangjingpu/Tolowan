<?php if ($wrapper == true) { ?>
<div class="col-sm-<?= $size ?>"<?php if (isset($id)) { ?> id="<?= $id ?>"<?php } ?>>
<?php } ?>
    <div class="box box-<?= $color ?>">
        <?php if (!isset($hiddenTitle)) { ?>
        <div class="box-header with-border">
            <h3 class="box-title"><?= $title ?></h3>
        </div>
        <?php } ?>
        <!-- /.box-header -->
        <div class="box-body">
            <?= $this->view->r($content) ?>
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer-->
    </div>
<?php if ($wrapper == true) { ?>
</div>
<?php } ?>