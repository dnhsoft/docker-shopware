#!/bin/bash

rm ./Default.php

wget https://raw.githubusercontent.com/shopware/shopware/v$1/engine/Shopware/Configs/Default.php 

meld Default.php configs-default.php