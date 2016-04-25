#!/bin/bash

docker exec productionshop_shop_1 /swtools/init.sh
docker exec productionshop_shop_1 /swtools/install-demo-data-en.sh
docker exec productionshop_shop_1 /swtools/prepare-dirs.sh
