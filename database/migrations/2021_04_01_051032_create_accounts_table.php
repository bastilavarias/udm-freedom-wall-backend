<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("accounts", function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table
                ->string("username")
                ->unique()
                ->nullable();
            $table->string("password")->nullable();
            $table->unsignedInteger("type_id");
            $table
                ->foreign("type_id")
                ->references("id")
                ->on("account_types");
            $table->softDeletes();
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
        Schema::dropIfExists("accounts");
    }
}
