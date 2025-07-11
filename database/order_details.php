<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('order_details', function($table) {
    $table->id();
    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    $table->unsignedBigInteger('order_id');
    $table->unsignedBigInteger('product_id');
    $table->unsignedInteger('quantity');
    $table->decimal('price', 5,2);
});