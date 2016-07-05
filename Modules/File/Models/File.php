<?php
namespace Modules\File\Models;

use Phalcon\Mvc\Model;

class File extends Model
{
    public $id;
    public $uid;
    public $state;
    public $access;
    public $md5;
    public $name;
    public $description;
    protected $path;
    public $gid;
    public $changed;
    public $created;
    public function setPath($path){
        $this->path = $path;
    }
    public function getPath(){
        if($this->access == 1){
            return '/'.$this->path;
        }else{
            return $this->path;
        }
    }
}
