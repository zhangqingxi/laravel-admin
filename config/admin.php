<?php

return [

    'admin_url' =>  env('APP_ADMIN_URL', ''),

    /**
     * 事件相关
     */
    'event' => [
        /**
         * 监听者
         */
        'listeners' => [
            /**
             * 默认的记录事件
             */
            'App\Events\ModelOperationEvents' => [
                'App\Listeners\ModelOperationListeners',
            ],
            'App\Events\ModelDeleteEvents' => [
                'App\Listeners\ModelDeleteListeners',
            ],
        ],

        /**
         * 模型观察者.
         * 以下添加的模型都被ModelObserver监听和观察
         * 后续添加
         */
        'observers' => [
           \App\Models\Admin\AdminMenu::class,
           \App\Models\Admin\AdminRecycleBin::class,
           \App\Models\Admin\AdminUser::class,
           \App\Models\Admin\AdminRole::class,
           \App\Models\Admin\Post::class,
           \App\Models\Admin\Tag::class,
        ],
    ],


];