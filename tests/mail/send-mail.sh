#!/bin/bash

body=`cat $1`

cp $1 ./outbox/message.txt

docker-compose up -d

docker exec mail_gmailer_1 bash -c "mail -s '$3' $2 < /outbox/message.txt"

# wait to flush the mail queue
sleep 5

rm -f ./outbox/message.txt

docker-compose stop
docker-compose rm --force