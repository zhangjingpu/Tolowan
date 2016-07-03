<?php
namespace Modules\Queue\Library;

use Modules\Queue\Models\Queue as QueueModel;
use \Exception;
use Core\HttpClient;
use Core\Config;

class Queue
{
    public static $queueLog = false;

    //添加任务
    public static function add($cron, $data, $type = 1, $run = true)
    {
        $cronTypeList = Config::cache('cronType');
        if (!isset($cronTypeList[$cron])) {
            return false;
        }
        $queueData = array(
            'callable' => $cronTypeList[$cron]['callable'],
            'data' => serialize($data)
        );
        Config::printCode($queueData);
        $queueModel = new QueueModel();
        $queueModel->type = $type;
        $queueModel->data = serialize($queueData);
        $queueModel->state = 1;
        $queueModel->runtime = 0;
        $queueModel->weight = time();
        if ($queueModel->save() && $run === true) {
            self::start();
        }
    }

    //开始执行任务
    public static function start()
    {
        if (self::isStart() === false) {
            return 2;
        }
        global $di;
        $http = new HttpClient();
        $http->request($di->getShared('url')->get(array('for' => 'queue','id'=>0)), array(
            'stream' => true,
            'blocking' => false,
            'timeout' => 0,
            'filename' => CACHE_DIR . 'queue/lock'
        ));
    }

    //队列是否在运行中
    public static function isStart()
    {
        $lockFile = CACHE_DIR . 'queue/lock';
        if (file_exists($lockFile)) {
            return true;
        }
        return false;
    }

    //运行单个任务
    public static function runCron($id)
    {
        global $di;
        $http = new HttpClient();
        $http->request($di->getShared('url')->get(array('for' => 'queue','id'=>$id)), array(
            'stream' => true,
            'blocking' => false,
            'timeout' => 0,
            'filename' => CACHE_DIR . 'queue/lock'.$id
        ));
    }

    //运行全部任务
    public static function runAllCron()
    {
        try {
            //运行普通任务
            $query = array(
                'conditions' => 'state = :state: AND type = :type:',
                'bind' => array('state' => 1,'type'=>1),
                'order' => 'weight DESC'
            );
            $cron = QueueModel::findFirst($query);
            while ($cron) {
                //执行任务
                $output = false;
                $data = @unserialize($cron->data);
                if ($data) {
                    if (isset($data['callable']) && is_callable($data['callable'])) {
                        if (isset($data['data'])) {
                            $output = call_user_func($data['callable'], unserialize($data['data']));
                        } else {
                            $output = call_user_func($data['callable']);
                        }
                    }
                }
                if ($output !== true) {
                    $cron->state = 2;//设置专题为已运行错误任务
                    $cron->error = is_string($output) ? $output : serialize($output);
                    $cron->save();
                } else {
                        $cron->delete();
                }
                //处理执行后
                $cron = QueueModel::findFirst($query);
            }
            //运行定时任务
            self::runTimeCron();
            @unlink(CACHE_DIR . 'queue/lock');
        } catch (Exception $e) {
            @unlink(CACHE_DIR . 'queue/lock');
        }
        @unlink(CACHE_DIR . 'queue/lock');
    }

    //运行定时任务
    public static function runTimeCron()
    {
        self::resetTimeCron();
        $query = array(
            'conditions' => 'state = :state: AND type = :type:',
            'bind' => array('state' => 1,'type'=>2),
            'order' => 'weight DESC'
        );
        $cron = QueueModel::findFirst($query);
        while ($cron) {
            //执行任务
            if(self::testTimeCron($cron) === true) {
                $output = false;
                $data = @unserialize($cron->data);
                if ($data) {
                    if (isset($data['callable']) && is_callable($data['callable'])) {
                        if (isset($data['data'])) {
                            $output = call_user_func_array($data['callable'], unserialize($data['data']));
                        } else {
                            $output = call_user_func($data['callable']);
                        }
                    }
                }
                if ($output !== true) {
                    $cron->state = 2;//设置专题为已运行错误任务
                    $cron->error = is_string($output) ? $output : serialize($output);
                    $cron->save();
                } else {
                    $cron->delete();
                }
            }
            //处理执行后
            $cron = QueueModel::findFirst($query);
        }
    }
    //检测定时任务是否应该执行
    public static function testTimeCron($cron){
        if($cron->runtime+86400 > time()){
            $cron->state = 3;
            $cron->save();
            return false;
        }
        return true;
    }
    //重置定时任务
    public static function resetTimeCron(){
        $query = array(
            'conditions' => 'state = :state: AND type = :type:',
            'bind' => array('state' => 3,'type'=>2),
            'order' => 'weight DESC'
        );
        $crons = QueueModel::find($query);
        foreach ($crons as $cron){
            if($cron->runtime+86400 < time()){
                $cron->state = 1;
                $cron->save();
            }
        }
        return true;
    }
}