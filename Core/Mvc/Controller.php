<?php
namespace Core\Mvc;

use Core\Config;
use Phalcon\Mvc\Controller as Pcontroller;

class Controller extends Pcontroller
{
    public $variables;

    public function beforeExecuteRoute($dispatcher)
    {
        $this->view->init();
        $this->variables = array(
            'url' => $this->request->getURI(),
            'router_params' => $this->router->getParams(),
        );
        $coreConfig = (object) Config::get('m.core.config');
        $this->variables['coreConfig'] = $coreConfig;
        foreach ($this->variables['router_params'] as $key => $value) {
            $this->variables[$key] = $value;
        }
    }

    public function notFount()
    {
        $this->dispatcher->forward(array(
            'controller' => 'Index',
            'action' => 'notFount',
            'namespace' => 'Modules\Core\Controllers',
            'module' => 'core',
        ));
    }

    public function temMoved($url = false)
    {
        $this->view->disable();
        $this->response->setStatusCode(302, 'Temporarily Moved');
        if ($url != false) {
            $this->response->redirect($url);
        }
        return false;
    }

    public function moved($url = false)
    {
        $this->view->disable();
        if ($url != false) {
            if (is_array($url)) {
                $url = $this->url->get($url);
            }
            $this->response->redirect($url);
        }
        return false;
    }

    public function afterExecuteRoute($dispatcher)
    {
        //获取控制器监听列表
        $this->setVars();
        if (!isset($this->variables['#templates'])) {
            $this->variables['#templates'] = 'page';
        }
        $this->view->setBaseTemplate($this->variables['#templates']);
    }

    public function setVars()
    {
        foreach ($this->variables as $key => $value) {
            $this->view->setVar($key, $value);
        }
    }
}
