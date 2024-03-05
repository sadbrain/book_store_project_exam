<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('image_url', 255)->nullable()->default("https://placehold.co/500x600/png");
            $table->text('description')->nullable();
            $table->string('isbn', 255)->nullable();
            $table->string('author', 255)->nullable();
            $table->unsignedDouble('list_price',12,2)->default(0.0);
            $table->unsignedDouble('price',12,2)->default(0.0);
            $table->unsignedDouble('price50',12,2)->default(0.0);
            $table->unsignedDouble('price100',12,2)->default(0.0);
            $table->unsignedTinyInteger('category_id')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('set null')
                    ->onUpdate('CASCADE');
            /// Hoặc 'CASCADE' tùy thuộc vào yêu cầu của bạn
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
