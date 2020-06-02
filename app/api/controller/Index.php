<?php
/**
 * Created by PhpStorm.
 * User: rooty
 * Date: 2020-05-22
 * Time: 8:36
 */

namespace app\api\controller;


use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
        return json(["code" => "400", "msg" => "error"]);
    }
}
