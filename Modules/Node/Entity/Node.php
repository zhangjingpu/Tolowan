<?php
namespace Modules\Node\Entity;

use Modules\Entity\Entity\EntityModel;

/**
 *
 */
class Node extends EntityModel
{
    /**
     * @var string
     * 映射数据库表
     */
    protected $_source = 'node';

    /**
     * @var mixed
     */
    protected $created = false;

    /**
     * @var string
     * 当前实体类
     */
    protected $entityClassName = '\Modules\Node\Entity\Node';

    /**
     * @var string
     * 所属模块
     */
    protected $_module = 'node';

    /**
     * @var string
     * 实体机读名
     */
    protected $_entityId = 'node';

    /**
     * @var mixed
     */
    protected $changed = false;

    public function initialize()
    {
        parent::initialize();
        // Skips only when inserting
    }

    public function beforeValidationOnCreate()
    {
        if (!$this->created) {
            $this->created = time();
        }
        $this->changed = time();
    }

    public function beforeValidationOnUpdate()
    {
        $this->changed = time();
    }

    public function getCreated()
    {
        if ($this->created === false) {
            $this->created = time();
        }
        return $this->created;
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

    public function getChanged()
    {
        if ($this->changed === false) {
            $this->changed = time();
        }
        return $this->changed;
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
}
