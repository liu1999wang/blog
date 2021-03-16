<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>管理员添加</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('admin/public/style')
        @include('admin/public/script')
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            <span class="x-red">*</span>邮箱</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_email" name="email" required="" lay-verify="email" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>将会成为您唯一的登入名</div></div>
                            <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>手机号码</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_username" name="phone" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">默认头像</label>
                        <div class="layui-input-inline">
                        <select name="img" lay-verify="required" id="img">
                            <option value=" ">无</option>
                            <option value="..\upload\head\head1.jpg">默认头像1</option>
                            <option value="..\upload\head\head2.png">默认头像2</option>
                            <option value="..\upload\head\head3.jpg">默认头像3</option>
                            <option value="..\upload\head\head4.jpg">默认头像4</option>
                            <option value="..\upload\head\head5.jpg">默认头像5</option>
                        </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>头像</label>
                        <div class="layui-input-inline">
                            <button type="button" class="layui-btn" id="head">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                            </button>
                            <input id='img_path' type="hidden" name="img_path" value="">
                            <img id='upimg' src="" alt="" style="width: 150px;height: 150px;visibility: hidden;margin-top: 10px;">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>昵称</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_username" name="username" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>性别</label>
                        <div class="layui-input-inline">
                            <input type="radio" name="sex" value="0" title="男">
                            <input type="radio" name="sex" value="1" title="女" checked>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_pass" class="layui-form-label">
                            <span class="x-red">*</span>密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="L_pass" name="pass" required="" lay-verify="pass" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">6到16个字符</div></div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label">
                            <span class="x-red">*</span>确认密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="L_repass" name="repass" required="" lay-verify="repass" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
                </form>
            </div>
        </div>
        <script>
            layui.use('upload', function(){
                var upload = layui.upload;
                var tag_token = "{{ csrf_token() }}";
                //执行实例
                var uploadInst = upload.render({
                    elem: '#head' //绑定元素
                    ,url: "{{url('user/upload')}}" //上传接口
                    ,accept: 'file'
                    ,data:{
                        '_token':tag_token
                    }
                    ,done: function(res){
                        $("#img_path")[0].value=res.mag
                        $("#upimg")[0].src=res.mag
                        $("#upimg")[0].style.visibility='visible';

                    //上传完毕回调
                    }
                    ,error: function(){
                    //请求异常回调
                    }
                });
            });
        </script>
        <script>layui.use(['form', 'layer','jquery'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //监听select
                form.on('select', function(data){
                    if(data.value==' '){
                            $("#upimg")[0].style.visibility='hidden';
                            $("#img_path")[0].value=data.value
                        }
                    else{
                            $("#upimg")[0].src=data.value
                            $("#img_path")[0].value=data.value
                            $("#upimg")[0].style.visibility='visible';
                        }
                })

                //自定义验证规则
                form.verify({
                    nikename: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){6,12}$/, '密码必须6到12位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)',
                function(data) {
                    //发异步，把数据提交给php
                    $.ajax({
                            url:"{{url('user/add')}}",
                            type:'post',
                            data:data.field,
                            success:function(data){
                                var data= JSON.parse ( data )   
                                if(data.code==1){
                                    layer.alert(data.mag, {
                                        icon: 6
                                    },
                                    function() {
                                        //关闭当前frame
                                        xadmin.close();

                                        // 可以对父窗口进行刷新 
                                        xadmin.father_reload();
                                    });
                                }else{
                                    layer.alert(data.mag, {
                                        icon: 5
                                    },
                                    function() {
                                        //关闭当前frame
                                        xadmin.close();

                                        // 可以对父窗口进行刷新 
                                        xadmin.father_reload();
                                    });
                                }
                            }
                    });
                    return false;
                });

            });</script>
    </body>

</html>