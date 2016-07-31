<?php
$di->getShared('eventsManager')->attach('form:initialize', function ($event, $form) {
    if ($form->formId == 'entityNode' && isset($form->formEntity['settings']['contentModel']) && $form->formEntity['settings']['contentModel'] != 'book') {
        $form->formEntity['book'] = \Core\Config::get('book.nodeBookHook');
    }
});
$di->getShared('eventsManager')->attach('entity:saveAfter', function ($event, $entity) {
    global $di;
    $entityId = $entity->getEntityId();
    if ($entityId === 'node') {
        $entityForm = $entity->entityForm;
        $formData = $entityForm->getData();
        if (isset($formData['book_id']) && $formData['book_id']) {
            $bookModel = new \Modules\Book\Models\NodeBook();
            $bookModel->nid = $entity->entityModel->id;
            $bookModel->bid = $formData['book_id'];
            if (isset($formData['book_pid'])) {
                $bookModel->pid = $formData['book_pid'];
            }
            if (isset($formData['book_weight'])) {
                $bookModel->weight = $formData['book_weight'];
            }
            $bookModel->title = $entity->entityModel->getTitle();
            if ($bookModel->save()) {
                $di->getShared('flash')->success('成功保存文章到书本目录');
            } else {
                $di->getShared('flash')->error('保存文章到书本目录失败');
            }
        }
    }
});
$di->getShared('eventsManager')->attach('entity:links', function ($event, $entity) {
    global $di;
    $entityId = $entity->getEntityId();
    if ($entityId === 'node' && isset($entity->contentModel) && $entity->contentModel == 'book') {
        $links = $entity->getLinks();
        $links['bookSort'] = array(
            'href' => array(
                'for' => 'adminBookTocSort',
                'id' => $entity->id,
            ),
            'icon' => 'danger',
            'name' => '排序书本目录',
        );
        $entity->setLinks($links);
    }
});
//函数库
function bookToc($id,$contentModel){
    $data = true;
    if($contentModel != 'book'){
        $nodeBook = \Modules\Book\Models\NodeBook::findFirstByNid($id);
        if(!$nodeBook){
            $data = false;
        }else{
            $bid = $nodeBook->bid;
        }
    }else{
        $nodeBook = \Modules\Book\Models\NodeBook::findFirstBybid($id);
        if(!$nodeBook){
            $data = false;
        }else{
            $bid = $nodeBook->bid;
        }
    }
    if($data === true) {
        $data = \Modules\Book\Models\NodeBook::findFirst(array(
            'order' => 'weight DESC',
            'conditions' => 'bid = :bid: AND pid = :pid:',
            'bind' => array(
                'pid' => 0,
                'bid' => $bid
            ),
        ));
    }
    $output = array(
        '#templates' => array(
            'bookToc',
            'bookToc-'.$id
        ),
        'data' => $data
    );
    return $output;
}