<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('mon')->default(FALSE);
            $table->boolean('tue')->default(FALSE);
            $table->boolean('wed')->default(FALSE);
            $table->boolean('thu')->default(FALSE);
            $table->boolean('fri')->default(FALSE);
            $table->boolean('sat')->default(FALSE);
            $table->boolean('sun')->default(FALSE);
            $table->integer('internal');
            $table->integer('external');
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
        Schema::dropIfExists('groups');
    }
}
