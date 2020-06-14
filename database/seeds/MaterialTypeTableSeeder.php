<?php

use Illuminate\Database\Seeder;
use App\Material_type;
use Carbon\Carbon;

class MaterialTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    //E ไฟฟ้า
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'บัลลาสต์',
            'desc' => '',
            'code' => '01',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'สตาร์ทเตอร์',
            'desc' => '',
            'code' => '02',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'เบรคเกอร์',
            'desc' => '',
            'code' => '03',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'ฟิวส์',
            'desc' => '',
            'code' => '04',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'หม้อแปลง',
            'desc' => '',
            'code' => '05',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);Material_type::insert([
            'm_g_id' => 1,
            'name' => 'หลอดไฟ',
            'desc' => '',
            'code' => '06',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'อุปกรณ์ไฟฟ้า',
            'desc' => '',
            'code' => '07',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'สายไฟ',
            'desc' => '',
            'code' => '08',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'ปลั๊ก',
            'desc' => '',
            'code' => '09',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'อุปกรณ์ปกป้องสายไฟ',
            'desc' => '',
            'code' => '10',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'อุปกรณ์ยึดสายไฟ',
            'desc' => '',
            'code' => '11',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 1,
            'name' => 'อุปกรณ์ตัดวงจร',
            'desc' => '',
            'code' => '12',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
    //W ปะปา
        Material_type::insert([
            'm_g_id' => 2,
            'name' => 'ก็อกน้ำ / วาล์วน้ำ',
            'desc' => '',
            'code' => '01',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 2,
            'name' => 'สายชำระ',
            'desc' => '',
            'code' => '02',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 2,
            'name' => 'อุปกรณ์สุขภัณฑ์',
            'desc' => '',
            'code' => '03',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 2,
            'name' => 'ชุดลูกลอย',
            'desc' => '',
            'code' => '04',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 2,
            'name' => 'อุปกรณ์ท่อ PVC',
            'desc' => '',
            'code' => '05',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 2,
            'name' => 'อุปกรณ์ตู้กดน้ำดื่ม',
            'desc' => '',
            'code' => '06',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
    //T โทรศัพท์
        Material_type::insert([
            'm_g_id' => 3,
            'name' => 'ปลั๊ก / เต้ารับ',
            'desc' => '',
            'code' => '01',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 3,
            'name' => 'สายโทรศัพท์ / สายLAN',
            'desc' => '',
            'code' => '02',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
    //B อาคาร
        Material_type::insert([
            'm_g_id' => 4,
            'name' => 'อุปกรณ์ประตู',
            'desc' => '',
            'code' => '01',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 4,
            'name' => 'อุปกรณ์อะไหล่เครื่องมือ',
            'desc' => '',
            'code' => '02',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 4,
            'name' => 'อุปกรณ์อะไหล่เครื่องมือ',
            'desc' => '',
            'code' => '03',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 4,
            'name' => 'อุปกรณ์ระบบ MATV',
            'desc' => '',
            'code' => '04',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 4,
            'name' => 'น็อต / ตะปู',
            'desc' => '',
            'code' => '05',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 4,
            'name' => 'อุปกรณ์ทาสี',
            'desc' => '',
            'code' => '06',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        Material_type::insert([
            'm_g_id' => 4,
            'name' => 'ถ่านอัลคาไลน์',
            'desc' => '',
            'code' => '07',
            'trash' => 0,
            'created_at' => Carbon::now(),
        ]);
        
    }
}
