#!/bin/bash

/swtools/wait-mysql.sh

HAS_SHOPWARE=$(php /swtools/has-shopware-db.php)

if [ -z "$HAS_SHOPWARE" ]
then
  /swtools/init.sh
fi