<?php
function termList($limit, $taxonomy = null, $parent = null)
{
    global $di;
    $query = array(
        'limit' => $limit,
        'andWhere' => array(),
    );
    if (!is_null($taxonomy)) {
        $query['andWhere'][] = array(
            'conditions' => '%contentModel% = :contentModel:',
            'bind' => array('contentModel' => $taxonomy),
        );
    }
    if (!is_null($parent)) {
        $query['andWhere'][] = array(
            'conditions' => '%parent% = :parent:',
            'bind' => array('parent' => $parent),
        );
    }
    $user = $di->getShared('entityManager')->get('term');
    return $user->find($query);
}
