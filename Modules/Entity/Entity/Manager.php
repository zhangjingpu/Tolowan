<?php
namespace Modules\Entity\Entity;

use Core\Config;
use Core\Entity\Entity;
use Phalcon\Exception;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

/**
 * Class EntityManager
 * @package Core
 */
class Manager extends Plugin
{
    protected $_entityId = 'entity';
    protected $_module = 'entity';
    protected $_entityInfo;
    protected $_connect = 'db';
    protected $_query;

    public function __construct()
    {
        $this->_entityInfo = $this->getDI()->getEntityManager()->getEntityInfo($this->_entityId);
    }

    protected function paramsValidate($query)
    {
        if (!isset($query['entity'])) {
            throw new Exception('参数错误');
        }
        if (!isset($this->_entitys[$query['entity']])) {
            throw new Exception('实体类型不存在：' . $query['entity']);
        }
    }

    public function getContentModelList()
    {
        return Config::get('m.' . $this->_module . '.entity' . ucfirst($this->_entityId) . 'ContentModelList', array());
    }

    public function addForm($contentModel, $data = array())
    {
        global $di;
        $addFormInfo = $this->getFields($contentModel);
        $addFormInfo['settings']['contentModel'] = $contentModel;
        $addFormInfo['contentModel']['settings']['default'] = $contentModel;
        $entityForm = $di->getShared('form')->create($addFormInfo, $data);
        if ($entityForm->isValid()) {
            $this->save($entityForm);
        }
        return $entityForm;
    }

    public function editForm($contentModel = null, $id = null)
    {
        global $di;
        $data = $this->findFirst($id);
        if (is_object($data)) {
            if (method_exists($data, 'toArray')) {
                $data = $data->toArray();
            } else {
                $data = (array) $data;
            }
        }
        if (is_null($contentModel) && isset($data['contentModel'])) {
            $contentModel = $data['contentModel'];
        } elseif (is_null($contentModel)) {
            throw new Exception('参数错误');
        }
        $addFormInfo = $this->getFields($contentModel);
        $addFormInfo['settings']['contentModel'] = $contentModel;
        $addFormInfo['settings']['id'] = $id;
        $addFormInfo['contentModel']['settings']['default'] = $contentModel;
        $entityForm = $di->getShared('form')->create($addFormInfo, $data);
        if ($entityForm->isValid()) {
            $this->save($entityForm);
        }
        return $entityForm;
    }

