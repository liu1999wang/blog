<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\AdminData;
use App\Model\RoleData;
use App\Model\PermissionData;
use Illuminate\Support\Facades\Cache;
class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        // 获取当前路由
        $route=\Route::current()->getActionName();
        //获取用户权限
        $user=AdminData::find(session()->get('user_id'));
        $role=$user->admin_role;
        $is_role=true;
        $arr=[];//储存权限
        $is_show=[];
        foreach($role as $r){
            if($r->id==1){
                $is_role=false;
                $per=PermissionData::get();
                foreach($per as $p){
                    if($p->is_show==1){
                        $is_show[]=$p->id;
                    }
                    $arr[]=$p->per_url;
                }
            }else{
                foreach($r->role_permission as $p){
                    if($p->is_show==1){
                        $is_show[]=$p->id;
                    }
                    $arr[]=$p->per_url;
                }
            }
        }
        //去掉重复权限
        $arr=array_unique($arr);
        $is_show=array_unique($is_show);

        Cache::put('admin_is_show',$is_show);
        // dd($route);
        if(!$is_role){
            return $next($request);
        }
        if(in_array($route,$arr)){
            return $next($request);
        }else{
            return redirect('index/nothing');
        }

    }
}
