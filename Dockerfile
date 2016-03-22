FROM ubuntu:14.04

MAINTAINER Jan Klan <jan@beatee.org>

RUN apt-get update && apt-get install -y supervisor

ADD docker/supervisord.conf /etc/supervisor/conf.d/

########

RUN apt-get install -y nginx

ADD docker/nginx/nginx.conf /etc/nginx/
ADD docker/nginx/app.conf /etc/nginx/sites-available/
ADD docker/nginx/upstream.conf /etc/nginx/conf.d/upstream.conf
ADD docker/nginx/fastcgi_params /etc/nginx/

RUN ln -s /etc/nginx/sites-available/app.conf /etc/nginx/sites-enabled/app
RUN rm /etc/nginx/sites-enabled/default

########

RUN apt-get install -y php5-common php5-cli php5-fpm php5-mysql

RUN rm /etc/php5/fpm/pool.d/www.conf

ADD docker/fpm/app.ini /etc/php5/fpm/conf.d/
ADD docker/fpm/app.ini /etc/php5/cli/conf.d/
ADD docker/fpm/app.pool.conf /etc/php5/fpm/pool.d/

EXPOSE 80

########

RUN echo -e "\nexport TERM=xterm" >> ~/.bashrc

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
