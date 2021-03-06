<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>管理员列表</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        @include('admin/public/style')
        @include('admin/public/script')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5" action="{{url('admin/list')}}" method="get">
                                <div class="layui-inline">
                                  <div class="layui-input-inline layui-show-xs-block">
                                    <select name="quiz" >
                                      <option value="">请选择问题</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text"  name="user_name" value="{{$request->input('user_name')}}" placeholder="请输入管理员名称" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" onclick="xadmin.open('添加管理员','{{url('admin/add')}}',600,400)"><i class="layui-icon"></i>添加</button>
                        </div>
                        <div class="layui-card-body layui-table-body layui-table-main">
                            <table class="layui-table layui-form">
                                <thead>
                                  <tr>
                                    <th>
                                      <input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
                                    </th>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>密码</th>
                                    <th>状态</th>
                                    <th>操作</th></tr>
                                </thead>
                                <tbody>
                                  
                                  @foreach($data as $v)
                                  <tr>
                                    <td>
                                      <input type="checkbox" name="id" value="1"   lay-skin="primary"> 
                                    </td>
                                    <td>{{$v->user_id}}</td>
                                    <td>{{$v->user_name}}</td>
                                    <td>{{$v->user_pass}}</td>
                                    <td class="td-status">
                                    
                                    <a onclick="member_stop(this,'{{$v->user_id}}')" href="javascript:;"  title="@if($v->statu==1)已启用@endif @if($v->statu==0)已禁用@endif"><span class="layui-btn layui-btn-normal @if($v->statu==0) layui-btn-danger @endif  layui-btn-mini">@if($v->statu==1) 已启用 @endif @if($v->statu==0) 已禁用 @endif</span></a></td>
                                    <td class="td-manage">
                                      <a title="编辑"  onclick="xadmin.open('编辑','{{url('admin/'.$v->user_id.'/edit')}}',600,400)" href="javascript:;">
                                        <i class="layui-icon">&#xe642;</i>
                                      </a>
                                      <a onclick="reset_pass('{{$v->user_id}}')" title="重置密码" href="javascript:;">
                                        <i class="layui-icon">&#xe673;</i>
                                      </a>
                                      <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                                        <i class="layui-icon">&#xe640;</i>
                                      </a>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                {!! $data->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script>
      layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var  form = layui.form;


        // 监听全选
        form.on('checkbox(checkall)', function(data){

          if(data.elem.checked){
            $('tbody input').prop('checked',true);
          }else{
            $('tbody input').prop('checked',false);
          }
          form.render('checkbox');
        }); 
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });


      });

       /*用户-停用*/
      function member_stop(obj,id){
        // console.log(obj,id)
        if($(obj).attr('title').replace(/\s+/g,"")=="已启用"){
          layer.confirm('确认要禁用吗？',function(index){
            $.ajax({
                    url:"{{url('admin/statu')}}",
                    type:'post',
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{'uid':id},
                    success:function(data){
                      var data= JSON.parse ( data ) 
                      if(data.code==1){
                        layer.msg(data.mag,{icon: 6,time:1000});
                         //发异步把用户状态进行更改
                        $(obj).attr('title','已禁用')
                        $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-danger').html('已禁用');
                      }else{
                        layer.msg(data.mag,{icon: 5,time:1000});
                      }
                    }
                    });
            
          });
        }else{
          layer.confirm('确认要启用吗？',function(index){
            $.ajax({
                    url:"{{url('admin/statu')}}",
                    type:'post',
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{'uid':id},
                    success:function(data){
                      var data= JSON.parse ( data ) 
                      if(data.code==1){
                        layer.msg(data.mag,{icon: 6,time:1000});
                        //发异步把用户状态进行更改
                        $(obj).attr('title','已启用')
                        $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-danger').html('已启用');
                      }else{
                        layer.msg(data.mag,{icon: 5,time:1000});
                        
                      }
                    }
                    });
          });
        }
      }
      // 密码重置
      function reset_pass(id){
        layer.confirm('确认要重置密码为123456吗？',function(index){
              $.ajax({
                    url:"{{url('admin/reset_pass')}}",
                    type:'post',
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{'uid':id},
                    success:function(data){
                      var data= JSON.parse ( data ) 
                      if(data.code==1){
                        layer.msg(data.mag,{icon: 6,time:1000});
                        parent.location.reload();
                      }else{
                        layer.msg(data.mag,{icon: 5,time:1000});
                      }
                    }
                });
          });
      }
      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {
        var ids = [];

        // 获取选中的id 
        $('tbody input').each(function(index, el) {
            if($(this).prop('checked')){
               ids.push($(this).val())
            }
        });
  
        layer.confirm('确认要删除吗？'+ids.toString(),function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
</html>