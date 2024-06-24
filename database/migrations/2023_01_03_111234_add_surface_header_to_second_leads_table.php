<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSurfaceHeaderToSecondLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('second_leads', function (Blueprint $table) {
            $table->string('Surface_à_chauffer')->nullable();
            $table->string('Merci_de_précisez')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('second_leads', function (Blueprint $table) {
            $table->dropColumn('Surface_à_chauffer');
            $table->dropColumn('Merci_de_précisez');
        });
    }
}
