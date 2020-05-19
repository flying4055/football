<?php
/**
 * Created by PhpStorm.
 * User: rooty
 * Date: 2020-05-15
 * Time: 13:57
 */

namespace app\admin\controller;


use app\BaseController;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
        return View::fetch('../public/system/test.html');
    }

    public function login()
    {
        return view('login');
    }
}