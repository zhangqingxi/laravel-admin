<?php

namespace App\Models\Admin;

/**
 * Class AdminUserRole
 *
 * @package App\Models\Admin
 * @author Qasim <15750783791@163.com>
 * @date 2019-05-18
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $admin_user_id 用户ID
 * @property int $role_id 角色ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole whereAdminUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminUserRole whereUpdatedAt($value)
 */
class AdminUserRole extends Base
{
    //
}
