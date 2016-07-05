<?php
$settings = array(
    'queue' => array(
        'entity' => 'Modules\Queue\Models\Queue',
        'columns' => array('queue.id','queue.type','queue.data','queue.runtime','queue.error','queue.weight','queue.state'),
    )
);