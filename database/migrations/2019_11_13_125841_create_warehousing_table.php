<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('warehousing')) {
            Schema::create('warehousing', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->decimal('price');
                $table->integer('quantity');
                $table->decimal('total');
                $table->unsignedBigInteger('products_id');
                $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
                $table->unsignedBigInteger('supplier_id');
                $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehousing');
    }
}
