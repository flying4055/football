<?php

use think\facade\Route;

Route::rule('payment', 'payment/index');
Route::rule('login', 'user/login');
Route::rule('register', 'user/register');
Route::rule('forgot_password', 'user/forgot_password');
