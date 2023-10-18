<?php

use App\Enums\V1\Market\Market\MarketStatus;
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
        Schema::create('markets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('cover')->nullable();
            $table->smallInteger('status')->default(MarketStatus::ACTIVE);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('markets', function (Blueprint $table) {
            $table->foreignUuid('parent_id')->nullable()->constrained('markets')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('markets');
    }
};
