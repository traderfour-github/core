<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Enums\V1\License\Version\Status ;
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
        Schema::create('versions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->foreignUuid('post_id')->constrained('posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('platform_id')->constrained('platforms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->string('signature')->unique()->index();
            $table->string('file')->nullable();
            $table->string('user_manual')->nullable();
            $table->text('change_log')->nullable();
            $table->integer('update_type')->default(1103);
            $table->tinyInteger('major');
            $table->tinyInteger('minor');
            $table->tinyInteger('patch');
            $table->boolean('force')->default(false);
            $table->unsignedBigInteger('downloads')->default(0);
            $table->unsignedBigInteger('requests')->default(0);
            $table->integer('status')->default(Status::Active->value);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('last_update')->nullable();
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
        Schema::dropIfExists('versions');
    }
};
