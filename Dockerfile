FROM dnhsoft/shopware-base:5.2.x

COPY assets/configs-default.php /shopware/engine/Shopware/Configs/Default.php

ENV SWCSRFPROTECTION_FRONTEND 1
ENV SWCSRFPROTECTION_BACKEND 1
