<?php

namespace App\Http\Controllers;


use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.index');
    }

    //用户crud
    public function addUser()
    {
        $roles = Role::select('name','id')->get();
        return view('admin.addUser',['roles'=>$roles]);
    }

    public function editUser($id)
    {
        $user = User::select('name','email','id')->find($id);
        $roles = Role::select('name','id')->get();
        return view('admin.editUser',['user'=>$user,'roles'=>$roles]);
    }

    public function userList()
    {

        $userList = User::select('id','name','email')->paginate(8);
        foreach ($userList as $key => $user){
            $userList[$key]['roles'] = $user->roles;
        }
        return view('admin.userList',['userList'=> $userList]);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request['id']);
        $user->roles()->detach();
        if($user->delete()){
            return response('', 200);
        }else{
            return response('', 501);
        }

    }


    //角色crud
    public function roleList()
    {

        $roleList = Role::select('id','name','slug')->paginate(8);
        foreach ($roleList as $key => $role){
            $roleList[$key]['permissions'] = $role->permissions;
        }
        return view('admin.roleList',['roleList'=> $roleList]);
    }

    public function addRole()
    {
        $permissions = Permission::select('name','id')->get();
        return view('admin.addRole',['permissions'=>$permissions]);
    }

    public function addRoleApi(Request $request)
    {
        $data = $request->all();
        $role = Role::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);
        if(isset($data['permission'])){
            foreach ($data['permission'] as $permissionKey => $value){
                $role->permissions()->attach($permissionKey);
            }
        }
        return response('', 200);
    }

    public function editRole($id)
    {
        $role = Role::select('name','slug','id')->find($id);
        $permissions = Permission::select('name','id')->get();
        return view('admin.editRole',['role'=>$role,'permissions'=>$permissions]);
    }


    public function editRoleApi(Request $request)
    {
        $data = $request->all();
        $role = Role::find($data['id']);
        $role->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);
        $role->permissions()->detach();
        if(isset($data['permission'])){
            foreach ($data['permission'] as $permissionKey => $value){
                $role->permissions()->attach($permissionKey);
            }
        }
        return response('', 200);
    }

    public function deleteRole(Request $request)
    {
        $role = Role::find($request['id']);
        $role->permissions()->detach();
        $role->users()->detach();
        if($role->delete()){
            return response('', 200);
        }else{
            return response('', 501);
        }

    }

    //权限crud
    public function permissionList()
    {

        $permissionList = Permission::select('id','name','slug','route')->orderBy('id', 'asc')->paginate(6);
        return view('admin.permissionList',['permissionList'=> $permissionList]);
    }

    public function addPermission()
    {

        return view('admin.addPermission');
    }

    public function addPermissionApi(Request $request)
    {
        $data = $request->all();
        Permission::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'route' => $data['route'],
        ]);
        return response('', 200);
    }

    public function editPermission($id)
    {
        $permission = Permission::select('name','slug','id','route')->find($id);
        return view('admin.editPermission',['permission'=>$permission]);
    }


    public function editPermissionApi(Request $request)
    {
        $data = $request->all();
        $permission = Permission::find($data['id']);
        $permission->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'route' => $data['route'],
        ]);
        return response('', 200);
    }

    public function deletePermission(Request $request)
    {
        $permission = Permission::find($request['id']);
        $permission->roles()->detach();
        if($permission->delete()){
            return response('', 200);
        }else{
            return response('', 501);
        }

    }








    public function test2()
    {
        return view('admin.test1');
    }

    public function test1()
    {

        return view('admin.test');
    }
}
