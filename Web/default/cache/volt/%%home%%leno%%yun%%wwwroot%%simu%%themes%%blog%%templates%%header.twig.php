<!-- banner -->
<div class="banner" style="background: url(/themes/blog/images/banner3.jpg);">
    <!-- header -->
    <div class="header container">
        <!--个人信息-->
        <div class="row">
            <div class="col-md-12">
                <div class="personInfo">
                    <div class="logo">
                        <a href="/">
                            <img src="<?php echo $coreConfig->logo; ?>" alt="logo">
                        </a>
                    </div>
                    <div class="logoTheme">
                        <h1><?php echo $coreConfig->name; ?></h1>
                        <h3><?php echo $coreConfig->description; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav id="navigation" class="col-md-12 hidden-xs">
        <?php echo $this->view->r(menuRender('main')); ?>
    </nav>
</div>