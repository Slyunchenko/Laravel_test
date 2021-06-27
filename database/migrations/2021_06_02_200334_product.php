<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', static function(Blueprint $table) {
            $table->integer('product_id', true, true);
            $table->string('product_name');
            $table->string('product_description');
            $table->double('product_price');
            $table->integer('category_id')->unsigned();
            $table->date('created_at');
            $table->date('updated_at');
            $table->foreign('category_id')->references('category_id')->on('product_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
