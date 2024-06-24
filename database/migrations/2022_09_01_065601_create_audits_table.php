<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('audit_type')->nullable();
            $table->string('study_office')->nullable();
            $table->string('audit_user')->nullable();
            $table->string('release_date')->nullable();
            $table->string('audit_status')->nullable();
            $table->string('report_status')->nullable();
            $table->string('report_reference')->nullable();
            $table->string('report_result')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('audits');
    }
}
