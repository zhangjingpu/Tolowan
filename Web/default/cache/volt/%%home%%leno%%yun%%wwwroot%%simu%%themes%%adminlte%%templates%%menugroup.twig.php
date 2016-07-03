<div class="col-xs-12 dataTables_wrapper">
    <div class="margin">
        <div aria-label="Basic example" role="group" class="btn-group">
            <?php if (isset($title)) { ?>
                <button data-target="#main" class="btn btn-primary"><?php echo $title; ?></button>
            <?php } ?>
            <?php foreach ($data as $key => $value) { ?>
                <a class="btn btn-default <?php echo $key; ?>" href="<?php echo $this->url->get($value['href']); ?>"
                   data-target="#main"><?php echo $value['name']; ?></a>
            <?php } ?>
        </div>
    </div>
</div>