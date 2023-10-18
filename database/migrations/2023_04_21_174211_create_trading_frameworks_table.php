<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trading_frameworks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->foreignUuid("market_id")->nullable()->constrained("markets")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('trading_account_id')->constrained('trading_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid("risk_management_id")->nullable()->constrained("risk_managements")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('trading_plan_id')->nullable()->constrained('trading_plans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid("money_management_id")->nullable()->constrained("money_managements")->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('title')->nullable();

            $table->unsignedSmallInteger("reverse_positioning")->default(0);

            $table->unsignedInteger("trail_entry_step")->default(0);
            $table->unsignedInteger("trail_entry_stop")->default(0);

            $table->boolean("virtual_price")->default(false);

            $table->string("magic_number")->nullable();
            $table->unsignedInteger("max_slippage")->nullable();
            $table->unsignedInteger("max_spread")->nullable();

            $table->unsignedSmallInteger("position_management")->default(22000);
            $table->text("partial_close")->nullable();
            $table->unsignedSmallInteger("partial_close_calculation")->nullable(); // Points, Percentage

            $table->unsignedInteger("risk_free_step")->nullable();
            $table->unsignedSmallInteger("risk_free_calculation")->nullable(); // Points, Percentage
            $table->string("risk_free_extras")->nullable(); // Commission, Spread, Swap, All, None
            $table->timestamp("risk_free_swap_calculate")->nullable();

            $table->unsignedInteger("trail_stop_loss")->nullable();
            $table->unsignedSmallInteger("trail_stop_loss_calculation")->nullable(); // Points, Percentage
            $table->unsignedInteger("trail_stop_loss_step")->nullable();
            $table->unsignedSmallInteger("trail_stop_loss_step_calculation")->nullable(); // Points, Percentage

            $table->unsignedSmallInteger("max_anti_martingale")->nullable();
            $table->unsignedSmallInteger("consecutive_stop_hits")->nullable();
            $table->float("anti_martingale_multiplier", 5, 3)->nullable();

            $table->unsignedSmallInteger("reward_multiplier_method")->nullable();
            $table->json("reward_multiplier_setting")->nullable();

            $table->unsignedInteger("nearest_trade")->nullable();

            $table->unsignedTinyInteger("rounded_numbers_zero_digits")->nullable();
            $table->unsignedInteger("rounded_numbers_max_distance")->nullable();

            $table->string("max_daily_profit")->nullable();
            $table->unsignedSmallInteger("max_daily_profit_mode")->nullable();
            $table->unsignedSmallInteger("max_daily_profit_calculation")->nullable();

            $table->string("max_daily_loss")->nullable();
            $table->unsignedSmallInteger("max_daily_loss_mode")->nullable();
            $table->unsignedSmallInteger("max_daily_loss_calculation")->nullable();

            $table->string("equity_protector")->nullable();
            $table->unsignedSmallInteger("equity_protector_mode")->nullable();
            $table->boolean("equity_protector_stop_out")->nullable();

            $table->boolean("session_london")->default(true);
            $table->time("session_london_start")->default("07:00");
            $table->time("session_london_end")->default("15:00");
            $table->boolean("session_new_york")->default(true);
            $table->time("session_new_york_start")->default("12:00");
            $table->time("session_new_york_end")->default("20:00");
            $table->boolean("session_sydney")->default(true);
            $table->time("session_sydney_start")->default("22:00");
            $table->time("session_sydney_end")->default("06:00");
            $table->boolean("session_tokyo")->default(true);
            $table->time("session_tokyo_start")->default("23:00");
            $table->time("session_tokyo_end")->default("07:00");
            $table->boolean("session_frankfurt")->default(true);
            $table->time("session_frankfurt_start")->default("06:00");
            $table->time("session_frankfurt_end")->default("14:00");

            $table->boolean("news_trading")->default(false);
            $table->unsignedTinyInteger("news_trading_before")->nullable();
            $table->unsignedTinyInteger("news_trading_after")->nullable();
            $table->unsignedSmallInteger("news_trading_impact")->nullable();

            $table->boolean("opposite_trading")->default(false);

            $table->unsignedTinyInteger("close_trades_on_weekend")->nullable();

            $table->boolean('public')->default(false);
            $table->smallInteger('status')->default(18000);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trading_frameworks');
    }
};
