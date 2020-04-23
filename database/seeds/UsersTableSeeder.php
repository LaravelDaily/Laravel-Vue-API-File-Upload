<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$FCDg32a2Fh0xiJIWjVTFIe4ZXjv6JkwFAZSNJ3GXb7J6CWko8w/Bq',
                'remember_token' => null,
            ],
        ];

        User::insert($users);

    }
}