    public function saveBefore($entityForm)
    {
        $output = $this->eventsManager->fire("entity:saveBefore", $entityForm);
        return !empty($output) && $output !== false ? $output : $entityForm;
    }
    public function save($entityForm)
    {
        $entityForm = $this->saveBefore($entityForm);
        if ($entityForm === false) {
            return false;
        }
        $options = $entityForm->getUserOptions();
        $entityModelName = $this->_entityInfo['entityModel'];
        $connectName = 'get' . ucfirst($this->_connect);
        $db = $this->getDI()->{$connectName}();
        $db->begin();
        if (isset($options['id'])) {
            $entityModel = $entityModelName::findFirst($options['id']);
            if (!$entityModel) {
                throw new Exception('内容不存在');
            }
        } else {
            $entityModel = new $entityModelName();
        }
        $data = $entityForm->getData();
        $entityModel->contentModel = $options['contentModel'];
        foreach ($entityForm->getElements() as $fieldKey => $field) {
            $elementOptions = $field->getUserOptions();
            if (isset($elementOptions['baseField']) && $elementOptions['baseField'] == true) {
                if (isset($data[$fieldKey])) {
                    $entityModel->{$fieldKey} = $data[$fieldKey];
                } elseif (isset($elementOptions['default'])) {
                    $entityModel->{$fieldKey} = $elementOptions['default'];
                }
            } elseif (isset($elementOptions['addition']) && $elementOptions['addition'] == true) {
                if (!isset($data[$fieldKey]) && isset($elementOptions['default']) && isset($elementOptions['required']) && $elementOptions['required'] == false) {
                    $data[$fieldKey] = $elementOptions['default'];
                }
                if (isset($data[$fieldKey])) {
                    if (!isset($elementOptions['model'])) {
                        $elementOptions['model'] = '\Models\\' . ucfirst($this->_entityId) . 'Field' . ucfirst($fieldKey);
                    }
                    $elementOptions['entity'] = $this->_entityId;
                    $elementOptions['contentModel'] = $options['contentModel'];
                    $elementOptions['fieldName'] = $fieldKey;
                    $model = $elementOptions['model'];
                    if (isset($elementOptions['maxNum']) && $elementOptions['maxNum'] > 1) {
                        $fieldModelList = array();
                        if (is_string($data[$fieldKey])) {
                            $data[$fieldKey] = array($data[$fieldKey]);
                        }
                        $newData = array();
                        $fieldList = $model::findByEid($entityModel->id);
                        $fieldModelLength = count($fieldList);
                        $dataFieldLength = count($data[$fieldKey]);
                        if ($fieldModelLength < $dataFieldLength) {
                            $cha = $dataFieldLength - $fieldModelLength;
                            $newData = array_slice($data[$fieldKey], $cha - 1);
                        }
                        $i = 0;
                        foreach ($fieldList as $fieldModel) {
                            if (isset($data[$fieldKey][$i])) {
                                $fieldModel->setOptions($elementOptions);
                                $fieldModel->setValue($data[$fieldKey][$i]);
                                $fieldModelList[] = $fieldModel;
                            } else {
                                $fieldModel->delete();
                            }
                            $i++;
                        }
                        foreach ($newData as $value) {
                            $fieldModel = new $model();
                            $fieldModel->eid = $entityModel->id;
                            $fieldModel->setOptions($elementOptions);
                            $fieldModel->setValue($value);
                            $fieldModelList[] = $fieldModel;
                        }
                    } else {
                        $fieldModel = $model::findFirstByEid($entityModel->id);
                        if (!$fieldModel) {
                            $fieldModel = new $model();
                            $fieldModel->eid = $entityModel->id;
                        }
                        $fieldModel->setOptions($elementOptions);
                        $fieldModel->setValue($data[$fieldKey]);
                        $fieldModelList = $fieldModel;
                    }
                    $entityModel->{$fieldKey} = $fieldModelList;
                }
            }
        }
        if ($entityModel->save()) {
            if ($this->getDI()->getEventsManager()->fire('entity:saveAfter', $this) === false) {
                return false;
            }
            $this->getDI()->getFlash()->success('内容保存成功');
            $db->commit();
            $this->saveAfter($entityModel, $entityForm);
            return $entityModel;
        } else {
            $error = '';
            foreach ($entityModel->getMessages() as $message) {
                $error .= $message . "<br>";
            }
            $this->getDI()
                ->getFlash()
                ->error('内容保存失败<br>' . $error);
            $db->rollback();
            return false;
        }
    }

    public function saveAfter($entityModel, $entityForm)
    {
        $this->eventsManager->fire("entity:saveAfter", $entityModel, $entityForm);
    }
    public function getContentModelInfo($contentModel, $key = null)
    {
        $contentModelList = $this->getContentModelList();
        if (!isset($contentModelList[$contentModel])) {
            return false;
        }
        if (is_null($key) && isset($contentModelList[$contentModel][$key])) {
            return $contentModelList[$contentModel][$key];
        }
        return $contentModelList[$contentModel];
    }

    public function menuTabs()
    {
        return false;
    }

    public function hasContentModel($contentModel)
    {
        $contentModelList = Config::get('m.' . $this->_module . '.entity' . ucfirst($this->_entityId) . 'ContentModelList');
        if (isset($contentModelList[$contentModel])) {
            return true;
        }
        return false;
    }
    public function getFields($contentModel = null)
    {
        $baseFields = Config::get($this->_module . '.' . $this->_entityId . 'BaseFields', array());
        $contentModelList = Config::get('m.' . $this->_module . '.entity' . ucfirst($this->_entityId) . 'ContentModelList');
        if (is_null($contentModel)) {
            foreach ($contentModelList as $model) {
                $fields = array();
                if (isset($model['fields'])) {
                    if (is_array($model['fields'])) {
                        $fields = $model['fields'];
                    } elseif (is_string($model['fields'])) {
                        $fields = Config::get($model['fields'], array());
                    }
                }
                $baseFields = array_merge($fields, $baseFields);
            }
        } else {
            if (isset($contentModelList[$contentModel])) {
                $model = $contentModelList[$contentModel];
                $fields = array();
                if (isset($model['fields'])) {
                    if (is_array($model['fields'])) {
                        $fields = $model['fields'];
                    } elseif (is_string($model['fields'])) {
                        $fields = Config::get($model['fields'], array());
                    }
                }
                $baseFields = array_merge($fields, $baseFields);
            } else {
                throw new Exception('参数错误，实体类型不存在');
            }
        }
        if (!is_null($contentModel)) {
            $baseFields['formId'] = $this->_entityId . ucfirst($contentModel);
        }
        return $baseFields;
    }

