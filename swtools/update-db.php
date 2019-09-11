<?php

$SWDB_USER = getenv('SWDB_USER');
$SWDB_PASS = getenv('SWDB_PASS');
$SWDB_DATABASE = getenv('SWDB_DATABASE');
$SWDB_HOST = getenv('SWDB_HOST');
$SWDB_PORT = getenv('SWDB_PORT');


$mysql_conn = "mysql -u$SWDB_USER -p$SWDB_PASS -h$SWDB_HOST -P$SWDB_PORT ";

echo shell_exec("$mysql_conn $SWDB_DATABASE < /swtools/custom.sql 2>&1");
