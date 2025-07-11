<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->table('tables', function($table) {
    $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
}); 