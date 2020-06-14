<?php

use Illuminate\Database\Seeder;
use App\Jobstatus;
use Carbon\Carbon;
class JobstatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jobstatus::insert([
            'name' => 'เปิดงาน',
            'desc' => '',
            'code' => 'OPEN',
            'trash' =>0,
            'created_at' => Carbon::now(),
        ]);
        Jobstatus::insert([
            'name' => 'รอเบิกของ',
            'desc' => '',
            'code' => 'WAITING_OUT',
            'trash' =>0,
            'created_at' => Carbon::now(),
        ]);
        Jobstatus::insert([
            'name' => 'รอช่างภายนอกเข้าซ่อม',
            'desc' => '',
            'code' => 'WAITING_VENDOR',
            'trash' =>0,
            'created_at' => Carbon::now(),
        ]);
        Jobstatus::insert([
            'name' => 'ยังไม่คืนของ',
            'desc' => '',
            'code' => 'WAITING_IN',
            'trash' =>0,
            'created_at' => Carbon::now(),
        ]);
        Jobstatus::insert([
            'name' => 'จบงาน',
            'desc' => '',
            'code' => 'CLOSE',
            'trash' =>0,
            'created_at' => Carbon::now(),
        ]);
    }
}
