<?php

include_once __DIR__."/pswd.php";

$conn = array(
    'driver' => 'pdo_mysql', // pdo_sqlite
    'path' => __DIR__ . '/db.sqlite',
    'host' => 'localhost',
    'dbname' => CONFIG_DB_NAME,
    'user' => CONFIG_DB_USER,
    'password' => CONFIG_DB_PASSWORD,
    'charset'  => 'utf8',
);
