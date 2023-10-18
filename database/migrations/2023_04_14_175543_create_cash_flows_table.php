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
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('market_id')->nullable()->constrained('markets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('user_id')->nullable();
            $table->foreignUuid('trading_account_id')->nullable()->constrained('trading_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->boolean("public")->default(false);
            $table->timestamp("from")->nullable();
            $table->timestamp("till")->nullable();
            $table->unsignedSmallInteger("status")->default(30000);
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
        Schema::dropIfExists('cash_flows');
    }
};
