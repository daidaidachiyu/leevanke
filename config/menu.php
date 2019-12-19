<?php
/*
 * 配置左侧多级菜单，采用x-admin样式
 * 配置childrem属性使当前节点设为父类节点，无法设置route（路由），需要设置icon（图标）属性
 * 其余为子类节点，可以设置route，无法设置icon
 *
 * http://x.xuebingsi.com/x-admin/v2.2/查看模板图标样式
 * php artisan config:cache将配置写入缓存
 */
return [
    "List" => [
        [
            'name' => '用户与权限管理',
            'children' => [
                [
                    'name'=>'用户管理',
                    'route'=>'admin.userList'
                ],
                [
                    'name'=>'角色管理',
                    'route'=>'admin.roleList'
                ],
                [
                    'name'=>'权限管理',
                    'route'=>'admin.permissionList'
                ]
            ]
        ],
        [
            'name' => '多级菜单演示',
            'icon' => '&#xe699',
            'children' => [
                [
                    'name' => '第二级菜单',
                    'icon' => '&#xe699',
                    'children' => [
                        [
                            'name' => '第三级菜单',

                        ]
                    ]
                ]
            ]
        ],

        [
            'name' => '权限功能演示',
            'icon' => '&#xe6b5',
            'children' => [
                [
                    'name' => '一号权限',
                    'route' => 'admin.test1'
                ],
                [
                    'name' => '二号权限',
                    'route' => 'admin.test2'
                ]
            ]
        ]
    ]


];
