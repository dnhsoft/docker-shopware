#!/bin/bash

# echo "Setting up Shopware directory rights..."

cd /shopware

echo "Moving ./files directory..."
if [ ! -d ./files ]; then
    mv /swvolumes/files ./files
fi

echo "Moving ./media directory..."
if [ ! -d ./media ]; then
    mv /swvolumes/media ./media
fi

echo "Moving ./var/log directory..."
if [ ! -d ./var/log ]; then
    mv /swvolumes/log ./var/log
fi

# echo "Setting rights to /shopware directory, be patient..."
# chown -R www-data:www-data /shopware
# echo "Done setting rights to /shopware directory."

echo "Setting proper mode to various Shopware directories, be patient... "
chown -R www-data:www-data var/log var/cache files media engine/Shopware/Plugins/Community custom/plugins
chmod 775 -R var/log var/cache files media engine/Shopware/Plugins/Community
chmod 544 /shopware/bin/console
echo "Done setting proper mode to various Shopware directories."

# echo "Shopware directories rights done."