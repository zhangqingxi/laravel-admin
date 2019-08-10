<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Auth;
class ModelOperationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title,
            $content,
            $adminUserId,
            $tableName,
            $tableId;
    /**
     * Create a new event instance.
     *
     * SystemLogs constructor.
     * @param string $title
     * @param string $content
     * @param int $adminUserId
     * @param int $tableId
     * @param string $tableName
     *
     * @return void
     */
    public function __construct(string $title, string $content, int $adminUserId, string $tableName, int $tableId)
    {

        $this->title = $title;

        $this->content = $content;

        $this->tableName = $tableName;

        $this->tableId = $tableId;

        $this->adminUserId = $adminUserId ?: Auth::guard('admin')->id();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }


}
