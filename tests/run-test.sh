#!/bin/bash

TAG=$1

echo "Starting test shopware $TAG..."

mkdir -p logs

docker build -t shopware-test:$TAG ./../$TAG

cp docker-compose.yml.template docker-compose.yml
sed -i "s/{VERSION}/$TAG/g" docker-compose.yml

docker-compose up -d

echo "Starting init.sh..."

if  [ "$1" == "dev" ]; then
    # Hack for dev version: setup the database so that http://shop is accessible
    docker exec tests_shop_1 sed -i "s/localhost:8000/shop/g" /swtools/shop.sql
fi

docker exec tests_shop_1 /swtools/init.sh

docker exec tests_tester_1 bash -c "/scripts/check-shop.php $1"

docker-compose stop
docker-compose rm --force
rm docker-compose.yml

docker rmi shopware-test:$TAG

echo "Finished testing shopware $TAG"