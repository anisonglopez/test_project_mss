<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserInRole;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 100) -> create();
        User::insert([   
            'branch_id' => 1,
            'emp_id' => '1',
            'email' => 'admin',
            'email_real' =>'admin@ch7.com',
            'status' =>1,
            'email_verified_at' => now(),
            'password' => '$2y$10$D6ujsUtikmk6hVTJEuupT.Cp6GqRs87Ta4d7AINXJOyjmORkxvirK', // p@ssw0rd
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        UserInRole::insert([   
            'user_id' => 1,
            'role_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::insert([   
            'branch_id' => 1,
            'emp_id' => '2',
            'email' => 'supervior',
            'email_real' =>'supervior@ch7.com',
            'status' =>1,
            'email_verified_at' => now(),
            'password' => '$2y$10$D6ujsUtikmk6hVTJEuupT.Cp6GqRs87Ta4d7AINXJOyjmORkxvirK', // p@ssw0rd
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        UserInRole::insert([   
            'user_id' => 2,
            'role_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //
        User::insert([   
            'branch_id' => 1,
            'emp_id' => '3',
            'email' => 'user',
            'email_real' =>'user@ch7.com',
            'status' =>1,
            'email_verified_at' => now(),
            'password' => '$2y$10$D6ujsUtikmk6hVTJEuupT.Cp6GqRs87Ta4d7AINXJOyjmORkxvirK', // p@ssw0rd
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        UserInRole::insert([   
            'user_id' => 3,
            'role_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::insert([   
            'branch_id' => 1,
            'emp_id' => '4',
            'email' => 'ITBC',
            'email_real' =>'ITBC@ch7.com',
            'status' =>1,
            'email_verified_at' => now(),
            'password' => '$2y$10$D6ujsUtikmk6hVTJEuupT.Cp6GqRs87Ta4d7AINXJOyjmORkxvirK', // p@ssw0rd
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        UserInRole::insert([   
            'user_id' => 4,
            'role_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
