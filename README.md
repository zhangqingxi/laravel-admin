# blog 
My Personal Website Blog

#迁移前提
    composer install --optimize-autoloader --no-dev
    
## 清理应用文件 
    php artisan cache:clear
    
## 清理编译缓存文件 
    php artisan optimize:clear
    
## 重新优化 (路由缓存 配置缓存 文件缓存)
    php artisan optimize

也可以使用单独命令进行各项优化


#下面是做blog用到的知识点

#安装工具自动提示扩展
[laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)

    composer require --dev barryvdh/laravel-ide-helper
    
在config/app.php add service provider

    Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class
    
门面的自动PHPDOC生成 === 每次使用composer都要重新运行改命令

    php artisan ide-helper:generate

#安装调试工具
[laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

    composer require --dev barryvdh/laravel-debugbar 
    
在config/app.php add service provider
    
    Barryvdh\Debugbar\ServiceProvider::class,
    
生成配置

    php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"

#安装富文本编辑框扩展
[laravel-u-editor](https://github.com/stevenyangecho/laravel-u-editor)

    composer require --dev stevenyangecho/laravel-u-editor

在config/app.php add service provider

    Stevenyangecho\UEditor\UEditorServiceProvider::class

生成静态资源
    
    php artisan vendor:publish --provider="Stevenyangecho\UEditor\UEditorServiceProvider" --tag=config

blade引入资源
    
    <!--引入资源-->
    @include('vendor.UEditor::head');
    
    <!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain">
        这里写你的初始化内容
    </script>
    
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
            ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.    
        });
    </script>
    
开启storage资源软连接  
    
    php artisan stotage:link 
    
#安装验证码扩展
[captcha](https://github.com/mewebstudio/captcha)

    composer require --dev mews/captcha

在config/app.php add service provider

    Mews\Captcha\CaptchaServiceProvider::class
    
生成配置文件

    php artisan vendor:publish --provider="Mews\Captcha\CaptchaServiceProvider" --tag=config

#安装validate提示语言包
[laravel-lang](https://github.com/overtrue/laravel-lang)

    composer require --dev overtrue/laravel-lang

在config/app.php add service provider  and edit locale  'zh-CN',
    
    Illuminate\Translation\TranslationServiceProvider::class,
    
    locale => zh-CN
    
在resources/lang add zh-CN

    php artisan lang:publish zh-CN
    
#laravel异步队列
生产环境需要使用进程管理器 Supervisor 来确保队列处理器不会停止运行

队列存储需要的数据表

    php artisan queue:table
    php artisan migrate
    
创建任务UpdateAdminUserLoginInfo （用于后台用户登录后更新登录的信息）

    php artisan make:job UpdateAdminUserLoginInfo
      
推送任务
    
    public function handle()
    {
        //TODO
    }
    
    dispatch(new UpdateAdminUserLoginInfo());
    
启动队列 
   在配置文件开启对应的队列驱动模式
   
    // --queue      被监听的队列
    // --daemon     在后台模式运行
    // --delay      给执行失败的任务设置延时时间 (默认为零: 0)
    // --force      强制在「维护模式下」运行
    // --memory     内存限制大小，单位为 MB (默认为: 128)
    // --sleep      当没有任务处于有效状态时, 设置其进入休眠的秒数 (默认为: 3)
    // --tries      任务记录失败重试次数 (默认为: 0)
    php artisan queue:work --daemon [--queue[="..."]] [--delay[="..."]] [--force[="..."]] [--memory[="..."]] [--sleep[="..."]] [--tries[="..."]] 


#laravel事件 监听 观察者 服务
创建一个系统操作事件
    
    php artisan artisan make:event SystemOperation 
    
监听这个事件
    
    php artisan artisan make:listener SystemLogs 
    
观察者 模型的操作观察
Laravel 事先已经定义好了 10 个模型事件以供我们使用

    // creating    监听数据即将创建的事件。
    // created     监听数据创建后的事件。
    // updating    监听数据即将更新的事件。
    // updated     监听数据更新后的事件。
    // saving      监听数据即将保存的事件。
    // saved       监听数据保存后的事件。
    // deleting    监听数据即将删除的事件。
    // deleted     监听数据删除后的事件。
    // restoring   监听数据即将从软删除状态恢复的事件。
    // restored    监听数据从软删除状态恢复后的事件。
    php artisan artisan make:observer ModelObserver 
 
在app\config 新建一个配置  内容如下

        'event' => [
            'listeners' => [
                'App\Events\SystemOperation' => [
                    'App\Listeners\SystemLogs',
                ],
            ],
            'observers' => [
               \App\Model\Admin\AdminMenu::class
               ...
            ],
        ],
        
注册一个服务

    artisan make:provider SystemOperationProvuder
    
    //boot内容
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
     
    

