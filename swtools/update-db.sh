#!/bin/bash

/swtools/wait-mysql.sh

echo "Start updating database..."
php /swtools/update-db.php
echo "Database updatеd."

