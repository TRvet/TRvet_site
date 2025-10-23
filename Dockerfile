# Base PHP-FPM (processa PHP na porta 9000)
FROM php:8.2-fpm as php
WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Final: Nginx + PHP-FPM no mesmo container usando Supervisor
FROM debian:bookworm-slim

# Instala dependências: nginx, supervisor, gettext-base (envsubst)
RUN apt-get update \
 && apt-get install -y --no-install-recommends nginx supervisor gettext-base \
 && rm -rf /var/lib/apt/lists/*

# Copia app e PHP-FPM do estágio anterior
COPY --from=php /usr/local/sbin /usr/local/sbin
COPY --from=php /usr/local/bin /usr/local/bin
COPY --from=php /usr/local/etc /usr/local/etc
COPY --from=php /var/www/html /var/www/html

# Nginx template (Render usa PORT)
COPY nginx.prod.conf.template /etc/nginx/conf.d/default.conf.template

# Supervisor config
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Ajustes de permissões/logs/run
RUN mkdir -p /var/log/nginx /var/run/nginx /var/run/php \
 && chown -R www-data:www-data /var/www/html /var/log/nginx /var/run/nginx /var/run/php

EXPOSE 80
CMD ["/usr/bin/supervisord", "-n"]