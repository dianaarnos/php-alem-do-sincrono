FROM php:7.4-cli-alpine

WORKDIR /var/www

RUN apk --update upgrade

# PHP cURL
RUN apk add curl curl-dev
RUN docker-php-ext-install curl && docker-php-ext-enable curl

EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000"]
