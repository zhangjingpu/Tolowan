<?php
$settings = array(
    'field' => 'group',
    'widget' => 'Group',
    'label' => '编入书本',
    'description' => '',
    'error' => '',
    'attributes' => array(),
    'access' => array(
        'path' => array(
            '/admin/.*',
            '/.*?/admin/.*'
        )
    ),
    'right' => true,
    'group' => array(
        'book_id' => array(
            'field' => 'number',
            'widget' => 'Text',
            'source' => '/auto_source/bookname/',
            'access' => array(
                'addForm' => false,
                'editForm' => false,
                'baseField' => true,
            ),
            'length' => 10,
            'required' => false,
            'description' => '添加该文章到此书本目录',
            'error' => '',
            'right' => 'true',
            'dataType' => 'id',
            'label' => '书本',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ),
        'book_pid' => array(
            'field' => 'number',
            'widget' => 'Text',
            'source' => '/auto_source/bookparent/',
            'access' => array(
                'addForm' => true,
                'editForm' => true,
                'baseField' => true,
            ),
            'length' => 10,
            'required' => false,
            'label' => '父目录',
            'description' => '该文章在书本目录中的父节点',
            'error' => '',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ),
        'book_weight' => array(
            'field' => 'number',
            'widget' => 'Text',
            'access' => array(
                'addForm' => true,
                'editForm' => true,
                'baseField' => true,
            ),
            'length' => 10,
            'required' => false,
            'label' => '权重',
            'description' => '该文章在书本目录中的排序权重',
            'error' => '',
            'attributes' => array(
                'class' => 'form-control',
            ),
        ),
    ),
);