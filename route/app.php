<?php
use think\facade\Route;

Route::domain('*', '@index');
Route::domain('admin', '@admin');
Route::domain('api', '@api');
