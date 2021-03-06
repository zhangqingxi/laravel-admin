<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdminRole
 *
 * @package App\Models\Admin
 * @author Qasim <15750783791@163.com>
 * @date 2019-05-18
 * @property int $id
 * @property string $name 角色名称
 * @property string $remark 角色备注
 * @property int $status 角色状态 0禁用 1正常
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRole whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\AdminMenu[] $permissions
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\AdminRole onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\AdminRole withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\AdminRole withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\AdminRoleMenu[] $roleMenus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\AdminUserRole[] $roleUsers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\AdminUser[] $users
 * @property-read int|null $permissions_count
 * @property-read int|null $role_menus_count
 * @property-read int|null $role_users_count
 * @property-read int|null $users_count
 */
class AdminRole extends Base
{

    use SoftDeletes;

    /**
     * 可写入的字段
     * @var array
     */
    protected $fillable = [
        'status', 'name', 'remark'
    ];


    public static function boot()
    {

        parent::boot(); // TODO: Change the autogenerated stub

        //当角色删除的时候  连带角色权限 用户角色一起删除
        static::deleted(function(AdminRole $adminRole) {

            //获取删除前的数据
            $adminRoleOriginal = $adminRole->getOriginal();

            //是彻底删除的话 关联模型删除
            if($adminRoleOriginal['deleted_at']){

                //角色关联的用户删除
                $adminRole->roleUsers()->delete();

                //角色关联的菜单删除
                $adminRole->roleMenus()->delete();

            }

        });

    }


    /**
     * 角色 关联的用户
     */
    public function roleUsers()
    {

        return $this->hasMany(AdminUserRole::class, 'role_id', 'id');

    }

    /**
     * 角色 关联的菜单权限
     */
    public function roleMenus()
    {

        return $this->hasMany(AdminRoleMenu::class, 'role_id', 'id');

    }

    /*
    * 用户拥有的角色
    */
    public function users()
    {

        return $this->belongsToMany(AdminUser::class,  AdminUserRole::class, 'role_id', 'admin_user_id');

    }

    /*
    * 当前角色的所有权限
    */
    public function permissions()
    {

        return $this->belongsToMany(AdminMenu::class, AdminRoleMenu::class, 'role_id', 'menu_id');

    }


    /*
     * 给角色授权
     */
    public function grantPermission($permission)
    {

        return $this->permissions()->save($permission);

    }

    /*
     * 删除之前无效的权限
     */
    public function deletePermission($permission)
    {

        return $this->permissions()->detach($permission);

    }


}
