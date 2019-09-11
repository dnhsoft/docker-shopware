#!/bin/bash

if [ ! $SW_CRON -eq 1 ]; then
  exit 0
fi

echo "Starting shopware cron..."

while true;
do
  /swtools/run-cron.sh &
  sleep 2m
done

