FROM jrottenberg/ffmpeg:3.4-scratch as ffmpeg

FROM php:alpine
MAINTAINER Mark Myers <marcusmyers@gmail.com>

RUN apk --update add espeak

COPY --from=ffmpeg /bin/ffmpeg /usr/local/bin/ffmpeg
COPY . /app/
WORKDIR /app

CMD [ "php", "-S", "0.0.0.0:8080", "index.php" ]
