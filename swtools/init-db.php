<?php

$SWDB_USER = getenv('SWDB_USER');
$SWDB_PASS = getenv('SWDB_PASS');
$SWDB_DATABASE = getenv('SWDB_DATABASE');
$SWDB_HOST = getenv('SWDB_HOST');
$SWDB_PORT = getenv('SWDB_PORT');


$mysql_conn = "mysql -u$SWDB_USER -p$SWDB_PASS -h$SWDB_HOST -P$SWDB_PORT ";

// Create database
echo shell_exec("$mysql_conn -e 'CREATE DATABASE IF NOT EXISTS $SWDB_DATABASE CHARACTER SET utf8 COLLATE utf8_general_ci'");


if (file_exists('/swtools/full-custom.sql')) {
	
	echo "Full custom database found - importing /swtools/full-custom.sql...\n";
	echo shell_exec("$mysql_conn $SWDB_DATABASE < /swtools/full-custom.sql 2>&1");
	echo "Custom database imported (/swtools/full-custom.sql).\n";

} else {

	echo "No /swtools/full-custom.sql detected. Importing default shopware database entries...\n";

	include '/swtools/sql-data.php';
	foreach ($sql_files as $file) {
		echo shell_exec("$mysql_conn $SWDB_DATABASE < $file 2>&1");
	}

	if (file_exists('/shopware/demo.sql')) {
		echo "demo.sql found. Importing...";
		echo shell_exec("$mysql_conn $SWDB_DATABASE < /shopware/demo.sql 2>&1");
		echo shell_exec("rm /shopware/demo.sql 2>&1");
		echo "demo.sql imported.";
	}
	
	echo "Default database entries imported.\n";
}