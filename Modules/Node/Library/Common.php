<?php
namespace Modules\Node\Library;

use Core\Config;
use Core\Options;
use Modules\Node\Models\Node as Mnode;
use Modules\Node\Models\NodeAttach;
use Modules\Node\Models\NodeEntity;
use Modules\Node\Models\NodeMate;
use Modules\Taxonomy\Models\EntityTerm;
use Modules\Taxonomy\Models\Term;

class Common
{
    public static $tocParams = array(
        'index' => 0,
        'upTag' => null,
        'upTagId' => null,
        'toc' => array(),
        'tocCache' => array(),
        'tocHtml' => array(),
    );
    public static function url($node)
    {
        global $di;
        $uri = $di->getShared('url')->get(array(
            'for' => 'node',
            'type' => $node->type,
            'id' => $node->id,
        ));
        return $uri;
    }
    public static function nodeMateHandle($nid, $type)
    {
        global $di;
        $paramsType = array(
            1 => 'yes',
            2 => 'no',
            3 => 'comment_num',
            4 => 'browse',
        );
        switch ($type) {
            case 1:
                if ($di->getShared('session')->has('yes') || $di->getShared('session')->has('no')) {
                    return false;
                }
                break;
            case 2:
                if ($di->getShared('session')->has('yes') || $di->getShared('session')->has('no')) {
                    return false;
                }
                break;
            case 3:
                if ($di->getShared('session')->has('comment_num')) {
                    return false;
                }
                break;
            case 4:
                if ($di->getShared('session')->has('browse')) {
                    return false;
                }
                break;
            default:
                return false;
                break;
        }
        $nodeMate = NodeMate::findFirstByNid($nid);
        if (!isset($nodeMate->id) || empty($nodeMate->id)) {
            $nodeMate = new NodeMate();
            $nodeMate->nid = $nid;
            $nodeMate->yes = 0;
            $nodeMate->no = 0;
            $nodeMate->comment_num = 0;
            $nodeMate->browse = 0;
        }
        $nodeMate->{$paramsType[$type]} = $nodeMate->{$paramsType[$type]}+1;
        switch ($type) {
            case 1:
                $di->getShared('session')->set('yes', 1);
                break;
            case 2:
                $di->getShared('session')->set('no', 1);
                break;
            case 3:
                $di->getShared('session')->set('comment_num', 1);
                break;
            case 4:
                $di->getShared('session')->set('browse', 1);
                break;
            default:
                return false;
                break;
        }
        $nodeMate->save();
    }
    //格式化时间
    public static function getNodeTime($form)
    {
        if (isset($form['data'][$form['key']]) && !empty($form['data'][$form['key']])) {
            $form['data'][$form['key']] = date('Y-m-d H:i:s', $form['data'][$form['key']]);
        }
        return $form;
    }
    public static function nodeMate($attach, $id)
    {
        $nodeMate = false;
        $nodeMate = NodeMate::findFirstByNid($id);
        if ($nodeMate == false) {
            $nodeMate = new NodeMate();
            $nodeMate->nid = 1;
            $nodeMate->yes = 0;
            $nodeMate->no = 0;
            $nodeMate->comment_num = 0;
            $nodeMate->browse = 0;
        }
        if (isset($nodeMate->{$attach}) && is_int($nodeMate->{$attach})) {
            $nodeMate->{$attach} += 1;
        }
        $nodeMate->save();
    }
    //删除一个节点
    public static function delete($id)
    {
        global $di;
        $db = $di->getShared('db');
        $node = Mnode::findFirst($id);
        if ($node == false) {
            $di->getShared('flash')->error('文章不存在，删除失败');
            return false;
        }
        //预留钩子147258369
        $eventsManager = $di->getShared('eventsManager');
        $nodeTypeEntity = Config::get('m.node.node_' . $node->type);
        foreach ($nodeTypeEntity as $key => $element) {
            if (isset($element['widget']) && isset($element['settings']['delete'])) {
                if(!is_callable($element['settings']['delete'])){
                    $di->getShared('flash')->error($key.' 字段相关信息删除，因为回调函数无效：'.$element['settings']['delete']);
                    break;
                }
                $element['settings']['entity'] = $node;
                $element['settings']['key'] = $key;
                call_user_func($element['settings']['delete'],$element);
            }
        }
        $db->begin();
        NodeEntity::$type = $node->type;
        $nodeEntity = NodeEntity::findFirstByNid($id);
        if ($nodeEntity) {
            $nodeEntity->delete();
        }
        if ($node->delete()) {
            $db->commit();
            $di->getShared('flash')->success('删除节点成功');
        } else {
            $db->rollback();
            $di->getShared('flash')->error('删除节点失败');
        }
    }
    /*
     * $state
     * 1 正常
     * 2 待审核
     * 4 收入回收站
     */
    public static function changeState($id,$state){
        $node = Node::findFirst($id);
        if(!$node){
            return false;
        }
        switch($state){
            case 'yes':
                //审核通过
                if($node->state == 2){
                    $node->state = 1;
                }
                break;
            case 'no':
                if($node->state == 1){
                    $node->state = 2;
                }
                break;
            case 'remove':
                if($node->state == 1){
                    $node->state = 4;
                }
                break;
            case 'fuyuan':
                if($node->state == 4){
                    $node->state = 1;
                }
                break;
        }
        if($node->save()){
            return $node;
        }else{
            return false;
        }
    }
    // 渲染一个节点
    public static function node($node)
    {
        if ((is_string($node) || is_int($node)) && (int) $node == intval($node)) {
            $node = intval($node);
            $node = self::findFirst(null, $node);
            if (!isset($node->id)) {
                return '';
            }
        }
        return array(
            '#templates' => array('node', 'node-' . $node->type),
            'node' => $node,
        );
    }

