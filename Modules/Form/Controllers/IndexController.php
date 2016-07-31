<?php
namespace Modules\Form\Controllers;

use Core\Config;
use Modules\Form\Library\ValidateCode;
use Core\Mvc\Controller;
use Core\Db\Query;

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

    public function autoSourceAction()
    {
        extract($this->variables['router_params']);
        $autoSourceList = Config::cache('autoSource');
        if(!$this->request->isAjax() || !isset($autuSourceList[$id])){
            //return $this->notFount();
        }
        $autoSource = $autoSourceList[$id];
        $query = array(
            'from' => array('id' => $autoSource['from']),
            'limit' => 15,
            'andWhere' => array(
                array(
                    'conditions' => $autoSource['query'],
                    'bind' => array('word' => $word)
                )
            ),
        );
        if(isset($autoSource['order'])){
            $query['order'] = $autoSource['order'];
        }
        Config::printCode($query);
        $data = Query::find($query);
        $output = array();
        foreach ($data as $item){
            $output[] = array(
                'label' => $item->{$autoSource['label']},
                'value' => $item->{$autoSource['value']}
            );
        }
        $this->variables['#templates'] = 'json';
        $this->variables['data'] = $output;
    }
}
