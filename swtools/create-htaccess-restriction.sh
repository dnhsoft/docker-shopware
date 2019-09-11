#!/bin/bash

if [ ! -z ${HTACCESS_USER} ] && [ ! -z ${HTACCESS_PASSWORD} ]; then
    htpasswd -b -c /shopware/.htpasswd ${HTACCESS_USER} ${HTACCESS_PASSWORD}
    chmod 644 /shopware/.htpasswd

    cat >> /shopware/.htaccess <<EOL
AuthType Basic
AuthName "${HTACCESS_USER}"
AuthUserFile /shopware/.htpasswd
Require valid-user
EOL

    MEDIA_DIRECTORY=/shopware/media/
    if [ -d "$MEDIA_DIRECTORY" ]; then
        #exclude media restriction
        echo "Satisfy any" > ${MEDIA_DIRECTORY}.htaccess
        chmod 644 ${MEDIA_DIRECTORY}.htaccess
    fi

fi
