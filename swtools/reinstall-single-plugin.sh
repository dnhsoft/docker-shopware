#!/bin/bash

PLUGIN=$1

cd /shopware

php bin/console sw:plugin:refresh

echo "Reinstalling plugin $PLUGIN..."
php bin/console sw:plugin:reinstall $PLUGIN
echo "Plugin $PLUGIN reinstalled."
