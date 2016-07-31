<?php
namespace Modules\Ckeditor\Controllers;

use Core\Config;
use Core\File;
use Core\Mvc\Controller;
use Modules\File\Models\File as FileModel;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

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
            'CKEditorFuncNum' => (int)$getData['CKEditorFuncNum'],
            'langCode' => $getData['langCode'],
        );
    }

    public function browseImageListAction()
    {
        extract($this->variables['router_params']);
        if (!$this->user->isLogin()) {
            $uid = 0;
        } else {
            $uid = $this->user->id;
        }
        $query = FileModel::find(array(
            'conditions' => 'uid = :uid: AND content_type IN (:content_type:) AND access > :access:',
            'bind' => array(
                'uid' => $uid,
                'content_type' => "'jpeg','png','jpg','gif'",
                'access' => 19
            )
        ));
        $data = new PaginatorModel(
            array(
                "data" => $query,
                "limit" => 16,
                "page" => $page
            )
        );
        $this->variables += array(
            '#templates' => 'ckBrowseImageList',
            'data' => $data->getPaginate(),
            'page' => $page,
        );
    }

    public function uploadImageAction()
    {
        extract($this->variables['router_params']);
        $data = '';
        if ($this->request->hasFiles() == true) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $urlPath = '/images/' . date('Y/m/d/');
                $dir = WEB_CODE.$urlPath;
                $fileNameArray = explode('.', $file->getName());
                $fileType = end($fileNameArray);
                $fileNameEncode = time();
                $url = $urlPath . $fileNameEncode . '.' . $fileType;
                $fileDir = ROOT_DIR . $dir;
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
                    $data .= '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $callback . ',"' . $url . '","");</script>';
                } else {
                    $data .= '<script type="text/javascript">alert("上传图片失败啦")</script>';
                }
            }
        }

        $this->variables += array(
            '#templates' => 'upload_image',
            'data' => &$data
        );
    }
}
