#!/bin/bash

docker exec demoshop_shop_1 /swtools/init.sh
docker exec demoshop_shop_1 /swtools/install-demo-data-en.sh
docker exec demoshop_shop_1 /swtools/prepare-dirs.sh
