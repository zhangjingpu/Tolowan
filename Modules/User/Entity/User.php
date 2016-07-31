<?php
namespace Modules\User\Entity;

use Modules\Entity\Entity\EntityModel;

/**
 *
 */
class User extends EntityModel
{
    /**
     * @var string
     * 映射数据库表
     */
    protected $_source = 'user';

    /**
     * @var mixed
     */
    protected $created = false;

    /**
     * @var string
     * 当前实体类
     */
    protected $entityClassName = '\Modules\User\Entity\User';

    /**
     * @var string
     * 所属模块
     */
    protected $_module = 'user';

    /**
     * @var string
     * 实体机读名
     */
    protected $_entityId = 'user';

    /**
     * @var mixed
     */
    protected $changed = false;

    protected $password;

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        if($this->password != $password){
            $this->password = $this->getDI()->getSecurity()->hash($password);
        }
    }
    public function getCreated()
    {
        if ($this->created === false) {
            $this->created = time();
        }
        return date('Y-m-d H:i:s', $this->created);
    }

    /**
     * @param $created
     */
    public function setCreated($created)
    {
        if (strtotime($created)) {
            $created = strtotime($created);
        }
        $this->created = $created;
    }

    public function links()
    {
        $this->_links = array(
            'edit' => array(
                'href' => array(
                    'for' => 'adminEntityEdit',
                    'entity' => $this->_entityId,
                    'contentModel' => isset($this->contentModel) && $this->contentModel ? $this->contentModel : 'user',
                    'id' => $this->id,
                ),
                'icon' => 'info',
                'name' => '编辑',
            ),
            'delete' => array(
                'href' => array(
                    'for' => 'adminEntityDelete',
                    'entity' => $this->_entityId,
                    'id' => $this->id,
                ),
                'icon' => 'danger',
                'name' => '删除',
            ),
        );
        if ($this->getDI()->getEventsManager()->fire('entity:links', $this) === false) {
            return false;
        }
        return $this->_links;
    }

    public function getChanged()
    {
        if ($this->changed === false) {
            $this->changed = time();
        }
        return date('Y-m-d H:i:s', $this->changed);
    }

    public function setChanged($changed)
    {
        if (strtotime($changed)) {
            $changed = strtotime($changed);
        }
        $this->changed = $changed;
    }

    /**
     * @return mixed
     */
    public function renderState()
    {
        $output = array(
            '审核中',
            '已发布',
            '回收站',
            '禁用',
        );
        return $output[$this->state];
    }

    /**
     * @param $form
     */
    protected function _submitHandleForm($form)
    {
        $data = $form->getData();
        $checkItem = $_POST['checkAll'];
        $checkItem = array_flip($checkItem);
        $nodeList = self::find(array(
            'conditions' => 'id IN (:id:)',
            'bind' => array('id' => implode(',', $checkItem)),
        ));
        $output = array('success' => 0, 'error' => 0);
        foreach ($nodeList as $node) {
            if ($node) {
                if (isset($data['delete'])) {
                    if ($node->delete()) {
                        $output['success']++;
                        continue;
                    } else {
                        $output['error']++;
                    }
                }
                if (isset($data['state']) && $data['state'] != 4) {
                    //更改实体状态
                    $node->state = $data['state'];
                }
                if (isset($data['hot']) && $data['hot'] != 2) {
                    //更改热点状态
                    $node->hot = $data['hot'];
                }
                if (isset($data['essence']) && $data['essence'] != 2) {
                    //更改精华状态
                    $node->essence = $data['essence'];
                }
                if (isset($data['top']) && $data['top'] != 2) {
                    //更改置顶状态
                    $node->top = $data['top'];
                }
                if ($node->save()) {
                    $output['success']++;
                } else {
                    $output['error']++;
                }
            }
        }
        $this->getDI()->getFlash()->notice('成功执行' . $output['success'] . '条，' . $output['error'] . '条执行失败');
    }

    public function saveEntityBefore($form)
    {
        parent::saveEntityBefore($form);

        //处理创建和更改
        if (isset($this->created) && $this->created && strtotime($this->created)) {
            $this->created = strtotime($this->created);
        } else {
            $this->created = time();
        }
        if (isset($this->changed) && $this->changed && strtotime($this->created)) {
            $this->changed = strtotime($this->changed);
        } else {
            $this->changed = time();
        }
    }

}
