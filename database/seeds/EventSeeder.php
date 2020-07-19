<?php

use App\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10; $i++){
            $starts = RAND(4,8);
            $end = RAND(4,8);

            if($starts > $end)
                $end = $starts + 1;

            Event::create([
                'name'          => "Event {$i}",
                'description'   => 'Event is starting soon',
                'category_id'   => RAND(1,5),
                'starts_at'     => Carbon::create('2020', $starts, RAND(1,30)),
                'ends_at'       => Carbon::create('2020', $end, RAND(1,30)),
                'user_id'       => 1
            ]);
        }

    }
}
