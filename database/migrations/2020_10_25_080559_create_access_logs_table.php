<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('redirect_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('ip')->nullable()->comment('IP');
            $table->string('ua')->nullable()->comment('UserAgent');
            $table->timestamp('created_at')->default(\DB::raw('current_timestamp'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_logs', function (Blueprint $table) {
            $table->dropForeign(['redirect_id']);
        });
        Schema::dropIfExists('access_logs');
    }
}
