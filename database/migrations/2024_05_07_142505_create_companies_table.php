<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Utils\AddCreatedAndUpdatedByColumns;

return new class extends AddCreatedAndUpdatedByColumns
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
             $table->string('name')->unique();
             $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('logo')->nullable();
            $table->string('website')->nullable();
            $this->addAuditFields($table);
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
        Schema::dropIfExists('companies');
    }
};
