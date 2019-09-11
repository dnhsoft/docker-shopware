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
#    echo "Installing plugin ${PLUGIN}..."
    php bin/console sw:plugin:install ${PLUGIN}
#    echo "Plugin ${PLUGIN} installed."

#    echo "Activating plugin ${PLUGIN}..."
    php bin/console sw:plugin:activate ${PLUGIN}
#    echo "Plugin ${PLUGIN} activated."
done


