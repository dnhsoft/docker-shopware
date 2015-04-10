#!/bin/bash

#stop on error
set -e


#./run-test.sh 4.3.6
#./run-test.sh 4.3.5
#./run-test.sh 4.3.4
#./run-test.sh 4.3.3
#./run-test.sh 4.3.2
#./run-test.sh 4.3.0
#./run-test.sh 4.2.1
#
#./run-test.sh 4.1.0
#./run-test.sh 4.1.1
#./run-test.sh 4.1.2
#./run-test.sh 4.1.3
#./run-test.sh 4.1.4

./run-test.sh 4.3.6.d
./run-test.sh 4.3.5.d
./run-test.sh 4.3.4.d
./run-test.sh 4.3.3.d
./run-test.sh 4.3.2.d
./run-test.sh 4.3.0.d
./run-test.sh 4.2.1.d

./run-test.sh 4.1.0.d
./run-test.sh 4.1.1.d
./run-test.sh 4.1.2.d
./run-test.sh 4.1.3.d
./run-test.sh 4.1.4.d

#./run-test.sh 4.0.1
#./run-test.sh 4.0.2
#./run-test.sh 4.0.3
#./run-test.sh 4.0.4
#./run-test.sh 4.0.5
#./run-test.sh 4.0.6
#./run-test.sh 4.0.7
#./run-test.sh 4.0.8


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
