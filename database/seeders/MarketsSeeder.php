<?php

namespace Database\Seeders;

use App\Models\Trader4\V1\Market\Market;
use Illuminate\Database\Seeder;

class MarketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markets = [
            'Capital Markets' => [
                'Stock Market',
                'Bond Market',
            ],
            'Commodity Markets' => [
                'Energy',
                'Agriculture',
                'Metals',
                'Softs',
            ],
            'Money Markets' => [],
            'Derivatives Markets' => [],
            'Future Markets' => [],
            'Forex Markets' => [],
            'Crypto Markets' => [],
            'Spot Markets' => [],
            'Interbank Markets' => [],
        ];
        foreach ($markets as $market => $subMarket) {
            $market = Market::create([
                'name' => $market,
                'slug' => strtolower(str_replace(' ', '-', $market)),
                'created_at' => now(),
            ]);
            if (is_array($subMarket) && count($subMarket) > 0) {
                foreach ($subMarket as $item) {
                    Market::create([
                        'parent_id' => $market->id,
                        'name' => $item,
                        'slug' => strtolower(str_replace(' ', '-', $item)),
                        'created_at' => now(),
                    ]);
                }
            }
        }
    }
}
