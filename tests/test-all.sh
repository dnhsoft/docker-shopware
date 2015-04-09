#!/bin/bash

#stop on error
set -e


./run-test.sh 4.3.6
./run-test.sh 4.3.5
./run-test.sh 4.3.4
./run-test.sh 4.3.3
./run-test.sh 4.3.2
./run-test.sh 4.3.0
./run-test.sh 4.2.1



##build the base image
#
#docker build $1 -t dnhsoft/shopware:4.x ./shops/4.x
#
#
##build the basic images
#
#docker build $1 -t dnhsoft/shopware:4.3 ./shops/4.3.6
#docker build $1 -t dnhsoft/shopware:latest ./shops/4.3.6
#
#docker build $1 -t dnhsoft/shopware:4.3.6 ./shops/4.3.6
#docker build $1 -t dnhsoft/shopware:4.3.5 ./shops/4.3.5
#docker build $1 -t dnhsoft/shopware:4.3.4 ./shops/4.3.4
#docker build $1 -t dnhsoft/shopware:4.3.3 ./shops/4.3.3
#docker build $1 -t dnhsoft/shopware:4.3.2 ./shops/4.3.2
#
#docker build $1 -t dnhsoft/shopware:4.2.1 ./shops/4.2.1
#docker build $1 -t dnhsoft/shopware:4.2 ./shops/4.2.1
#
#
#cd ./shops/4.0.x
#
#./build-docker.sh 4.0.1 install_4.0.1 $1
#./build-docker.sh 4.0.2 install_4.0.2 $1
#./build-docker.sh 4.0.3 install_4.0.3 $1
#./build-docker.sh 4.0.4 install_4.0.4 $1
#./build-docker.sh 4.0.5 install_4.0.5 $1
#./build-docker.sh 4.0.6 install_4.0.6 $1
#./build-docker.sh 4.0.7 install_4.0.7 $1
#./build-docker.sh 4.0.8 install_4.0.8 $1
#./build-docker.sh 4.0   install_4.0.8 $1
#
#cd -
#
#
#cd ./shops/4.1.x
#
#./build-docker.sh 4.1.0 install_4.1.0 $1
#./build-docker.sh 4.1.1 install_4.1.1 $1
#./build-docker.sh 4.1.2 install_4.1.2 $1
#./build-docker.sh 4.1.3 install_4.1.3 $1
#./build-docker.sh 4.1.4 install_4.1.4 $1
#./build-docker.sh 4.1   install_4.1.4 $1
#
#cd -
#
#
## build images with demo-shop data (4.0.x are excluded - no demo-shop data found on web)
#
#cd ./shops/4.x.x.d
#
#./build-docker.sh latest demo_4.3.0 $1
#./build-docker.sh 4.3   demo_4.3.0 $1
#
#./build-docker.sh 4.3.6 demo_4.3.0 $1
#./build-docker.sh 4.3.5 demo_4.3.0 $1
#./build-docker.sh 4.3.4 demo_4.3.0 $1
#./build-docker.sh 4.3.3 demo_4.3.0 $1
#./build-docker.sh 4.3.2 demo_4.3.0 $1
#
#./build-docker.sh 4.2.1 demo_4.2.0 $1
#./build-docker.sh 4.2   demo_4.2.0 $1
#
#./build-docker.sh 4.1.0 demo_4.1.4 $1
#./build-docker.sh 4.1.1 demo_4.1.4 $1
#./build-docker.sh 4.1.2 demo_4.1.4 $1
#./build-docker.sh 4.1.3 demo_4.1.4 $1
#./build-docker.sh 4.1.4 demo_4.1.4 $1
#./build-docker.sh 4.1   demo_4.1.4 $1
#
#cd -
#
#
## build the dev-shop version
#
#cd ./shops/dev
#./build-docker.sh
#cd -
#
#
#date
#
#
#
## run the tests
#
#cd ./tests
#
#./run-test.sh dev
#
#./run-test.sh latest
#
#./run-test.sh 4.3
#./run-test.sh 4.3.6
#./run-test.sh 4.3.5
#./run-test.sh 4.3.4
#./run-test.sh 4.3.3
#./run-test.sh 4.3.2
#
#./run-test.sh 4.2
#./run-test.sh 4.2.1
#
#./run-test.sh 4.0.1
#./run-test.sh 4.0.2
#./run-test.sh 4.0.3
#./run-test.sh 4.0.4
#./run-test.sh 4.0.5
#./run-test.sh 4.0.6
#./run-test.sh 4.0.7
#./run-test.sh 4.0.8
#./run-test.sh 4.0
#
#./run-test.sh 4.1.0
#./run-test.sh 4.1.1
#./run-test.sh 4.1.2
#./run-test.sh 4.1.3
#./run-test.sh 4.1.4
#./run-test.sh 4.1
#
#
#./run-test.sh latest.d
#./run-test.sh 4.3.d
#./run-test.sh 4.3.6.d
#./run-test.sh 4.3.5.d
#./run-test.sh 4.3.4.d
#./run-test.sh 4.3.3.d
#./run-test.sh 4.3.2.d
#./run-test.sh 4.2.1.d
#./run-test.sh 4.2.d
#./run-test.sh 4.1.0.d
#./run-test.sh 4.1.1.d
#./run-test.sh 4.1.2.d
#./run-test.sh 4.1.3.d
#./run-test.sh 4.1.4.d
#./run-test.sh 4.1.d
#
#
#
#if [ -f ./logs/errors.log ]; then
#    cd ./mail
#    ./send-mail.sh ./../logs/errors.log chudomir.delchev@gmail.com 'Errors in building shopware dockers'
#    cd -
#    rm -f ./logs/errors.log
#    ERRORS=1
#else
#    ERRORS=0
#    echo "All tests passed!"
#fi
#
#cd -
#date
#
#exit $ERRORS
