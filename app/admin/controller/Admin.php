<?php
/**
 * Created by PhpStorm.
 * User: rooty
 * Date: 2020-05-19
 * Time: 21:58
 */

namespace app\admin\controller;


use app\BaseController;

class Admin extends BaseController
{
    // 关于管理员的行为操作
    public function login_check()
    {
        $params = $this->request->post();

        dump($params);
    }
}