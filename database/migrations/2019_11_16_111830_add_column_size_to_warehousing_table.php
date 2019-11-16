<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSizeToWarehousingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('warehousing')) {
            Schema::table('warehousing', function (Blueprint $table) {
                if (!Schema::hasColumn('warehousing', 'size')) {
                    $table->integer('size');
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
        Schema::table('warehousing', function (Blueprint $table) {
            //
        });
    }
}
