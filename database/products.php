<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('products', function($table) {
    $table->id();
    $table->string('name', 30);
    $table->unsignedBigInteger('category_id');
    $table->decimal('price', 5,2);

    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
});