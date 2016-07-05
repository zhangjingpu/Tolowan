<?php
namespace Modules\Form\Forms;

use Core\Config;
use Phalcon\Forms\Element;

class AutocompleteMultiple extends Element
{

    public function render($attributes = null)
    {
        $name = $this->getName();
        $config = Config::get('site');
        $imgList = explode(';', $this->getValue());
        $imgListHtml = '';
        foreach ($imgList as $value) {
            $imgListHtml .= '<li class="check_image_li"><a class="cboxElement">';
            $imgListHtml .= '<img src="' . $value . '"></a></li>';
        }
        $imagesManageLink = '/' . $config['adminPrefix'] . '/images_manage/box_';
        $imageUploadLink = '/' . $config['adminPrefix'] . '/images_upload/box';
        $output = '<div class="tabbable ss"><input type="hidden" value="' . $this->getValue() . '" name="' . $name . '" class="images_box_input">';
        $output .= '<ul id="myTab" class="nav nav-tabs padding-12 tab-color-blue background-blue"><li class="active"><a href="#checkImage" data-toggle="tab">已选择图片</a></li><li><a link="' . $imagesManageLink . '" href="#tuku" data-toggle="tab">浏览图库</a></li><li><a link="' . $imageUploadLink . '" href="#imageUpload" data-toggle="tab">上传图片</a></li><li state="n" class="action">点击展开</li></ul><div class="tab-content"><div class="tab-pane in active" id="checkImage"><p>点击图片从已删除图片列表删除图片</p><ul class="images_list">' . $imgListHtml . '</ul><div class="clear"></div></div><div load="n" class="tab-pane" id="tuku"><p>图库加载中，长时间不能加载请刷新页面。</p></div><div load="n" class="tab-pane" id="imageUpload"><p>组件加载中，长时间不能加载请刷新页面。</p></div></div></div>';
        return $output;
    }
    private function renderAttributes($attributes)
    {
        $output = '';
        foreach ($attributes as $aKey => $aValue) {
            $output .= $aKey . '="' . $aValue . '" ';
        }
        return $output;
    }
}
