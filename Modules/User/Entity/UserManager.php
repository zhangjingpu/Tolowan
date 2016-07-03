<?php
namespace Modules\User\Entity;

use Modules\Entity\Entity\Manager;

class UserManager extends Manager
{
    protected $_entityId = 'user';
    protected $_module = 'user';


    public function menuTabs(){
        $links = array();
        $contentModelList = $this->getContentModelList();
        foreach($contentModelList as $key => $contentModel){
            $links[] = array(
                'href' => array(
                    'for' => 'adminEntityAdd',
                    'entity' => $this->_entityId,
                    'contentModel' => $key
                ),
                'name' => $contentModel['modelName']
            );
        }
        return $links;
    }
}