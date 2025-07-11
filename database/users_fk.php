<?php

require "../vendor/autoload.php";
require "../Bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->table('users', function($table) {
    $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
}); 