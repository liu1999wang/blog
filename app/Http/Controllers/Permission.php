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
class Permission extends BaseController
{
        // 权限列表
    public function list(Request $request){

        $permissiondata=PermissionData::orderBy('id','asc')
        ->where(function($query) use($request){
            $per_name=$request->input('per_name');
            if(!empty($per_name)){ 
                $query->where('per_name','like','%'.$per_name.'%');
            }
        })
        ->paginate(15);
        
        return view('admin/permission/list')->with('data',$permissiondata)->with('request',$request);
   }
    //权限添加
    public function add(Request $request){
        if($request->isMethod('post')){
            $input=$request->except('_token'); 
            $per_name=PermissionData::where('per_name',$input['per_name'])->first();
            if($per_name){
                return json_encode(['code'=>0,'mag'=>'名称已存在']); 
            }else{
                $res=PermissionData::create(['per_name'=>$input['per_name'],'per_url'=>$input['per_url'],'parent'=>$input['parent'],'is_show'=>$input['is_show']]);
                if($res){
                    return json_encode(['code'=>1,'mag'=>'添加成功']); 
                }else{
                    return json_encode(['code'=>0,'mag'=>'添加失败']); 
                }
            }
        }else{
            $permissiondata=PermissionData::get();
            return view('admin/permission/add')->with('permissiondata',$permissiondata);
        }
    }
    //修改页
    public function edit($id){
        $permission=PermissionData::find($id);
        // dd($admindata['user_name']);
        $permissiondata=PermissionData::get();
        return view('admin/permission/edit')->with('data',$permission)->with('permissiondata',$permissiondata);
    }
    //修改数据
    public function update(Request $request){
        $input=$request->all();
        $user=PermissionData::find($input['uid']);
        $res=$user->update(['per_name'=>$input['per_name'],'per_url'=>$input['per_url'],'parent'=>$input['parent'],'is_show'=>$input['is_show']]);
        if($res){
            return json_encode(['code'=>1,'mag'=>'修改成功']);
        }else{
            return json_encode(['code'=>0,'mag'=>'修改失败']);
        }
    }
}