# Definido imagem base do container;
FROM php:8.2-fpm

# Definido variável do usuário;
ARG user=pdi_project

# Definido id do usuário;
ARG uid=1000

# Atualiza e instala os pacotes mencionados
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpa o cache dos pacotes instalados reduzindo o tamanho final da imagem.
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala as extensões do PHP;
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Copia o executável do composer da imagem oficial do composer para dentro do container. 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Adiciona um novo usuário ao container, aos grupos www-data, root e ao diretório /home/$user. (Importante adicionar o usuário ao diretório para evitar problemas de permissões ao dar manutenção dentro dos diretórios do container.)
RUN useradd -G www-data,root -u $uid -d /home/$user $user

# Cria o diretório /.composer no diretório do usuário (mkdir -p /home/$user/.composer). Também define o usuário e o grupo donos do diretório (chown -R $user:$user /home/$user);
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Define o diretório de trabalho.
WORKDIR /var/www

# Copia o arquivo custom.ini para dentro do container, permitindo alterar configurações do PHP.
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Define o usuário padrão para todas as execuções no container.
USER $user