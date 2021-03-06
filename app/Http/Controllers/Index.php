<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;//表单提交
use App\Model\AdminData;
use Illuminate\Support\Facades\View;//视图
class Index extends BaseController
{
    // 首页
    public function index(){
        return view('admin/index/index');;
        // $user = User::get();
        // return view('admin/index/index')->with('user',$user);
        // dd('首页');
    }
    // 欢迎页
    public function welcome(){
        return view('admin/index/welcome')->with('user_name',session('user_name'));
    }
    // 退出登录
    public function loginout(){
        // 清空session
        session()->flush();
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
}
