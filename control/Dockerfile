FROM ubuntu
RUN apt update -y
RUN apt upgrade -y

RUN apt install python3-pip -y
RUN pip3 install RPi.GPIO
RUN pip3 install gpiozero
RUN apt install python3-setuptools -y
RUN apt install python3-mysqldb -y
RUN pip3 install Flask

ADD python /scripts

RUN apt install cron -y
COPY crontab.config /etc/cron.d/crontab.config
RUN chmod 0644 /etc/cron.d/crontab.config
RUN crontab /etc/cron.d/crontab.config

COPY entry-point.sh /scripts/entry-point.sh
RUN chmod +x /scripts/entry-point.sh
ENTRYPOINT ["/scripts/entry-point.sh"]