    //文章目录
    public static function toc($node, $key = null)
    {
        if ($key == null) {
            $key == 'body';
        }
        if (!isset($node->{$key})) {
            return $node;
        }
        if (!is_string($node->{$key})) {
            return $node;
        }
        $node->{$key} = preg_replace_callback('/<h([2-4]{1})>(.*?)<\/h[2-4]{1}>/i', 'self::tocReplace', $node->{$key});
        $node->toc = array(
            '#templates' => array('toc', 'toc-' . $node->id),
            'data' => self::$tocParams,
            'toc' => self::$tocParams['toc'],
            'tocHtml' => self::$tocParams['tocHtml'],
        );
        return $node;
    }
    public static function tocReplace($matches)
    {
        $matches[1] = (int) $matches[1];
        self::$tocParams['index']++;
        if (self::$tocParams['upTagId'] == null) {
            self::$tocParams['upTagId'] = self::$tocParams['index'];
        }
        if (self::$tocParams['upTag'] == null) {
            self::$tocParams['upTag'] = $matches[1];
        }
        self::$tocParams['tocCache'][self::$tocParams['index']] = array();
        if (self::$tocParams['upTag'] < $matches[1]) {
            if (!isset(self::$tocParams['tocCache'][self::$tocParams['upTagId']]['children'])) {
                self::$tocParams['tocCache'][self::$tocParams['upTagId']]['children'] = array();
            }
            self::$tocParams['tocCache'][self::$tocParams['upTagId']]['children'][self::$tocParams['index']] = &self::$tocParams['tocCache'][self::$tocParams['index']];
        } else {
            self::$tocParams['toc'][self::$tocParams['index']] = &self::$tocParams['tocCache'][self::$tocParams['index']];
        }
        self::$tocParams['upTagId'] = self::$tocParams['index'];
        self::$tocParams['upTag'] = $matches[1];
        self::$tocParams['tocHtml'][self::$tocParams['index']] = '<a href="#toc' . self::$tocParams['index'] . '">' . $matches[2] . '</a>';
        return '<h' . $matches[1] . '>' . $matches[2] . '<a id="toc' . self::$tocParams['index'] . '"><i class="icon-filter"></i></a></h' . $matches[1] . '>';
    }
    public static function getNodeTerm($params)
    {
        $query = array(
            'from' => array('id' => 'entity_term'),
            'leftJoin' => array(
                array(
                    'id' => 'term',
                    'conditions' => 'entity_term.tid = term.id',
                ),
            ),
            'where' => array(
                array(
                    'conditions' => 'entity_term.eid = :eid:',
                    'bind' => array('eid' => $params['eid']),
                ),
            ),
        );
        if (isset($params['module'])) {
            $query['andWhere'][] = array(
                'conditions' => 'entity_term.module = :module:',
                'bind' => array('module' => $params['module']),
            );
        }
        if (isset($params['field'])) {
            $query['andWhere'][] = array(
                'conditions' => 'entity_term.field = :field:',
                'bind' => array('field' => $params['field']),
            );
        }
        if (isset($params['limit'])) {
            $query['limit'] = $params['limit'];
        }
        return Model::find($query);
    }
    // 保存文章
    public static function save($form)
    {
        $node = false;
        global $di;
        $formEntity = $form->formEntity;
        $db = $di->getShared('db');
        $formData = $form->getData();
        $settings = $formEntity['settings'];
        //$db->begin();
        if (isset($formEntity['settings']['id'])) {
            $node = Mnode::findFirst($formEntity['settings']['id']);
            if (!$node) {
                throw new \Exception('保存失败，内容节点不存在');
            }
        }
        if (!$node) {
            $node = new Mnode();
            $node->created = time();
            $node->uid = 0;
            $node->comment = 1;
            $node->state = 1;
            $node->top = 0;
            $node->hot = 0;
            $node->essence = 0;
            $node->type = $settings['type'];
            $node->module = $settings['module'];
        }
        $node->changed = time();
        foreach (array('created', 'uid', 'comment','state','top','hot','essence') as $value){
            if (isset($formData[$value]) && is_int($formData[$value])) {
                $node->{$value} = $formData[$value];
            }
        }
        $node->title = $formData['title'];
        if ($node->save() != false) {
            //预留事件管理器
            $nodeEntity = false;
            NodeEntity::$type = $node->type;
            $nodeEntity = NodeEntity::findFirstByNid($node->id);
            if (!$nodeEntity) {
                $nodeEntity = new NodeEntity();
                $nodeEntity->nid = $node->id;
            }
            foreach ($form->getElements() as $key => $element) {
                if ($element->getUserOption('table') == 1) {
                    if (isset($nodeEntity->{$key}) && !empty($nodeEntity->{$key})) {
                        $nodeEntity->{$key} = $form->getValue($key) ? $form->getValue($key) : $nodeEntity->{$key};
                    } elseif(isset($settings['default'])) {
                        $nodeEntity->{$key} = $form->getValue($key) ? $form->getValue($key) : $settings['default'];
                    }else{
                        $nodeEntity->{$key} = $form->getValue($key);
                    }
                }
            }
            if ($nodeEntity->save()) {
                //预留事件
                //$db->commit();
                return $node;
            } else {
                //$db->rollback();
                foreach ($nodeEntity->getMessages() as $message) {
                    $di->getShared('flash')->error($message);
                }
                return false;
            }
        } else {
            foreach ($node->getMessages() as $message) {
                $di->getShared('flash')->error($message);
            }
            $di->getShared('flash')->error('文章节本信息保存失败');
            return false;
        }
        return false;
    }

}
