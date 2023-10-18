<?php

use App\Enums\V1\Market\Server\ServerIPType;
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
        Schema::create('servers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->uuid('user_id')->nullable()->index();
            $table->foreignUuid('market_id')->constrained('markets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('broker_id')->constrained('brokers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('platform_id')->constrained('platforms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('address'); // IP or Domain
            $table->unsignedSmallInteger('ip_type')->default(ServerIPType::IPV4);
            $table->unsignedSmallInteger('port');
            $table->boolean('is_official')->default(false);
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('status')->default(16500);
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
        Schema::dropIfExists('servers');
    }
};
