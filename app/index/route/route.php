<?php

use think\facade\Route;

Route::rule('login', 'user/login');
Route::rule('register', 'user/register');
Route::rule('forgot_password', 'user/forgot_password');
