<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->table('orders', function($table) {
    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    $table->foreign('table_id')->references('id')->on('tables')->onDelete('set null');
}); 