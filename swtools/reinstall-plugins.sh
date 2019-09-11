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
    echo "Reinstalling plugin ${PLUGIN}..."
    php bin/console sw:plugin:reinstall ${PLUGIN}
    echo "Plugin ${PLUGIN} reinstalled."
done

bin/console sw:cache:clear