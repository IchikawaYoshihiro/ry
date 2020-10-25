<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('rand')->comment('乱数');
            $table->string('original_url')->comment('オリジナルのURL');
            $table->timestamp('created_at')->default(\DB::raw('current_timestamp'));
            $table->timestamp('updated_at')->default(\DB::raw('current_timestamp on update current_timestamp'));

            $table->unique(['id', 'rand']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('redirects', function (Blueprint $table) {
            $table->dropUnique(['id', 'rand']);
        });
        Schema::dropIfExists('redirects');
    }
}
