<?php
namespace Modules\Node\Library;

class Search{
    public static function search($data){
        global $di;
        $query = array(
            'limit' => 15,
            'paginator' => true,
            'match' => array()
        );
        $nodeEntity = $di->getShared('entityManager')->get('node');
        $fields = $nodeEntity->getFields();
        $nodeForm = $di->get('form')->create($fields);
        foreach ($nodeForm->getElements() as $key => $element){
            $elementOptions = $element->getUserOptions();
            if(isset($elementOptions['fullTextSearch']) && $elementOptions['fullTextSearch'] === true){
                $query['match'][] = array(
                    'conditions' => 'MATCH(%'.$key.'%) AGAINST(:'.$key.':)',
                    'bind' => array($key => $data['word'])
                );
            }
        }
        $data = $nodeEntity->find($query);
        return $data;
    }
}