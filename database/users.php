<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function($table) {
    $table->id();
    $table->string('first_name', 30);
    $table->string('last_name', 30);
    $table->unsignedBigInteger('role_id');
    $table->string('city', 30)->nullable();
    $table->string('address')->nullable();
    $table->string('phone', 30)->nullable();
    $table->string('password')->nullable();
    $table->string('username', 10)->nullable()->unique();
    $table->string('code', 8)->nullable()->unique();

    $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');

    $table->timestamps();
});