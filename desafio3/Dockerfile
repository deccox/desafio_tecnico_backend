# Usa a imagem base do PHP 5.6 com FPM
FROM php:5.6-fpm

# Define o diretório de trabalho
WORKDIR /var/www/html

COPY . /var/www/html

# Atualiza as fontes de repositórios para usar snapshots antigos do Debian Stretch
RUN echo "deb http://archive.debian.org/debian stretch main contrib non-free" > /etc/apt/sources.list && \
    echo "deb http://archive.debian.org/debian-security stretch/updates main contrib non-free" >> /etc/apt/sources.list && \
    echo "Acquire::Check-Valid-Until false;" > /etc/apt/apt.conf.d/99no-check-valid-until

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Instala o Composer 2.2 LTS
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.2.18

# Comando padrão para rodar o PHP-FPM
CMD ["php-fpm"]