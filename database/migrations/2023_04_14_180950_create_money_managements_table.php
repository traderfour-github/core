<?php

use App\Enums\V1\FinancialEngineering\MoneyManagement;
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
        Schema::create('money_managements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // @TODO: add trading_account_id to pivot table
            $table->foreignUuid("instrument_id")->nullable()->constrained("instruments")->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('user_id')->index();
            $table->string('title')->nullable();
            $table->string('position_size')->nullable();
            $table->smallInteger('position_size_mode')->nullable(); //, multiplier as add / ratio / fixed / relative
            $table->smallInteger('position_size_calculation')->nullable();
            $table->unsignedInteger("maximum_size")->nullable();
            $table->unsignedInteger("minimum_size")->nullable();
            $table->unsignedSmallInteger('status')->default(MoneyManagement::STATUS_ACTIVE->value);
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
        Schema::dropIfExists('money_managements');
    }
};
