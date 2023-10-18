<?php

use App\Enums\V1\Trading\Account\MarginTypeEnum;
use App\Enums\V1\Trading\Account\StatusesEnum;
use App\Enums\V1\Trading\Account\TradeModeEnum;
use App\Models\Trader4\V1\Trading\Account;
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
        Schema::create(Account::TABLE, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->string('name')->nullable();
            $table->foreignUuid('market_id')->constrained('markets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('broker_id')->constrained('brokers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('platform_id')->constrained('platforms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('server_id')->constrained('servers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('company')->nullable();
            $table->text('identity');
            $table->text('secret')->nullable();
            $table->text('secret_read_only')->nullable();
            $table->unsignedSmallInteger('trade_mode')->default(TradeModeEnum::REAL->value);
            $table->unsignedSmallInteger('margin_type')->default(MarginTypeEnum::EXCHANGE->value);
            $table->smallInteger('order_limit')->default(200);
            $table->boolean('trade_allowed')->default(true);
            $table->boolean('hedge')->default(true);
            $table->boolean('capital_road')->default(false);
            $table->string('currency', 3)->nullable();
            $table->smallInteger('leverage')->nullable();
            $table->integer('stopout_level')->nullable();
            $table->string('balance')->nullable();
            $table->string('credit')->nullable();
            $table->string('equity')->nullable();
            $table->string('margin')->nullable();
            $table->string('free_margin')->nullable();
            $table->string('margin_level')->nullable();
            $table->smallInteger('report')->default(0);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_funded')->default(false);
            $table->unsignedSmallInteger('status')->default(StatusesEnum::Registered->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Account::TABLE);
    }
};
