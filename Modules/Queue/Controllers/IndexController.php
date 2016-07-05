<?php
namespace Modules\Queue\Controllers;

use Modules\Queue\Library\Queue;
use Core\Mvc\Controller;
use Modules\Queue\Models\Queue as QueueModel;
use Modules\Queue\Models\QueueLog;

class IndexController extends Controller
{

    public function indexAction()
    {
        extract($this->variables['router_params']);
        ini_set('disable_functions', '');//开启所有函数
        ignore_user_abort(true); // 后台运行
        set_time_limit(0); // 取消脚本运行时间的超时上限
        $this->view->disable();
        if($id == 0){
            Queue::runAllCron();
            exit(0);
        }else{
            $cron = QueueModel::findFirst($id);
            $output = false;
            $data = @unserialize($cron->data);
            if ($data) {
                if (isset($data['callable']) && is_callable($data['callable'])) {
                    if (isset($data['params'])) {
                        $output = call_user_func_array($data['callable'], unserialize($data['data']));
                    }else{
                        $output = call_user_func($data['callable']);
                    }
                }
            }
            if($output === false){
                $cron->state = 2;
                $cron->save();
            }else{
                $cron->delete();
            }
            @unlink(CACHE_DIR . 'queue/lock'.$id);
        }
    }
    public function progressAction(){
        extract($this->variables['router_params']);
        $queueLog = QueueLog::findFirstByQid($id);
        $this->response->setHeader("Content-Type", "application/json");
        $this->variables['#templates'] = 'json';
        $this->variables['data'] = json_encode($queueLog->toArray());
    }
}
