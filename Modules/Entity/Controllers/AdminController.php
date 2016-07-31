<?php
namespace Modules\Entity\Controllers;

use Core\Config;
use Core\Mvc\Controller;

class AdminController extends Controller
{

    public function indexAction()
    {
        extract($this->variables['router_params']);
        // 获取实体类型
        $entityObject = $this->entityManager->get($entity);
        $entityInfo = $entityObject->getEntityInfo();
        if (!isset($entityInfo['path']['adminEntityList']) || $entityInfo['path']['adminEntityList'] === false) {
            return $this->notFount();
        }
        $contentModelList = $entityObject->getContentModelList();
        $label = $entityInfo['entityName'];
        $filterForm = $entityObject->filterForm($entity);
        $query = array(
            'limit' => 20,
            'page' => $page,
            'paginator' => true,
            'order' => 'changed DESC',
        );
        if ($filterForm->isValid()) {
            $query = $entityObject->submitFilterForm($filterForm, $query);
        }
        $data = $entityObject->find($query);
        $this->variables = array_merge($this->variables, array(
            'title' => '实体',
            'contentModelList' => $contentModelList,
            'description' => $label . '列表',
            'params' => $this->variables['router_params'],
            'breadcrumb' => array(
                'admin' => array(
                    'href' => array(
                        'for' => 'adminIndex',
                    ),
                    'name' => '控制台',
                ),
                'nodeList' => array(
                    'name' => $label . '列表',
                ),
            ),
            'content' => array(),
        ));

        if ($filterForm) {
            $content['filter'] = array(
                '#templates' => 'box',
                'max' => false,
                'color' => 'widget',
                'hiddenTitle' => false,
                'size' => '12',
                'wrapper' => true,
                'content' => array(
                    'filterForm' => $filterForm->renderForm(),
                ),
            );
        }
        $menuGroup = $entityObject->menuTabs();
        $content['nodeList'] = array();
        $content['nodeList'] = array(
            '#templates' => 'box',
            'wrapper' => true,
            'title' => $label . '列表',
            'max' => false,
            'color' => 'success',
            'size' => '12',
            'content' => array(
                'menuGroup' => array(),
                'list' => array(
                    '#templates' => array(
                        'adminEntityList',
                        'adminEntityList-' . $entity,
                    ),
                    '#module' => $entityInfo['module'],
                    'data' => $data,
                    'handleForm' => $entityObject->handleForm(),
                ),
            ),
        );
        if ($menuGroup) {
            $content['nodeList']['content']['menuGroup'] = array(
                '#templates' => 'menuGroup',
                'title' => '添加',
                'data' => $menuGroup,
            );
        }
        $this->variables['content'] += $content;
    }

    protected function _filterForm($query)
    {
        $params = $this->request->getQuery();
        foreach (array(
                     'top',
                     'hot',
                     'essence',
                 ) as $value) {
            if (isset($params[$value])) {
                $query[$value] = 1;
            }
        }
        if (isset($params['state']) && $params['state']) {
            $query['state'] = intval($params['state']);
        }
        if (isset($params['type'])) {
            $nodeType = Config::get('m.node.type');
            if (isset($nodeType[$params['type']])) {
                $query['type'] = $params['type'];
            }
        }
        return $query;
    }

    public function addAction()
    {
        extract($this->variables['router_params']);
        $entityManager = $this->entityManager->get($entity);
        $contentModelInfo = $entityManager->getContentModelInfo($contentModel);
        $entityInfo = $entityManager->getEntityInfo();
        if (!isset($entityInfo['path']['adminEntityAdd']) || $entityInfo['path']['adminEntityAdd'] === false) {
            return $this->notFount();
        }
        $label = '添加' . $contentModelInfo['modelName'];
        $content = array();

        $entityEditForm = $entityManager->addForm($contentModel);
        $this->variables = array(
            'title' => $label,
            'description' => '',
            'breadcrumb' => array(
                'admin' => array(
                    'href' => array(
                        'for' => 'adminIndex',
                    ),
                    'name' => '控制台',
                ),
                'adminAddNode' => array(
                    'name' => $label,
                ),
            ),
            'content' => array(
                'entityForm' => array(
                    '#templates' => 'adminEntityForm',
                    'data' => $entityEditForm,
                ),
            ),
        );
    }

    public function editAction()
    {
        extract($this->variables['router_params']);
        $entityManager = $this->entityManager->get($entity);
        $contentModelInfo = $entityManager->getContentModelInfo($contentModel);
        $entityInfo = $entityManager->getEntityInfo();
        if (!isset($entityInfo['path']['adminEntityEdit']) || $entityInfo['path']['adminEntityEdit'] === false) {
            return $this->notFount();
        }
        $label = '编辑' . $contentModelInfo['modelName'];
        $content = array();

        $entityEditForm = $entityManager->editForm($contentModel, $id);
        $this->variables = array(
            'title' => $label,
            'description' => '',
            'breadcrumb' => array(
                'admin' => array(
                    'href' => array(
                        'for' => 'adminIndex',
                    ),
                    'name' => '控制台',
                ),
                'adminAddNode' => array(
                    'name' => $label,
                ),
            ),
            'content' => array(
                'entityForm' => array(
                    '#templates' => 'adminEntityForm',
                    'data' => $entityEditForm,
                ),
            ),
        );
    }

    public function deleteAction()
    {
        extract($this->variables['router_params']);
        $entityModel = $this->entityManager->get($entity);
        $entityInfo = $entityModel->getEntityInfo();
        if (!isset($entityInfo['path']['adminEntityDelete']) || $entityInfo['path']['adminEntityDelete'] === false) {
            return $this->notFount();
        }
        if ($entityModel->delete($id)) {
            $this->flash->success('删除成功');
        } else {
            $this->flash->error('删除失败');
        }
        return $this->moved(array('for' => 'adminEntityList', 'entity' => $entity, 'page' => 1));
    }

    public function typeAction()
    {
        extract($this->variables['router_params']);
        $entityType = $this->entityManager->getEntityType($entity);
        $entityTypeName = $entityType->getName();
        $module = $entityType->getModule();
        $typeList = Config::get('m.' . $module . '.type');
        $this->variables += array(
            'title' => $entityTypeName . '类型列表',
            'description' => $entityType->getDescription(),
            'params' => $this->variables['router_params'],
            'breadcrumb' => array(
                'admin' => array(
                    'href' => array(
                        'for' => 'adminIndex',
                    ),
                    'name' => '控制台',
                ),
                'nodeList' => array(
                    'name' => $entityTypeName . '类型列表',
                ),
            ),
            'content' => array(),
        );

        // echo $entityType->getModule().'<br>';
        $content['entityTypeList'] = array(
            '#templates' => 'box',
            'wrapper' => true,
            'title' => '列表',
            'max' => false,
            'color' => 'success',
            'size' => '12',
            'content' => array(
                'list' => array(
                    '#templates' => array(
                        'adminEntityTypeList',
                        'adminEntityTypeList-' . $entity,
                    ),
                    '#module' => $entityType->getModule(),
                    'data' => $typeList,
                ),
            ),
        );
        $this->variables['content'] += $content;
    }

    public function addTypeAction()
    {
    }

    public function editTypeAction()
    {
    }

    public function deleteTypeAction()
    {
    }
}
