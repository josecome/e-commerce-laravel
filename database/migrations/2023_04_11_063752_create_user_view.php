<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::statement($this->dropView());
    }
    private function createView(): string
    {
        return
            "CREATE OR REPLACE VIEW view_users AS SELECT *, (YEAR(NOW()) - YEAR(date_of_birth)) AS age FROM users"
        ;
    }
};
