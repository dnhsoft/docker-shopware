#!/bin/bash

if [ ! -z ${SW_DOMAIN_HASH} ]; then
    echo ${SW_DOMAIN_HASH} > /shopware/sw-domain-hash.html
    chmod 644 /shopware/sw-domain-hash.html
fi