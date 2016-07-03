<?php $this->_macros['adminMenu'] = function($__p = null) { if (isset($__p[0])) { $data = $__p[0]; } else { if (isset($__p["data"])) { $data = $__p["data"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'adminMenu' was called without parameter: data");  } } if (isset($__p[1])) { $h = $__p[1]; } else { if (isset($__p["h"])) { $h = $__p["h"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'adminMenu' was called without parameter: h");  } }  ?>
  <ul class="treeview-menu">
    <?php foreach ($h as $key => $value) { ?>
      <?php if ($key == $value) { ?>
        <li><a data-target="#main" href="<?= $this->url->get($data[$key]['href']) ?>"><?php if (isset($data[$key]['icon'])) { ?><i class="<?= $data[$key]['icon'] ?>"></i><?php } ?><span><?= $data[$key]['name'] ?></span></a></li>
      <?php } elseif (is_array($value) == true) { ?>
        <li><a href="#"><?php if (isset($data[$key]['icon'])) { ?><i class="<?= $data[$key]['icon'] ?>"></i><?php } ?><span><?= $data[$key]['name'] ?></span><i class="fa fa-angle-left pull-right"></i></a>
        <?= $this->callMacro('adminMenu', [$data, $value]) ?>
        </li>
      <?php } ?>
    <?php } ?>
  </ul><?php }; $this->_macros['adminMenu'] = \Closure::bind($this->_macros['adminMenu'], $this); ?>
<ul class="sidebar-menu">
  <?php foreach ($hierarchy as $key => $value) { ?>
      <?php if ($key == $value) { ?>
        <li><a data-target="#main" href="<?= $this->url->get($data[$key]['href']) ?>"><?php if (isset($data[$key]['icon'])) { ?><i class="<?= $data[$key]['icon'] ?>"></i><?php } ?><span><?= $data[$key]['name'] ?></span></a></li>
      <?php } elseif (is_array($value) == true) { ?>
        <li><a href="#<?= $this->url->get($data[$key]['href']) ?>"><?php if (isset($data[$key]['icon'])) { ?><i class="<?= $data[$key]['icon'] ?>"></i><?php } ?><span><?= $data[$key]['name'] ?></span><i class="fa fa-angle-left pull-right"></i></a>
        <?= $this->callMacro('adminMenu', [$data, $value]) ?>
        </li>
      <?php } ?>
    <?php } ?>
</ul>
