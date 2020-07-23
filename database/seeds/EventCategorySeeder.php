<?php

use App\EventCategory;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Default Event','Football','Golf','Horse','Basketball','Hockey'] as $cat)
            EventCategory::create(['name' => $cat, 'user_id' => 1]);
    }
}
