<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Model\AdminData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Model\PermissionData;
use App\Model\RoleData;
class Login extends BaseController
{

   public function index(Request $request){
         if(session()->get('user_id')){
            return redirect('index/index');
         }
         return view('admin/login/index');
   } 
   public function store(Request $request){
      $input=$request->except('_token');   
      $rule=[
            'user_name'=>'required|between:4,18',
            'user_pass'=>'required|between:4,18|alpha_dash'
      ];
      $msg=[
            'user_name.between'=>'用户名长度错误（4~18）',
            'user_pass.between'=>'密码长度错误（4~18）'
      ];
      $validator = Validator::make($input,$rule,$msg);
      if ($validator->fails())
            return json_encode(['code'=>0,'mag'=>$validator]);
      $user=AdminData::where('user_name',$input['user_name'])->first();
      if(!$user){
            return json_encode(['code'=>2,'mag'=>'用户名不存在']);
      }else{
            $pass=md5('ljw990'.$input['user_pass'].'210ww');
            if($user['user_pass']==$pass){
                  if($user['statu']==0)
                        return json_encode(['code'=>2,'mag'=>'用户被禁用']);
                  session()->put('user_id', $user['user_id']);
                  session()->put('user_name', $user['user_name']);
                  if(session()->get('user_id')){
                        $user=AdminData::find(session()->get('user_id'));
                        $role=$user->admin_role;
                        $is_show=[];
                        foreach($role as $r){
                              foreach($r->role_permission as $p){
                                    if($p->is_show==1){
                                    $is_show[]=$p->id;
                                    }
                                    $arr[]=$p->per_url;
                              }
                        }
                        $is_show=array_unique($is_show);
                        Cache::put('admin_is_show',$is_show,60*60);
                        return json_encode(['code'=>1,'mag'=>'登录成功']);
                  }else{
                        return json_encode(['code'=>2,'mag'=>'系统维护中']);
                  }
            }
            return json_encode(['code'=>2,'mag'=>'密码错误']);
      }
   } 
}
