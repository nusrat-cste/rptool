<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            //
            $table->increments('requirements_id');
            $table->string('requirements_name');
            $table->text('requirements_info')->nullable();
            $table->timestamps();
        });
        Schema::table('requirements', function (Blueprint $table) {
                 $table->renameColumn('requirements_info', 'requirement_info');
                    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                Schema::dropIfExists('requirements');
    }
}


