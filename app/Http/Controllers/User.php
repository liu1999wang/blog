<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class User extends BaseController
{

   public function add(){
    // if (View::exists('user/add')) {
    //     dd("存在");
    // }else{
    //     dd("不存在");
    // }
    return view('user/add');
    // dd("1212");
   } 
   public function store(Request $request){
    // $input=$request->all();
    $input=$request->except('_token');
    $input['password']=md5($input['password']);
    dd($input);
   } 
}
