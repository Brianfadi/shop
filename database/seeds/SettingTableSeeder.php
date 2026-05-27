<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            'description'=>"Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis iste natus error sit voluptatem Excepteu

                            sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspi deserunt mollit anim id est laborum. sed ut perspi.",
            'short_des'=>"Your one-stop online shop in Kenya. We offer a wide range of quality products — from electronics and fashion to home essentials — delivered fast and securely to your doorstep. Shop with confidence, pay with ease.",
            'photo'=>"image.jpg",
            'logo'=>'logo.jpg',
            'address'=>"115 Test Street, Test Country",
            'email'=>"codeastro.com",
            'phone'=>"1234567777",
        );
        DB::table('settings')->insert($data);
    }
}
