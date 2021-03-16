<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    @include('admin/public/style')
    @include('admin/public/script')
</head>
<body>
    <div class="wrapper">
        <div class="login">
            <div class="login-box">
                
                <h1>后台管理</h1>
                <form method="post" class="layui-form">
                {{csrf_field()}}
                <div class="user" >
                    <label class="username">Username</label>
                    <input autocomplete="off" required  type="text" onBlur="defocus(this,'username')" onFocus="focusing(this,'username')"  title="请填写此字段" name="user_name">
                </div>
                <div class="user">
                    <label class="password">Password</label>
                    <input autocomplete="off" required  type="password" onBlur="defocus(this,'password')" onFocus="focusing(this,'password')" title="请填写此字段" name="user_pass">
                </div>
                <button lay-filter="login" lay-submit="" >登 录
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    @if ($errors!='[]')
        layui.use(['laydate', 'form'],function (){
            layer = layui.layer;
            let msg="{{$errors}}"
            layer.msg(msg);    
        })
    @endif

    // 失焦
    function defocus (data,name){
        if(data.value==''){
            data.style.borderWidth="0px";
           let label= document.getElementsByClassName(name)[0];
           label.style.bottom=10+'px'
           label.style.fontSize=20+'px'
           label.style.color="#fff"
        }
    }
    // 聚焦
    function focusing(data,name){
        if(data.value==''){
           data.style.borderWidth="1px";
           let label= document.getElementsByClassName(name)[0];
           label.style.bottom=35+'px'
           label.style.fontSize=15+'px'
           label.style.color="rgb(3 233 244)"
        }
    }
    layui.use(['form', 'layer'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
            layer = layui.layer;
            $(function  () {
                layui.use('form', function(){
                var form = layui.form;
                //   监听提交
                    form.on('submit(login)', function(data){
                        // console.log(data.field)
                        $.ajax({
                            url:"{{url('login/store')}}",
                            type:'post',
                            data:data.field,
                            success:function(data){   
                                var data= JSON.parse ( data )
                                console.log(data)
                                
                               if(data.code==1){
                                   console.log(data.mag)
                                   
                                layer.alert('', {
                                    type: 3
                                    ,time: 3000
                                    ,end:function(){
                                        location.href="{{url('index/index')}}";
                                    }
                                });
                               }else if(data.code==2){
                                layer.alert('', {
                                    type: 3
                                    ,time: 2000
                                    ,end:function(){
                                        layer.msg(data.mag);
                                    }
                                });
                                
                               }else{
                                let mag='';
                                for(j in data.mag.customMessages) {
                                    mag+=data.mag.customMessages[j]+"<br/>"
                                }
                                layer.msg(mag);
                               }
                            }
                        });
                        return false
                    });
                });
            });
        });

