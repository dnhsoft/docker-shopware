#!/bin/bash

cd /shopware

php bin/console sw:cache:clear
php bin/console sw:theme:cache:generate
/swtools/prepare-dirs.sh

