<?php

namespace App\Models\Admin;

/**
 * App\Models\Admin\AdminSystemLog
 *
 * @package App\Models\Admin;
 * @author Qasim <15750783791@163.com>
 * @date 2019-05-14
 * @property int $id
 * @property int $admin_user_id 用户ID
 * @property string $route 执行路由
 * @property string $method 执行方法
 * @property string $ip 客户端ip
 * @property string $table_name 表名
 * @property int $table_id 表ID
 * @property string $title 标题
 * @property string $content 内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereAdminUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminSystemLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminSystemLog extends Base
{

    protected $fillable = [
        'admin_user_id', 'route', 'method', 'ip', 'table_name', 'table_id', 'title',  'content',
    ];

}
