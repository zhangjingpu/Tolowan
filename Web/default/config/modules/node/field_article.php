<?php
$settings = array(
    'title' => array(
        'field' => 'string',
        'widget' => 'Text',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'isTitle' => true,
        'number' => 1,
        'addition' => true,
        'label' => '标题',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'body' => array(
        'field' => 'textLong',
        'widget' => 'Textarea',
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'search' => true,
        'fullTextSearch' => true,
        'wordsmith' => true,
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '内容',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'cat' => array(
        'field' => 'term',
        'widget' => 'Select',
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'addTerm' => false,
        'valueType' => 'id',
        'maxNum' => 1,
        'taxonomy' => 'tags',
        'mainTable' => 2,
        'parent' => 0,
        'addition' => true,
        'label' => '分类',
        'description' => '文章分类',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'tags' => array(
        'field' => 'term',
        'widget' => 'Tags',
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'addTerm' => true,
        'valueType' => 'name',
        'type' => 'article',
        'maxNum' => 10,
        'taxonomy' => 'tags',
        'mainTable' => 2,
        'parent' => 0,
        'addition' => true,
        'label' => '标签',
        'description' => '文章标签',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'images' => array(
        'field' => 'fileBox',
        'widget' => 'FileBox',
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'wordsmith' => true,
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '图片',
        'description' => '特色图片',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'commentContentModel' => 'comment',
);
