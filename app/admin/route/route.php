<?php

use think\facade\Route;

Route::rule('index', 'index/index');
Route::rule('login', 'index/login');
Route::rule('login_check', 'admin/login_check');
