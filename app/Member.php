<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // 指定表明
    protected $table="member";
    // 指定主键id
    protected $primarKey="member_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
