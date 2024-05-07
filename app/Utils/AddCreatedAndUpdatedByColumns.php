<?php

namespace App\Utils;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

abstract class AddCreatedAndUpdatedByColumns extends Migration
{
    public function addAuditFields(Blueprint $table)
    {
        $table->unsignedBigInteger('created_by')->nullable();
        $table->foreign('created_by')->references('id')->on('users');
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->foreign('updated_by')->references('id')->on('users');
        $table->unsignedBigInteger('deleted_by')->nullable();
        $table->foreign('deleted_by')->references('id')->on('users');
    }
}
