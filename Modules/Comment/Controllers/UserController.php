<?php
namespace Modules\Comment\Controllers;

use Core\Controller;
use Modules\User\Models\UserLog;

class UserController extends Controller
{
    public function indexAction()
    {
        extract($this->variables['router_params']);
    }

    public function loveAction()
    {
        extract($this->variables['router_params']);
        $data = array();
        $this->variables += array(
            '#templates' => 'json',
            'data' => &$data
        );
        $commentEntity = $this->entityManager->get('comment');
        $comment = $commentEntity->findFirst($id, true);
        if (!$comment) {
            $data = array(
                'state' => 'fail',
                'number' => '0',
                'notice' => '内容不存在了'
            );
        }
        $log = UserLog::findFirst(array(
            'conditions' => 'uid = :uid: AND type = :type:',
            'bind' => array(
                'uid' => $this->user->id,
                'type' => 'comment_love_' . $id
            )
        ));

        if ($log && $comment->love >= 1) {
            $comment->love += 1;
        } else {
            $comment->love -= 1;
        }
        if ($comment->save()) {
            $data = array(
                'state' => 'success',
                'number' => $comment->love,
            );
        } else {
            $data = array(
                'state' => 'fail',
                'number' => $comment->love,
                'notice' => '保存失败',
            );
        }
    }
}
