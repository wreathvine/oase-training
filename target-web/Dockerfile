# IMAGE install
FROM centos:centos8

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-centosofficial && \
    dnf -y upgrade && \
    dnf -y install glibc-locale-source langpacks-ja && \
    dnf clean all && \
    localedef -f UTF-8 -i ja_JP ja_JP.UTF-8 && \
    ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

ENV LANG="ja_JP.UTF-8" \
    LANGUAGE="ja_JP:ja" \
    LC_ALL="ja_JP.UTF-8" \
    TZ="Asia/Tokyo"

RUN dnf -y install php php-mbstring php-xml php-xmlrpc php-gd php-pdo php-mysqlnd php-json && \
    dnf clean all

COPY files/wait.php /var/www/html/

RUN chown apache: /var/www/html/wait.php 

COPY files/status.conf /etc/httpd/conf.d/


RUN rpm -Uvh https://repo.zabbix.com/zabbix/5.2/rhel/8/x86_64/zabbix-release-5.2-1.el8.noarch.rpm && \
    dnf -y install zabbix-agent && \
    dnf clean all

RUN sed -i.org -e "s/^Hostname=.*$/Hostname=target-web/" /etc/zabbix/zabbix_agentd.conf && \
    sed -i -e "s/^Server=.*$/Server=zabbix-server/" /etc/zabbix/zabbix_agentd.conf && \
    sed -i -e "s/^ServerActive=.*$/ServerActive=zabbix-server/" /etc/zabbix/zabbix_agentd.conf


RUN echo "Timeout 600" >> /etc/httpd/conf/httpd.conf && \
    sed -i.org -e "s/^max_execution_time.*$/max_execution_time = 600/" /etc/php.ini 

RUN systemctl enable httpd php-fpm zabbix-agent

COPY files/docker-entrypoint.sh /

ENTRYPOINT ["/docker-entrypoint.sh"]
