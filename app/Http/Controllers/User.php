<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;//表单提交
use Illuminate\Support\Facades\View;//视图
use App\Model\UserData;
class User extends BaseController
{
   public function list(Request $request){
        $data=UserData::orderBy('user_id','asc')
        ->where(function($query) use($request){
            $user_name=$request->input('user_name');
            if(!empty($user_name)){ 
                $query->where('user_name','like','%'.$user_name.'%');
            }
        })
        ->paginate(10);
        return view('admin/user/list')->with('data',$data);
   }
   public function add(Request $request){
        if(!$request->isMethod('post')){
            return view('admin/user/add');
        }else{
            $input=$request->except('_token');
            // dd($input);
            $user=UserData::where('email',$input['email'])->first();
            if($user){
                return json_encode(['code'=>0,'mag'=>"邮箱已注册"]);
            }else{
                $pass=md5('ljw990'.$input['pass'].'210ww');
                $res=UserData::create(['user_name'=>$input['username']
                    ,'user_pass'=>$pass
                    ,'email'=>$input['email']
                    ,'sex'=>$input['sex']
                    ,'phone'=>$input['phone']
                    ,'head'=>$input['img_path']
                    ,'add_time'=>date('Y-m-d H:i:s')]);
                if($res){
                    return json_encode(['code'=>1,'mag'=>'添加成功']); 
                }else{
                    return json_encode(['code'=>0,'mag'=>'添加失败']); 
                }
            }
            dd($input);
        }
   }
   //用户头像处理
   public function upload(Request $request){
        $name=$_FILES['file']['name'];
        $type1=$_FILES['file']['type'];
        $file_tmp=$_FILES['file']['tmp_name'];
        $type=explode("/",$type1);
        $types=['jpeg','png','gif'];
        $img=false;
        foreach($types as $tp){
            if($type[count($type)-1]==$tp){
                $img=true;
            }
        }
        //判断文件格式是否正确
        if($img){
            $imgname='';
            $time=strtotime(date('Y-m-d H:i:s'));//时间戳
            $list=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
            foreach($list as $li){
                $rand=rand(0,count($list)-1);
                $imgname=$imgname.$list[$rand];
            }
            $imgname=$imgname.$time.'.'.$type[count($type)-1];
                $path = "upload/uphead";
                $file_path=$path.'/'.$imgname;
                //判断文件是否存在
                if (file_exists($file_path)) {
                    return json_encode(['code'=>0,'mag'=>'上传失败，请重试']);
                } else {
                //TODO 判断当前的目录是否存在，若不存在就新建一个!
                if (!is_dir($path)){mkdir($path,0777,true);}
                    $upload_result = move_uploaded_file($file_tmp, $file_path); 
                    //此函数只支持 HTTP POST 上传的文件
                    if ($upload_result) {
                        return json_encode(['code'=>1,'mag'=>'../'.$file_path]);
                    } else {
                        return json_encode(['code'=>0,'mag'=>"上传失败"]);
                    }
                }
        }else{
            return json_encode(['code'=>0,'mag'=>'请上传正确格式的图片']);
        }
   }
}
