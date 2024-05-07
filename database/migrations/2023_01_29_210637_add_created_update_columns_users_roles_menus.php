<?php

use App\Utils\AddCreatedAndUpdatedByColumns;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends AddCreatedAndUpdatedByColumns {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = ['users', 'roles', 'menus'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $this->addAuditFields($table);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
