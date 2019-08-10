<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Admin\Tag
 *
 * @property int $id
 * @property string $name 名称
 * @property int $status 状态  1启用 0禁用
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Tag onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Tag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Tag withoutTrashed()
 * @mixin \Eloquent
 */
class Tag extends Base
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'status',
    ];
}
