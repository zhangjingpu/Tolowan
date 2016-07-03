<div id="form-element-<?= $formId ?>" class="form-group<?php if ($hasError !== false) { ?> has-error<?php } ?>">
    <?php if ($layout == 'inline') { ?>
        <div class="input-group">
            <div class="input-group-addon"><?= $label ?></div><?= $element ?>
        </div>
    <?php } else { ?>
        <h5>
            <label><?= $label ?></label><small>&nbsp;&nbsp;<i class="fa fa-fw fa-hand-o-right"></i>&nbsp;&nbsp;<?= $description ?>
            </small>
        </h5> <?= $element ?>
    <?php } ?>
</div>
