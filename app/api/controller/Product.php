<?php
/**
 * Created by PhpStorm.
 * User: Leon4055
 * Date: 2020-06-02
 * Time: 12:48
 */

namespace app\api\controller;

use app\api\model\Product as productModel;
use app\BaseController;
use app\Request;
use think\App;

class Product extends BaseController
{
    protected $model;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new productModel();
    }

    public function index()
    {
        return json(["code" => "400", "msg" => "error"]);
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_list()
    {
        $search = $this->request->get("search", '');
        $pageIndex = $this->request->get("pageIndex", 0);
        $pageSize = $this->request->get("pageSize", 10);
        $map = [];
        if (isset($search) && !empty($search)) {
            $map[] = ["title", "like", '%' . $search . '%'];
        }
        $total = $this->model->where($map)->count('id');
        $result = $this->model->where($map)->page($pageIndex, $pageSize)->select()->toArray();
        $data['count'] = $total;
        $data['list'] = $result;
        return json(["code" => "200", "msg" => "success", "data" => $data]);
    }


}
