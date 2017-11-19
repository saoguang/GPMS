<?php

use Illuminate\Database\Seeder;

class UsersBasicInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_users_basic_info')->insert([
            'user_job_id' => '14162400891',
            'email' => 'saoguang@vip.qq.com',
            'user_name' => 'sao',
            'password' => bcrypt('423719'),
            'role_id' => 1,
        ]);
    }
}
