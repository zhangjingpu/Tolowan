<?php
namespace Modules\User\Controllers;

use Core\Config;
use Core\Mvc\Controller;
use Modules\User\Library\Common;
use Modules\User\Models\User as Muser;

class IndexController extends Controller
{
    public function indexAction()
    {
        extract($this->variables['router_params']);
        $userEntity = $this->entityManager->get('user');
        $user = $userEntity->findFirst($id, true);
        if (!$user) {
            return $this->getNotFount();
        }
        $this->variables['title'] = $user->name.' 的主页';
        $this->variables['description'] = $user->name.' 的主页';
        $this->variables['keywords'] = $user->name;
        $this->variables += [
            '#templates' => 'pageUser',
            'data' => $user,
        ];
    }

    public function userCenterAction()
    {
        extract($this->variables['router_params']);
        $userEntity = $this->entityManager->get('user');
        $user = $nodeEntity->findFirst($this->user->id, true);
        $userCenterForm = $this->form->create('user.baseInfoForm');
        $this->variables += [
            '#templates' => 'pageUserCenterIndex',
            'title' => '用户中心-个人资料',
            'description' => '用户中心-个人资料',
            'key' => '用户中心',
            'userCenterForm' => $userCenterForm->renderForm(),
        ];
    }

    public function remoteAction()
    {
        extract($this->variables['router_params']);
        $this->variables['page'] = [
            '#templates' => 'remote',
        ];
        $valid = false;
        $this->response->setContentType('application/json', 'UTF-8');
        $username = $this->request->getPost('username');
        $user = Muser::findFirstByName($username);
        if ($user) {
            $valid = false;
        } else {
            $valid = true;
        }
        echo json_encode(['valid' => $valid]);
    }

    public function managerAction()
    {
        extract($this->variables['router_params']);
        $this->variables['#templates'] = 'userManager';
    }

    public function loginAction()
    {
        extract($this->variables['router_params']);
        if ($this->user->isLogin() === true) {
            $this->flash->success('已经登出，更换账户请退出后登陆');
            return $this->temMoved(['for' => 'index']);
        }
        $this->variables['keywords'] = $this->variables['description'] = $this->variables['title'] = '用户登陆';
        $loginForm = Config::get('user.loginForm');
        $loginForm = $this->form->create($loginForm);
        if ($loginForm->isValid()) {
            $state = $loginForm->save();
            if ($state !== false) {
                return $this->temMoved();
            }
        }
        $this->variables += [
            '#templates' => 'login',
            'data' => $loginForm->renderForm(),
        ];
    }

    public function logoutAction()
    {
        extract($this->variables['router_params']);
        $this->user->logout();
        if ($this->request->has('rd') && $this->request->get('rd') != $this->variables['url']) {
            $url = $this->request->get('rd');
        } else {
            $url = $this->url->get(['for' => 'index']);
        }
        return $this->temMoved($url);
    }

    public function checkEmailAction()
    {
        extract($this->variables['router_params']);
        $this->variables['keywords'] = $this->variables['description'] = $this->variables['title'] = '确认邮箱';
        $passwordForm = Config::get('user.checkEmail');
        $passwordForm = $this->form->create($passwordForm);
        $this->variables['page'] = [
            '#templates' => 'page',
        ];
        $this->variables['page']['loginForm'] = $passwordForm;
    }

    public function passwordAction()
    {
        extract($this->variables['router_params']);
        $this->variables['keywords'] = $this->variables['description'] = $this->variables['title'] = '找回密码';
        $passwordForm = Config::get('user.passwordForm');
        $passwordForm = $this->form->create($passwordForm);
        $this->variables['page'] += [
            '#templates' => 'password',
        ];
        $this->variables['page']['passwordForm'] = $passwordForm;
    }

    public function registerAction()
    {
        extract($this->variables['router_params']);
        $userEntity = $this->entityManager->get('user');
        $userAddForm = $userEntity->addForm('user');
        $this->variables['#templates'] = 'register';
        $this->variables['keywords'] = $this->variables['description'] = $this->variables['title'] = '用户注册';

        $this->variables['title'] = '用户注册';
        $this->variables['description'] = '用户注册';
        $this->variables['data'] = $userAddForm->renderForm();
    }
}
