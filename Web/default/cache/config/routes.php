<?php $settings = array (
  'index' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'core',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminFrame' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/frame',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Frame',
      'module' => 'core',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminIndex' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/index',
    'paths' => 
    array (
      'module' => 'core',
      'controller' => 'Admin',
      'action' => 'Index',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminCache' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/cache/{handle:([a-z]{2,})}/{type:([a-z]{2,})}',
    'paths' => 
    array (
      'module' => 'core',
      'controller' => 'Admin',
      'action' => 'Cache',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminModules' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/module',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'Core',
      'action' => 'Modules',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminSecurity' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/security',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'Core',
      'action' => 'Security',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminModulesInstall' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/module/install/{module:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'Core',
      'action' => 'ModulesInstall',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminModulesUninstall' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/module/uninstall/{module:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'Core',
      'action' => 'ModulesUninstall',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminModulesEnable' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/module/enable/{module:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'Core',
      'action' => 'ModulesEnable',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminModulesDisable' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/module/disable/{module:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'Core',
      'action' => 'ModulesDisable',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminThemes' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/Themes',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'core',
      'action' => 'Themes',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminThemesEnable' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/themes/enable/{theme:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'core',
      'action' => 'ThemesEnable',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminThemesDisable' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/themes/disable/{theme:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'core',
      'action' => 'ThemesDisable',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminThemesInstall' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/themes/install/{theme:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'core',
      'action' => 'ThemesInstall',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminThemesUninstall' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/themes/uninstall/{theme:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'core',
      'action' => 'ThemesUninstall',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminThemesSetDefault' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/themes/setDefault/{theme:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'core',
      'action' => 'ThemesSetDefault',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'adminThemesUnsetDefault' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/themes/unsetDefault/{theme:([0-9a-zA-Z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'core',
      'action' => 'ThemesUnsetDefault',
      'namespace' => 'Modules\\Core\\Controllers',
    ),
  ),
  'term' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/taxonomy_term/{id}_{page}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Term',
      'module' => 'node',
      'namespace' => 'Modules\\Node\\Controllers',
    ),
  ),
  'node' => 
  array (
    'httpMethods' => 
    array (
      0 => 'GET',
      1 => 'POST',
    ),
    'pattern' => '/node/{id:([1-9]{1}[0-9]{0,11})}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'node',
      'namespace' => 'Modules\\Node\\Controllers',
    ),
  ),
  'nodeLove' => 
  array (
    'httpMethods' => 
    array (
      0 => 'GET',
      1 => 'POST',
    ),
    'pattern' => '/node_love/{id:([1-9]{1}[0-9]{0,11})}',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'node',
      'namespace' => 'Modules\\Node\\Controllers',
    ),
  ),
  'nodeType' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/node_type/{contentModel:([a-z]{2,})}_{page:([1-9]{1}[0-9]{0,11})}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Type',
      'module' => 'node',
      'namespace' => 'Modules\\Node\\Controllers',
    ),
  ),
  'adminConfig' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/config/list',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Config',
      'module' => 'config',
      'namespace' => 'Modules\\Config\\Controllers',
    ),
  ),
  'adminConfigEdit' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/config/edit/{contentModel:([a-zA-Z\\.\\-]{3,60})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'ConfigEdit',
      'module' => 'config',
      'namespace' => 'Modules\\Config\\Controllers',
    ),
  ),
  'adminConfigList' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/config_list/list/{contentModel:([a-zA-Z\\.\\-]{3,60})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'ConfigList',
      'module' => 'config',
      'namespace' => 'Modules\\Config\\Controllers',
    ),
  ),
  'adminConfigListEditor' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/config_list/editor/{contentModel:([a-zA-Z\\.\\-]{3,60})}/{id:([a-zA-Z\\-\\_]{2,50})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'ConfigListEditor',
      'module' => 'config',
      'namespace' => 'Modules\\Config\\Controllers',
    ),
  ),
  'adminConfigListDelete' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/config_list/delete/{contentModel:([a-zA-Z\\.\\-]{3,60})}/{id:([a-zA-Z\\-\\_]{1,20})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'ConfigListDelete',
      'module' => 'config',
      'namespace' => 'Modules\\Config\\Controllers',
    ),
  ),
  'searchSubmit' => 
  array (
    'httpMethods' => 'POST',
    'pattern' => '/search_submit',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'search',
      'namespace' => 'Modules\\Search\\Controllers',
    ),
  ),
  'search' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/search/{type}/{word}/{page}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Search',
      'module' => 'search',
      'namespace' => 'Modules\\Search\\Controllers',
    ),
  ),
  'adminSearchSubmit' => 
  array (
    'httpMethods' => 'POST',
    'pattern' => '/admin/search_submit',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'search',
      'action' => 'Index',
      'namespace' => 'Modules\\Search\\Controllers',
    ),
  ),
  'adminSearch' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/search/{type}/{word}/{page}.html',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'search',
      'action' => 'Search',
      'namespace' => 'Modules\\Search\\Controllers',
    ),
  ),
  'user' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/user/{id}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'userManager' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/user',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Manager',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'userCropImage' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/user/crop_image',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'cropImage',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'userCenterIndex' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/user_center/index',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'userCenter',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'remote' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/remote',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Remote',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'login' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/login.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Login',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'logout' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/logout.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Logout',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'password' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/password.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Password',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'register' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/register.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Register',
      'module' => 'user',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'adminUserEditor' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/user_editor/{id}',
    'paths' => 
    array (
      'module' => 'user',
      'controller' => 'Admin',
      'action' => 'Index',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'adminUserHandle' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/user_handle',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'user',
      'action' => 'Handle',
      'namespace' => 'Modules\\User\\Controllers',
    ),
  ),
  'queue' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/queue/{id:([0-9]{0,11})}',
    'paths' => 
    array (
      'module' => 'queue',
      'controller' => 'Index',
      'action' => 'Index',
      'namespace' => 'Modules\\Queue\\Controllers',
    ),
  ),
  'adminQueue' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/queue/list_{page:([1-9]{1}[0-9]{0,11})}',
    'paths' => 
    array (
      'module' => 'queue',
      'controller' => 'Admin',
      'action' => 'Index',
      'namespace' => 'Modules\\Queue\\Controllers',
    ),
  ),
  'adminQueueDelete' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/queue/delete_{id:([1-9]{1}[0-9]{0,11})}',
    'paths' => 
    array (
      'module' => 'queue',
      'controller' => 'Admin',
      'action' => 'Delete',
      'namespace' => 'Modules\\Queue\\Controllers',
    ),
  ),
  'adminRegionBlockSort' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/region_block_sort/{region}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Sort',
      'module' => 'region',
      'namespace' => 'Modules\\Region\\Controllers',
    ),
  ),
  'adminRegionBlockAddList' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/region_block/{region}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Index',
      'module' => 'region',
      'namespace' => 'Modules\\Region\\Controllers',
    ),
  ),
  'adminRegionBlockAdd' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/region_block_add/{region}/{contentModel}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Add',
      'module' => 'region',
      'namespace' => 'Modules\\Region\\Controllers',
    ),
  ),
  'adminRegionBlockEdit' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/region_block_edit/{region}/{contentModel}/{block}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Edit',
      'module' => 'region',
      'namespace' => 'Modules\\Region\\Controllers',
    ),
  ),
  'adminRegionBlockDelete' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/region_block_delete/{region}_{block}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'region',
      'action' => 'BlockDelete',
      'namespace' => 'Modules\\Region\\Controllers',
    ),
  ),
  'ckeditorUploade' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/ckeditor/upload_image',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'UploadImage',
      'module' => 'ckeditor',
      'namespace' => 'Modules\\Ckeditor\\Controllers',
    ),
  ),
  'ckeditorBrowseImage' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/ckeditor/browse_image',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'ckeditor',
      'namespace' => 'Modules\\Ckeditor\\Controllers',
    ),
  ),
  'ckeditorBrowseImageList' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/ckeditor/browse_image_list/{page:([1-9]{1}[0-9]{0,8})}',
    'paths' => 
    array (
      'controller' => 'Index',
      'module' => 'ckeditor',
      'action' => 'BrowseImageList',
      'namespace' => 'Modules\\Ckeditor\\Controllers',
    ),
  ),
  'autoTermJson' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/taxonomy/auto_term_json/{key:([a-zA-Z]{2,})}/{value:([a-zA-Z]{2,})}/{name}.json',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'autoTermJson',
      'module' => 'taxonomy',
      'namespace' => 'Modules\\Taxonomy\\Controllers',
    ),
  ),
  'adminTermList' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/taxonomy/term/{contentModel:([a-z\\-_]{2,})}/{page:([1-9]{1}[0-9]{0,9})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'taxonomy',
      'action' => 'Index',
      'namespace' => 'Modules\\Taxonomy\\Controllers',
    ),
  ),
  'adminTermEditor' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/term_editor/{id:([1-9]{1}[0-9]{0,9})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'taxonomy',
      'action' => 'Editor',
      'namespace' => 'Modules\\Taxonomy\\Controllers',
    ),
  ),
  'adminTermDelete' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/term_delete/{id}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'taxonomy',
      'action' => 'Delete',
      'namespace' => 'Modules\\Taxonomy\\Controllers',
    ),
  ),
  'adminFileManage' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/file_manage/{page:([1-9]{1}[0-9]{0,11})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Index',
      'module' => 'file',
      'namespace' => 'Modules\\File\\Controllers',
    ),
  ),
  'adminFileDelete' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/file_delete/{id}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'file',
      'action' => 'Delete',
      'namespace' => 'Modules\\File\\Controllers',
    ),
  ),
  'privateFile' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/private_file/{id:([1-9]{1}[0-9]{0,})}',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'file',
      'namespace' => 'Modules\\File\\Controllers',
    ),
  ),
  'imagesBoxList' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/images_box/list/{page:([1-9]{1}[0-9]{0,})}',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'ImagesBoxList',
      'module' => 'file',
      'namespace' => 'Modules\\File\\Controllers',
    ),
  ),
  'imagesBoxUpload' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/images_box/upload',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'ImagesBoxUpload',
      'module' => 'file',
      'namespace' => 'Modules\\File\\Controllers',
    ),
  ),
  'adminMenuLinkList' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/menu_link/{id}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Index',
      'module' => 'menu',
      'namespace' => 'Modules\\Menu\\Controllers',
    ),
  ),
  'adminMenuLinkAdd' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/menu_link_add/{id}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'menu',
      'action' => 'LinkAdd',
      'namespace' => 'Modules\\Menu\\Controllers',
    ),
  ),
  'adminMenuLinkEditor' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/menu_link_editor/{id:([a-z]{2,})}_{link:([a-z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'menu',
      'action' => 'LinkEditor',
      'namespace' => 'Modules\\Menu\\Controllers',
    ),
  ),
  'adminMenuLinkDelete' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/menu_link_delete/{id:([a-z]{2,})}_{link:([a-z]{2,})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'module' => 'menu',
      'action' => 'LinkDelete',
      'namespace' => 'Modules\\Menu\\Controllers',
    ),
  ),
  'validateCode' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/validate_code',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'validateCode',
      'module' => 'form',
      'namespace' => 'Modules\\Form\\Controllers',
    ),
  ),
  'entity' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/e_{entity:([a-z\\-]{2,20})}/{id:([1-9]{1}[0-9]{0,11})}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'entityList' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/el_{entity:([a-zA-Z\\.\\-]{2,20})}/{page:([1-9]{1}[0-9]{0,11})}',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'EntityList',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'entityContentModelList' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/eml_{entity:([a-z\\-]{2,20})}_{model:([a-z\\-]{2,20})}/{page:([1-9]{1}[0-9]{0,11})}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'EntityModelList',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'entityModelFieldList' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/emfl_{entity:([a-z\\-]{2,20})}_{model:([a-z\\-]{2,20})}_{field:([a-z\\-]{2,20})}/{page:([1-9]{1}[0-9]{0,11})}.html',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'EntityModelFieldList',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'adminEntityList' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/e_list/{entity:([a-z\\-]{2,20})}/{page:([1-9]{1}[0-9]{0,11})}.html',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Index',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'adminEntityEdit' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/e_edit/{entity:([a-z\\-]{2,20})}/{contentModel:([0-9A-Za-z\\-\\_]{1,20})}/{id:([0-9a-z\\-\\_]{1,20})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'edit',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'adminEntityAdd' => 
  array (
    'httpMethods' => NULL,
    'pattern' => '/admin/e_add/{entity:([a-z\\-]{2,20})}/{contentModel:([0-9A-Za-z\\-\\_]{1,20})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'add',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'adminEntityDelete' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/admin/e_delete/{entity:([a-z\\-]{2,20})}/{id:([0-9a-z\\-\\_\\.]{1,20})}',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Delete',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'adminEntityHandle' => 
  array (
    'httpMethods' => 'POST',
    'pattern' => '/admin/e_handle',
    'paths' => 
    array (
      'controller' => 'Admin',
      'action' => 'Handle',
      'module' => 'entity',
      'namespace' => 'Modules\\Entity\\Controllers',
    ),
  ),
  'commentList' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/comment/{nid:([1-9]{1}[0-9]{0,11})}_{pid:([1-9]{1}[0-9]{0,11})}_{page:([1-9]{1}[0-9]{0,11})}',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Index',
      'module' => 'comment',
      'namespace' => 'Modules\\Comment\\Controllers',
    ),
  ),
  'commentLove' => 
  array (
    'httpMethods' => 'GET',
    'pattern' => '/comment_love/{id:([1-9]{1}[0-9]{0,11})}',
    'paths' => 
    array (
      'controller' => 'Index',
      'action' => 'Love',
      'module' => 'comment',
      'namespace' => 'Modules\\Comment\\Controllers',
    ),
  ),
);