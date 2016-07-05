<?php
$settings = array(
    'comment' => array(
        'entity' => 'Modules\Comment\Models\Comment',
        'columns' => array('comment_id'=>'comment.id', 'comment.nid', 'comment.pid', 'comment.uid','comment.created', 'comment.changed', 'comment.body'),
    ),
);
