<?php

use think\facade\Route;

// 选择支付方式 和 优惠券页面
Route::rule('order', 'order/index');
// 选择支付方式 和 优惠券页面
Route::rule('payments', 'payment/payments');
// 默认进入填写发货信息页面
Route::rule('payment', 'payment/index');
// 登陆页面
Route::rule('login', 'user/login');
// 注册页面
Route::rule('register', 'user/register');
// 忘记密码页面
Route::rule('forgot_password', 'user/forgot_password');
