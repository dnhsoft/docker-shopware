#!/bin/bash

/swtools/wait-mysql.sh


php /swtools/init-db.php


echo "Start shop initialization..."
/swtools/init-shop.sh
echo "Shop initialized."

