#!/bin/bash

echo "["$(date "+%Y-%m-%d %H:%M:%S %Z")"]" "sw:cron:run..."

php /shopware/bin/console sw:cron:run

cd /shopware/var/cache
CHECK_ROOT=$(ls -la | grep --only-matching  root | head -n1)

# echo $CHECK_ROOT
# ls -la /shopware/var/cache

if [ "$CHECK_ROOT" == "root" ]; then
    # there are generated cache files with root rights - must be fixed; 
    # this can be a slow operation and that's why we don't want it to be called on every cron
    echo "Fixing cache file rights after cron:run..."
    chown -R www-data:www-data /shopware/var/cache
    echo "Done fixing cache file rights after cron:run."
fi

# # restore the directories ownershop back to www-data
# /swtools/prepare-dirs.sh
