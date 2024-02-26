FROM ubuntu:22.04

RUN apt update && \
    apt install nginx -y

RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo UTC > /etc/timezone

RUN apt install software-properties-common -y && \
    add-apt-repository ppa:ondrej/php && \
    apt update

RUN apt install php8.2 -y
RUN apt install php8.2-fpm -y
RUN apt install php8.2-common php8.2-xml php8.2-curl php8.2-cli php8.2-dev php8.2-imap php8.2-mbstring php8.2-opcache php8.2-zip php8.2-intl php8.2-xdebug -y

RUN cd ~ && \
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    HASH=`curl -sS https://composer.github.io/installer.sig` && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN rm /etc/nginx/sites-available/default
COPY nginx.conf /etc/nginx/sites-available/default

CMD service nginx start && service php8.2-fpm start && /bin/bash
