#!/bin/bash

PLUGIN=$1

cd /shopware

php bin/console sw:plugin:refresh

echo "Installing plugin $PLUGIN..."
php bin/console sw:plugin:install $PLUGIN
php bin/console sw:plugin:activate $PLUGIN
echo "Plugin $PLUGIN installed and activated."


