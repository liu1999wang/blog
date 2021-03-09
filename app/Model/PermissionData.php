<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionData extends Model
{
    //模型关联表
    public  $table ='blog_permission';
    //关联表主键
    public  $primaryKey= 'id';
    /**
     * The attributes that are mass assignable.
     *允许被批量操作的字段
     * @var array
     */
    // protected $fillable = [
    //     'user_name','user_pass','statu'
    // ];
    protected $guarded=[];
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
