#!/bin/bash

docker exec productionshop_shop_1 /swtools/init.sh
docker exec productionshop_shop_1 bash -c "chown -R www-data:www-data /shopware/engine/Shopware/Plugins/Community"
docker exec productionshop_shop_1 bash -c "chmod -R 755 /shopware/engine/Shopware/Plugins/Community"
