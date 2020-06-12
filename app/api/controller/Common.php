<?php
/**
 * Created by PhpStorm.
 * User: Leon4055
 * Date: 2020-06-10
 * Time: 17:15
 */

namespace app\api\controller;


use app\BaseController;

class Common extends BaseController
{
    /**
     * 上传图片
     */
    public function upload_image()
    {
        $jsonData = ["code" => '0', "msg" => "error"];
        if (request()->isPost()) {
            // 图片的本地路径
            $file = $_FILES['image']['tmp_name'];
            // 换取上传图片的后缀
            $pathInfo = pathinfo($_FILES['image']['name']);
            $ext = $pathInfo['extension'];
            $fileName = date("YmdHis", strtotime('now')) . '.' . $ext;
            dump($file);
            dump($fileName);
            return false;
            if ($error === null) {
                return json(['img_url' => $img_url, 'text' => $text]);
            } else {
                $jsonData['code'] = '400';
                $jsonData['msg'] = '请求意外出现错误';
                return json($jsonData);
            }
        } else {
            $jsonData['code'] = '404';
            $jsonData['msg'] = '非法请求';
            return json($jsonData);
        }

    }
}
