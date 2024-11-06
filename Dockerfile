# Usa a imagem base do PHP
FROM php:8.2-fpm

# Instale dependências
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql

# Copie o arquivo de configuração do Nginx
COPY ./nginx.conf /etc/nginx/nginx.conf

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie o projeto para o diretório de trabalho
WORKDIR /var/www/html

# Configuração para rodar Nginx e PHP-FPM juntos
CMD service nginx start && php-fpm
