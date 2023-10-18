<?php

use App\Enums\V1\Market\Broker\BrokerStatus;
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
        Schema::create('brokers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('market_id')->constrained('markets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_dealing_desk')->default(false);
            $table->boolean('is_stp')->default(false);
            $table->boolean('is_ecn')->default(false);
            $table->boolean('is_market_maker')->default(false);
            $table->boolean('is_ndd')->default(false);
            $table->boolean('is_dma')->default(false);
            $table->boolean('is_prime_of_prime')->default(false);
            $table->text('country')->nullable();
            $table->json('offices')->nullable();
            $table->json('regulations')->nullable();
            $table->boolean('us_clients')->default(false);
            $table->text('account_currencies');
            $table->json('funding_methods')->nullable();
            $table->json('withdrawal_methods')->nullable();
            $table->boolean('has_swap_free')->default(false);
            $table->boolean('has_demo_account')->default(false);
            $table->boolean('has_segregated_account')->default(false);
            $table->boolean('interest_on_margin')->default(false);
            $table->boolean('has_managed_account')->default(false);
            $table->json('money_managers')->nullable();
            $table->text('phone')->nullable();
            $table->text('fax')->nullable();
            $table->text('email')->nullable();
            $table->text('languages')->nullable();
            $table->json('availability')->nullable();
            $table->boolean('has_mobile_trading')->default(true);
            $table->boolean('has_web_trading')->default(true);
            $table->boolean('has_api')->default(false);
            $table->boolean('has_socket')->default(false);
            $table->boolean('has_oco_orders')->default(false);
            $table->boolean('allow_hedge')->default(false);
            $table->boolean('has_trailing_stops')->default(true);
            $table->boolean('has_one_click_trading')->default(true);
            $table->boolean('has_bonus')->default(false);
            $table->boolean('has_contests')->default(false);
            $table->boolean('has_stocks')->default(false);
            $table->boolean('has_options')->default(false);
            $table->boolean('has_futures')->default(false);
            $table->boolean('has_indices')->default(false);
            $table->boolean('has_commodities')->default(false);
            $table->boolean('has_energies')->default(false);
            $table->boolean('has_shares')->default(false);
            $table->boolean('has_spread_betting')->default(false);
            $table->boolean('has_cfd')->default(false);
            $table->boolean('has_cryptocurrencies')->default(false);
            $table->unsignedSmallInteger('spread')->nullable();
            $table->boolean('five_decimals')->default(false);
            $table->boolean('allow_scalping')->default(true);
            $table->boolean('allow_super_scalping')->default(false);
            $table->unsignedSmallInteger('status')->default(BrokerStatus::ACTIVE);
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
        Schema::dropIfExists('brokers');
    }
};
