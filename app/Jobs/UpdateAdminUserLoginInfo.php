<?php

namespace App\Jobs;

use App\Models\Admin\AdminUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateAdminUserLoginInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $admin_user_id , $ip;

    /**
     * Create a new job instance.
     * @param int $admin_user_id
     * @param string $loginIp
     * @return void
     */
    public function __construct(int $admin_user_id, string $loginIp)
    {

        $this->admin_user_id = $admin_user_id;

        $this->ip = $loginIp;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //更新用户登录状态
        $adminUser = AdminUser::find($this->admin_user_id);

        $adminUser->last_login_ip = $this->ip;

        $adminUser->last_login_time = time();

        $adminUser->login_times ++;

        $adminUser->save();

    }

}