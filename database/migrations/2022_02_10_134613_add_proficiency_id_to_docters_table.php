<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProficiencyIdToDoctersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('docters', function (Blueprint $table) {
            $table->foreignId('proficiency_id')
                ->after('image')
                ->references('id')
                ->on('proficiencies')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docters', function (Blueprint $table) {
            $table->dropForeign('docters_proficiency_id_foreign');
            $table->dropColumn('proficiency_id)');
        });
    }
}
