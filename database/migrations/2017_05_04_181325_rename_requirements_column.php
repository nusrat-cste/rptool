<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameRequirementsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('requirements', function($t) {
                        $t->renameColumn('requirements_id', 'requirement_id');
                        $t->renameColumn('requirements_name', 'requirement_name');
                        $t->renameColumn('requirements_info', 'requirement_info');
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
         $t->renameColumn('requirement_id', 'requirements_id');
                        $t->renameColumn('requirement_name', 'requirements_name');
                        $t->renameColumn('requirement_info', 'requirements_info');
    }
}
