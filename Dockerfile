FROM dnhsoft/shopware-base:5.2.x

COPY assets/configs-default.php /shopware/engine/Shopware/Configs/Default.php

ENV SWCSRFPROTECTION_FRONTEND 1
ENV SWCSRFPROTECTION_BACKEND 1
ENV SWFRONT_CHARSET "utf-8"
ENV SWHTTPCACHE_ENABLED 1
ENV SWHTTPCACHE_LOOKUP_OPTIMIZATION 1
ENV SWHTTPCACHE_DEBUG 0
ENV SWHTTPCACHE_DEFAULT_TTL 0
ENV SWHTTPCACHE_ALLOW_RELOAD 0
ENV SWHTTPCACHE_ALLOW_REVALIDATE 0
ENV SWHTTPCACHE_STALE_WHILE_REVALIDATE 2
ENV SWHTTPCACHE_STALE_IF_ERROR 0
