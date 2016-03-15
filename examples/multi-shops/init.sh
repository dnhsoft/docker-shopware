#!/bin/bash

docker exec multishops_shop513_1 /swtools/init.sh
docker exec multishops_shop513_1 /swtools/install-demo-data-en.sh

docker exec multishops_shop434_1 /swtools/init.sh
docker exec multishops_shop433_1 /swtools/init.sh
docker exec multishops_shop432_1 /swtools/init.sh
docker exec multishops_shop421_1 /swtools/init.sh
