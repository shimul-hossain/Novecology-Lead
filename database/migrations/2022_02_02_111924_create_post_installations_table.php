<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_installations', function (Blueprint $table) {
            $table->id();
            $table->date('quality_control_date2')->nullable();
            $table->string('operator2')->nullable();
            $table->string('client_name2')->nullable();
            $table->string('postal_code2')->nullable();
            $table->date('installed_date')->nullable();
            $table->string('project2')->nullable();
            $table->string('installer')->nullable();
            $table->string('other_installer')->nullable();
            $table->string('commercial2')->nullable();
            $table->string('other_commercial')->nullable();
            $table->string('satisfied')->nullable();
            $table->string('equipment_installed')->nullable();
            $table->string('evaluation')->nullable();
            $table->string('score')->nullable();
            $table->string('recommend')->nullable();
            $table->string('mpr_contact')->nullable();
            $table->string('identity_validation')->nullable();
            $table->string('file_validation')->nullable();
            $table->string('address_validation')->nullable();
            $table->string('company_validation')->nullable();
            $table->string('other_validation')->nullable();
            $table->string('work_validation')->nullable();
            $table->string('proxy_validation')->nullable();
            $table->string('validation_comment')->nullable();
            $table->string('amount_validation')->nullable();
            $table->string('expense_validation')->nullable();
            $table->string('client_respond')->nullable();
            $table->string('paid_consent')->nullable();
            $table->string('customer_call')->nullable();
            $table->string('receive_invoice')->nullable();
            $table->string('review')->nullable();
            $table->string('carry_out')->nullable();
            $table->string('action_logement')->nullable();
            $table->string('contact_us')->nullable();
            $table->string('contact_soon')->nullable();
            $table->string('release_fund')->nullable();
            $table->string('observations')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('post_installations');
    }
}
