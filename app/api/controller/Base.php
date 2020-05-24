<?php
/**
 * Created by PhpStorm.
 * User: Leon4055
 * Date: 2020-05-24
 * Time: 15:33
 */

namespace app\api\controller;

class Base
{
    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;
        header("Access-Control-Allow-Origin: * ");
        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}


}