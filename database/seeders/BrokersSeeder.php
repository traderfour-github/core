<?php

namespace Database\Seeders;

use App\Models\Trader4\V1\Market\Broker;
use App\Models\Trader4\V1\Market\Market;
use Illuminate\Database\Seeder;

class BrokersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brokers = [
            'Exness',
            'FXCM' ,
            'IG' ,
            'Robo Forex' ,
            'TMGM' ,
            'Plus500'
        ];

        foreach (Market::all() as $market){
            Broker::create([
                'name'               => array_rand($brokers),
                'market_id'          => $market->id,
                'account_currencies' => array_rand(['USD' , 'GPB' , 'EUR']),
            ]);
        }
    }
}
