#!/bin/bash

cd /shopware/bin

php console sw:store:download SwagDemoDataEN
php console sw:plugin:install SwagDemoDataEN
php console sw:plugin:activate SwagDemoDataEN