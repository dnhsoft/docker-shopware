FROM dnhsoft/shopware-base:4.x

RUN apt-get update && apt-get install -y \
	git \ 
	ant

RUN a2enmod rewrite


COPY ./ant.build.properties.template /swtools/ant.build.properties.template
COPY ./sql-data.php /swtools/sql-data.php
COPY ./init.sh /swtools/init.sh

ENV COMPOSER_HOME /shopware