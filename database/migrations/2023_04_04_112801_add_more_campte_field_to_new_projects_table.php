<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreCampteFieldToNewProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->text('Compte_Email_de_récupération_email')->nullable();
            $table->text('Compte_Email_de_récupération_Mots_de_passe')->nullable();
            $table->text('Compte_Email_de_récupération_crée_le')->nullable();
            $table->text('Compte_Email_de_récupération_crée_par')->nullable();
            $table->text('Téléphone_de_récupération')->nullable();
            $table->text('Téléphone_de_récupération_Téléphone')->nullable();
            $table->text('Email_de_transfert')->nullable();
            $table->text('Email_de_transfert_Email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_projects', function (Blueprint $table) {
            $table->dropColumn('Compte_Email_de_récupération_email');
            $table->dropColumn('Compte_Email_de_récupération_Mots_de_passe');
            $table->dropColumn('Compte_Email_de_récupération_crée_le');
            $table->dropColumn('Compte_Email_de_récupération_crée_par');
            $table->dropColumn('Téléphone_de_récupération');
            $table->dropColumn('Téléphone_de_récupération_Téléphone');
            $table->dropColumn('Email_de_transfert');
            $table->dropColumn('Email_de_transfert_Email');
        });
    }
}
