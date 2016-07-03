<?php $settings = array (
  'node' => 
  array (
    'entity' => 'Modules\\Node\\Entity\\Node',
    'columns' => 
    array (
      0 => 'node.id',
      1 => 'node.state',
      2 => 'node.contentModel',
      3 => 'node.created',
      4 => 'node.changed',
      5 => 'node.uid',
      6 => 'node.comment',
      7 => 'node.hot',
      8 => 'node.top',
      9 => 'node.essence',
    ),
  ),
  'user' => 
  array (
    'entity' => 'Modules\\User\\Models\\User',
    'columns' => 
    array (
      0 => 'user.id',
      1 => 'user.name',
      2 => 'user.email',
      3 => 'user.password',
      4 => 'user.created',
      5 => 'user.active',
    ),
  ),
  'user_info' => 
  array (
    'entity' => 'Modules\\User\\Models\\UserInfo',
    'columns' => 
    array (
      0 => 'user_info.id',
      1 => 'user_info.uid',
      2 => 'user_info.portrait',
      3 => 'user_info.qq',
      4 => 'user_info.phone',
      5 => 'user_info.home_site',
      6 => 'user_info.gender',
      7 => 'user_info.job',
      8 => 'user_info.area',
      9 => 'user_info.school',
    ),
  ),
  'user_log' => 
  array (
    'entity' => 'Modules\\User\\Models\\UserLog',
    'columns' => 
    array (
      0 => 'user_log.id',
      1 => 'user_log.uid',
      2 => 'user_log.data',
      3 => 'user_log.type',
    ),
  ),
  'user_roles' => 
  array (
    'entity' => 'Modules\\User\\Models\\UserRoles',
    'columns' => 
    array (
      0 => 'user_roles.id',
      1 => 'user_roles.uid',
      2 => 'user_roles.role',
      3 => 'user_roles.created',
    ),
  ),
  'queue' => 
  array (
    'entity' => 'Modules\\Queue\\Models\\Queue',
    'columns' => 
    array (
      0 => 'queue.id',
      1 => 'queue.type',
      2 => 'queue.data',
      3 => 'queue.runtime',
      4 => 'queue.error',
      5 => 'queue.weight',
      6 => 'queue.state',
    ),
  ),
  'term' => 
  array (
    'entity' => 'Modules\\Taxonomy\\Entity\\Term',
    'columns' => 
    array (
      'term_id' => 'term.id',
      0 => 'term.name',
      1 => 'term.type',
      2 => 'term.description',
      3 => 'term.parent',
      4 => 'term.widget',
      5 => 'term.attach',
    ),
  ),
  'file' => 
  array (
    'entity' => 'Modules\\File\\Models\\File',
    'columns' => 
    array (
      0 => 'file.id',
      1 => 'file.state',
      2 => 'file.uid',
      3 => 'file.path',
      4 => 'file.created',
      5 => 'file.access',
      6 => 'file.content_type',
      7 => 'file.changed',
      8 => 'file.name',
      9 => 'file.description',
      10 => 'file.md5',
    ),
  ),
  'node_field_title' => 
  array (
    'entity' => 'Models\\NodeFieldTitle',
    'columns' => 
    array (
      0 => 'node_field_title.id',
      1 => 'node_field_title.eid',
      2 => 'node_field_title.value',
    ),
  ),
  'node_field_body' => 
  array (
    'entity' => 'Models\\NodeFieldBody',
    'columns' => 
    array (
      0 => 'node_field_body.id',
      1 => 'node_field_body.eid',
      2 => 'node_field_body.value',
    ),
  ),
  'node_field_cat' => 
  array (
    'entity' => 'Models\\NodeFieldCat',
    'columns' => 
    array (
      0 => 'node_field_cat.id',
      1 => 'node_field_cat.eid',
      2 => 'node_field_cat.value',
    ),
  ),
  'node_field_tags' => 
  array (
    'entity' => 'Models\\NodeFieldTags',
    'columns' => 
    array (
      0 => 'node_field_tags.id',
      1 => 'node_field_tags.eid',
      2 => 'node_field_tags.value',
    ),
  ),
  'node_field_images' => 
  array (
    'entity' => 'Models\\NodeFieldImages',
    'columns' => 
    array (
      0 => 'node_field_images.id',
      1 => 'node_field_images.eid',
      2 => 'node_field_images.value',
    ),
  ),
  'node_field_commentContentModel' => 
  array (
    'entity' => 'Models\\NodeFieldCommentContentModel',
    'columns' => 
    array (
      0 => 'node_field_commentContentModel.id',
      1 => 'node_field_commentContentModel.eid',
      2 => 'node_field_commentContentModel.value',
    ),
  ),
  'config_field_formId' => 
  array (
    'entity' => 'Models\\ConfigFieldFormId',
    'columns' => 
    array (
      0 => 'config_field_formId.id',
      1 => 'config_field_formId.eid',
      2 => 'config_field_formId.value',
    ),
  ),
  'config_field_form' => 
  array (
    'entity' => 'Models\\ConfigFieldForm',
    'columns' => 
    array (
      0 => 'config_field_form.id',
      1 => 'config_field_form.eid',
      2 => 'config_field_form.value',
    ),
  ),
  'config_field_logo' => 
  array (
    'entity' => 'Models\\ConfigFieldLogo',
    'columns' => 
    array (
      0 => 'config_field_logo.id',
      1 => 'config_field_logo.eid',
      2 => 'config_field_logo.value',
    ),
  ),
  'config_field_name' => 
  array (
    'entity' => 'Models\\ConfigFieldName',
    'columns' => 
    array (
      0 => 'config_field_name.id',
      1 => 'config_field_name.eid',
      2 => 'config_field_name.value',
    ),
  ),
  'config_field_description' => 
  array (
    'entity' => 'Models\\ConfigFieldDescription',
    'columns' => 
    array (
      0 => 'config_field_description.id',
      1 => 'config_field_description.eid',
      2 => 'config_field_description.value',
    ),
  ),
  'config_field_indexTitle' => 
  array (
    'entity' => 'Models\\ConfigFieldIndexTitle',
    'columns' => 
    array (
      0 => 'config_field_indexTitle.id',
      1 => 'config_field_indexTitle.eid',
      2 => 'config_field_indexTitle.value',
    ),
  ),
  'config_field_indexDescription' => 
  array (
    'entity' => 'Models\\ConfigFieldIndexDescription',
    'columns' => 
    array (
      0 => 'config_field_indexDescription.id',
      1 => 'config_field_indexDescription.eid',
      2 => 'config_field_indexDescription.value',
    ),
  ),
  'config_field_indexKeywords' => 
  array (
    'entity' => 'Models\\ConfigFieldIndexKeywords',
    'columns' => 
    array (
      0 => 'config_field_indexKeywords.id',
      1 => 'config_field_indexKeywords.eid',
      2 => 'config_field_indexKeywords.value',
    ),
  ),
  'config_field_icp' => 
  array (
    'entity' => 'Models\\ConfigFieldIcp',
    'columns' => 
    array (
      0 => 'config_field_icp.id',
      1 => 'config_field_icp.eid',
      2 => 'config_field_icp.value',
    ),
  ),
  'config_field_tel' => 
  array (
    'entity' => 'Models\\ConfigFieldTel',
    'columns' => 
    array (
      0 => 'config_field_tel.id',
      1 => 'config_field_tel.eid',
      2 => 'config_field_tel.value',
    ),
  ),
  'config_field_email' => 
  array (
    'entity' => 'Models\\ConfigFieldEmail',
    'columns' => 
    array (
      0 => 'config_field_email.id',
      1 => 'config_field_email.eid',
      2 => 'config_field_email.value',
    ),
  ),
  'config_field_other' => 
  array (
    'entity' => 'Models\\ConfigFieldOther',
    'columns' => 
    array (
      0 => 'config_field_other.id',
      1 => 'config_field_other.eid',
      2 => 'config_field_other.value',
    ),
  ),
  'config_field_settings' => 
  array (
    'entity' => 'Models\\ConfigFieldSettings',
    'columns' => 
    array (
      0 => 'config_field_settings.id',
      1 => 'config_field_settings.eid',
      2 => 'config_field_settings.value',
    ),
  ),
  'config_field_number' => 
  array (
    'entity' => 'Models\\ConfigFieldNumber',
    'columns' => 
    array (
      0 => 'config_field_number.id',
      1 => 'config_field_number.eid',
      2 => 'config_field_number.value',
    ),
  ),
  'config_field_term_number' => 
  array (
    'entity' => 'Models\\ConfigFieldTerm_number',
    'columns' => 
    array (
      0 => 'config_field_term_number.id',
      1 => 'config_field_term_number.eid',
      2 => 'config_field_term_number.value',
    ),
  ),
  'config_field_rename' => 
  array (
    'entity' => 'Models\\ConfigFieldRename',
    'columns' => 
    array (
      0 => 'config_field_rename.id',
      1 => 'config_field_rename.eid',
      2 => 'config_field_rename.value',
    ),
  ),
  'config_field_img_we' => 
  array (
    'entity' => 'Models\\ConfigFieldImg_we',
    'columns' => 
    array (
      0 => 'config_field_img_we.id',
      1 => 'config_field_img_we.eid',
      2 => 'config_field_img_we.value',
    ),
  ),
  'config_field_roles' => 
  array (
    'entity' => 'Models\\ConfigFieldRoles',
    'columns' => 
    array (
      0 => 'config_field_roles.id',
      1 => 'config_field_roles.eid',
      2 => 'config_field_roles.value',
    ),
  ),
  'config_field_private_img_down' => 
  array (
    'entity' => 'Models\\ConfigFieldPrivate_img_down',
    'columns' => 
    array (
      0 => 'config_field_private_img_down.id',
      1 => 'config_field_private_img_down.eid',
      2 => 'config_field_private_img_down.value',
    ),
  ),
  'config_field_open_comment' => 
  array (
    'entity' => 'Models\\ConfigFieldOpen_comment',
    'columns' => 
    array (
      0 => 'config_field_open_comment.id',
      1 => 'config_field_open_comment.eid',
      2 => 'config_field_open_comment.value',
    ),
  ),
  'config_field_interval' => 
  array (
    'entity' => 'Models\\ConfigFieldInterval',
    'columns' => 
    array (
      0 => 'config_field_interval.id',
      1 => 'config_field_interval.eid',
      2 => 'config_field_interval.value',
    ),
  ),
  'config_field_sort' => 
  array (
    'entity' => 'Models\\ConfigFieldSort',
    'columns' => 
    array (
      0 => 'config_field_sort.id',
      1 => 'config_field_sort.eid',
      2 => 'config_field_sort.value',
    ),
  ),
  'config_field_comment_type' => 
  array (
    'entity' => 'Models\\ConfigFieldComment_type',
    'columns' => 
    array (
      0 => 'config_field_comment_type.id',
      1 => 'config_field_comment_type.eid',
      2 => 'config_field_comment_type.value',
    ),
  ),
  'config_field_user_center' => 
  array (
    'entity' => 'Models\\ConfigFieldUser_center',
    'columns' => 
    array (
      0 => 'config_field_user_center.id',
      1 => 'config_field_user_center.eid',
      2 => 'config_field_user_center.value',
    ),
  ),
  'config_field_open_register' => 
  array (
    'entity' => 'Models\\ConfigFieldOpen_register',
    'columns' => 
    array (
      0 => 'config_field_open_register.id',
      1 => 'config_field_open_register.eid',
      2 => 'config_field_open_register.value',
    ),
  ),
  'config_field_open_register_roles' => 
  array (
    'entity' => 'Models\\ConfigFieldOpen_register_roles',
    'columns' => 
    array (
      0 => 'config_field_open_register_roles.id',
      1 => 'config_field_open_register_roles.eid',
      2 => 'config_field_open_register_roles.value',
    ),
  ),
  'config_field_open_register_captcha' => 
  array (
    'entity' => 'Models\\ConfigFieldOpen_register_captcha',
    'columns' => 
    array (
      0 => 'config_field_open_register_captcha.id',
      1 => 'config_field_open_register_captcha.eid',
      2 => 'config_field_open_register_captcha.value',
    ),
  ),
  'config_field_open_login_captcha' => 
  array (
    'entity' => 'Models\\ConfigFieldOpen_login_captcha',
    'columns' => 
    array (
      0 => 'config_field_open_login_captcha.id',
      1 => 'config_field_open_login_captcha.eid',
      2 => 'config_field_open_login_captcha.value',
    ),
  ),
  'config_field_open_email_active' => 
  array (
    'entity' => 'Models\\ConfigFieldOpen_email_active',
    'columns' => 
    array (
      0 => 'config_field_open_email_active.id',
      1 => 'config_field_open_email_active.eid',
      2 => 'config_field_open_email_active.value',
    ),
  ),
  'config_field_email_active_body' => 
  array (
    'entity' => 'Models\\ConfigFieldEmail_active_body',
    'columns' => 
    array (
      0 => 'config_field_email_active_body.id',
      1 => 'config_field_email_active_body.eid',
      2 => 'config_field_email_active_body.value',
    ),
  ),
  'config_field_no_user' => 
  array (
    'entity' => 'Models\\ConfigFieldNo_user',
    'columns' => 
    array (
      0 => 'config_field_no_user.id',
      1 => 'config_field_no_user.eid',
      2 => 'config_field_no_user.value',
    ),
  ),
  'configList_field_formId' => 
  array (
    'entity' => 'Models\\ConfigListFieldFormId',
    'columns' => 
    array (
      0 => 'configList_field_formId.id',
      1 => 'configList_field_formId.eid',
      2 => 'configList_field_formId.value',
    ),
  ),
  'configList_field_form' => 
  array (
    'entity' => 'Models\\ConfigListFieldForm',
    'columns' => 
    array (
      0 => 'configList_field_form.id',
      1 => 'configList_field_form.eid',
      2 => 'configList_field_form.value',
    ),
  ),
  'configList_field_id' => 
  array (
    'entity' => 'Models\\ConfigListFieldId',
    'columns' => 
    array (
      0 => 'configList_field_id.id',
      1 => 'configList_field_id.eid',
      2 => 'configList_field_id.value',
    ),
  ),
  'configList_field_name' => 
  array (
    'entity' => 'Models\\ConfigListFieldName',
    'columns' => 
    array (
      0 => 'configList_field_name.id',
      1 => 'configList_field_name.eid',
      2 => 'configList_field_name.value',
    ),
  ),
  'configList_field_description' => 
  array (
    'entity' => 'Models\\ConfigListFieldDescription',
    'columns' => 
    array (
      0 => 'configList_field_description.id',
      1 => 'configList_field_description.eid',
      2 => 'configList_field_description.value',
    ),
  ),
  'configList_field_attach' => 
  array (
    'entity' => 'Models\\ConfigListFieldAttach',
    'columns' => 
    array (
      0 => 'configList_field_attach.id',
      1 => 'configList_field_attach.eid',
      2 => 'configList_field_attach.value',
    ),
  ),
  'configList_field_settings' => 
  array (
    'entity' => 'Models\\ConfigListFieldSettings',
    'columns' => 
    array (
      0 => 'configList_field_settings.id',
      1 => 'configList_field_settings.eid',
      2 => 'configList_field_settings.value',
    ),
  ),
  'block_field_formId' => 
  array (
    'entity' => 'Models\\BlockFieldFormId',
    'columns' => 
    array (
      0 => 'block_field_formId.id',
      1 => 'block_field_formId.eid',
      2 => 'block_field_formId.value',
    ),
  ),
  'block_field_form' => 
  array (
    'entity' => 'Models\\BlockFieldForm',
    'columns' => 
    array (
      0 => 'block_field_form.id',
      1 => 'block_field_form.eid',
      2 => 'block_field_form.value',
    ),
  ),
  'block_field_id' => 
  array (
    'entity' => 'Models\\BlockFieldId',
    'columns' => 
    array (
      0 => 'block_field_id.id',
      1 => 'block_field_id.eid',
      2 => 'block_field_id.value',
    ),
  ),
  'block_field_name' => 
  array (
    'entity' => 'Models\\BlockFieldName',
    'columns' => 
    array (
      0 => 'block_field_name.id',
      1 => 'block_field_name.eid',
      2 => 'block_field_name.value',
    ),
  ),
  'block_field_body' => 
  array (
    'entity' => 'Models\\BlockFieldBody',
    'columns' => 
    array (
      0 => 'block_field_body.id',
      1 => 'block_field_body.eid',
      2 => 'block_field_body.value',
    ),
  ),
  'block_field_settings' => 
  array (
    'entity' => 'Models\\BlockFieldSettings',
    'columns' => 
    array (
      0 => 'block_field_settings.id',
      1 => 'block_field_settings.eid',
      2 => 'block_field_settings.value',
    ),
  ),
  'block_field_src' => 
  array (
    'entity' => 'Models\\BlockFieldSrc',
    'columns' => 
    array (
      0 => 'block_field_src.id',
      1 => 'block_field_src.eid',
      2 => 'block_field_src.value',
    ),
  ),
  'comment' => 
  array (
    'entity' => 'Modules\\Comment\\Models\\Comment',
    'columns' => 
    array (
      'comment_id' => 'comment.id',
      0 => 'comment.nid',
      1 => 'comment.pid',
      2 => 'comment.uid',
      3 => 'comment.created',
      4 => 'comment.changed',
      5 => 'comment.body',
    ),
  ),
);