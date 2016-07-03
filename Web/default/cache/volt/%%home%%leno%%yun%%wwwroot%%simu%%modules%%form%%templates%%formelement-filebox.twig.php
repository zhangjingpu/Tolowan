<div id="form-element-<?php echo $formId; ?>" class="form-group images-box">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a data-toggle="tab" href="#tab_check">选中图片</a></li>
            <li><a data-toggle="tab" ajax-data="<?php echo $this->url->get(array('for' => 'imagesBoxList', 'page' => 1)); ?>" href="#tab_tuku">图库</a></li>
            <li><a data-toggle="tab" ajax-data="<?php echo $this->url->get(array('for' => 'imagesBoxUpload')); ?>" href="#tab_upload">上传</a></li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    切换显示 <span class="caret"></span>
                </a>
            </li>
            <li class="pull-left header"><h5><i class="fa fa-th"></i> <?php echo $label; ?></h5></li>
        </ul>

    <?php echo $element; ?>
        <div class="tab-content">
            <div id="tab_check" class="tab-pane active">
                <div class="alert alert-block alert-info">
                    <i class="fa fa-fw fa-file-image-o"></i>
                    点击图片，从列表移除
                </div>
                <ul class="check_images_list list">
                    <?php $v87627771265191969621iterated = false; ?><?php foreach ($element->ex() as $value) { ?><?php $v87627771265191969621iterated = true; ?>
                        <?php if ($value) { ?>
                        <li class="check_images_li">
                            <a class="cboxElement"><img src="<?php echo $value; ?>"></a>
                        </li>
                    <?php } ?>
                    <?php } if (!$v87627771265191969621iterated) { ?>
                        <li class="no-check">没有选中图片</li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.tab-pane -->
            <div id="tab_tuku" data="empty" class="tab-pane tuku">
                图库还没有加载。
            </div>
            <!-- /.tab-pane -->
            <div id="tab_upload" data="empty" class="tab-pane upload">
                上传组件还没有加载
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
</div>
<script type="text/javascript">
    $('[ajax-data]').click(function () {
        dataBox = $(this).attr('href');
        dataState = $(dataBox).attr('data');
        if(dataState == 'empty'){
            href = $(this).attr('ajax-data');
            $.ajax({
                url: href,
                async: false,
                dataType: "html",
                error:function(){
                    $(dataBox).html('加载失败，请刷新页面重试');
                },
                success: function(data) {
                    $(dataBox).attr('data','yes').html(data);
                }
            });
        }
    });
    $('.images-box').on('click','.images-box-item',function(){
        imgsrc = $(this).attr('src');
        parentBox = $(this).parents('.images-box');
        thisinput = parentBox.find('input').first();
        checklist = parentBox.find('.check_images_list');
        inputvalue = thisinput.val();
        thisinput.attr('disabled','disabled');
        $(this).clone().removeClass('images-box-item').prependTo(checklist);
        $(this).attr('check-id',imgsrc).addClass('check').removeClass('images-box-item');
        if(inputvalue == ''){
            inputvalue = imgsrc;
        }else{
            inputvalue = inputvalue+';'+imgsrc;
        }
        checklist.find('.no-check').css('display','none');
        thisinput.val(inputvalue);
    })
    $('.images-box').on('click','.check_images_list img',function(){
        parentBox = $(this).parents('.images-box');
        imgList = parentBox.find('.boxs-list');
        imgsrc = $(this).attr('src');
        imgList.find("[check-id='"+imgsrc+"']").removeClass('check').attr('check-id', '').addClass('images-box-item');
        thisinput = parentBox.find('input').first();
        inputvalue = thisinput.val();
        inputvaluearr = inputvalue.split(';');
        for(x in inputvaluearr){
            if(inputvaluearr[x] == imgsrc){
                inputvaluearr.splice(x,1);
            }
        }
        inputvalue = inputvaluearr.join(';');
        thisinput.val(inputvalue);
        $(this).remove();
    });
</script>
<style type="text/css">
    .list li{
        list-style: none;
        display: inline-block;
    }
    .check{
        border: 3px solid #00a65a;
    }
    .check_images_list img{
        max-height: 100px;
        width:auto;
        margin:15px;
        display: inline-block;
    }
    .list img{
        display:inline-block;
        height: 100px;
        width:auto;
    }
</style>