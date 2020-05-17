<?php
use think\facade\Route;

Route::domain('*', '@index');
Route::domain('admin', '@admin');