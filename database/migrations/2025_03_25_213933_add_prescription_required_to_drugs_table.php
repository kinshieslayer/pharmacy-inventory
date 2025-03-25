<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('drugs', function (Blueprint $table) {
            $table->boolean('prescription_required')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('drugs', function (Blueprint $table) {
            $table->dropColumn('prescription_required');
        });
    }
    };
