<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\AdminData;
use App\Model\RoleData;
class Admin extends BaseController
{
    // 列表页
    public function list(Request $request){
        $admindata=AdminData::orderBy('user_id','asc')
            ->where(function($query) use($request){
                $user_name=$request->input('user_name');
                if(!empty($user_name)){ 
                    $query->where('user_name','like','%'.$user_name.'%');
                }
            })
            ->paginate(10);
        return view('admin/admin/list')->with('data',$admindata)->with('request',$request);
    }
    //添加页
    public function add(Request $request){
        if($request->isMethod('post')){
            $input=$request->except('_token'); 
            $user=AdminData::where('user_name',$input['user_name'])->first();
            if($user){
                return json_encode(['code'=>0,'mag'=>'名称已存在']); 
            }else{
                $pass=md5('ljw990'.$input['user_pass'].'210ww');
                $res=AdminData::create(['user_name'=>$input['user_name'],'user_pass'=>$pass]);
                if($res){
                    return json_encode(['code'=>1,'mag'=>'添加成功']); 
                }else{
                    return json_encode(['code'=>0,'mag'=>'添加失败']); 
                }
            }
        }else{
            return view('admin/admin/add');
        }
    }
    //修改页
    public function edit($id){
        $admindata=AdminData::find($id);
        // dd($admindata['user_name']);
        return view('admin/admin/edit')->with('data',$admindata);
    }
    //修改数据
    public function update(Request $request){
        $input=$request->all();
        $user=AdminData::find($input['uid']);
        $roel=$user->admin_role;

        //超级管理员不能被修改
        foreach($roel as $v){
            if($v->id==1){
                return json_encode(['code'=>0,'mag'=>'无权修改该用户']);
            }
        }
        $res=$user->update(['user_name'=>$input['user_name']]);
        if($res){
            return json_encode(['code'=>1,'mag'=>'修改成功']);
        }else{
            return json_encode(['code'=>0,'mag'=>'修改失败']);
        }
    }
    //状态修改
    public function statu(Request $request){
        $input=$request->all();
        $user=AdminData::find($input['uid']);
        $roel=$user->admin_role;
        //超级管理员不能被修改
        foreach($roel as $v){
            if($v->id==1){
                return json_encode(['code'=>0,'mag'=>'无权修改该用户']);
            }
        }
        if($user['statu']==1){
            $res=$user->update(['statu'=>0]);
            if($res){
                return json_encode(['code'=>1,'mag'=>'修改成功']);
            }else{
                return json_encode(['code'=>0,'mag'=>'修改失败']);
            }
        }else{
            $res=$user->update(['statu'=>1]);
            if($res){
                return json_encode(['code'=>1,'mag'=>'修改成功']);
            }else{
                return json_encode(['code'=>0,'mag'=>'修改失败']);
            }
        }
    }
    // 密码重置
    public function reset_pass(Request $request){
        $input=$request->all();
        $user=AdminData::find($input['uid']);
        $roel=$user->admin_role;
        //超级管理员不能被修改
        foreach($roel as $v){
            if($v->id==1){
                return json_encode(['code'=>0,'mag'=>'无权修改该用户']);
            }
        }
        $pass=md5('ljw990'.'123456'.'210ww');
        $res=$user->update(['user_pass'=>$pass]);
        if($res){
            return json_encode(['code'=>1,'mag'=>'修改成功']);
        }else{
            return json_encode(['code'=>0,'mag'=>'修改失败']);
        }
    }
    //赋予角色
    public function role($admin_id){
        $role=RoleData::get();
        $admin=AdminData::find($admin_id)->admin_role;
        return view('admin/admin/role')->with('data',$admin)->with('roledata',$role)->with('admin_id',$admin_id);
    }
    //修改管理员角色
    public function give(Request $request){
        $input=$request->except('_token');
        $admin=AdminData::find($input['admin_id'])->admin_role;

        //超级管理员不能被修改
        foreach($admin as $v){
            if($v->id==1){
                return json_encode(['code'=>0,'mag'=>'无权修改该用户']);
            }
        }
        if(!isset($input['role'])){
            return json_encode(['code'=>0,'mag'=>'角色不能为空']);
        }
        $res=AdminData::find($input['admin_id'])->admin_role()->sync($input['role']);
        if($res){
            return json_encode(['code'=>1,'mag'=>'授权成功']);
        }else{
            return json_encode(['code'=>0,'mag'=>'授权失败']);
        }
    }
}
