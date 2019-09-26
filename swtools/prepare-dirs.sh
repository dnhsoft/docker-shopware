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

mkdir -p files/documents
mkdir -p files/downloads
mkdir -p recovery
mkdir -p media/archive
mkdir -p media/image
mkdir -p media/image/thumbnail
mkdir -p media/music
mkdir -p media/pdf
mkdir -p media/unknown
mkdir -p media/vector
mkdir -p media/video
mkdir -p media/temp


# echo "Setting rights to /shopware directory, be patient..."
# chown -R www-data:www-data /shopware
# echo "Done setting rights to /shopware directory."

echo "Setting proper mode to various Shopware directories, be patient... "
chown -R www-data:www-data var/log var/cache web/cache files media \
    engine/Shopware/Plugins/Community custom/plugins recovery config.php engine/Shopware/Configs/Default.php
chmod 775 -R var/log var/cache files media engine/Shopware/Plugins/Community 
chmod 544 /shopware/bin/console
echo "Done setting proper mode to various Shopware directories."

# echo "Shopware directories rights done."