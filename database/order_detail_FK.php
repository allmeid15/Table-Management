<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->table('order_details', function($table) {
    $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
}); 