<?php

namespace app\index\controller;

use app\BaseController;
use app\index\model\User as userModel;
use think\facade\Session;

class User extends BaseController
{
    public function index()
    {
        return "";
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function forgot_password()
    {
        return view('forgot_password');
    }

    // 检查登录账户
    public function login_check()
    {
        $params = $this->request->post();
        // Email格式
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $params['email'])) {
            return json(['code' => '4000', "msg" => "Email格式不正确"]);
        }
        // 密码长度
        if (!preg_match('/^[a-zA-Z\d_]{6,}$/', $params['password'])) {
            return json(['code' => '4000', "msg" => "密码长度不能少于6个字符或大于16个字符"]);
        }
        $userModel = new userModel;
        $res = $userModel->where(['email' => $params['email']])->find();
        if ($res !== null) {
            $result = $res->toArray();
            if (md5($params['password']) == $result['password']) {
                unset($result['password']); // 密码不可以展示
                $userModel->where(['uid' => $result['uid']])->data(['login_time' => time()])->save();
                return json(['code' => '0', 'msg' => '恭喜您登陆成功', 'data' => $result]);
            } else {
                return json(['code' => '4000', "msg" => "密码有误"]);
            }
        } else {
            return json(['code' => '4000', "msg" => "该账户不存在"]);
        }
    }

    // 保存数据
    public function store()
    {
        $params = $this->request->post();
        // 检测用户提交的数据格式是否正确
        // 用户名称长度
        if (!preg_match('/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u', $params['username'])) {
            return json(['code' => '4000', "msg" => "用户名由2-16位数字或字母、汉字、下划线组成"]);
        }
        // Email格式
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $params['email'])) {
            return json(['code' => '4000', "msg" => "Email格式不正确"]);
        }
        // 密码长度
        if (!preg_match('/^[a-zA-Z\d_]{6,}$/', $params['password'])) {
            return json(['code' => '4000', "msg" => "密码长度不能少于6个字符或大于16个字符"]);
        }
        // 电话长度
        if (strlen($params['phone']) < 11 && !preg_match('/^(((d{3}))|(d{3}-))?13d{9}$/', $params['phone'])) {
            return json(['code' => '4000', "msg" => "电话长度不能少于11个字符"]);
        }
        $userModel = new userModel;
        // 查询用户是否存在
        $res = $userModel->field('email')->where(['email' => $params['email']])->find();
        // 如果该用户信息为空
        if ($res === null) {
            // 如果该用户不存在,则进行保存操作
            $res = $userModel->save($params);
            if ($res) {
                // 保存成功
                return json(['code' => '0', "msg" => "恭喜您注册成功了"]);
            } else {
                // 保存失败
                return json(['code' => '4000', "msg" => "网络错误!!"]);
            }
        } else {
            // 如果该用户存在
            return json(['code' => '4000', "msg" => "该账户已存在"]);
        }
    }

    // 忘记密码接受
    public function forgot_pwd()
    {
        $params = $this->request->post();
        return json(['code' => '4000', "msg" => "输入有误,或该账户不存在!"]);
    }
}
