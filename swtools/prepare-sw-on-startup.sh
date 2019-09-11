#!/bin/bash

/swtools/create-plugin-hash-file.sh
/swtools/create-htaccess-restriction.sh
/swtools/prepare-dirs.sh
/swtools/init-on-startup.sh
/swtools/start-cron.sh &