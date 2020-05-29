<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // 指定表明
    protected $table="admin";
    // 指定主键id
    protected $primarKey="admin_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
