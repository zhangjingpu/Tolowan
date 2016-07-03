<?php echo $data->start(); ?>
<?php if ($layout == 'inline') { ?>
    <label><?php echo $formName; ?></label>
<?php } ?>
<div class="input-group">
    <?php foreach ($data->formEntity as $key => $value) { ?><?php if (isset($value['widget'])) { ?> <?php echo $this->view->r($data->renderElement($key)); ?> <?php } ?> <?php } ?>
    <span class="input-group-btn">
            <button type="submit" class="btn btn-default">搜索</button>
    </span>
</div>
</form>
<script type="text/javascript">
    $('#nodeAdd').validate({
        validClass: "has-success",
    });
</script>
