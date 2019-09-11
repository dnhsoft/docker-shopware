#!/bin/bash

HAS_MYSQL=1

while [ $HAS_MYSQL != 0 ]
do
	echo "Waiting for mysql server..."
	sleep 1
	mysqladmin --silent -h$SWDB_HOST -u$SWDB_USER -p$SWDB_PASS status
	HAS_MYSQL=$?
done

echo "Mysql server detected."