    public function getEntityInfo($infoKey = null)
    {
        if (is_null($infoKey)) {
            return $this->_entityInfo;
        } else {
            return $this->_entityInfo[$infoKey];
        }
    }

    public function find($query = array())
    {
        $modelList = Config::cache('modelsManager');
        $fields = $this->getFields();
        $entityForm = $this->getDI()->getForm()->create($fields);
        $fieldElements = $entityForm->getElements();
        $modelClassName = $this->_entityInfo['entityModel'];
        $columns = $modelList[$this->_entityId]['columns'];
        $this->_query = $modelClassName::query();
        foreach (array('join', 'leftJoin', 'rightJoin', 'innerJoin') as $condition) {
            if (isset($query[$condition]) && !empty($query[$condition]) && is_array($query[$condition])) {
                foreach ($query[$condition] as $item) {
                    $field = $item['id'];
                    if (isset($modelList[$field])) {
                        $this->_query = $this->_query->{$condition}($modelList[$field]['entity'], $item['conditions'], $field);
                        if (isset($item['columns']) && is_array($item['columns'])) {
                            $columns = array_merge($columns, $item['columns']);
                        } else {
                            $joinColumns = $modelList[$field]['columns'];
                            if (isset($item['exColumns']) && is_array($item['exColumns'])) {
                                foreach ($item['exColumns'] as $ec) {
                                    $ek = array_search($ec, $joinColumns);
                                    if ($ek !== false) {
                                        unset($joinColumns[$ek]);
                                    }
                                }
                            }
                            $columns = array_merge($columns, $joinColumns);
                        }

                    }
                }
                unset($joinColumns);
            }
        }
        /*
         * array('conditions'=>'','bind'=>'','type'=>'')
         */
        foreach (array('where', 'andWhere', 'orWhere', 'inWhere', 'notInWhere') as $condition) {
            if (isset($query[$condition]) && !empty($query[$condition]) && is_array($query[$condition])) {
                foreach ($query[$condition] as $item) {
                    $item['conditions'] = preg_replace_callback('|%([a-zA-Z_]+)%|', function ($matches) use ($fieldElements, $modelClassName) {
                        $fieldName = $matches[1];
                        if (isset($fieldElements[$fieldName])) {
                            $fieldOptions = $fieldElements[$fieldName]->getUserOptions();
                            if (isset($fieldOptions['addition']) && $fieldOptions['addition'] === true) {
                                $model = isset($fieldOptions['model']) ? $fieldOptions : '\Models\\' . ucfirst($this->_entityId) . 'Field' . ucfirst($matches[1]);
                                if (isset($fieldOptions['required']) && $fieldOptions['required'] === true) {
                                    $this->_query->join($model, $modelClassName . '.id = ' . $matches[1] . '.eid', $matches[1]);
                                } else {
                                    $this->_query->leftJoin($model, $modelClassName . '.id = ' . $matches[1] . '.eid', $matches[1]);
                                }
                                return $matches[1] . '.value';
                            }
                        }
                        return $matches[1];
                    }, $item['conditions']);
                    if ($condition == 'inWhere' || $condition == 'notInWhere') {
                        $this->_query = $this->_query->{$condition}($item['conditions'], $item['bind']);
                    } else {
                        if (!isset($item['type'])) {
                            $item['type'] = null;
                        }
                        if (isset($item['conditions']) && isset($item['bind'])) {
                            $this->_query = $this->_query->{$condition}($item['conditions'], $item['bind'], $item['type']);
                        }
                    }
                }
            }
        }

        foreach (array('match') as $condition) {
            if (isset($query[$condition]) && !empty($query[$condition]) && is_array($query[$condition])) {
                foreach ($query[$condition] as $item) {
                    $item['conditions'] = preg_replace_callback('|%([a-zA-Z_]+)%|', function ($matches) use ($fieldElements, $modelClassName) {
                        $fieldName = $matches[1];
                        if (isset($fieldElements[$fieldName])) {
                            $fieldOptions = $fieldElements[$fieldName]->getUserOptions();
                            if (isset($fieldOptions['addition']) && $fieldOptions['addition'] === true) {
                                $model = isset($fieldOptions['model']) ? $fieldOptions : '\Models\\' . ucfirst($this->_entityId) . 'Field' . ucfirst($matches[1]);
                                if (isset($fieldOptions['required']) && $fieldOptions['required'] === true) {
                                    $this->_query->join($model, $modelClassName . '.id = ' . $matches[1] . '.eid', $matches[1]);
                                } else {
                                    $this->_query->leftJoin($model, $modelClassName . '.id = ' . $matches[1] . '.eid', $matches[1]);
                                }
                                return $matches[1] . '.full_text';
                            }
                        }
                        return $matches[1];
                    }, $item['conditions']);
                    $this->_query = $this->_query->andWhere($item['conditions'], $item['bind']);
                }
            }
        }
        //$this->_query = $this->_query->columns($columns);
        if (isset($query['order'])) {
            $this->_query = $this->_query->orderBy($query['order']);
        }
        if (isset($query['group'])) {
            $this->_query = $this->_query->groupBy($query['group']);
        }

        if (isset($query['paginator']) && $query['paginator'] == true) {
            if (!isset($query['limit'])) {
                $query['limit'] = 20;
            }
            if (!isset($query['page'])) {
                $query['page'] = 1;
            }

            $output = new PaginatorModel(array(
                'data' => $this->_query->execute(),
                'limit' => $query['limit'],
                'page' => $query['page'],
            ));

            return $output->getPaginate();
        }
        if (isset($query['limit'])) {
            if ($query['limit'] == 1) {
                return $this->_query->execute();
            } else {
                $this->_query = $this->_query->limit(intval($query['limit']));
            }
        }
        return $this->_query->execute();
    }

