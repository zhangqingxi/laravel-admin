<?php

namespace App\Listeners;

use App\Events\ModelDeleteEvents;
use App\Models\Admin\AdminRecycleBin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Request;
class ModelDeleteListeners
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
     *
     * @param  ModelDeleteEvents  $event
     * @return void
     */
    public function handle(ModelDeleteEvents $event)
    {
        AdminRecycleBin::create([
            'admin_user_id' => $event->adminUserId,
            'content' => $event->content,
            'table_name' => $event->tableName,
            'table_id' => $event->tableId,
            'ip' => Request::getClientIp(),
        ]);
    }
}
