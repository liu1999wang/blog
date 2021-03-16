<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;//表单提交
use Illuminate\Support\Facades\View;//视图
use App\Model\PermissionData;
use App\Model\RoleData;
class Role extends BaseController
{
        // 角色列表
    public function list(Request $request){

        $roledata=RoleData::orderBy('id','asc')->where('id','>','1')
        ->where(function($query) use($request){
            $role_name=$request->input('role_name');
            if(!empty($role_name)){ 
                $query->where('role_name','like','%'.$role_name.'%');
            }
        })
        ->paginate(10);
        
        return view('admin/role/list')->with('data',$roledata)->with('request',$request);
   }
    //角色授权
    public function empower($role_id){
        $permission=PermissionData::get();
        $role_permission=RoleData::find($role_id)->role_permission;
        $permission_ids=[];
        foreach ($role_permission as $v) {
            $permission_ids[]=$v->id;
        }
        return view('admin/role/empower')->with('permission_ids',$permission_ids)->with('permission',$permission)->with('role_id',$role_id);
   }
    // 修改角色权限
    public function upempower(Request $request){
        $input=$request->except('_token');
        if(!isset($input['perids'])){
            return json_encode(['code'=>0,'mag'=>'权限不能为空']);
        }
        $res=RoleData::find($input['role_id'])->role_permission()->sync($input['perids']);
        if($res){
            return json_encode(['code'=>1,'mag'=>'授权成功']);
        }else{
            return json_encode(['code'=>0,'mag'=>'授权失败']);
        }
    }
    //角色添加
    public function add(Request $request){
        if($request->isMethod('post')){
            $input=$request->except('_token'); 
            $user=RoleData::where('role_name',$input['role_name'])->first();
            if($user){
                return json_encode(['code'=>0,'mag'=>'名称已存在']); 
            }else{
                $res=RoleData::create(['role_name'=>$input['role_name'],'describe'=>$input['describe']]);
                if($res){
                    return json_encode(['code'=>1,'mag'=>'添加成功']); 
                }else{
                    return json_encode(['code'=>0,'mag'=>'添加失败']); 
                }
            }
        }else{
            return view('admin/role/add');
        }
    }
    //修改页
    public function edit($id){
        $admindata=RoleData::find($id);
        // dd($admindata['user_name']);
        return view('admin/role/edit')->with('data',$admindata);
    }
    //修改数据
    public function update(Request $request){
        $input=$request->all();
        $user=RoleData::find($input['uid']);
        $res=$user->update(['role_name'=>$input['role_name'],'describe'=>$input['describe']]);
        if($res){
            return json_encode(['code'=>1,'mag'=>'修改成功']);
        }else{
            return json_encode(['code'=>0,'mag'=>'修改失败']);
        }
    }
}