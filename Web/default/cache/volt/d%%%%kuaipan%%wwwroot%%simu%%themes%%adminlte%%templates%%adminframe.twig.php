<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/themes/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/library/font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/library/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/themes/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/themes/AdminLTE/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= $this->url->get(['for' => 'adminFrame']) ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>后</b>台</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>管理</b>后台</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- /.search form -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-search"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li>
                                <!-- search form -->
                                <?= $this->view->r(formRender('search.adminSearchForm')) ?>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li><a href="/" target="_blank">访问前台首页</a></li>
                            <li>
                                <a href="#">退出</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">


            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?= $this->view->r($adminMenu) ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div id="main" class="content-wrapper">
        aaa
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.2
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">豫之旗</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Tab panes -->
    <div class="tab-content">
        <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">
            <div><h4 class="control-sidebar-heading">布局选项</h4>
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        <input type="checkbox" class="pull-right" data-layout="fixed">
                        冻结框架
                    </label>
                    <p>冻结表头始终在顶部、固定左侧边栏高度</p></div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        <input type="checkbox" class="pull-right" data-layout="layout-boxed">
                        窄屏
                    </label>
                    <p>切换到窄屏布局</p></div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        <input type="checkbox" class="pull-right" data-controlsidebar="control-sidebar-open">
                        冻结右边栏
                    </label>
                    <p>总是显示右侧设置边栏</p></div>
                <h4 class="control-sidebar-heading">皮肤</h4>
                <ul class="list-unstyled clearfix">
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-blue" href="javascript:void(0);">
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-light-blue"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p class="text-center no-margin">Blue</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-black" href="javascript:void(0);">
                            <div class="clearfix" style="box-shadow: 0 0 2px rgba(0,0,0,0.1)">
                                <span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #222;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p class="text-center no-margin">Black</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-purple" href="javascript:void(0);">
                            <div>
                                <span class="bg-purple-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-purple"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p class="text-center no-margin">Purple</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-green" href="javascript:void(0);">
                            <div>
                                <span class="bg-green-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-green"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p class="text-center no-margin">Green</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-red" href="javascript:void(0);">
                            <div>
                                <span class="bg-red-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-red"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p class="text-center no-margin">Red</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-yellow" href="javascript:void(0);">
                            <div>
                                <span class="bg-yellow-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-yellow"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p class="text-center no-margin">Yellow</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-blue-light" href="javascript:void(0);">
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-light-blue"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p style="font-size: 12px" class="text-center no-margin">Blue Light</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-black-light" href="javascript:void(0);">
                            <div class="clearfix" style="box-shadow: 0 0 2px rgba(0,0,0,0.1)">
                                <span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p style="font-size: 12px" class="text-center no-margin">Black Light</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-purple-light" href="javascript:void(0);">
                            <div>
                                <span class="bg-purple-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-purple"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p style="font-size: 12px" class="text-center no-margin">Purple Light</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-green-light" href="javascript:void(0);">
                            <div>
                                <span class="bg-green-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-green"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p style="font-size: 12px" class="text-center no-margin">Green Light</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-red-light" href="javascript:void(0);">
                            <div>
                                <span class="bg-red-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-red"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p style="font-size: 12px" class="text-center no-margin">Red Light</p></li>
                    <li style="float:left; width: 33.33333%; padding: 5px;">
                        <a class="clearfix full-opacity-hover" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" data-skin="skin-yellow-light" href="javascript:void(0);">
                            <div>
                                <span class="bg-yellow-active" style="display:block; width: 20%; float: left; height: 7px;"></span><span style="display:block; width: 80%; float: left; height: 7px;" class="bg-yellow"></span>
                            </div>
                            <div>
                                <span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                            </div>
                        </a>
                        <p style="font-size: 12px;" class="text-center no-margin">Yellow Light</p></li>
                </ul>
            </div>
        </div>
    </div>
</aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<div id="notice">没有消息</div>
<!-- ./wrapper -->
<link rel="stylesheet" href="/library/js/loadding-bar/css/loadingbar.css">
<link rel="stylesheet" href="/library/tabledrag/assets/jquery.tabledrag.css">
<link rel="stylesheet" href="/library/jQueryUI/jquery-ui.min.css">
<link rel="stylesheet" href="/library/date-time/datepicker.css">
<!-- jQuery 2.2.0 -->
<script src="/library/jquery/2.0.3/jquery.min.js"></script>
<!-- date-range-picker -->
<script src="//cdn.bootcss.com/moment.js/2.11.1/moment.min.js"></script>
<script src="//cdn.bootcss.com/moment.js/2.11.1/locale/zh-cn.js"></script>


<!-- jQuery UI 1.11.4 -->
<script src="/library/jquery.cookie/jquery.cookie.min.js"></script>
<script src="/library/jQueryUI/jquery-ui.min.js"></script>
<script src="/themes/AdminLTE/plugins/notice/notice.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript" src="/library/tabledrag/jquery.tabledrag.js"></script>
<script type="text/javascript" src="/library/js/loadding-bar/js/jquery.loadingbar.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="/themes/AdminLTE/bootstrap/js/bootstrap.min.js"></script>

<script src="/library/jquery/jquery_form_3_50/jquery.form.min.js"></script>
<script src="/library/jquery/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/library/jquery-validate/jquery.validate.js"></script>
<script type="text/javascript" src="/library/jquery-validate/localization/messages_zh.min.js"></script>
<script src="/themes/AdminLTE/dist/js/demo.js"></script>
<!-- AdminLTE App -->
<script src="/themes/AdminLTE/dist/js/app.min.js"></script>
<script src="/themes/AdminLTE/dist/js/js.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/themes/AdminLTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE for demo purposes -->
</body>
</html>
