<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnApprovedToWarehousingTable extends Migration
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
                if (!Schema::hasColumn('warehousing', 'approved')) {
                    $table->boolean('approved')->default(0);
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
