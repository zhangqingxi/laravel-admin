----admin_menus----
INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (1, 0, 1, 555, 'set', '设置中心', 'layui-icon-set', '设置中心', NULL, '2019-05-07 18:06:37', '2019-05-07 18:06:37');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (2, 1, 1, 0, 'menus', '菜单管理', '', '菜单管理', NULL, '2019-05-07 22:37:42', '2019-05-07 22:37:45');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (3, 2, 0, 0, 'menus/list', '菜单列表', '', '菜单列表', NULL, '2019-05-21 13:35:28', '2019-05-21 13:35:28');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (4, 2, 0, 0, 'menus/edit', '编辑菜单', '', '编辑菜单', NULL, '2019-05-07 15:21:37', '2019-05-11 01:32:11');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (5, 2, 0, 0, 'menus/add', '添加菜单', '', '添加菜单', NULL, '2019-05-07 15:21:20', '2019-05-07 15:21:20');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (6, 2, 0, 0, 'menus/delete', '删除菜单', '', '删除菜单', NULL, '2019-05-07 15:20:47', '2019-05-07 15:20:47');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (7, 1, 1, 0, 'systemLogs', '系统日志', '', '系统日志', NULL, '2019-05-11 00:47:35', '2019-05-11 05:57:12');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (8, 7, 0, 0, 'systemLogs/list', '日志列表', '', '日志列表', NULL, '2019-05-21 13:35:03', '2019-05-21 13:35:03');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (9, 7, 0, 0, 'systemLogs/clear', '清理日志', '', '清理日志', NULL, '2019-05-11 00:52:17', '2019-05-11 05:53:07');
INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (10, 0, 1, 999, 'content', '内容中心', 'layui-icon-app', '内容中心模块', NULL, '2019-05-07 15:30:47', '2019-05-21 20:18:00');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (11, 10, 1, 0, 'posts', '文章管理', '', '文章管理', NULL, '2019-05-07 15:32:26', '2019-05-21 20:18:00');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (13, 11, 0, 0, 'posts/list', '文章列表', '', '查看文章列表', NULL, '2019-05-21 13:30:12', '2019-05-21 13:36:27');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (14, 11, 0, 0, 'posts/edit', '编辑文章', '', '编辑文章', NULL, '2019-05-07 17:13:21', '2019-05-07 17:13:21');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (15, 11, 0, 0, 'posts/add', '添加文章', '', '添加文章', NULL, '2019-05-07 15:40:59', '2019-05-21 20:18:00');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (16, 11, 0, 0, 'posts/delete', '删除文章', '', '删除文章', NULL, '2019-05-07 16:23:15', '2019-05-07 16:23:15');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (17, 10, 1, 0, 'tags', '标签管理', '', '文章标签', NULL, '2019-05-11 01:33:24', '2019-05-11 01:34:46');
        INSERT INTO `blog`.`admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (18, 17, 0, 0, 'tags/list', '标签列表', '', '查看标签列表', NULL, '2019-05-21 13:31:14', '2019-05-21 13:37:35');
        INSERT INTO `blog`.`admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (19, 17, 0, 0, 'tags/edit', '编辑标签', '', '编辑标签', NULL, '2019-05-11 01:35:51', '2019-05-11 01:35:51');
        INSERT INTO `blog`.`admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (20, 17, 0, 0, 'tags/add', '添加标签', '', '添加标签', NULL, '2019-05-11 01:35:27', '2019-05-11 01:35:27');
        INSERT INTO `blog`.`admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (21, 17, 0, 0, 'tags/delete', '删除标签', '', '删除标签', NULL, '2019-05-11 01:36:20', '2019-05-11 01:36:20');
INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (22, 0, 1, 666, 'recycle', '回收中心', 'layui-icon-template', '回收中心', NULL, '2019-05-11 00:12:54', '2019-05-11 00:18:43');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (23, 22, 1, 1, 'recycleBin', '回收管理', '', '回收管理', NULL, '2019-05-11 00:19:22', '2019-05-11 00:26:47');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (24, 23, 0, 0, 'recycleBin/list', '回收列表', '', '回收列表', NULL, '2019-05-21 13:34:34', '2019-05-21 13:34:34');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (25, 23, 0, 0, 'recycleBin/restore', '回收还原', '', '回收还原', NULL, '2019-05-11 00:21:18', '2019-05-11 00:21:18');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (26, 23, 0, 0, 'recycleBin/delete', '彻底删除', '', '彻底删除', NULL, '2019-05-11 00:22:16', '2019-05-11 00:22:16');
INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (27, 0, 1, 888, 'user', '用户中心', 'layui-icon-user', '用户中心', NULL, '2019-05-11 00:22:51', '2019-05-11 00:22:51');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (28, 27, 1, 0, 'users', '用户管理', '', '用户管理', NULL, '2019-05-11 00:24:16', '2019-05-14 18:44:27');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (29, 28, 0, 0, 'users/list', '用户列表', '', '查看用户列表', NULL, '2019-05-21 13:33:12', '2019-05-21 13:39:46');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (30, 28, 0, 0, 'users/role', '角色设置', '', '角色设置', NULL, '2019-05-21 14:44:41', '2019-05-21 14:44:41');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (31, 28, 0, 0, 'users/edit', '编辑用户', '', '编辑用户', NULL, '2019-05-11 00:33:57', '2019-05-11 00:33:57');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (32, 28, 0, 0, 'users/add', '添加用户', '', '添加用户', NULL, '2019-05-11 00:32:37', '2019-05-11 00:32:37');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (33, 28, 0, 0, 'users/delete', '删除用户', '', '删除用户', NULL, '2019-05-11 00:34:26', '2019-05-11 00:34:26');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (34, 27, 1, 0, 'roles', '角色管理', '', '角色管理', NULL, '2019-05-11 00:24:33', '2019-05-14 18:43:35');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (35, 34, 0, 0, 'roles/list', '角色列表', '', '查看角色列表', NULL, '2019-05-21 13:32:51', '2019-05-21 13:40:01');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (36, 34, 0, 0, 'roles/permission', '权限设置', '', '设置角色权限', NULL, '2019-05-19 23:27:08', '2019-05-21 12:57:57');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (37, 34, 0, 0, 'roles/edit', '编辑角色', '', '编辑角色', NULL, '2019-05-11 00:28:24', '2019-05-11 00:28:24');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (38, 34, 0, 0, 'roles/add', '添加角色', '', '添加角色', NULL, '2019-05-11 00:27:57', '2019-05-11 00:27:57');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (39, 34, 0, 0, 'roles/delete', '删除角色', '', '删除角色', NULL, '2019-05-11 00:28:51', '2019-05-11 00:28:51');
INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (40, 0, 1, 777, 'resource', '资源中心', 'layui-icon-file-b', '资源中心', NULL, '2019-05-11 00:38:58', '2019-05-11 00:38:58');
    INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (41, 40, 1, 0, 'files', '文件管理', '', '文件管理', NULL, '2019-05-11 00:39:30', '2019-05-11 00:39:30');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (42, 41, 0, 0, 'files/list', '文件列表', '', '查看文件列表', NULL, '2019-05-21 13:33:42', '2019-05-21 13:38:06');
        INSERT INTO `admin_menus`(`id`, `parent_id`, `status`, `sort`, `route`, `name`, `icon`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES (43, 41, 0, 0, 'files/delete', '删除文件', '', '删除文件', NULL, '2019-05-11 00:46:20', '2019-05-11 00:46:20');

----admin_users----
INSERT INTO `admin_users`(`id`, `username`, `password`, `nickname`, `last_login_ip`, `last_login_time`, `login_times` , `status`, `deleted_at`, `created_at`, `updated_at`) VALUES (1, 'admin', '$2y$10$nvD4kseoE8.kNxsyyYT5EOGW2mYD3O2cfoVqnHvrBKb.zR3m1PYoG', '系统管理员', '', 0, 0, 1, NULL, '2019-05-11 01:36:20', '2019-05-24 11:40:15');


----admin_roles----
INSERT INTO `admin_roles`(`id`, `name`, `remark`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES (1, '系统管理员', '拥有网站最高管理员权限！', 1, NULL, '2019-05-19 14:03:11', '2019-05-21 20:27:05');

----admin_role_menus----
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (1, 1, 1);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (2, 1, 2);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (3, 1, 3);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (4, 1, 4);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (5, 1, 5);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (6, 1, 6);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (7, 1, 7);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (8, 1, 8);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (9, 1, 9);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (10, 1, 10);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (11, 1, 11);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (12, 1, 12);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (13, 1, 13);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (14, 1, 14);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (15, 1, 15);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (16, 1, 16);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (17, 1, 17);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (18, 1, 18);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (19, 1, 19);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (20, 1, 20);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (21, 1, 21);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (22, 1, 22);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (23, 1, 23);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (24, 1, 24);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (25, 1, 25);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (26, 1, 26);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (27, 1, 27);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (28, 1, 28);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (29, 1, 29);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (30, 1, 30);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (31, 1, 31);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (32, 1, 32);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (33, 1, 33);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (34, 1, 34);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (35, 1, 35);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (36, 1, 36);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (37, 1, 37);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (38, 1, 38);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (39, 1, 39);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (40, 1, 40);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (41, 1, 41);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (42, 1, 42);
INSERT INTO `admin_role_menus`(`id`, `role_id`, `menu_id`) VALUES (43, 1, 43);

----admin_user_roles----
INSERT INTO `admin_user_roles`(`id`, `admin_user_id`, `role_id`) VALUES (1, 1, 1);
