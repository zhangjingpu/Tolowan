<?php $settings = array (
  'node' => 
  array (
    'id' => 'node',
    'entityName' => '内容',
    'module' => 'node',
    'entityModel' => '\\Modules\\Node\\Entity\\Node',
    'entityManager' => '\\Modules\\Node\\Entity\\NodeManager',
    'source' => 'node',
    'filterForm' => 'node.filterForm',
    'path' => 
    array (
      'adminEntityList' => true,
      'adminEntityEdit' => true,
      'adminEntityAdd' => true,
      'adminEntityDelete' => true,
      'adminEntityHandle' => true,
      'entity' => false,
      'entityList' => false,
      'entityContentModelList' => false,
      'entityModelFieldList' => false,
    ),
    'thead' => 
    array (
      'id' => 'ID',
      'label' => '内容',
      'user' => '用户',
      'created' => '创建',
      'changed' => '最近更改',
      'state' => '状态',
    ),
    'entity_keys' => 
    array (
      'id' => 'nid',
      'revision' => 'vid',
      'label' => 'title',
      'uuid' => 'uuid',
      'status' => 'status',
      'uid' => 'uid',
    ),
  ),
  'config' => 
  array (
    'id' => 'config',
    'entityName' => '配置',
    'module' => 'config',
    'label' => 'name',
    'entityModel' => '\\Modules\\Config\\Entity\\Config',
    'entityManager' => '\\Modules\\Config\\Entity\\ConfigManager',
    'source' => 'node',
    'form' => 
    array (
      'default' => 'node.node',
      'handle' => 'node.handle',
      'edit' => 'node.node',
    ),
    'path' => 
    array (
      'list' => 
      array (
        'for' => 'config',
      ),
      'add' => false,
      'delete' => false,
    ),
    'thead' => 
    array (
      'id' => 'ID',
      'label' => '配置名',
      'user' => '描述',
    ),
  ),
  'configList' => 
  array (
    'id' => 'configList',
    'name' => '配置列表',
    'module' => 'config',
    'label' => 'name',
    'entityModel' => '\\Modules\\Config\\Entity\\ConfigList',
    'entityManager' => '\\Modules\\Config\\Entity\\ConfigListManager',
    'source' => 'node',
    'form' => 
    array (
      'default' => 'node.node',
      'handle' => 'node.handle',
      'edit' => 'node.node',
    ),
    'path' => 
    array (
      'list' => 
      array (
        'for' => 'config',
      ),
      'add' => false,
      'delete' => false,
    ),
    'thead' => 
    array (
      'id' => 'ID',
      'label' => '内容',
      'user' => '用户',
      'created' => '创建',
      'changed' => '最近更改',
      'state' => '状态',
    ),
    'entity_keys' => 
    array (
      'id' => 'nid',
      'revision' => 'vid',
      'label' => 'title',
      'uuid' => 'uuid',
      'status' => 'status',
      'uid' => 'uid',
    ),
  ),
  'user' => 
  array (
    'id' => 'user',
    'entityName' => '用户',
    'module' => 'user',
    'entityModel' => '\\Modules\\User\\Entity\\User',
    'entityManager' => '\\Modules\\User\\Entity\\UserManager',
    'source' => 'user',
    'filterForm' => 'user.filterForm',
    'path' => 
    array (
      'adminEntityList' => true,
      'adminEntityEdit' => true,
      'adminEntityAdd' => true,
      'adminEntityDelete' => true,
      'adminEntityHandle' => true,
      'entity' => false,
      'entityList' => false,
      'entityContentModelList' => false,
      'entityModelFieldList' => false,
    ),
    'thead' => 
    array (
      'id' => 'ID',
      'label' => '内容',
      'user' => '用户',
      'created' => '创建',
      'changed' => '最近更改',
      'state' => '状态',
    ),
    'entity_keys' => 
    array (
      'id' => 'nid',
      'revision' => 'vid',
      'label' => 'title',
      'uuid' => 'uuid',
      'status' => 'status',
      'uid' => 'uid',
    ),
  ),
  'block' => 
  array (
    'id' => 'block',
    'name' => '区块',
    'module' => 'region',
    'label' => 'name',
    'entityModel' => '\\Modules\\Region\\Entity\\Block',
    'entityManager' => '\\Modules\\Region\\Entity\\BlockManager',
    'source' => 'm.region.blockList',
    'form' => 
    array (
      'default' => 'node.node',
      'handle' => 'node.handle',
      'edit' => 'node.node',
    ),
    'path' => 
    array (
      'list' => 
      array (
        'for' => 'config',
      ),
      'add' => false,
      'delete' => false,
    ),
    'thead' => 
    array (
      'id' => 'ID',
      'label' => '内容',
      'user' => '用户',
      'created' => '创建',
      'changed' => '最近更改',
      'state' => '状态',
    ),
    'entity_keys' => 
    array (
      'id' => 'nid',
      'revision' => 'vid',
      'label' => 'title',
      'uuid' => 'uuid',
      'status' => 'status',
      'uid' => 'uid',
    ),
  ),
  'term' => 
  array (
    'id' => 'term',
    'entityName' => '内容',
    'module' => 'taxonomy',
    'entityModel' => '\\Modules\\Taxonomy\\Entity\\Term',
    'entityManager' => '\\Modules\\Taxonomy\\Entity\\TermManager',
    'source' => 'term',
    'storage' => 'MultiTable',
    'filterForm' => 'taxonomy.filterForm',
    'path' => 
    array (
      'adminEntityList' => false,
      'adminEntityEdit' => false,
      'adminEntityAdd' => false,
      'adminEntityDelete' => false,
      'adminEntityHandle' => false,
      'entity' => false,
      'entityList' => false,
      'entityContentModelList' => false,
      'entityModelFieldList' => false,
    ),
    'thead' => 
    array (
      'id' => 'ID',
      'label' => '内容',
      'user' => '用户',
      'created' => '创建',
      'changed' => '最近更改',
      'state' => '状态',
    ),
    'entity_keys' => 
    array (
      'id' => 'nid',
      'revision' => 'vid',
      'label' => 'title',
      'uuid' => 'uuid',
      'status' => 'status',
      'uid' => 'uid',
    ),
  ),
  'comment' => 
  array (
    'id' => 'comment',
    'entityName' => '内容',
    'module' => 'comment',
    'entityModel' => '\\Modules\\Comment\\Entity\\Comment',
    'entityManager' => '\\Modules\\Comment\\Entity\\CommentManager',
    'source' => 'comment',
    'filterForm' => 'taxonomy.filterForm',
    'path' => 
    array (
      'adminEntityList' => true,
      'adminEntityEdit' => true,
      'adminEntityAdd' => true,
      'adminEntityDelete' => true,
      'adminEntityHandle' => true,
      'entity' => false,
      'entityList' => false,
      'entityContentModelList' => false,
      'entityModelFieldList' => false,
    ),
    'thead' => 
    array (
      'id' => 'ID',
      'label' => '内容',
      'user' => '用户',
      'created' => '创建',
      'changed' => '最近更改',
      'state' => '状态',
    ),
    'entity_keys' => 
    array (
      'id' => 'nid',
      'revision' => 'vid',
      'label' => 'title',
      'uuid' => 'uuid',
      'status' => 'status',
      'uid' => 'uid',
    ),
  ),
);