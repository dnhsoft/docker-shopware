#!/bin/bash

cd /shopware/bin

php console sw:store:download SwagDemoDataDE
php console sw:plugin:install SwagDemoDataDE
php console sw:plugin:activate SwagDemoDataDE