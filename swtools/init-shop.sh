#!/bin/bash

cd /shopware/bin

chmod 744 console

php console sw:generate:attributes
php console sw:firstrunwizard:disable
php console sw:theme:initialize

/swtools/prepare-dirs.sh
