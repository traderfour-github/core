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
        Schema::create('trading_strategies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable()->index();
            $table->foreignUuid("market_id")->nullable()->constrained("markets")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('trading_account_id')->constrained('trading_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid("risk_management_id")->nullable()->constrained("risk_managements")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('trading_plan_id')->nullable()->constrained('trading_plans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid("money_management_id")->nullable()->constrained("money_managements")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->smallInteger("time_frame")->default(20000);
            $table->timestamp("exit_on_friday")->nullable();
            $table->timestamp("exit_end_of_day")->nullable();
            $table->string("minimum_stop_loss")->nullable();
            $table->string("maximum_stop_loss")->nullable();
            $table->string("minimum_target_price")->nullable();
            $table->string("maximum_target_price")->nullable();
            $table->string("maximum_spread")->nullable();
            $table->string("maximum_slippage")->nullable();
            $table->unsignedTinyInteger("entry_triggers_count")->nullable();
            $table->unsignedTinyInteger("exit_triggers_count")->nullable();
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
        Schema::dropIfExists('trading_strategies');
    }
};
