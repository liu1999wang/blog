<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>角色授权</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        @include('admin/public/style')
        @include('admin/public/script')
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form">
                    {{csrf_field()}}
                    <div class="layui-form-item">
                        <label class="layui-form-label">权限</label>
                        <div class="layui-input-block">
                        <table class="layui-table" style="margin: 0;">
                        @foreach($permission as $per)
                        @if($per->parent==0)
                            <tr>
                                <td><input type="checkbox" name="like[]" title="{{$per->per_name}}" ></td>
                                <td>
                                @foreach($permission as $per1)
                                @if($per1->parent==$per->id)
                                <table class="layui-table" style="margin: 0;">
                                <tr><td><input type="checkbox" name="like[]" title="{{$per1->per_name}}" ></td>
                                <td>
                                @foreach($permission as $per2)
                                @if($per2->parent==$per1->id)
                                <table class="layui-table" style="margin: 0;">
                                <tr><input type="checkbox" name="like[]" title="{{$per2->per_name}}" ></tr>
                                </table>
                                @endif
                                @endforeach
                                </td>
                                </tr>
                                </table>
                                @endif
                                @endforeach 
                                </td>
                            </tr>
                        @endif
                        @endforeach 
                        </table>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
                </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer','jquery'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                // 自定义验证规则
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
                            url:"{{url('admin/add')}}",
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