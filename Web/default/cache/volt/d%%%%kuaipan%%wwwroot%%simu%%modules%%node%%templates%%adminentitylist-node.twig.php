<div class="col-xs-12 dataTables_wrapper">
    <?php if (isset($handleForm) && $handleForm) { ?>
    <form class="form-inline" ajax-submit="#main" accept-charset="utf-8" method="post"
          action="<?= $url ?>">
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
            <?php $v16292041691iterated = false; ?><?php foreach ($data->items as $item) { ?><?php $v16292041691iterated = true; ?>
                <tr class="tr-<?= $item->id ?>">
                    <td class="center">
                        <input type="checkbox" class="checkAll" name="checkAll[<?= $item->id ?>]"> <span
                                class="lbl"></span>
                    </td>
                    <td class="center"><?= $item->id ?></td>
                    <td class="center"><a href="<?= $this->url->get(['for' => 'entity', 'entity' => 'node', 'id' => $item->id]) ?>"
                                          data-toggle="tooltip" target="_blank" data-placement="right"
                                          title="访问<?= $item->title ?>"><?= $item->title ?></a></td>
                    <td class="center"><a data-target="#main" href="<?= $url ?>?type=<?= $item->contentModel ?>"
                                          data-toggle="tooltip" target="_blank" data-placement="right"
                                          title="只查看类型文章"><?= getVar($item, 'contentModel') ?></a></td>
                    <td class="center"><?php if ($item->uid) { ?><a data-target="#main" href="<?= $url ?>?uid=<?= $item->uid ?>" data-toggle="tooltip"
                                          target="_blank" data-placement="right"
                                          title="只查看该用户文章"><?= $item->getEntity('uid')->name ?></a><?php } else { ?>匿名用户<?php } ?></td>
                    <td class="center"><a data-target="#main" href="<?= $url ?>?state=<?= $item->state ?>"
                                          data-toggle="tooltip" target="_blank" data-placement="right"
                                          title="只查看<?= getVar($item, 'state') ?>文章"><?= getVar($item, 'state') ?></a></td>
                    <td class="center"><?= $item->top ?></td>
                    <td class="center"><?= $item->hot ?></td>
                    <td class="center"><?= $item->essence ?></td>
                    <td class="center"><?= $item->created ?></td>
                    <td class="center"><?= $item->changed ?></td>
                    <td class="center">
                        <?php foreach ($item->links() as $key => $link) { ?>
                            <a href="<?= $this->url->get($link['href']) ?>" class="btn btn-xs btn-<?= $link['icon'] ?>"
                               data-target="#main"><?= $link['name'] ?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } if (!$v16292041691iterated) { ?>
                <tr>
                    <td colspan="7">没有数据</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="space-4"></div>
        <?php if (isset($handleForm) && $handleForm) { ?>
        <i>选中文章：</i>
        <?php foreach ($handleForm->getElements() as $key => $value) { ?> <?= $this->view->r($handleForm->renderElement($key)) ?> <?php } ?>
        <?= $handleForm->csrf() ?>
        <input type="hidden" name="<?= $handleForm->formId ?>" value="<?= $handleForm->formId ?>">
        <button type="submit" class="btn btn-xs btn-success" value="recycle">提交</button>
    </form>
    <?php } ?>
    <div class="space-8"></div>
    <?= $this->partial('Themes/AdminLTE/templates/paginator') ?>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>