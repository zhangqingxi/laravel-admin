<?php

namespace App\Models\Admin;


/**
 * App\Models\Admin\AdminRecycleBin
 *
 * @package App\Models\Admin
 * @author Qasim <15750783791@163.com>
 * @date 2019-05-14
 * @property int $id
 * @property int $admin_user_id 管理员ID
 * @property string $table_name 表名
 * @property int $table_id 表主键ID
 * @property string $content 内容
 * @property string $ip 客户端ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereAdminUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\AdminRecycleBin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminRecycleBin extends Base
{
    protected $table = 'admin_recycle_bin';

    protected $fillable = [
        'admin_user_id', 'table_name', 'content', 'table_id', 'ip'
    ];
}
