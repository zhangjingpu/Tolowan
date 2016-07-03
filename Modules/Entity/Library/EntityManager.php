<?php
namespace Modules\Entity\Library;

use Core\Config;
use Phalcon\Exception;
use Library\Scsw\PSCWS4;

class EntityManager
{
    protected $_entitys;
    protected $_entityManagers;

    public function __construct()
    {
        $this->_entitys = Config::cache('entitys');
    }

    public function getEntityInfo($entity)
    {
        if (isset($this->_entitys[$entity])) {
            return $this->_entitys[$entity];
        }
        return false;
    }

    public function get($entity)
    {
        if (isset($this->_entityManagers[$entity])) {
            return $this->_entityManagers[$entity];
        }
        if (isset($this->_entitys[$entity])) {
            if (!isset($this->_entitys[$entity]['entityManager']) || !class_exists($this->_entitys[$entity]['entityManager'])) {
                echo $this->_entitys[$entity]['entityManager'];
                throw new Exception('参数错误，不是有效的实体管理类' . $entity);
            }
            $entityClassName = $this->_entitys[$entity]['entityManager'];
            $this->_entityManagers[$entity] = new $entityClassName();
            return $this->_entityManagers[$entity];
        } else {
            throw new Exception('实体类型不存在：' . $entity);
        }
        return false;
    }

    public static function fieldScsw($data = array())
    {
        global $di;
        if (!isset($data['entity']) || !isset($data['field']) || !isset($data['id'])) {
            return '参数错误';
        }
        $fieldName = $data['field'];
        $entity = $di->getShared('entityManager')->get($data['entity']);
        $entityNode = $entity->findFirst($data['id'], true);
        if (!$entityNode) {
            return '实体不存在，id:' . $data['id'];
        }
        //Config::printCode($entityNode->toArray());
        $fieldModel = $entityNode->{$fieldName};
        if ($fieldModel) {
            //分词
            $output = '';
            $pscws = new PSCWS4();
            $pscws->set_charset();
            $pscws->set_dict();
            $pscws->set_rule();
            $pscws->send_text($entityNode->{$fieldName}->value);
            while ($some = $pscws->get_result()) {
                foreach ($some as $word) {
                    $output = $output . ' ' . $word['word'];
                }
            }
            $pscws->close();
            if (!empty($output)) {
                $fieldModel->full_text = $output;
                if ($fieldModel->save()) {
                    return true;
                } else {
                    return '保存失败';
                }
            } else {
                return true;
            }
        } else {
            return '字段不存在';
        }
    }
}