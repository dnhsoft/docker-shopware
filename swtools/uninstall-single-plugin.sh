#!/bin/bash

PLUGIN=$1

cd /shopware

php bin/console sw:plugin:refresh

echo "Installing plugin $PLUGIN..."
php bin/console sw:plugin:deactivate $PLUGIN
php bin/console sw:plugin:uninstall $PLUGIN
echo "Plugin $PLUGIN deactivated and uninstalled."

