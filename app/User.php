<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    //模型关联表
    public  $table ='data_admin_user';
    //关联表主键
    public  $primaryKey= 'user_id';
    /**
     * The attributes that are mass assignable.
     *允许被批量操作的字段
     * @var array
     */
    protected $fillable = [
        'user_name','user_pass',
    ];
    //禁用时间戳
    public $timestamps=false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
