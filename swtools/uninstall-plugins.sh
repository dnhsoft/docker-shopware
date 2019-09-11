#!/bin/bash


declare -a PLUGINS=()

cd /shopware/custom/plugins/

for dir in */
do
    dir=${dir%*/}
    DIR=${dir##*/}
    PLUGINS+=("$DIR")
done


cd /shopware

php bin/console sw:plugin:refresh

for PLUGIN in "${PLUGINS[@]}"
do
#    echo "Deactivating plugin ${PLUGIN}..."
    php bin/console sw:plugin:deactivate ${PLUGIN}
#    echo "Plugin ${PLUGIN} deactivated."

#    echo "Uninstalling plugin ${PLUGIN}..."
    php bin/console sw:plugin:uninstall ${PLUGIN}
#    echo "Plugin ${PLUGIN} uninstalled."
done