</script>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    body{
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100vh;
        background:linear-gradient(#141e30, #243b55);
        position: relative;
        overflow: hidden;
    }
    .yu{
        position: absolute;
        margin: 0;
        font-size: 20px;
        line-height: 20px;
        width: 20px;
        color:rgb(3 233 244);
        word-wrap: break-word;
        text-transform:capitalize;
        text-align: center;
        left: 0px;
        background-image: -webkit-linear-gradient(rgb(3 233 244 / 25%),#03e9f4);
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-background-size: 200% 100%;
    }
    @media screen and (max-width:600px){
            .yu{
                font-size: 10px;
                width: 10px;
            }
        }
    .wrapper{
        width: 100%;
        height: 100vh;
        position: relative;
        background-image: linear-gradient(#141e30, #243b55);
    }
    .login{
        width: 300px;
        height: 300px;
        background-color: rgba(0,0,0,.5);
        box-shadow:0 15px 25px rgb(0 0 0 / 60%);
        position: absolute;
        left:calc(50% - 150px);
        top:calc(0% - 400px); 
        border-radius:10px;
        z-index: 99;
        transition: top 3s;
    }
    .login-box{
        margin: 20px;
    }
    h1{
        font-size: 20px;  
        text-align: center;
        color:#fff;
    }
    input{
        position: relative;
        margin:auto;
        width:100%;
        height:40px;
        background-color: transparent;
        color:#fff;
        outline:none;
        border: none;
        border-bottom: 1px solid #fff;
        border-width:0px;
        z-index:999;
    }
    .user{
        position: relative;
        margin: 30px 0;
        
    }
    .user>label{
        color:#fff;
        position: absolute;
        font-size: 20px;
        bottom: 10px;
        user-select:none;
        z-index:999;
        transition: font-size .5s,bottom .5s;
    }
    button{
        width: 100%;
        height:40px;
        background-color: transparent;
        border: none;
        color:rgb(3 233 244);
        overflow:hidden;
        position: relative;
    }
    button:hover {
        background: #03e9f4;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px #03e9f4,
                    0 0 25px #03e9f4,
                    0 0 50px #03e9f4,
                    0 0 100px #03e9f4;
    }
    button span {
        position: absolute;
        display: block;
    }

    button span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #03e9f4);
        animation: btn-anim1 1s linear infinite;
    }

    @keyframes btn-anim1 {
        0% {
            left: -100%;
        }
        50%,100% {
            left: 100%;
        }
    }

    button span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, transparent, #03e9f4);
        animation: btn-anim2 1s linear infinite;
        animation-delay: .25s
    }

    @keyframes btn-anim2 {
        0% {
            top: -100%;
        }
        50%,100% {
            top: 100%;
        }
    }

    button span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(270deg, transparent, #03e9f4);
        animation: btn-anim3 1s linear infinite;
        animation-delay: .5s
    }

    @keyframes btn-anim3 {
        0% {
            right: -100%;
        }
        50%,100% {
            right: 100%;
        }
    }

    button span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(360deg, transparent, #03e9f4);
        animation: btn-anim4 1s linear infinite;
        animation-delay: .75s
    }

    @keyframes btn-anim4 {
        0% {
            bottom: -100%;
        }
        50%,100% {
            bottom: 100%;
        }
    }
</style>
<style>
    /* 加载框样式 */
    .layui-layer.layui-layer-loading .layui-layer-content{
            width: 150px;
            background-color: rgba(0,0,0,0.5);
            border-radius: 5px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100%;
            color: #FFFFFF;
            height: auto;
            padding-top: 100px; text-align: center;
            padding-bottom: 10px;
            background-image:url("{{asset('admin/images/load.gif')}}");
    }
    .demo-class{
        background-color:rgb(3 233 244);
    }
</style>
<script>
         
         let number=100;
        
         let body=document.getElementsByTagName('body')[0];
         let html=''
         if(body.offsetWidth<700){
                     number=40
                     let zyyu=document.getElementsByClassName('yu');
                     console.log(zyyu)
                    } 
         let data=[0,1]
         let yu=[],js=[]
         let maxheight=document.body.clientHeight;
         for (let index = 0; index < number; index++) {
             html+=`<div class="yu" id="`
             html+='yu'+index
             html+=`"></div>`
         }
         body.innerHTML+=html
         // console.log(body.innerHTML)
         for (let n = 0; n < number; n++) {
             let id="yu"+n
             yu[n]=document.getElementById(id);
             let length=Math.round(Math.random()*5)+10;
             let left=Math.round(Math.random()*body.offsetWidth);
             let height=Math.round(Math.random()*1000)+20
             yu[n].style.left=left+'px'
             dmt(n,yu[n],length,height)
         }
     function dmt(n,yu,length,height){
         let html='';
         for (let i = 0; i < length; i++) {
             let j=Math.round(Math.random()*(data.length-1));
             html+=data[j]
             // console.log(j)
         }
         yu.innerHTML=html;
         height=-height
         yu.style.top=height+'px'
         js[n]=setInterval(function(){
             let html='';
             for (let i = 0; i < length; i++) {
             let j=Math.round(Math.random()*(data.length-1));
             html+=data[j]
 
         }
 
         yu.innerHTML=html;
             height+=5
             yu.style.top=height+'px'
             if(height>maxheight){
                 height=-yu.offsetHeight
             }
         },20);
     }
     let login=document.getElementsByClassName('login')[0];
        login.style.top="calc(50% - 150px)";
     </script>


</html>