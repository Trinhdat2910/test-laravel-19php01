<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeWarehousingIdAndOrderIdOnTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('transaction')) {
            Schema::table('transaction', function (Blueprint $table) {
                if (Schema::hasColumn('transaction', 'warehousing_id', 'order_id')) {
                    $table->unsignedBigInteger('warehousing_id')->nullable()->change();
                    $table->unsignedBigInteger('order_id')->nullable()->change();
                }
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
        //
    }
}
