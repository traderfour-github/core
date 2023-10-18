<?php

use App\Enums\V1\Market\Platform\Status;
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
        Schema::create('platforms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('market_id')->nullable()->constrained('markets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('broker_id')->nullable()->constrained('brokers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->string('cover')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->text('url')->nullable();
            $table->text('email')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_of_use')->nullable();
            $table->longText('api_documentation')->nullable();
            $table->text('address')->nullable();
            $table->json('permissions')->nullable();
            $table->json('oss')->nullable();
            $table->unsignedSmallInteger('status')->default(Status::ACTIVE);
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
        Schema::dropIfExists('platforms');
    }
};
