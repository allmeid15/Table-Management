<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('tables', function($table) {
    $table->id();
    $table->string('name', 30);
    $table->unsignedBigInteger('user_id')->nullable();
    $table->unsignedBigInteger('order_id')->nullable();
    $table->enum('status', ['available', 'occupied', 'reserved'])->default('available');

    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
});