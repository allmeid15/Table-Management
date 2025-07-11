<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('table_user', function($table) {
    $table->unsignedBigInteger('table_id');
    $table->unsignedBigInteger('user_id');

    $table->timestamps();

    $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});