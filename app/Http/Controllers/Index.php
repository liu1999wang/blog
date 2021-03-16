<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;//表单提交
use App\Model\AdminData;
use Illuminate\Support\Facades\Cache;//缓存
use Illuminate\Support\Facades\View;//视图
use App\Model\PermissionData;
class Index extends BaseController
{
    // 首页
    public function index(Request $request){
        $dh= Cache::get('admin_is_show');
        $dhdata=[];
        foreach($dh as $v){
            $dhdata[]=PermissionData::find($v);

        }
        foreach($dhdata as $v){
            $dataurl=explode('\\',$v->per_url);
            $url=strtolower(str_replace("@","/",$dataurl[count($dataurl)-1]));
            $dhurl=$url;
            $v->per_url=$dhurl;
        }
        return view('admin/index/index')->with('data',$dhdata);
    }
    // 欢迎页
    public function welcome(){
        return view('admin/index/welcome')->with('user_name',session('user_name'));
    }
    // 退出登录
    public function loginout(){
        // 清空session
        session()->flush();
        //清空缓存
        Cache::flush();
        return redirect('login/index');
    }
    //修改页面
    public function edit($id){
        $user=AdminData::find($id);
        return view('admin/index/edit')->with('user',$user);
    }
    //修改数据
    public function update(Request $request){
        $input=$request->all();
        $user=AdminData::find($input['user_id']);
        $res=$user->update(['user_name'=>$input['user_name']]);
        if($res){
            return redirect('admin/login/index');
        }else{
            return back();
        }
    }
    //无权限页面
    public function nothing(){
        return view('admin/index/nothing');
    }
}
