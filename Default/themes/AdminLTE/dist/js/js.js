jQuery(function($) {
    //初始化框架加载页面
    if (location.hash != '' && location.hash != '#') {
        $.ajax({
            url: location.hash.substr(1),
            async: false,
            dataType: "html",
            success: function(data) {
                $.notice('加载页面成功');
                $('#main').html(data);
            }
        });
    } else {
        if ($('#main').attr('data')) {
            $.ajax({
                url: $('#main').attr('data'),
                async: false,
                dataType: "html",
                success: function(data) {
                    $.notice('加载页面成功');
                    $('#main').html(data);

                }
            });
        }
    }
    //表单组
    $('#main').on('click', '.formElement-group .formElement-group-title', function() {
        $(this).next().slideToggle(800);
    });
    //表格全选
    $('#main').on(
        'click',
        'table th input:checkbox',
        function() {
            var that = this;
            $(this).closest('table').find(
                'tr > td:first-child input:checkbox').each(function() {
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });

        });
    //框架ajax加载
    $('body').on('click', 'a[data-target]', function() {
        $(this).loadingbar({
            replaceURL: true,
            direction: "right",
            animationTime: 2000
        });
        return false;
    });
    $.ajaxNoBlock = function(dataUrl) {
            $.ajax({
                url: dataUrl,
                async: false,
                dataType: "html",
                success: function(data) {
                    $.notice('请求成功');
                }
            });
        }
        //进度
    $('body').on('click', 'a[data-cron]', function() {
            dataUrl = $(this).attr('href');
            $.ajaxNoBlock(dataUrl);
            return false;
        })
        //删除确认操作
    $('body').on('click', 'a[data-delete]', function() {
        var r = confirm('是否确认操作');
        if (r == false) {
            return false;
        }
        dataitem = $(this);
        var datadelte = $(this).attr('data-delete');
        if (datadelte == 'ajax') {
            var href = $(this).attr('href');
            $.ajax({
                url: href,
                async: false,
                dataType: "json",
                success: function(data) {
                    if (data.state == true) {
                        $.notice(data.flash);
                        dataitem.parents('.data-delete-box').hide(800);
                    } else {
                        $.notice(data.flash);
                    }
                },
                error: function() {
                    $.notice('删除失败，请求没有成功');
                }
            });
            return false;
        }
    });
    //ajax表单提交
    $('body').on('submit', 'form[ajax-submit]', function() {
        $(this).next('.overlay').css('display', 'block');
        dataTarget = $(this).attr('ajax-submit');
        me = $(this);
        $(this).ajaxSubmit({
            success: function(data) {
                me.next('.overlay').css('display', 'none');
                $(dataTarget).html(data);
            },
        });
        return false;
    });
    // 最大化动态窗口
    $('.main-content').on('click', '.max-box', function() {
        boxClass = $(this).parents('.col-sm-6').attr('class');
        if (boxClass == 'col-sm-6') {
            $(this).parents('.col-sm-6').attr('class', 'col-sm-12')
                .siblings('.col-sm-6').css('display', 'none');
        } else {
            $(this).parents('.col-sm-12').attr('class', 'col-sm-6')
                .siblings('.col-sm-6').css('display', 'block');
        }
    });
    //初始化时间字段
    $.dateinput = function(element) {
            alert(234234);
            d = new Date();
            time = element.Val();
            time = elementValue * 1000;
            alert(time());
            d.setTime(time);
            inputvalue = d.Format('yyyy-MM-dd hh:mm:ss');
            element.val(inputvalue);
        }
        // 处理任务队列start
        // 运行任务
    $.queueRun = function() {

    }
});
//时间格式化

function writeObj(obj){
    var description = "";
    for(var i in obj){
        var property=obj[i];
        description+=i+" = "+property+"\n";
    }
    alert(description);
}