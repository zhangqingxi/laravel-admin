<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Admin\Post
 *
 * @property int $id
 * @property int $admin_user_id 用户ID
 * @property string $ip 用户ID
 * @property string $title 标题
 * @property string $content 内容
 * @property int $image_id 图片ID
 * @property int $status 文章状态 1已发布 0未发布
 * @property int $is_comment 文章是否允许评论 1允许 0不允许
 * @property int $is_top 是否允许置顶 1允许 0不允许
 * @property int $hits 浏览量
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereAdminUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereIsComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Post withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Tag[] $tags
 * @property string $description 简介
 * @property string $image 图片
 * @property-read int|null $tags_count
 * @property-read \App\Models\Admin\AdminUser $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Post whereImage($value)
 */
class Post extends Base
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'admin_user_id', 'ip', 'title', 'content', 'image','status', 'is_comment','is_top', 'hits',
    ];


    public function user()
    {
        return $this->hasOne(AdminUser::class, 'id', 'admin_user_id');
    }

    public function tags()
    {

        return $this->belongsToMany(Tag::class, PostTag::class, 'post_id', 'tag_id');

    }

    /**
     * 处理富文本内容
     * @param $value
     */
    public function setContentAttribute($value)
    {

        $this->attributes['content'] = htmlspecialchars($value);

    }

    /**
     * 处理富文本内容
     * @param $value
     */
    public function getContentAttribute($value)
    {

        $this->attributes['content'] = htmlspecialchars_decode($value);

    }

}
