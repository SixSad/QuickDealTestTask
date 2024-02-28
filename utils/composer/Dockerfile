FROM composer:latest
WORKDIR /app
COPY entrypoint.sh /.
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["sh", "/entrypoint.sh"]
