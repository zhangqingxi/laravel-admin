<?php

namespace App\Listeners;

use App\Events\ModelOperationEvents;
use App\Models\Admin\AdminSystemLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Request;

class ModelOperationListeners
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param ModelOperationEvents $event
     * @return void
     */
    public function handle(ModelOperationEvents $event)
    {

        AdminSystemLog::create([
            'admin_user_id' => $event->adminUserId,
            'title' => $event->title,
            'content' => $event->content,
            'table_name' => $event->tableName,
            'table_id' => $event->tableId,
            'route' => Request::getRequestUri(),
            'method' => Request::getMethod(),
            'ip' => Request::getClientIp(),
        ]);
    }
}
