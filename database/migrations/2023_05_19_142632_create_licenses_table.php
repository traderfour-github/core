<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Enums\V1\License\License\Status ;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->foreignUuid('version_id')->nullable()->constrained('versions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('key_type')->nullable();
            $table->text('private_key')->nullable();
            $table->text('public_key')->nullable();
            $table->foreignUuid('post_id')->constrained('posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('max_terminals')->nullable();
            $table->unsignedSmallInteger('max_accounts')->nullable();
            $table->text('allowed_markets')->nullable();
            $table->text('allowed_brokers')->nullable();
            $table->text('allowed_countries')->nullable();
            $table->boolean('is_real')->default(true);
            $table->unsignedBigInteger('max_balance')->nullable();
            $table->unsignedBigInteger('max_equity')->nullable();
            $table->unsignedBigInteger('max_volume')->nullable();
            $table->unsignedBigInteger('max_orders')->nullable();
            $table->unsignedBigInteger('max_symbols')->nullable();
            $table->unsignedBigInteger('max_timeframes')->nullable();
            $table->boolean('is_lifetime')->default(false);
            $table->boolean('is_trial')->default(false);
            $table->unsignedSmallInteger('status')->default(Status::Active->value);
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
        Schema::dropIfExists('licenses');
    }
};
