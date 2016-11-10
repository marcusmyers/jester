FROM php:alpine
MAINTAINER Mark Myers <marcusmyers@gmail.com>

COPY . /app/
WORKDIR /app

CMD [ "php", "-S", "0.0.0.0:8080", "index.php" ]
