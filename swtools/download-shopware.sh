#!/bin/bash

if [ "$SHOPWARE_VERSION" = "latest"  ]; then
  DOWNLOAD_URL="http://releases.shopware.com/install_5.5.10_edfcb8e82f331fa5a0935a6c6ff35fe4348bf262.zip"
elif [ "$SHOPWARE_VERSION" = "5.5.10"  ]; then
  DOWNLOAD_URL="http://releases.shopware.com/install_5.5.10_edfcb8e82f331fa5a0935a6c6ff35fe4348bf262.zip"
elif [ "$SHOPWARE_VERSION" = "5.5.9"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.5.9_402d088c6bc5a8c6f94cd785b046f081d664b3f8.zip"
elif [ "$SHOPWARE_VERSION" = "5.5.8"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.5.8_d5bf50630eeaacc6679683e0ab0dcba89498be6d.zip"
elif [ "$SHOPWARE_VERSION" = "5.5.7"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.5.7_f785facc70e39f2ca4292e78739457417f19fbcf.zip"
else
  echo "Unsupported Shopware version for update: '$SHOPWARE_VERSION'" 
  exit 1
fi

wget -O /shopware/shop.zip $DOWNLOAD_URL