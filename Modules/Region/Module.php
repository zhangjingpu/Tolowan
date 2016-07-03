<?php
use Core\COnfig;

$di->getShared('eventsManager')->attach('entity:links', function ($event, $entity) {
    if ($entity->getEntityId() == 'configList' && $entity->contentModel == 'region') {
        $links = $entity->getLinks();
        $links['addBlock'] = array(
            'href' => array(
                'for' => 'adminRegionBlockAddList',
                'region' => $entity->id,
            ),
            'data-target' => 'right_handle',
            'icon' => 'info',
            'name' => '添加区块'
        );
        $links['sortBlock'] = array(
            'href' => array(
                'for' => 'adminRegionBlockSort',
                'region' => $entity->id,
            ),
            'data-target' => 'right_handle',
            'icon' => 'info',
            'name' => '区块列表'
        );
        $entity->setLinks($links);
    }
});

function regionList(){
    $regionListData = Config::get('m.region.list');
    $output = array();
    foreach ($regionListData as $key => $value){
        $output[$key] = $value['name'];
    }
    return $output;
}

function renderRegion($region)
{
    $regionList = Config::get('m.region.list');
    if (!isset($regionList[$region])) {
        return false;
    }
    $blockList = Config::get('m.region.blockList-' . $region);
    $blockList['#templates'] = array(
        'region',
        'region-' . $region
    );
    return $blockList;
}

function renderBlock($block)
{
    if (!is_array($block['contentModel']) && !isset($block['contentModel'])) {
        throw new \Exception('区块数据不合法');
    }
    $contentModel = $block['contentModel'];
    $blockContentModelList = Config::get('m.region.entityBlockContentModelList');
    if (!isset($blockContentModelList[$contentModel])) {
        throw new Exception("区块类型不存在");
    }
    if (!isset($blockContentModelList[$contentModel]['class'])) {
        $block['#templates'] = array(
            'block',
            'block-' . $contentModel,
            'block-' . $block['id']
        );
        return $block;
    } else {
        $contentModelClass = $blockContentModelList[$contentModel];
        $output = new $contentModelClass($block);
        return $output;
    }
    return false;
}