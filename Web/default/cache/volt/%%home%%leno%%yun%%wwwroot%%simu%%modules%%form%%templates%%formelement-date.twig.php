<div id="form-element-<?php echo $formId; ?>" class="form-group">
    <?php if ($layout == 'inline') { ?>
    <div class="input-group">
        <div class="input-group-addon"><?php echo $label; ?><i class="fa fa-calendar"></i></div><?php echo $element; ?>
    </div>
    <?php } else { ?>
    <h5>
        <label><?php echo $label; ?></label><small>&nbsp;&nbsp;<i
            class="fa fa-fw fa-hand-o-right"></i>&nbsp;&nbsp;<?php echo $description; ?>
        </small>
    </h5>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <?php echo $element; ?>
    </div>
    <?php } ?>
</div>
<div class="clear"></div>

<script type="text/javascript">

</script>