<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>权限添加</title>
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
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>权限名称</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_username" name="per_name" required="" lay-verify="nikename" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>权限路径</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_username" name="per_url" required="" lay-verify="nikename" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">父级</label>
                        <div class="layui-input-inline">
                        <select name="parent" lay-filter="aihao">
                            <option value="0">无</option>
                            @foreach($permissiondata as $v)
                            @if($v->is_show==1)
                            <option value="{{$v->id}}">{{$v->per_name}}</option>
                            @endif
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否在导航栏显示</label>
                        <div class="layui-input-block">
                        <input type="radio" name="is_show" value="1" title="是" checked ><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><div>是</div></div>
                        <input type="radio" name="is_show" value="0" title="否"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><div>否</div></div>
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
                //监听提交
                form.on('submit(add)',
                function(data) {
                    console.log(data.field)
                    //发异步，把数据提交给php
                    $.ajax({
                            url:"{{url('permission/add')}}",
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