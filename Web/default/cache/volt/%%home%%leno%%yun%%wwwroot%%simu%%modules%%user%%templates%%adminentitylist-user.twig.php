<div class="col-xs-12 dataTables_wrapper">
    <?php if (isset($handleForm) && $handleForm) { ?>
    <form class="form-inline" ajax-submit="#main" accept-charset="utf-8" method="post"
          action="<?php echo $handleForm->getAction(); ?>">
        <?php } ?>
        <table class="table table-striped table-bordered table-hover" id="sample-table-1">
            <thead>
            <tr>
                <th class="center">
                    <input type="checkbox" class="checkAll" name="checkAll"> <span class="lbl"></span>
                </th>
                <th class="center">ID</th>
                <th class="center">用户名</th>
                <th class="center">角色</th>
                <th class="center">状态</th>
                <th class="center">创建时间</th>
                <th class="center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php $v135219843821835144711iterated = false; ?><?php foreach ($data->items as $item) { ?><?php $v135219843821835144711iterated = true; ?>
                <tr class="tr-<?php echo $item->id; ?>">
                    <td class="center">
                        <input type="checkbox" class="checkAll" name="checkAll[<?php echo $item->id; ?>]"> <span
                                class="lbl"></span>
                    </td>
                    <td class="center"><?php echo $item->id; ?></td>
                    <td class="center">
                        <a href="<?php echo $this->url->get(array('for' => 'entity', 'entityName' => 'user', 'id' => $item->id)); ?>" data-toggle="tooltip"
                           target="_blank" data-placement="right" title="访问<?php echo getVar($item, 'label'); ?>主页">
                            <?php echo getVar($item, 'label'); ?>
                        </a>
                    </td>
                    <td class="center">
                        <?php $v135219843821835144712iterator = $item->roles; $v135219843821835144712incr = 0; $v135219843821835144712loop = new stdClass(); $v135219843821835144712loop->length = count($v135219843821835144712iterator); $v135219843821835144712loop->index = 1; $v135219843821835144712loop->index0 = 1; $v135219843821835144712loop->revindex = $v135219843821835144712loop->length; $v135219843821835144712loop->revindex0 = $v135219843821835144712loop->length - 1; ?><?php foreach ($v135219843821835144712iterator as $role) { ?><?php $v135219843821835144712loop->first = ($v135219843821835144712incr == 0); $v135219843821835144712loop->index = $v135219843821835144712incr + 1; $v135219843821835144712loop->index0 = $v135219843821835144712incr; $v135219843821835144712loop->revindex = $v135219843821835144712loop->length - $v135219843821835144712incr; $v135219843821835144712loop->revindex0 = $v135219843821835144712loop->length - ($v135219843821835144712incr + 1); $v135219843821835144712loop->last = ($v135219843821835144712incr == ($v135219843821835144712loop->length - 1)); ?>
                            <a data-target="#main" href="<?php echo $url; ?>?roles=<?php echo $role->value; ?>" data-toggle="tooltip"
                               target="_blank"
                               data-placement="right" title="只查看该用户文章"><?php echo $role->value; ?></a>
                            <?php if ($v135219843821835144712loop->last == false) { ?>，<?php } ?>
                        <?php $v135219843821835144712incr++; } ?>
                    </td>
                    <td class="center"><?php echo getVar($item, 'active'); ?></td>
                    <td class="center"><?php echo $item->created; ?></td>
                    <td class="center">
                        <?php $v135219843821835144712iterator = $item->links(); $v135219843821835144712incr = 0; $v135219843821835144712loop = new stdClass(); $v135219843821835144712loop->length = count($v135219843821835144712iterator); $v135219843821835144712loop->index = 1; $v135219843821835144712loop->index0 = 1; $v135219843821835144712loop->revindex = $v135219843821835144712loop->length; $v135219843821835144712loop->revindex0 = $v135219843821835144712loop->length - 1; ?><?php foreach ($v135219843821835144712iterator as $key => $link) { ?><?php $v135219843821835144712loop->first = ($v135219843821835144712incr == 0); $v135219843821835144712loop->index = $v135219843821835144712incr + 1; $v135219843821835144712loop->index0 = $v135219843821835144712incr; $v135219843821835144712loop->revindex = $v135219843821835144712loop->length - $v135219843821835144712incr; $v135219843821835144712loop->revindex0 = $v135219843821835144712loop->length - ($v135219843821835144712incr + 1); $v135219843821835144712loop->last = ($v135219843821835144712incr == ($v135219843821835144712loop->length - 1)); ?>
                            <a href="<?php echo $this->url->get($link['href']); ?>" class="btn btn-xs btn-<?php echo $link['icon']; ?>"
                               data-target="#main"><?php echo $link['name']; ?></a>
                        <?php $v135219843821835144712incr++; } ?>
                    </td>
                </tr>
            <?php } if (!$v135219843821835144711iterated) { ?>
                <tr>
                    <td colspan="7">没有数据</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="space-4"></div>
        <?php if (isset($handleForm) && $handleForm) { ?>
        <i>选中文章：</i>
        <?php foreach ($handleForm->getElements() as $key => $value) { ?> <?php echo $this->view->r($handleForm->renderElement($key)); ?> <?php } ?>
        <?php echo $handleForm->csrf(); ?>
        <input type="hidden" name="<?php echo $handleForm->formId; ?>" value="<?php echo $handleForm->formId; ?>">
        <button type="submit" class="btn btn-xs btn-success" value="recycle">提交</button>
    </form>
    <?php } ?>
    <div class="space-8"></div>
    <?php echo $this->partial('Themes/AdminLTE/templates/paginator'); ?>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>