<?php

use Illuminate\Database\Seeder;

class EmailContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\Emailcontent::create([
            'key' => 'asset_notify',
            'value' => 'null',
        ]);
        
        $user = App\Emailcontent::create([
            'key' => 'asset_utilize',
            'value' => 'null',
        ]);
        
        $user = App\Emailcontent::create([
            'key' => 'documentation',
            'value' => 'null',
        ]);
    }
}
