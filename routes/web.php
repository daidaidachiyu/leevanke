<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Auth::routes();

//登录登出
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//注册
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
////Route::post('register', 'Auth\RegisterController@register');
//
////密码找回与重置
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//
////邮箱验证
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


//admin业务
Route::group(['middleware' => ['auth','permission']], function() {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/test1', 'AdminController@test1')->name('admin.test1');
    Route::get('/test2', 'AdminController@test2')->name('admin.test2');

    //添加用户
    Route::get('/addUser', 'AdminController@addUser')->name('admin.addUser');
    Route::post('/register', 'Auth\RegisterController@register')->name('admin.addUserApi');

    //显示用户列表
    Route::get('/userList', 'AdminController@userList')->name('admin.userList');


    //修改用户
    Route::get('/editUser/{id}', 'AdminController@editUser')->name('admin.editUser');
    Route::post('/editUser', 'Auth\RegisterController@edit')->name('admin.editUserApi');

    //删除用户
    Route::delete('/deleteUser', 'AdminController@deleteUser')->name('admin.deleteUser');

    //角色crud
    Route::get('/roleList', 'AdminController@roleList')->name('admin.roleList');
    Route::get('/addRole', 'AdminController@addRole')->name('admin.addRole');
    Route::post('/addRole', 'AdminController@addRoleApi')->name('admin.addRoleApi');
    Route::get('/editRole/{id}', 'AdminController@editRole')->name('admin.editRole');
    Route::post('/editRole', 'AdminController@editRoleApi')->name('admin.editRoleApi');
    Route::delete('/deleteRole', 'AdminController@deleteRole')->name('admin.deleteRole');

    //权限crud
    Route::get('/permissionList', 'AdminController@permissionList')->name('admin.permissionList');
    Route::get('/addPermission', 'AdminController@addPermission')->name('admin.addPermission');
    Route::post('/addPermission', 'AdminController@addPermissionApi')->name('admin.addPermissionApi');
    Route::get('/editPermission/{id}', 'AdminController@editPermission')->name('admin.editPermission');
    Route::post('/editPermission', 'AdminController@editPermissionApi')->name('admin.editPermissionApi');
    Route::delete('/deletePermission', 'AdminController@deletePermission')->name('admin.deletePermission');
});


