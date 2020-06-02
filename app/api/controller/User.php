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
        $username = $this->request->get('username', '');
        $pageIndex = $this->request->get('pageIndex', 0);
        $pageSize = $this->request->get('pageSize', 10);
        $map = [];
        if (isset($username) && !empty($username)) {
            $map[] = ["username", "like", '%' . $username . '%'];
        }
        $userModel = new userModel;
        $total = $userModel->where($map)->count();
        $result = $userModel->where($map)->page($pageIndex, $pageSize)->order("uid desc")->select()->toArray();
        $data['count'] = $total;
        $data['list'] = $result;
        return json(["code" => "0", "msg" => "success", "data" => $data]);
    }
}
