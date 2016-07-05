<?php
namespace Modules\Config\Entity;

use Core\Config;
use Modules\Entity\Entity\Manager;

class ConfigListManager extends Manager
{
    protected $_entityId = 'configList';
    protected $_module = 'config';

    public function getThead($contentModel)
    {
        $fields = $this->getFields($contentModel);
        if (isset($fields['settings']['thead'])) {
            return $fields['settings']['thead'];
        }
        return array(
            'id' => '机读名',
            'name' => '项目',
        );
    }

    public function find($query = array())
    {
        $modelClassName = $this->_entityInfo['entityModel'];
        return $modelClassName::find($query);
    }

    public function addForm($contentModel, $data = array())
    {
        global $di;
        $addFormInfo = $this->getFields($contentModel);
        $addFormInfo['settings']['contentModel'] = $contentModel;
        $addFormInfo['contentModel']['settings']['default'] = $contentModel;
        $addForm = $di->getShared('form')->create($addFormInfo, $data);
        if ($addForm->isValid()) {
            $this->save($addForm);
        }
        return $addForm;
    }

    public function editForm($contentModel = null, $id = null)
    {
        global $di;
        $addFormInfo = $this->getFields($contentModel);
        $addFormInfo['settings']['contentModel'] = $contentModel;
        $addFormInfo['settings']['id'] = $id;
        $addFormInfo['contentModel']['settings']['default'] = $contentModel;
        $data = $this->findFirst(array('contentModel' => $contentModel, 'id' => $id));
        if (is_object($data)) {
            $data = (array)$data;
        }
        $addForm = $di->getShared('form')->create($addFormInfo, $data);
        if ($addForm->isValid()) {
            $this->save($addForm);
        }
        return $addForm;
    }

    public function save($form)
    {
        $data = $form->getData();
        $options = $form->getUserOptions();
        $dataList = Config::get($options['data']);
        if (isset($options['id'])) {
            $data['id'] = $options['id'];
        } elseif (!isset($data['id'])) {
            $this->getDI()->getFlash()->error('保存失败，数据不完整');
        }
        $dataList[$data['id']] = $data;
        return Config::set($options['data'], $dataList);
    }
}