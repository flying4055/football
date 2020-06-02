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
        $pageIndex = isset($params['pageIndex']) ? $params['pageIndex'] : 0;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 10;
        $userModel = new userModel;
        $total = $userModel->where($search)->count();
        $res = $userModel->where($search)->page($pageIndex, $pageSize)->order("uid desc")->select();
        $result = $res->toArray();
        $data['count'] = $total;
        $data['list'] = $result;
        return json(["code" => "0", "msg" => "success", "data" => $data]);
    }
}
