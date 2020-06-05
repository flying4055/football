<?php

namespace app\index\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function cart_info()
    {
        return view('index/cart_info');
    }

    public function detail()
    {
        return view('index/detail');
    }
}
