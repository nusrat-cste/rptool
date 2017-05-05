<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsStakeholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements_stakeholders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requirement_id');
            $table->integer('stackholder_id');
            $table->integer('project_id');
            $table->string('weight')->nullable();
            $table->string('business_value')->nullable();
            $table->string('reusability')->nullable();
            $table->string('effort')->nullable();
            $table->string('alternatives')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirements_stakeholders');
    }
}
