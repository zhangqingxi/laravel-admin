<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $sql = (require_once __DIR__.'/../sql/init.php') ?? [];

        foreach ($sql as $key => $value)
        {

            switch ($key){

                case "admin_menus":

                    \App\Models\Admin\AdminMenu::truncate();

                    \App\Models\Admin\AdminMenu::insert($value);

                    break;

                case "admin_users":

                    \App\Models\Admin\AdminUser::truncate();

                    \App\Models\Admin\AdminUser::insert($value);

                    break;

            }

        }

    }
}
