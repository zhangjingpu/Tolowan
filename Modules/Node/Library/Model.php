<?php
namespace Modules\Node\Library;

use Core\Config;
use Core\Model as Cmodel;
use Modules\Node\Models\NodeEntity;
use Modules\Node\Models\Node;

class Model
{
    // 获取文章列表
    public static function find($query)
    {
        //config::printCode($query);
        $query += array(
            'now' => true,
            'state' => 1,
            'order' => 'node.changed DESC',
        );
        $settings = Config::get('m.node.settings', array('limit' => 15));
        $nodeType = Config::get('m.node.type', array());
        $nodeEntity = false;
        $query['from'] = array('id' => 'node');
        foreach (array('mate') as $value) {
            if (isset($query[$value])) {
                $entityName = 'node_' . $value;
                $query['leftJoin'][] = array(
                    'id' => $entityName,
                    'conditions' => $entityName . '.nid = node.id',
                );
            }
            unset($query[$value]);
        }
        if (isset($query['type']) && isset($nodeType[$query['type']])) {
            NodeEntity::$type = $query['type'];
            $query['andWhere'][] = array(
                'conditions' => 'node.type = :type:',
                'bind' => array('type' => $query['type']),
            );
        }
        if (isset($query['entity']) && isset($query['type']) && isset($nodeType[$query['type']])) {
            $nodeModelsManager = Config::get('node.modelsManager');
            $nodeEntity = Config::get('m.node.node_' . $query['type']);
            $query['leftJoin'][] = array(
                'id' => 'node_entity',
                'conditions' => 'node_entity.nid = node.id',
                'columns' => array_merge_recursive($nodeModelsManager['node_entity']['columns'],$nodeEntity['settings']['tableColumns']),
            );
            unset($query['type']);
            unset($query['entity']);
            unset($nodeEntity);
        }
        unset($nodeType);
        if (!isset($query['now'])) {
            $query['now'] = true;
        }
        if ($query['now'] == true) {
            $query['andWhere'][] = array(
                'conditions' => 'node.created <= :now_time:',
                'bind' => array('now_time' => time()),
            );
            unset($query['now']);
        }
        //Config::printCode($query);
        foreach (array('state', 'top', 'hot', 'essence', 'module', 'comment', 'uid', 'id') as $value) {
            if (isset($query[$value])) {
                $query['andWhere'][] = array(
                    'conditions' => "node.$value = :$value:",
                    'bind' => array($value => $query[$value])
                );
            }
            unset($query[$value]);
        }
        if (!isset($query['limit'])) {
            $query['limit'] = $settings['limit'];
        }
        return Cmodel::find($query);
    }

    public static function findFirst($id, $query)
    {
        $query += array(
            'limit' => 1
        );
        $query['andWhere'][] = array(
            'conditions' => 'node.id = :id:',
            'bind' => array('id' => $id),
        );
        if (!isset($query['entity'])) {
            $query['entity'] = true;
        }
        if ($query['entity'] == true && !isset($query['type'])) {
            $node = Node::findFirst($id);
            if (!$node) {
                return false;
            } else {
                $query['type'] = $node->type;
            }
        }
        //Config::printCode($query);
        return self::find($query);
    }

    public static function node($id, $type = null)
    {
        if (is_object($id)) {
            //Config::printCode($id);
            $node = $id;
            $id = $node->nid;
            $type = $node->type;
        } else {
            $node = self::getNode($id, $type);
        }
        $output = array(
            '#templates' => array(
                'node'
            ),
            'data' => $node,
        );
        if (!is_null($type)) {
            $output['#templates'][] = 'node--' . $type;
        }
        if ($node) {
            $output['#templates'][] = 'node--state-' . $node->state;
            foreach (array('top', 'hot', 'essence') as $value) {
                if ($node->{$value}) {
                    $output['#templates'][] = 'node--' . $value;
                }
            }
            $output['#templates'][] = 'node--author-' . $node->uid;
        }
        $output['#templates'][] = 'node--' . $id;
        return $output;
    }

    public static function getNode($id, $type = null)
    {
        $query = array();
        if (!is_null($type)) {
            $query['type'] = $type;
        }
        return self::findFirst($id, $query);
    }
}