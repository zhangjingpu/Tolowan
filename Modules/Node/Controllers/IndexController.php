<?php
namespace Modules\Node\Controllers;

use Core\Config;
use Core\Mvc\Controller;
use Modules\Node\Models\Node;

class IndexController extends Controller
{

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function indexAction()
    {
        extract($this->variables['router_params']);
        $nodeEntity = $this->entityManager->get('node');
        $data = $nodeEntity->findFirst($id, true);
        if (!$data) {
            return $this->notFount();
        }
        $nodeConfig = Config::get('m.node.config');
        if (isset($nodeConfig['browse']) && $nodeConfig['browse'] == true) {
            $data->browse = $data->browse + 1;
            $data->save();
        }
        $this->variables['title'] = $data->getTitle();
        $this->variables += array(
            '#templates' => array(
                'pageNode',
                'pageNode-' . $data->contentModel,
                'pageNode-' . $id,
            ),
            'contentModel' => $data->contentModel,
            'data' => $data,
        );
    }

    public function loveAction()
    {
        extract($this->variables['router_params']);
        $data = array(
            'state' => false,
            'notice' => '执行失败',
        );
        $this->variables['#templates'] = 'json';
        $this->variables['data'] = &$data;
        $nodeEntity = $this->entityManager->get('node');
        $node = $nodeEntity->findFirst($id, true);
        if ($node) {
            $node->love = $node->love + 1;
            if ($node->save()) {
                $data = array(
                    'state' => true,
                    'notice' => '执行成功',
                );
            }
        }
    }

    public function termAction()
    {
        extract($this->variables['router_params']);
        $nodeConfig = Config::get('m.node.config');
        $termEntity = $this->entityManager->get('term');
        $term = $termEntity->findFirst($id, true);
        if (!$term) {
            return $this->notFount();
        }
        $termContentModel = $term->contentModel;
        $nodeEntity = $this->entityManager->get('node');
        $nodeFields = $nodeEntity->getFields();
        $termFieldList = array();
        foreach ($nodeFields as $fieldName => $field) {
            if (isset($field['field']) && $field['field'] == 'term' && $field['taxonomy'] == $termContentModel) {
                $termFieldList[$fieldName] = $fieldName;
            }
        }
        $conditions = array();
        $bind = array();
        foreach ($termFieldList as $field) {
            $conditions[] = '%' . $field . '% = :' . $field . ':';
            $bind[$field] = $id;
        }
        $conditions = implode(' OR ', $conditions);
        $query = array(
            'andWhere' => array(
                array(
                    'conditions' => $conditions,
                    'bind' => $bind,
                ),
            ),
            'limit' => isset($nodeConfig['term_number']) && $nodeConfig['term_number'] ? $nodeConfig['term_number'] : 15,
            'page' => $page,
            'paginator' => true,
        );
        $data = $nodeEntity->find($query);
        $this->variables['title'] = $term->name;
        $this->variables['description'] = $term->description;
        $this->variables['keywords'] = $term->name;
        $this->variables += array(
            '#templates' => array(
                'pageNodeTerm',
                'pageNodeTerm-' . $id,
                'pageNodeTerm-' . $id . '-' . $page,
            ),
            'id' => $id,
            'page' => $page,
            'term' => $term,
            'data' => $data,
        );
    }

    public function typeAction()
    {
        extract($this->variables['router_params']);
        $nodeConfig = Config::get('m.node.config');
        $nodeEntity = $this->entityManager->get('node');
        $nodeType = $nodeEntity->getContentModelList();
        if (!isset($nodeType[$contentModel])) {
            return $this->notFount();
        }
        $query = array(
            'andWhere' => array(
                array(
                    'conditions' => '%contentModel% = :contentModel:',
                    'bind' => array('contentModel' => $contentModel),
                ),
            ),
            'limit' => isset($nodeConfig['number']) && $nodeConfig['number'] ? $nodeConfig['number'] : 15,
            'paginator' => true,
            'page' => $page,
        );
        $data = $nodeEntity->find($query);
        $this->variables['title'] = $nodeType[$contentModel]['modelName'];
        $this->variables['description'] = $nodeType[$contentModel]['description'];
        $this->variables += array(
            '#templates' => array(
                'pageNodeType',
                'pageNodeType-' . $contentModel,
            ),
            'data' => $data,
            'nodeType' => $nodeType[$contentModel],
            'contentModel' => $contentModel,
            'page' => $page,
        );
    }

    public function mateAction()
    {
        extract($this->variables['router_params']);
        $nodeExist = Node::findFirst($nid);
        if ($nodeExist) {
            Common::nodeMateHandle($nid, $type);
        } else {
            return $this->getNotFount();
        }
    }
}
