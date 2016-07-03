<div class="col-xs-12">
	<?php foreach ($cacheList as $value) { ?>
		<a class="btn btn-block btn-primary" data-target="#main" href="<?= $this->url->get($value['href']) ?>"><b><?= $value['name'] ?></b></a>
		<div class="space-8"></div>
	<?php } ?>
</div>