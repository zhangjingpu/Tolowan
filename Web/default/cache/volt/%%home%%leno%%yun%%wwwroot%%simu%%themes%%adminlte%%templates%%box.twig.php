<?php if ($wrapper == true) { ?>
<div class="col-sm-<?php echo $size; ?>"<?php if (isset($id)) { ?> id="<?php echo $id; ?>"<?php } ?>>
<?php } ?>
    <div class="box box-<?php echo $color; ?>">
        <?php if (!isset($hiddenTitle)) { ?>
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $title; ?></h3>
        </div>
        <?php } ?>
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo $this->view->r($content); ?>
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer-->
    </div>
<?php if ($wrapper == true) { ?>
</div>
<?php } ?>