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
        Schema::create('trading_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trading_account_id')->constrained('trading_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('user_id')->nullable()->index();
            $table->foreignUuid("market_id")->nullable()->constrained("markets")->cascadeOnUpdate()->cascadeOnDelete();
            $table->text("instruments")->nullable();
            $table->timestamp("daily_start")->nullable();
            $table->timestamp("daily_finish")->nullable();
            $table->boolean("daily_finish_exit")->default(true);
            $table->bigInteger("max_daily_trades")->default(0);
            $table->boolean("public")->default(false);
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
        Schema::dropIfExists('trading_plans');
    }
};
