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

    public function index()
    {
        return "";
    }

    public function login()
    {
        $params = $this->request->post();
        $adminModel = new adminModel;
        $res = $adminModel->where(['name' => $params['username']])->find();
        if ($res !== null) {
            $result = $res->toArray();
            if (md5($params['password']) == $result['password']) {
                unset($result['password']); // 密码不可以展示
                return json(['code' => '0', 'msg' => '恭喜您登陆成功', 'data' => $result]);
            } else {
                return json(['code' => '4000', "msg" => "密码有误"]);
            }
        } else {
            return json(['code' => '4000', "msg" => "该账户不存在"]);
        }
    }
}