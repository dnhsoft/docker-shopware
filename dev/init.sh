#!/bin/bash

cd /shopware
rm -rf ./*

git clone https://github.com/shopware/shopware.git ./


cd /shopware/build/


# prepare the ant build properties
cp /swtools/ant.build.properties.template ./build.properties
sed -i "s/__SWDB_HOST__/$SWDB_HOST/g"  ./build.properties
sed -i "s/__SWDB_DATABASE__/$SWDB_DATABASE/g"  ./build.properties
sed -i "s/__SWDB_USER__/$SWDB_USER/g"  ./build.properties
sed -i "s/__SWDB_PASS__/$SWDB_PASS/g"  ./build.properties
sed -i "s/__SWDB_PORT__/$SWDB_PORT/g"  ./build.properties

# by default we use localhost:8000, but it can be replaced by an argument;
# in any case the ant build properties file needs an escaping of the ":" character.
APP_HOST="localhost:8000"
if [ "$1" != "" ]; then
  APP_HOST=$1
fi
APP_HOST=${APP_HOST/":"/"\:"}
sed -i "s/__APP_HOST__/$APP_HOST/g"  ./build.properties


/swtools/wait-mysql.sh

ant build-unit


#extract the demo-shop data files
cd /shopware
wget -O demo.zip http://releases.s3.shopware.com/demo_4.3.0.zip
unzip -n -q demo.zip
rm demo.zip


chown -R www-data.1000 /shopware
chmod 755 -R /shopware/cache
chmod 755 -R /shopware/files
chmod 755 -R /shopware/logs
chmod 755 -R /shopware/media
chmod 755 -R /shopware/engine/Shopware/Plugins/Community


# this will import also the demo data sql
echo "Start importing database..."
mysql -u$SWDB_USER -p$SWDB_PASS -h$SWDB_HOST -P$SWDB_PORT $SWDB_DATABASE < /shopware/demo.sql
rm /shopware/demo.sql
echo "Database imported."