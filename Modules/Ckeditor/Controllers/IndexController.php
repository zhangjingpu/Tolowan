<?php
namespace Modules\Ckeditor\Controllers;

use Core\Config;
use Core\File;
use Core\Mvc\Controller;
use Modules\File\Library\Common as Fcommon;

class IndexController extends Controller
{
    protected $root = '/';
    protected $imgext = ['bmp', 'gif', 'jpg', 'jpe', 'jpeg', 'png']; // allowed image extensions
    protected $imgdr = ''; // current folder (in $root) with images
    public $config;
    public function initialize()
    {
        $this->config = Config::get('config');
        if (isset($_POST['imgroot'])) {
            $this->root = trim(strip_tags($_POST['imgroot']));
        }

        $this->root = trim($this->root, '/') . '/';
        $this->imgdr = isset($_POST['imgdr']) ? trim(trim(strip_tags($_POST['imgdr'])), '/') . '/' : '';
    }
    public function indexAction()
    {
        extract($this->variables['router_params']);
        $getData = $this->request->getQuery();
        $one = preg_match_all('/([a-z]+)/', $getData['CKEditor']);
        if ($one > 1 || $one = 0) {
            return false;
        }
        $one = preg_match_all('/([0-9]+)/', $getData['CKEditorFuncNum']);
        if ($one > 1 || $one = 0) {
            return false;
        }
        $one = preg_match_all('/([a-z\-]+)/', $getData['CKEditorFuncNum']);
        if ($one > 1 || $one = 0) {
            return false;
        }
        $this->variables += array(
            '#templates' => 'ckBrowseImage',
            'CKEditor' => $getData['CKEditor'],
            'CKEditorFuncNum' => (int) $getData['CKEditorFuncNum'],
            'langCode' => $getData['langCode'],
        );
    }
    public function browseImageListAction()
    {
        extract($this->variables['router_params']);
        $data = Fcommon::find(array(
            'limit' => 20,
            'page' => $page,
            'paginator' => true,
        ));
        $this->variables += array(
            '#templates' => 'ckBrowseImageList',
            'data' => $data,
            'page' => $page,
        );
    }

    public function uploadImageAction()
    {
        extract($this->variables['router_params']);
        $this->variables['page'] = array(
            '#templates' => 'upload_image',
        );
        if ($this->request->hasFiles() == true) {
            $config = Config::get('config');
            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {

                //Print file details
                //echo $file->getName(), " ", $file->getSize(), "\n";

                //Move the file into the application
                $dir = 'public/images/' . Config::$encode . '/' . date('Y/m/d/');
                $fileNameArray = explode('.', $file->getName());
                $fileType = end($fileNameArray);
                $fileNameEncode = base64_encode($fileNameArray[0]);
                $fileNameEncode = str_replace('/', '_', $fileNameEncode);
                $fileNameEncode = str_replace('+', ':', $fileNameEncode);
                $url = '/images/' . Config::$encode . '/' . date('Y/m/d/') . $fileNameEncode . '.' . $fileType;
                $fileDir = $config['dir']['rootDir'] . $dir;
                $newFile = $fileDir . $fileNameEncode . '.' . $fileType;
                if (!file_exists($fileDir)) {
                    File::mkdir($dir);
                }
                if (!is_writable($fileDir) && file_exists($fileDir)) {
                    chmod($fileDir, 0777);
                }
                $state = $file->moveTo($newFile);
                $callback = $this->request->get('CKEditorFuncNum');
                if ($state) {
                    echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $callback . ',"' . $url . '","");</script>';
                } else {
                    echo '<script type="text/javascript">alert("上传图片失败啦")</script>';
                }
                return;
            }
        }
    }
}
