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
        Schema::create('cash_flow_investing', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cash_flow_id')->constrained('cash_flows')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("title")->nullable();
            $table->bigInteger("amount")->nullable();
            $table->timestamp("from")->nullable();
            $table->timestamp("till")->nullable();
            $table->nullableUlidMorphs("source");
            $table->unsignedSmallInteger("status")->default(30000);
            $table->boolean("is_public")->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table("cash_flow_investing", function (Blueprint $table){
            $table->foreignUuid("parent_id")->nullable()->constrained("cash_flow_investing")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_flow_investing');
    }
};
