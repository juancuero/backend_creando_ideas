<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique()->comment('Name menu');
            $table->string('description', 200)->nullable()->comment('It is describes the objective of the route');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('If the item is a submenu, it will have a parent id');
            $table->string('route', 255)->nullable()->comment('Path menu, path does not need "/" at startup');
            $table->string('route_name', 100)->nullable()->comment('Path name');
            $table->string('icono', 100)->nullable()->comment('Image representing the item');
            $table->boolean('draw')->default(1)->comment('If it is enabled to be seen');
            $table->double('order', 8, 2)->nullable()->unique()->comment('Order display items');
            $table->boolean('private')->default(true)->comment('Describes whether the path is private access.');
            $table->boolean('link_external')->default(0)->nullable()->comment('If it is enabled is link external');
            $table->foreign('parent_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('menus');
    }
};
