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
            'name' => '会员管理',
            'icon' => '&#xe698',
            'children' => [
                [
                    'name' => '会员管理1',
                    'children' => [
                        [
                            'name' => '尊贵的VIP1',
                        ],
                        [
                            'name' => '尊贵的VIP2'
                        ],
                        [
                            'name' => 'test',
                            'route' => 'admin.test'
                        ]
                    ]
                ],
            ]
        ],
        [
            'name' => '单身贵族',
            'children' => [
                [
                    'name' => '单身狗之子',
                ]
            ]
        ],

        [
            'name' => 'test',
            'children' => [
                [
                    'name' => 'test',
                    'route' => 'admin.test1'
                ]
            ]
        ]
    ]


];
