<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('orders', function($table) {
    $table->id();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->unsignedBigInteger('table_id')->nullable();
    $table->enum('status',['open', 'closed'])->default('open');

    
    $table->timestamps();
});