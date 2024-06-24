<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesFieldToSubventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subventions', function (Blueprint $table) {
            $table->string('file')->nullable();
            $table->timestamp('Consentement_reçu_le')->nullable();
            $table->timestamp('Consentement_répondu_le')->nullable();
            $table->integer('Consentement_répondu_par')->nullable();
            $table->string('Statut_subvention')->nullable();
            $table->timestamp('Date_forclusion')->nullable();
            $table->text('Motif_rejet')->nullable();
            $table->string('Notification_de_rejet')->nullable();
            $table->string('Statut_subvention_yes_file')->nullable();
            $table->string('Statut_subvention_no_file')->nullable(); 
            $table->integer('Statut_subvention_yes_mail_status')->default(0);
            $table->integer('Statut_subvention_no_mail_status')->default(0);
            $table->integer('Statut_subvention_yes_2_month_before_mail_status')->default(0);
            $table->integer('Statut_subvention_yes_1_month_before_mail_status')->default(0);
            $table->integer('Statut_subvention_yes_15_days_before_mail_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subventions', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropColumn('Consentement_reçu_le');
            $table->dropColumn('Consentement_répondu_le');
            $table->dropColumn('Consentement_répondu_par');
            $table->dropColumn('Statut_subvention');
            $table->dropColumn('Date_forclusion');
            $table->dropColumn('Motif_rejet');
            $table->dropColumn('Notification_de_rejet');
            $table->dropColumn('Statut_subvention_yes_file');
            $table->dropColumn('Statut_subvention_no_file');
            $table->dropColumn('Statut_subvention_yes_mail_status');
            $table->dropColumn('Statut_subvention_no_mail_status');
            $table->dropColumn('Statut_subvention_yes_2_month_before_mail_status');
            $table->dropColumn('Statut_subvention_yes_1_month_before_mail_status');
            $table->dropColumn('Statut_subvention_yes_15_days_before_mail_status');
        });
    }
}
