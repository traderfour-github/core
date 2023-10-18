<?php

use App\Enums\V1\Market\Instrument\InstrumentCalculationMode;
use App\Enums\V1\Market\Instrument\InstrumentChartMode;
use App\Enums\V1\Market\Instrument\InstrumentIndustry;
use App\Enums\V1\Market\Instrument\InstrumentSector;
use App\Enums\V1\Market\Instrument\InstrumentStatus;
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
        Schema::create('instruments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();

            $table->foreignUuid('broker_id')->constrained('brokers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('platform_id')->constrained('platforms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('server_id')->constrained('servers')->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedSmallInteger('sector')->default(InstrumentSector::UNDEFINED);
            $table->unsignedSmallInteger('industry')->default(InstrumentIndustry::UNDEFINED);
            $table->unsignedTinyInteger('digits')->default(2);
            $table->unsignedSmallInteger('contract_size');
            $table->unsignedSmallInteger('spread');
            $table->unsignedSmallInteger('stops_level');
            $table->string('margin_currency', 3)->default('USD');
            $table->string('profit_currency', 3)->default('USD');
            $table->unsignedSmallInteger('calculation_mode')->default(InstrumentCalculationMode::FOREX);
            $table->unsignedDecimal('tick_size', 4)->default(0);
            $table->unsignedSmallInteger('tick_value')->default(0);
            $table->unsignedSmallInteger('chart_mode')->default(InstrumentChartMode::BID_PRICE);
            $table->json('margin_rate')->nullable();
            $table->json('swap_rate')->nullable();
            $table->json('sessions')->nullable();

            $table->unsignedSmallInteger('max_leverage')->nullable(); // 1-3000
            $table->unsignedDecimal('min_lot_size', 5)->nullable();
            $table->unsignedDecimal('max_lot_size', 5)->nullable();
            $table->unsignedDecimal('commission', 5)->nullable();
            $table->string('commission_calculation_mode')->nullable(); // fixed / percentage / us_dollar

            $table->unsignedSmallInteger('status')->default(InstrumentStatus::ACTIVE);
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
        Schema::dropIfExists('instruments');
    }
};
