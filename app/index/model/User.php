<?php
/**
 * Created by PhpStorm.
 * User: rooty
 * Date: 2020-05-15
 * Time: 12:58
 */

namespace app\index\model;


use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = true;

    protected function setPasswordAttr($value)
    {
        return md5($value);
    }
}