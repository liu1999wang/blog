<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
class Login extends BaseController
{

   public function add(){
    // if (View::exists('user/add')) {
    //     dd("存在");
    // }else{
    //     dd("不存在");
    // }
    return view('login/add');
    // dd("1212");
   } 
   public function store(Request $request){
    // $input=$request->all();
    $input=$request->except('_token');
    $input['user_pass']=md5($input['user_pass']);
    $res = User::create($input);
    if($res){
       return redirect('index/index');
    }else{
       return back();
    }
   } 
}
