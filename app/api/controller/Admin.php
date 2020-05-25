<?php
/**
 * Created by PhpStorm.
 * User: Leon4055
 * Date: 2020-05-22
 * Time: 8:57
 */

namespace app\api\controller;

use app\api\model\Admin as adminModel;
use app\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        return "";
    }

    public function login()
    {
        $params = $this->request->post();
//        如果前端传参/参数存在且不为空
        if (trim(isset($params['username'])) && trim(isset($params['password']))) {
            $adminModel = new adminModel;
            $res = $adminModel->field("name,password")->where(['name' => $params['username']])->find();
//            如果返回值不为空
            if (!empty($res)) {
//                将对象数据转换成数组
                $result = $res->toArray();
//                如果密码对比正确
                if (md5($params['password']) === $result['password']) {
                    unset($result['password']); // 密码不可以展示
                    return json(['code' => '0', 'msg' => '恭喜您登陆成功', 'data' => $result]);
                } else {
                    return json(['code' => '4000', "msg" => "密码有误"]);
                }
            } else {
                return json(['code' => '4000', "msg" => "该账户不存在"]);
            }
        }
        return json(['code' => '4000', "msg" => "操作有误"]);
    }
}