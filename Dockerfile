FROM jugendpresse/apache:php-7.2
MAINTAINER Martin Winter

# expose ports
EXPOSE 80
EXPOSE 443

WORKDIR $APACHE_WORKDIR

COPY boot.sh /boot.d/startup.sh
COPY web/ $APACHE_WORKDIR
RUN composer update

# run on every (re)start of container
ENTRYPOINT ["entrypoint"]
CMD ["apache2-foreground"]
