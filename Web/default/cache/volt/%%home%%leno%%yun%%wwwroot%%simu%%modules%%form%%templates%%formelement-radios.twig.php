<div id="form-element-<?php echo $formId; ?>" class="form-group">
    <h5>
        <label><?php echo $label; ?></label>
        <small class="help-block inline">&nbsp;&nbsp;<i
                    class="icon-double-angle-right"></i>&nbsp;&nbsp;<?php echo $description; ?>
        </small>
    </h5>
    <div class="clear"></div>
    <?php $default = $element->getDefault(); ?>
    <?php $v87627771265191969621iterator = $element->getOptions(); $v87627771265191969621incr = 0; $v87627771265191969621loop = new stdClass(); $v87627771265191969621loop->length = count($v87627771265191969621iterator); $v87627771265191969621loop->index = 1; $v87627771265191969621loop->index0 = 1; $v87627771265191969621loop->revindex = $v87627771265191969621loop->length; $v87627771265191969621loop->revindex0 = $v87627771265191969621loop->length - 1; ?><?php foreach ($v87627771265191969621iterator as $key => $value) { ?><?php $v87627771265191969621loop->first = ($v87627771265191969621incr == 0); $v87627771265191969621loop->index = $v87627771265191969621incr + 1; $v87627771265191969621loop->index0 = $v87627771265191969621incr; $v87627771265191969621loop->revindex = $v87627771265191969621loop->length - $v87627771265191969621incr; $v87627771265191969621loop->revindex0 = $v87627771265191969621loop->length - ($v87627771265191969621incr + 1); $v87627771265191969621loop->last = ($v87627771265191969621incr == ($v87627771265191969621loop->length - 1)); ?>
        <div class="input-group pull-left<?php if ($v87627771265191969621loop->last == false) { ?> margin-right-15<?php } ?>">
                <input<?php if ($default == $key) { ?> checked="true"<?php } ?> type="radio" name="<?php echo $element->getName(); ?>"
                                                                        value="<?php echo $key; ?>"><label><?php echo $value; ?></label>
        </div>
    <?php $v87627771265191969621incr++; } ?>
</div>
<div class="clear"></div>
