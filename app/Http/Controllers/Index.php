<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;//表单提交
use App\User;
use Illuminate\Support\Facades\View;//视图
class Index extends BaseController
{
    public function index(){
        $user = User::get();
        return view('index/index')->with('user',$user);
        dd('首页');
    }
    //修改页面
    public function edit($id){
        $user=User::find($id);
        return view('index/edit')->with('user',$user);
    }
    //修改数据
    public function update(Request $request){
        $input=$request->all();
        $user=User::find($input['user_id']);
        $res=$user->update(['user_name'=>$input['user_name']]);
        if($res){
            return redirect('index/index');
        }else{
            return back();
        }
    }
}
