<?php

namespace App\Providers;

use App\Repositories\V1\FinancialEngineering\CashFlow\CashFlowRepository;
use App\Repositories\V1\FinancialEngineering\CashFlow\Financing\CashFlowFinancingRepository;
use App\Repositories\V1\FinancialEngineering\CashFlow\Financing\ICashFlowFinancingRepository;
use App\Repositories\V1\FinancialEngineering\CashFlow\ICashFlowRepository;
use App\Repositories\V1\FinancialEngineering\CashFlow\Investing\CashFlowInvestingRepository;
use App\Repositories\V1\FinancialEngineering\CashFlow\Investing\ICashFlowInvestingRepository;
use App\Repositories\V1\FinancialEngineering\CashFlow\Operating\CashFlowOperatingRepository;
use App\Repositories\V1\FinancialEngineering\CashFlow\Operating\ICashFlowOperatingRepository;
use App\Repositories\V1\FinancialEngineering\Entry\EntryRepository;
use App\Repositories\V1\FinancialEngineering\Entry\IEntryRepository;
use App\Repositories\V1\FinancialEngineering\ExitStrategy\ExitStrategyRepository;
use App\Repositories\V1\FinancialEngineering\ExitStrategy\IExitStrategyRepository;
use App\Repositories\V1\FinancialEngineering\MoneyManagement\IMoneyManagementRepository;
use App\Repositories\V1\FinancialEngineering\MoneyManagement\MoneyManagementRepository;
use App\Repositories\V1\FinancialEngineering\RiskManagement\IRiskManagementRepository;
use App\Repositories\V1\FinancialEngineering\RiskManagement\RiskManagementRepository;
use App\Repositories\V1\FinancialEngineering\TradingPlan\ITradingPlanRepository;
use App\Repositories\V1\FinancialEngineering\TradingPlan\TradingPlanRepository;
use App\Repositories\V1\FinancialEngineering\TradingStrategy\ITradingStrategyRepository;
use App\Repositories\V1\FinancialEngineering\TradingStrategy\TradingStrategyRepository;
use App\Repositories\V1\Market\Market\IMarketRepository;
use App\Repositories\V1\Market\Market\MarketRepository;
use App\Repositories\V1\My\License\License\ILicenseRepository as MyILicenseRepository;
use App\Repositories\V1\My\License\License\LicenseRepository as MyLicenseRepository;
use App\Repositories\V1\My\License\Licensable\ILicensableRepository as MyILicensableRepository;
use App\Repositories\V1\My\License\Licensable\LicensableRepository as MyLicensableRepository;
use App\Repositories\V1\My\License\Version\IVersionRepository as MyIVersionRepository;
use App\Repositories\V1\My\License\Version\VersionRepository as MyVersionRepository;
use App\Repositories\V1\My\License\Terminal\ITerminalRepository as MyITerminalRepository;
use App\Repositories\V1\My\License\Terminal\TerminalRepository as MyTerminalRepository;
use App\Repositories\V1\My\Trading\Account\AccountRepository as MyAccountRepository;
use App\Repositories\V1\My\Trading\Account\IAccountRepository as MyIAccountRepository;
use App\Repositories\V1\My\Trading\Framework\FrameworkRepository as MyFrameworkRepository;
use App\Repositories\V1\My\Trading\Framework\IFrameworkRepository as MyIFrameworkRepository;
use App\Repositories\V1\Post\IPostRepository;
use App\Repositories\V1\Post\PostRepository;
use App\Repositories\V1\Trading\Account\AccountRepository;
use App\Repositories\V1\Trading\Account\IAccountRepository;
use App\Repositories\V1\Trading\Framework\FrameworkRepository;
use App\Repositories\V1\Trading\Framework\IFrameworkRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(IMarketRepository::class, MarketRepository::class);
        app()->bind(ICashFlowRepository::class,CashFlowRepository::class);
        app()->bind(IMoneyManagementRepository::class,MoneyManagementRepository::class);
        app()->bind(ICashFlowInvestingRepository::class,CashFlowInvestingRepository::class);
        app()->bind(ICashFlowOperatingRepository::class,CashFlowOperatingRepository::class);
        app()->bind(ICashFlowFinancingRepository::class,CashFlowFinancingRepository::class);
        app()->bind(IRiskManagementRepository::class, RiskManagementRepository::class);
        app()->bind(ITradingPlanRepository::class, TradingPlanRepository::class);
        app()->bind(IEntryRepository::class, EntryRepository::class);
        app()->bind(IExitStrategyRepository::class, ExitStrategyRepository::class);
        app()->bind(ITradingStrategyRepository::class, TradingStrategyRepository::class);
        app()->bind(IPostRepository::class, PostRepository::class);

        app()->bind(MyILicenseRepository::class, MyLicenseRepository::class);
        app()->bind(MyIVersionRepository::class, MyVersionRepository::class);
        app()->bind(MyITerminalRepository::class, MyTerminalRepository::class);
        app()->bind(MyILicensableRepository::class, MyLicensableRepository::class);

        app()->bind(IAccountRepository::class , AccountRepository::class);
        app()->bind(MyIAccountRepository::class , MyAccountRepository::class);

        app()->bind(IFrameworkRepository::class, FrameworkRepository::class);
        app()->bind(MyIFrameworkRepository::class , MyFrameworkRepository::class);


        // Estimated reading time
        Str::macro('readDuration', function(...$text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int)max(1, $minutesToRead);
        });
    }
}
