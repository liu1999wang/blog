<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;//表单提交
use Illuminate\Support\Facades\View;//视图
class User extends BaseController
{
   public function list(){
       return view('admin/user/list');
   }
}
