#!/bin/bash

cd /shopware

if [ -f ./shop.zip ]; then

    unzip -q shop.zip
    rm shop.zip

    if [ -d ./recovery ]; then
        mv ./recovery /swrecovery
    fi

    if [ -d ./install ]; then
        mv ./install /swinstall
    fi

    if [ -f ./demo.zip ]; then
        unzip ./demo.zip
        rm ./demo.zip
    fi

    mkdir -p /shopware/var
    mkdir -p /shopware/var/log

    chown -R www-data:www-data /shopware/

    mv var/log /swvolumes/log
    mv files /swvolumes/files
    mv media /swvolumes/media

fi
