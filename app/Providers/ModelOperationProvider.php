<?php

namespace App\Providers;

use App\Observers\ModelObserver;
use Illuminate\Support\ServiceProvider;
use Event;

class ModelOperationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerEvents();
    }


    /**
     * 执行配置文件
     */
    public function registerEvents()
    {

        $allListeners = config('blog.event.listeners');

        foreach ($allListeners as $event => $listeners) {

            foreach ($listeners as $listener) {

                Event::listen($event, $listener);

            }

        }

        $observers = config('blog.event.observers');

        foreach ($observers as $observer) {

            $observer::observe(ModelObserver::class);

        }

    }

}