    public function findFirst($query, $object = false)
    {
        $modelClassName = $this->_entityInfo['entityModel'];
        $entityModel = $modelClassName::findFirst($query);
        if (!$entityModel) {
            throw new Exception('节点不存在');
        }
        if ($object === true) {
            return $entityModel;
        }
        $contentModel = $entityModel->contentModel;
        $output = $entityModel->toArray();
        $fields = $this->getFields($contentModel);
        $fieldForm = $this->getDI()->getForm()->create($fields);
        foreach ($fieldForm->getElements() as $key => $field) {
            $fieldOptions = $field->getUserOptions();
            if (isset($fieldOptions['addition']) && $fieldOptions['addition'] == true) {
                $fieldModelName = isset($fieldOptions['model']) ? $fieldOptions['model'] : '\Models\\' . ucfirst($this->_entityId) . 'Field' . ucfirst($key);

                $output[$key] = call_user_func_array($fieldModelName . '::filterValue', array($entityModel->{$key}, $fieldOptions));

            }
        }
        return $output;
    }

    public function filterForm()
    {
        $filterFormInfo = Config::get($this->_module . '.' . $this->_entityId . 'FilterForm', array());
        $filterForm = $this->getDI()->getForm()->create($filterFormInfo);
        return $filterForm;
    }

    public function submitFilterForm($filterForm, $query)
    {
        $data = $filterForm->getData;
        foreach ($data as $key => $value) {
            $query['andWhere'][] = array(
                'conditions' => "%$key% = :$key:",
                'bind' => array(
                    $key => $value,
                ),
            );
        }
        return $query;
    }
    public function handleForm()
    {
        $handleFormInfo = Config::get($this->_module . '.' . $this->_entityId . 'HandleForm', array());
        $handleForm = $this->getDI()->getForm()->create($handleFormInfo);
        if ($handleForm->isValid()) {
            $this->handleSubmit($handleForm);
        }
        return $handleForm;
    }

    public function handleSubmit($form)
    {
        global $di;
        $data = $form->getData();
        $query = array(
            'inWhere' => array(
                array(
                    'conditions' => '%id%',
                    'bind' => array($data['list']),
                ),
            ),
        );
        $entity = $di->getShared('entityManager')->get('node');
        $entityList = $entity->find($query);

        foreach ($entityList as $item) {
            if (isset($data['delete']) && $data['delete'] == true) {
                $item->delete();
            } else {
                $fields = $this->getFields();
                foreach ($data as $key => $value) {
                    if ($value !== 'null') {
                        $item->{$key} = $value;
                    }

                }
                $item->save();
            }
        }
        return $form;
    }
    public function delete($id)
    {
        $modelClassName = $this->_entityInfo['entityModel'];
        $entity = $modelClassName::findFirst($id);
        if ($entity && $entity->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
