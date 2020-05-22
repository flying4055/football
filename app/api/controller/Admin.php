<?php
/**
 * Created by PhpStorm.
 * User: Leon4055
 * Date: 2020-05-22
 * Time: 8:57
 */

namespace app\api\controller;

use app\BaseController;
use app\api\model\Admin as adminModel;
use think\App;

class Admin extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        header("Access-Control-Allow-Origin: * ");
    }

    public function index()
    {
        return "";
    }

    public function login()
    {
        $params = $this->request->post();
        return json(["code" => "0", "msg" => "success", "data" => $params]);
    }
}