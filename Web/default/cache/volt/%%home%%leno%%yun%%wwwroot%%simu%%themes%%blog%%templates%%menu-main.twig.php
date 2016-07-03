<?php $this->_macros['main_menu'] = function($__p = null) { if (isset($__p[0])) { $data = $__p[0]; } else { if (isset($__p["data"])) { $data = $__p["data"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'main_menu' was called without parameter: data");  } } if (isset($__p[1])) { $hierarchy = $__p[1]; } else { if (isset($__p["hierarchy"])) { $hierarchy = $__p["hierarchy"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'main_menu' was called without parameter: hierarchy");  } }  ?>
    <?php foreach ($hierarchy as $key => $value) { ?>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category">
            <a href="<?php echo $this->url->get($data[$key]['href']); ?>"><?php echo $data[$key]['name']; ?>
                <?php if ($key != $value) { ?>
                    <i aria-hidden="true" class="icon-caret-down"></i>
                <?php } ?>
            </a>
            <?php if ($key != $value) { ?>
                <div class="submenu js-submenu" id="nav-platform-submenu">
                    <div class="submenu-column">
                        <ul>
                            <?php echo $this->callMacro('main_menu', array($data, $value)); ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </li>
    <?php } ?><?php }; $this->_macros['main_menu'] = \Closure::bind($this->_macros['main_menu'], $this); ?>
<ul id="" class="nav nav-pills container">
<?php echo $this->callMacro('main_menu', array($data, $hierarchy)); ?>
</ul>