<?php

use App\Enums\V1\Post\Comment;
use App\Enums\V1\Post\Status;
use App\Enums\V1\Post\Type;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->string('title', 225);
            $table->string('slogan', 225)->nullable()->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->unsignedBigInteger('download_count')->default(0);
            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedBigInteger('purchase_count')->default(0);
            $table->unsignedBigInteger('comment_count')->default(0);
            $table->unsignedDecimal('popularity_score')->default(0);
            $table->unsignedSmallInteger('comments')->default(Comment::PUBLIC->value);
            $table->unsignedSmallInteger('type')->default(Type::ARTICLE->value);
            $table->boolean('is_public')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('for_kids')->default(false);
            $table->timestamp('last_update')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedSmallInteger('status')->default(Status::Pending->value);
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
        Schema::dropIfExists('posts');
    }
};
