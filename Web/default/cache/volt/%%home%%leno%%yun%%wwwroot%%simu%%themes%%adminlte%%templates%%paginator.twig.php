<ul class="pagination">
    <li class="paginate_button previous disabled"><a href="#" data-dt-idx="0" tabindex="0">共 <?php echo $data->total_pages; ?> 页</a></li>
    <?php $rt = $router_params; ?>
    <?php $rt['for'] = $this->router->getMatchedRoute()->getName(); ?>
    <?php foreach (paginator($data->total_pages, $data->current, 4) as $key => $value) { ?>
        <?php $rt['page'] = $value; ?>
        <li class="paginate_button<?php if ($key == $data->current) { ?> active<?php } ?>"><a data-target="#main" href="<?php echo $this->url->get($rt); ?>"><?php echo $key; ?></a></li>
    <?php } ?>

</ul>