<?php

use Illuminate\Database\Seeder;

class SitemoduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		 $user = App\Modules::create([
            'modules_id' => '1',
            'module_title' => 'Site Modules',
            'module_description' => 'Site Modules',
            'module_url' => 'site_modules',
            'module_primary_key' => 'modules_id',
            'module_table' => 'Modules',
            'module_alert_account' => 'somto.anowai@c-ileasing.com',
            'module_value' => '1',
            'module_status' => '1',
            'module_add_items' => 'text-module_title, text-module_table, text-module_primary_key, textarea-module_add_items, textarea-module_display_items, textarea-module_description, text-module_url, email-module_alert_account, number-module_value, modules_unique_item, on_off-module_status',
            'module_display_items' => 'modules_id, module_title, module_table, module_description, module_status',
            'modules_unique_item' => 'module_title, module_url'
        ]);
		
    }
}
