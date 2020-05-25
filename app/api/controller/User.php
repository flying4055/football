<?php
/**
 * Created by PhpStorm.
 * User: Leon4055
 * Date: 2020-05-25
 * Time: 10:45
 */

namespace app\api\controller;

use app\api\model\User as userModel;
use app\BaseController;

class User extends BaseController
{
    public function get_list()
    {
        $params = $this->request->get();
        $search = [];
        if (isset($params['username']) && !empty($params['username'])) {
            $search = ['username' => ["like", '%' . $params['username'] . '%']];
        }
        $pageIndex = isset($params['pageIndex']);
        $pageSize = isset($params['pageSize']);
        $userModel = new userModel;
        $res = $userModel->where($search)->page($pageIndex, $pageSize)->order("uid desc")->select();
        $result = $res->toArray();
        return json(["code" => "0", "msg" => "success", "list" => $result]);
    }
}