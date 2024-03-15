FROM ubuntu/nginx
RUN rm -rf /etc/nginx/sites-enabled/default \
&& rm -rf /etc/nginx/sites-available/default
WORKDIR /var/www/html
RUN useradd -ms /bin/bash spirit1086
RUN chown -R spirit1086:spirit1086 /var/www/html
RUN usermod -aG root spirit1086
RUN usermod -a -G www-data spirit1086
RUN chown -R spirit1086:www-data /var/www/html
RUN apt-get update
RUN apt-get install curl -y