<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
  /**
   * 关联到模型的数据表
   *
   * @var string
   */
  protected $table = 'users';
  /**
   * 表明模型是否应该被打上时间戳
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * 验证用户
   */
  static function checkUser(String $name)
  {
    $user = DB::table('users')->where('name', $name)->value('id');
    return $user;
  }
}
