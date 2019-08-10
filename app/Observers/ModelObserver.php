<?php

namespace App\Observers;

use App\Events\ModelDeleteEvents;
use App\Events\ModelOperationEvents;
use App\Models\Admin\AdminRecycleBin;
use App\Models\Admin\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Arr;

class ModelObserver
{

    /**
     * 模型新建后
     * @param Model $model
     */
    public function created(Model $model)
    {

        $attributes = $model->getAttributes();

        $attributes = Arr::except($attributes, ['created_at', 'updated_at']);

        $tableName = get_class($model);

        $tableId = $model->getKey();

        $title = "添加数据";

        $content = "模型数据：".prettyPrint($attributes)."";

        if($model instanceof AdminRecycleBin){

            $attributes['content'] = "关联数据";

            $content = "模型数据：".prettyPrint($attributes);

        }

        event(new ModelOperationEvents($title, $content, 0, $tableName, $tableId));

    }


    /**
     * 模型更新后
     * @param Model $model
     */
    public function updated(Model $model)
    {

        $dirty = $model->getDirty();

        $original = $model->getOriginal();

        $dirty = Arr::except($dirty, ['updated_at']);

        $original = Arr::only($original, array_keys($dirty));

        if (count($dirty) > 0) {

            $modelName = get_class($model);

            $modelId = $model->getKey();

            $title = "更新数据";

            $content = "数据更新前：".prettyPrint($original)."数据更新后：".prettyPrint($dirty);

            $adminUserId = 0;//操作用户Id

            if($model instanceof AdminUser){

                $adminUserId = $model->id;

            }

            event(new ModelOperationEvents($title, $content, $adminUserId, $modelName, $modelId));

        }

    }

    /**
     * 模型删除后
     * @param Model $model
     */
    public function deleted(Model $model)
    {

        $attributes = $model->getAttributes();

        $modelName = get_class($model);

        $modelId = $model->getKey();

        $title = "删除数据";

        $content = "模型数据：".prettyPrint($attributes);

        //如果不是資源回收表 將刪除数据保存到回收表
        if(!($model instanceof AdminRecycleBin)){

            //更新状态 伪删除 需要往回收站添加数据
            if (count($model->getDirty()) > 0){

                event(new ModelDeleteEvents($content, 0, $modelName, $modelId));

            }

        }else if($model instanceof AdminRecycleBin){

            $attributes['content'] = "关联数据";

            $content = "模型数据：".prettyPrint($attributes);

        }

        event(new ModelOperationEvents($title, $content, 0, $modelName, $modelId));

    }

}
