<?php
namespace Modules\Form\Controllers;

use Core\Config;
use Modules\Form\Library\ValidateCode;
use Core\Mvc\Controller;

class IndexController extends Controller
{
    public function validateCodeAction()
    {
        $this->variables = array(
            '#templates' => 'validate',
        );
        $validate = new ValidateCode();
        $validate->doimg();
        $this->session->set('code', $validate->getCode());
    }
}
