<?php
namespace Modules\User\Controllers;

use Core\Config;
use Core\Mvc\Controller;
use Modules\User\Library\CropAvatar;
use Modules\User\Models\User as Muser;

class UserController extends Controller
{

    public function indexAction()
    {
        extract($this->variables['router_params']);
        $userEntity = $this->entityManager->get('user');
        $user = $userEntity->findFirst($this->user->id, true);
        $userCenterForm = $this->form->create('user.baseInfoForm');
        $this->variables += [
            '#templates' => array(
                'pageUserCenter',
                'pageUserCenterIndex'
            ),
            'title' => '用户中心-个人资料',
            'description' => '用户中心-个人资料',
            'key' => '用户中心',
            'data' => $user,
            'userCenterForm' => $userCenterForm->renderForm(),
        ];
    }

    public function cropFaceAction()
    {
        extract($this->variables['router_params']);
        $crop = new CropAvatar(
            md5($this->user->id),
            isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
            isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
            isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
        );

        $response = array(
            'state' => 200,
            'message' => $crop->getMsg(),
            'result' => $crop->getResult(),
        );
        if (empty($crop->getMsg())) {
            $userInfo = UserInfo::findFirstByUid($this->user->uid);
            if (!$userInfo) {
                $userInfo = new UserInfo();
                $userInfo->uid = $this->user->uid;
            }
            $userInfo->face = $crop->getResult();
            if ($userInfo->save()) {
                $this->user->updateCookie('face', $userInfo->face);
            }
        }
        self::$variables += array(
            '#templates' => 'json',
            'data' => $response,
        );
    }

    public function logoutAction()
    {
        extract($this->variables['router_params']);
        $this->user->logout();
        return $this->moved();
    }

    public function checkEmailAction()
    {
        extract($this->variables['router_params']);
        $this->variables['keywords'] = $this->variables['description'] = $this->variables['title'] = '验证邮箱';
        $passwordForm = Config::get('user.checkEmail');
        $passwordForm = $this->form->create($passwordForm);
        $this->variables += array(
            '#templates' => array(
                'pageUserCenter',
                'pageUserCenterCheckEmail'
            ),
            'content' => array(
                'data' => $passwordForm->renderForm()
            )
        );
    }

    public function sendEmail()
    {
        extract($this->variables['router_params']);
    }

    public function passwordAction()
    {
        extract($this->variables['router_params']);
        $this->variables['keywords'] = $this->variables['description'] = $this->variables['title'] = '修改密码';
        $passwordForm = Config::get('user.passwordForm');
        $passwordForm = $this->form->create($passwordForm);
        if ($passwordForm->isValid()) {
            if ($passwordForm) {
                $this->user->logout();
                return $this->moved(array(
                    'for' => 'login'
                ));
            }
        }
        $this->variables += array(
            '#templates' => array(
                'pageUserCenter',
                'pageUserCenterPassword'
            ),
            'content' => array(
                'data' => $passwordForm->renderForm()
            )
        );
    }
}
