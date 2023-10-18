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
        Schema::create('risk_managements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // @TODO: add trading_account_id to pivot table
            $table->uuid('user_id')->nullable()->index();
            $table->string('title')->nullable();
            $table->string("max_risk")->nullable();
            $table->unsignedSmallInteger('max_risk_mode')->nullable();
            $table->unsignedSmallInteger('max_risk_calculation')->nullable();
            $table->boolean('is_max_risk_relative')->default(false);
            $table->string('max_daily_risk')->nullable();
            $table->unsignedSmallInteger('max_daily_risk_mode')->nullable();
            $table->unsignedSmallInteger('max_daily_risk_calculation')->nullable();
            $table->string('max_daily_profit')->nullable();
            $table->unsignedSmallInteger('max_daily_profit_mode')->nullable();
            $table->unsignedSmallInteger('max_daily_profit_calculation')->nullable();
            $table->string('risk_per_chart')->nullable();
            $table->unsignedSmallInteger('risk_per_chart_mode')->nullable();
            $table->unsignedSmallInteger('risk_per_chart_calculation')->nullable();
            $table->string('risk_per_trade')->nullable();
            $table->unsignedSmallInteger('risk_per_trade_mode')->nullable();
            $table->unsignedSmallInteger('risk_per_trade_calculation')->nullable();
            $table->unsignedTinyInteger('risk_reward_ratio')->nullable();
            $table->json('positive_correlation')->nullable();
            $table->json('negative_correlation')->nullable();
            $table->json('low_correlation')->nullable();
            $table->boolean('hedge')->default(false);
            $table->boolean('required_stop_loss')->default(false);
            $table->boolean('required_target_profit')->default(false);
            $table->json('news_trading')->nullable();
            $table->json('allowed_instruments')->nullable();
            $table->json('allowed_times')->nullable();
            $table->json('allowed_order_types')->nullable();
            $table->boolean("is_public")->default(false);
            $table->unsignedSmallInteger('status')->default(1);
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
        Schema::dropIfExists('risk_managements');
    }
};
