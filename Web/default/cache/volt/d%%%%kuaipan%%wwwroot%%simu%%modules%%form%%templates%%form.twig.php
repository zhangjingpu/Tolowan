<?= $data->start() ?>
<?php if ($layout == 'inline') { ?>
    <label><?= $formName ?></label>
<?php } ?>
<?php foreach ($data->formEntity as $key => $value) { ?><?php if (isset($value['widget'])) { ?> <?= $this->view->r($data->renderElement($key)) ?> <?php } ?> <?php } ?>
<div class="form-group">
    <button class="save_sort btn btn-success btn-block" type="submit">提交
    </button>
</div>
</form>
<div class="overlay">
    <i class="fa fa-refresh fa-spin"></i>
</div>
<script type="text/javascript">
    $('#nodeAdd').validate({
        validClass: "has-success",
    });
</script>
