<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->table('products', function($table) {
    $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
}); 