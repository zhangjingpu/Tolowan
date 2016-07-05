<?php
$settings = array(
    'term' => array(
        'name' => '富图片上传框',
        'widget' => array(
            'Text' => '文本框',
            'Select' => '下拉列表',
            'Tags' => '标签框',
        ),
        'init' => '\Modules\Taxonomy\Forms\Field::termInit',
        'validate' => array(),
        'filter' => array()
    ),
);