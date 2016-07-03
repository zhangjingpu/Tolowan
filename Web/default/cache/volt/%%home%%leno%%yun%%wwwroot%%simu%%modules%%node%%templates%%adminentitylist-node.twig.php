<div class="col-xs-12 dataTables_wrapper">
    <?php if (isset($handleForm) && $handleForm) { ?>
    <form class="form-inline" ajax-submit="#main" accept-charset="utf-8" method="post"
          action="<?php echo $url; ?>">
        <?php } ?>
        <table class="table table-striped table-bordered table-hover" id="sample-table-1">
            <thead>
            <tr>
                <th class="center">
                    <input type="checkbox" class="checkAll" name="checkAll"> <span class="lbl"></span>
                </th>
                <th class="center">ID</th>
                <th class="center">内容</th>
                <th class="center">类型</th>
                <th class="center">用户</th>
                <th class="center">状态</th>
                <th class="center">置顶</th>
                <th class="center">热点</th>
                <th class="center">精华</th>
                <th class="center">创建时间</th>
                <th class="center">最近更改</th>
                <th class="center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php $v36625621899542025461iterated = false; ?><?php foreach ($data->items as $item) { ?><?php $v36625621899542025461iterated = true; ?>
                <tr class="tr-<?php echo $item->id; ?>">
                    <td class="center">
                        <input type="checkbox" class="checkAll" name="checkAll[<?php echo $item->id; ?>]"> <span
                                class="lbl"></span>
                    </td>
                    <td class="center"><?php echo $item->id; ?></td>
                    <td class="center"><a href="<?php echo $this->url->get(array('for' => 'entity', 'entity' => 'node', 'id' => $item->id)); ?>"
                                          data-toggle="tooltip" target="_blank" data-placement="right"
                                          title="访问<?php echo $item->title; ?>"><?php echo $item->title; ?></a></td>
                    <td class="center"><a data-target="#main" href="<?php echo $url; ?>?type=<?php echo $item->contentModel; ?>"
                                          data-toggle="tooltip" target="_blank" data-placement="right"
                                          title="只查看类型文章"><?php echo getVar($item, 'contentModel'); ?></a></td>
                    <td class="center"><?php if ($item->uid) { ?><a data-target="#main" href="<?php echo $url; ?>?uid=<?php echo $item->uid; ?>" data-toggle="tooltip"
                                          target="_blank" data-placement="right"
                                          title="只查看该用户文章"><?php echo $item->getEntity('uid')->name; ?></a><?php } else { ?>匿名用户<?php } ?></td>
                    <td class="center"><a data-target="#main" href="<?php echo $url; ?>?state=<?php echo $item->state; ?>"
                                          data-toggle="tooltip" target="_blank" data-placement="right"
                                          title="只查看<?php echo getVar($item, 'state'); ?>文章"><?php echo getVar($item, 'state'); ?></a></td>
                    <td class="center"><?php echo $item->top; ?></td>
                    <td class="center"><?php echo $item->hot; ?></td>
                    <td class="center"><?php echo $item->essence; ?></td>
                    <td class="center"><?php echo $item->created; ?></td>
                    <td class="center"><?php echo $item->changed; ?></td>
                    <td class="center">
                        <?php foreach ($item->links() as $key => $link) { ?>
                            <a href="<?php echo $this->url->get($link['href']); ?>" class="btn btn-xs btn-<?php echo $link['icon']; ?>"
                               data-target="#main"><?php echo $link['name']; ?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } if (!$v36625621899542025461iterated) { ?>
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