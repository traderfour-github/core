<?php

namespace Database\Seeders;


use App\Models\Trader4\V1\FinancialEngineering\MoneyManagement;
use App\Models\Trader4\V1\FinancialEngineering\RiskManagement;
use App\Models\Trader4\V1\FinancialEngineering\TradingPlan;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Market\Server;
use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Tag;
use App\Models\Trader4\V1\Trading\Account;
use App\Models\Trader4\V1\Trading\Framework;
use App\Models\Trader4\V1\Trading\History;
use App\Models\Trader4\V1\Trading\Trade;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->callOnce([
            CategoriesSeeder::class,
            MarketsSeeder::class,
            BrokersSeeder::class,
            PlatformsSeeder::class,
        ]);

        Account::factory()->count(5)->create();
        History::factory()->count(5)->create();
        Server::factory()->count(5)->create();
        Trade::factory()->count(5)->create();
        Tag::factory()->count(5)->create();
        TradingPlan::factory()->count(5)->create();
        MoneyManagement::factory()->count(5)->create();
        Framework::factory()->count(5)->create();
        RiskManagement::factory()->count(5)->create();
        Post::factory()->count(10)->create();
        Platform::factory()->count(10)->create();
    }
}
