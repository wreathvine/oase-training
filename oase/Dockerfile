# IMAGE install
ARG OASE_VERSION=1.4.0

FROM centos:centos7

ARG OASE_VERSION
ENV OASE_VERSION ${OASE_VERSION}

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && \
   yum -y update && \
   rm -rf /var/cache/yum/*  && \
   yum -y install openssh-server openssh-clients && \
   yum clean all && \
   localedef -f UTF-8 -i ja_JP ja_JP.UTF-8 && \
   ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

ENV LANG="ja_JP UTF-8" \
   LANGUAGE="ja_JP:ja" \
   LC_ALL="ja_JP.UTF-8" \
   TZ="Asia/Tokyo"

RUN echo "root:password" | chpasswd

RUN yum -y install wget && \
   yum -y install gcc && \
   rm -rf /var/cache/yum/*  && \
   yum clean all

WORKDIR /home

#RUN wget  https://github.com/exastro-suite/oase/releases/download/v${OASE_VERSION}/exastro-oase-${OASE_VERSION}.tar.gz && \
#    tar zxvf /home/exastro-oase-${OASE_VERSION}.tar.gz -C /home && \
#    rm -f /home/exastro-oase-${OASE_VERSION}.tar.gz
#
COPY files/docker-entrypoint.sh /
#COPY files/oase_answers.txt /home/oase/oase_install_package/install_scripts/
#COPY files/setup.service /usr/lib/systemd/system/
#COPY files/setup /etc/sysconfig/setup
#
#RUN sed -i.org -e "/.*interact.*/d" /home/oase/oase_install_package/install_scripts/bin/oase_middleware_setup_core.sh
#
#RUN systemctl enable setup

ENTRYPOINT ["/docker-entrypoint.sh"]
