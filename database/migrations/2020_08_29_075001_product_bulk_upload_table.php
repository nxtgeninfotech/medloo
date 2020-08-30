<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductBulkUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('composition')->after('brand_id')->nullable();
            $table->string('ayurvedic_ingredients')->after('composition')->nullable();
            $table->string('prescription')->after('description')->nullable();
            $table->string('expert_advice')->after('prescription')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('composition');
            $table->dropColumn('ayurvedic_ingredients');
            $table->dropColumn('prescription');
            $table->dropColumn('expert_advice');
        });
    }
}
