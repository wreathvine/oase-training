# IMAGE install
ARG ITA_VERSION=1.6.3

FROM centos:centos8

ARG ITA_VERSION
ENV ITA_VERSION ${ITA_VERSION}

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-centosofficial && \
    dnf -y upgrade && \
    dnf -y install glibc-locale-source && \
    dnf -y install dnf-plugins-core && \
    dnf -y install wget && \
    yum config-manager --set-enabled powertools && \
    dnf -y install glibc-locale-source && \
    dnf clean all && \
    localedef -f UTF-8 -i ja_JP ja_JP.UTF-8 && \
    ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

ENV LANG="ja_JP UTF-8" \
    LANGUAGE="ja_JP:ja" \
    LC_ALL="ja_JP.UTF-8" \
    TZ="Asia/Tokyo"


WORKDIR /home

RUN wget https://github.com/exastro-suite/it-automation/releases/download/v${ITA_VERSION}/exastro-it-automation-${ITA_VERSION}.tar.gz && \
    tar zxvf /home/exastro-it-automation-${ITA_VERSION}.tar.gz -C /home && \
    rm -f /home/exastro-it-automation-${ITA_VERSION}.tar.gz && \
    mv /home/it-automation-${ITA_VERSION} /home/it-automation

COPY files/docker-entrypoint.sh /
COPY files/ita_answers.txt /home/it-automation/ita_install_package/install_scripts/
COPY files/setup.service /usr/lib/systemd/system/
COPY files/setup /etc/sysconfig/setup

WORKDIR /home/it-automation/ita_install_package/install_scripts
RUN chmod 755 /home/it-automation/ita_install_package/install_scripts/ita_installer.sh
# RUN sed -i.org -e "/.*interact.*/d" /home/it-automation/ita_install_package/install_scripts/bin/install.sh

RUN systemctl enable setup

ENTRYPOINT ["/docker-entrypoint.sh"]
