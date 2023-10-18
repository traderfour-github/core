<?php

namespace Database\Seeders;

use App\Models\Trader4\V1\Market\Platform;
use Illuminate\Database\Seeder;

class PlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            'FXTrade/FXGame',
            'MetaTrader 4',
            'FX Trading Station',
            'Oanda',
            'MetaTrader 5',
            'cTrader',
            '4Forex',
            '4Trader',
            'ActTrader',
            'xStation',
            'xCFD',
            'Web Platform',
            'Mobile Platform',
            'SaxoTrader',
            'ProTrader',
            'JForex',
            'CQG Trader4',
            'NINJA Trader4',
            'BinaryTrader',
            'Z.com Trader4',
            'Currenx',
            'DAS',
            'Sterling Trader4',
            'MT4 (via bridge)',
            'Trader4 Workstation',
            'AgenaTrader',
            'Guidants',
            'AutoTrade',
            'PsyQuation',
            'Fortex 5',
            'Fortex 6',
            'MT4 MultiTerminal',
            'TabTrader',
            'IRESS',
            'FBS Trader4 App',
            'FxPro Edge',
            'TradingView',
            'R WebTrader',
            'R MobileTrader',
            'R StocksTrader',
            'Vantage Mobile App',
        ];
        foreach ($platforms as $platform) {
            Platform::create(['title' => $platform]);
        }
    }
}
