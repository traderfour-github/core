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
        Schema::create('terminals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->uuid('assigned_by')->nullable();
            $table->foreignUuid('trading_account_id')->nullable()->constrained('trading_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('bulut_id')->nullable()->index();
            $table->ipAddress('ip_address')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('name')->nullable();
            $table->string('version')->nullable();
            $table->string('build')->nullable();
            $table->string('path')->nullable();
            $table->string('language')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->timestamp('installed_at')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->unsignedSmallInteger('status')->default(30300);
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
        Schema::dropIfExists('terminals');
    }
};
