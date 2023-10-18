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
        Schema::create('licensables', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->uuid('assigned_by')->nullable();
            $table->foreignUuid('trading_account_id')->nullable()->constrained('trading_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('post_id')->nullable()->constrained('posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('license_id')->constrained('licenses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('version_id')->nullable()->constrained('versions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('terminal_id')->nullable()->constrained('terminals')->cascadeOnUpdate()->cascadeOnDelete();
            $table->nullableUuidMorphs('licensable');
            $table->string('token_id')->unique()->index();
            $table->string('token_secret')->unique()->index();
            $table->unsignedSmallInteger('key_type')->nullable();
            $table->text('private_key')->nullable();
            $table->text('public_key')->nullable();
            $table->json('setting')->nullable();
            $table->timestamp('installed_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('deactivated_at')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('resumed_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->unsignedSmallInteger('status')->default(30100);
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
        Schema::dropIfExists('licensables');
    }
};
