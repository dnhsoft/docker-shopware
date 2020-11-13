#!/bin/bash

if [ "$SHOPWARE_VERSION" = "latest"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.6_f8cbea93398b121a4471c35795ce1a8822176d32.zip"
elif [ "$SHOPWARE_VERSION" = "5.6.6"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.6_f8cbea93398b121a4471c35795ce1a8822176d32.zip"
elif [ "$SHOPWARE_VERSION" = "5.6.5"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.5_482a9c1c64e67f009c47b25ebbf97a7f9f06066a.zip"
elif [ "$SHOPWARE_VERSION" = "5.6.4"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.4_3540d53b7727442cde5287b669c7d3b94f8a07c7.zip"
elif [ "$SHOPWARE_VERSION" = "5.6.3"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.3_fec7645a72a0393f8a39f48ddd6c27e138f44513.zip"
elif [ "$SHOPWARE_VERSION" = "5.6.2"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.2_6cadc5c14bad4ea8839395461ea42dbc359e9666.zip"
elif [ "$SHOPWARE_VERSION" = "5.6.1"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.1_51a886fad0d2ba1b956f68f06436bf4a988207f4.zip"
elif [ "$SHOPWARE_VERSION" = "5.6.0"  ]; then
  DOWNLOAD_URL="https://releases.shopware.com/install_5.6.0_3e81c54e1c57c6925e4d05336283ad18de9b10bb.zip"
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

#curl -O -J -L  $DOWNLOAD_URL
#mv install_$SHOPWARE_VERSION*.zip /shopware/shop.zip
