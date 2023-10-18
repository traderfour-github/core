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
        Schema::create('server_proxies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->uuid('user_id')->nullable()->index();
            $table->foreignUuid('server_id')->constrained('servers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->ipAddress('ip')->nullable();
            $table->unsignedSmallInteger('port')->nullable();
            $table->unsignedSmallInteger('type')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_official')->default(false);
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('priority')->nullable();
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
        Schema::dropIfExists('server_proxies');
    }
};
