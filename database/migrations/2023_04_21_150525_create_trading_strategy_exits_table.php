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
        Schema::create('trading_strategy_exits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trading_strategy_id')->constrained('trading_strategies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('user_id')->nullable()->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('order_type')->default(16000);
            $table->smallInteger('source')->default(20000);
            $table->smallInteger('source_type')->default(19000);
            $table->json("source_settings")->nullable();
            $table->smallInteger("comparison")->default(21000);
            $table->string("trigger")->nullable();
            $table->boolean("is_required")->default(false);
            $table->smallInteger("time_frame")->default(15000);
            $table->string("data_feed")->nullable();
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
        Schema::dropIfExists('trading_strategy_exits');
    }
};
