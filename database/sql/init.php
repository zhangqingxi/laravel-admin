<?php


return [

    'admin_menus' => [
        [
            'id' => 1,
            'parent_id' => 0,
            'route' => 'set',
            'status' => 1,
            'name' => '设置中心',
            'icon' => 'layui-icon-set',
            'remark' => '设置中心',
        ],
        [
            'id' => 2,
            'parent_id' => 1,
            'route' => 'menus',
            'status' => 1,
            'name' => '菜单管理',
            'icon' => '',
            'remark' => '菜单管理',
        ],
        [
            'id' => 3,
            'parent_id' => 2,
            'route' => 'menus/list',
            'status' => 1,
            'name' => '菜单列表',
            'icon' => '',
            'remark' => '菜单列表',
        ],
        [
            'id' => 4,
            'parent_id' => 2,
            'route' => 'menus/edit',
            'status' => 1,
            'name' => '编辑菜单',
            'icon' => '',
            'remark' => '编辑菜单',
        ],
        [
            'id' => 5,
            'parent_id' => 2,
            'route' => 'menus/add',
            'status' => 1,
            'name' => '添加菜单',
            'icon' => '',
            'remark' => '添加菜单',
        ],
        [
            'id' => 6,
            'parent_id' => 2,
            'route' => 'menus/delete',
            'status' => 1,
            'name' => '删除菜单',
            'icon' => '',
            'remark' => '删除菜单',
        ],
        [
            'id' => 7,
            'parent_id' => 1,
            'route' => 'systemLogs',
            'status' => 1,
            'name' => '系统日志',
            'icon' => '',
            'remark' => '系统日志',
        ],
        [
            'id' => 8,
            'parent_id' => 7,
            'route' => 'systemLogs/list',
            'status' => 1,
            'name' => '日志列表',
            'icon' => '',
            'remark' => '日志列表',
        ],
        [
            'id' => 9,
            'parent_id' => 7,
            'route' => 'systemLogs/clear',
            'status' => 1,
            'name' => '清理日志',
            'icon' => '',
            'remark' => '清理日志',
        ],
        [
            'id' => 10,
            'parent_id' => 0,
            'route' => 'content',
            'status' => 1,
            'name' => '内容中心',
            'icon' => 'layui-icon-app',
            'remark' => '内容中心',
        ],
        [
            'id' => 11,
            'parent_id' => 10,
            'route' => 'posts',
            'status' => 1,
            'name' => '文章管理',
            'icon' => '',
            'remark' => '文章管理',
        ],
        [
            'id' => 12,
            'parent_id' => 11,
            'route' => 'posts/list',
            'status' => 1,
            'name' => '文章列表',
            'icon' => '',
            'remark' => '文章列表',
        ],
        [
            'id' => 13,
            'parent_id' => 11,
            'route' => 'posts/edit',
            'status' => 1,
            'name' => '编辑文章',
            'icon' => '',
            'remark' => '编辑文章',
        ],
        [
            'id' => 14,
            'parent_id' => 11,
            'route' => 'posts/add',
            'status' => 1,
            'name' => '添加文章',
            'icon' => '',
            'remark' => '添加文章',
        ],
        [
            'id' => 15,
            'parent_id' => 11,
            'route' => 'posts/delete',
            'status' => 1,
            'name' => '删除文章',
            'icon' => '',
            'remark' => '删除文章',
        ],
        [
            'id' => 16,
            'parent_id' => 10,
            'route' => 'tags',
            'status' => 1,
            'name' => '标签管理',
            'icon' => '',
            'remark' => '标签管理',
        ],
        [
            'id' => 17,
            'parent_id' => 16,
            'route' => 'tags/list',
            'status' => 1,
            'name' => '标签列表',
            'icon' => '',
            'remark' => '标签列表',
        ],
        [
            'id' => 18,
            'parent_id' => 16,
            'route' => 'tags/edit',
            'status' => 1,
            'name' => '编辑标签',
            'icon' => '',
            'remark' => '编辑标签',
        ],
        [
            'id' => 19,
            'parent_id' => 16,
            'route' => 'tags/add',
            'status' => 1,
            'name' => '添加标签',
            'icon' => '',
            'remark' => '添加标签',
        ],
        [
            'id' => 20,
            'parent_id' => 16,
            'route' => 'tags/delete',
            'status' => 1,
            'name' => '删除标签',
            'icon' => '',
            'remark' => '删除标签',
        ],
        [
            'id' => 21,
            'parent_id' => 0,
            'route' => 'recycle',
            'status' => 1,
            'name' => '回收中心',
            'icon' => 'layui-icon-template',
            'remark' => '回收中心',
        ],
        [
            'id' => 22,
            'parent_id' => 21,
            'route' => 'recycleBin',
            'status' => 1,
            'name' => '回收管理',
            'icon' => '',
            'remark' => '回收管理',
        ],
        [
            'id' => 23,
            'parent_id' => 22,
            'route' => 'recycleBin/list',
            'status' => 1,
            'name' => '回收列表',
            'icon' => '',
            'remark' => '回收列表',
        ],
        [
            'id' => 24,
            'parent_id' => 22,
            'route' => 'recycleBin/restore',
            'status' => 1,
            'name' => '回收还原',
            'icon' => '',
            'remark' => '回收还原',
        ],
        [
            'id' => 25,
            'parent_id' => 22,
            'route' => 'recycleBin/delete',
            'status' => 1,
            'name' => '彻底删除',
            'icon' => '',
            'remark' => '彻底删除',
        ],
        [
            'id' => 26,
            'parent_id' => 0,
            'route' => 'users',
            'status' => 1,
            'name' => '用户中心',
            'icon' => 'layui-icon-user',
            'remark' => '用户中心',
        ],
        [
            'id' => 27,
            'parent_id' => 26,
            'route' => 'users',
            'status' => 1,
            'name' => '用户管理',
            'icon' => '',
            'remark' => '用户管理',
        ],
        [
            'id' => 28,
            'parent_id' => 27,
            'route' => 'users/list',
            'status' => 1,
            'name' => '用户列表',
            'icon' => '',
            'remark' => '用户列表',
        ],
        [
            'id' => 29,
            'parent_id' => 27,
            'route' => 'users/role',
            'status' => 1,
            'name' => '角色设置',
            'icon' => '',
            'remark' => '角色设置',
        ],
        [
            'id' => 30,
            'parent_id' => 27,
            'route' => 'users/edit',
            'status' => 1,
            'name' => '编辑用户',
            'icon' => '',
            'remark' => '编辑用户',
        ],
        [
            'id' => 31,
            'parent_id' => 27,
            'route' => 'users/add',
            'status' => 1,
            'name' => '添加用户',
            'icon' => '',
            'remark' => '添加用户',
        ],
        [
            'id' => 32,
            'parent_id' => 27,
            'route' => 'users/delete',
            'status' => 1,
            'name' => '删除用户',
            'icon' => '',
            'remark' => '删除用户',
        ],
        [
            'id' => 33,
            'parent_id' => 26,
            'route' => 'roles',
            'status' => 1,
            'name' => '角色管理',
            'icon' => '',
            'remark' => '角色管理',
        ],
        [
            'id' => 34,
            'parent_id' => 33,
            'route' => 'roles/list',
            'status' => 1,
            'name' => '角色列表',
            'icon' => '',
            'remark' => '角色列表',
        ],
        [
            'id' => 35,
            'parent_id' => 33,
            'route' => 'roles/permission',
            'status' => 1,
            'name' => '权限设置',
            'icon' => '',
            'remark' => '权限设置',
        ],
        [
            'id' => 36,
            'parent_id' => 33,
            'route' => 'roles/edit',
            'status' => 1,
            'name' => '编辑角色',
            'icon' => '',
            'remark' => '编辑角色',
        ],
        [
            'id' => 37,
            'parent_id' => 33,
            'route' => 'roles/add',
            'status' => 1,
            'name' => '添加角色',
            'icon' => '',
            'remark' => '添加角色',
        ],
        [
            'id' => 38,
            'parent_id' => 33,
            'route' => 'roles/delete',
            'status' => 1,
            'name' => '删除角色',
            'icon' => '',
            'remark' => '删除角色',
        ],
        [
            'id' => 39,
            'parent_id' => 0,
            'route' => 'resource',
            'status' => 1,
            'name' => '资源中心',
            'icon' => 'layui-icon-file-b',
            'remark' => '资源中心',
        ],
        [
            'id' => 40,
            'parent_id' => 39,
            'route' => 'files',
            'status' => 1,
            'name' => '文件管理',
            'icon' => '',
            'remark' => '文件管理',
        ],
        [
            'id' => 41,
            'parent_id' => 40,
            'route' => 'files/list',
            'status' => 1,
            'name' => '文件列表',
            'icon' => '',
            'remark' => '文件列表',
        ],
        [
            'id' => 42,
            'parent_id' => 40,
            'route' => 'files/delete',
            'status' => 1,
            'name' => '删除文件',
            'icon' => '',
            'remark' => '删除文件',
        ],
    ],

    'admin_users' => [
        [
            'id' => 1,
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'nickname' => '系统管理员',
        ],
    ],

];
