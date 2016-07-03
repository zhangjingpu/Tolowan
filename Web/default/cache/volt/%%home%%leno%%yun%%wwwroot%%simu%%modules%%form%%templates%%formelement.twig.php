<div id="form-element-<?php echo $formId; ?>" class="form-group<?php if ($hasError !== false) { ?> has-error<?php } ?>">
    <?php if ($layout == 'inline') { ?>
        <div class="input-group">
            <div class="input-group-addon"><?php echo $label; ?></div><?php echo $element; ?>
        </div>
    <?php } else { ?>
        <h5>
            <label><?php echo $label; ?></label><small>&nbsp;&nbsp;<i class="fa fa-fw fa-hand-o-right"></i>&nbsp;&nbsp;<?php echo $description; ?>
            </small>
        </h5> <?php echo $element; ?>
    <?php } ?>
</div>
