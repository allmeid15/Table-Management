<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('invoices', function($table) {
    $table->id();

    $table->unsignedBigInteger('order_id')->nullable();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->decimal('price', 5,2);

    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
});