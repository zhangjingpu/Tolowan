<?php
namespace Modules\Node\Library;

class View{
    public static function adminNodeLink($label){
        global $di;
        $url = $di->getShared('url')->get(array(
            'for' => 'noe'
        ));
        $output = '<a href="{{ url([\'for\':\'node\',\'type\':item.type,\'id\':item.node_id]) }}" data-toggle="tooltip" target="_blank" data-placement="right" title="访问{{ item.title }}">';
    }
}