#!/bin/bash

# コンテナで起動されるコマンドを/sbin/initにする
#exec /sbin/init
# タイムゾーンの変更
timedatectl set-timezone Asia/Tokyo
# bash -x ita_installer.sh

exec "/sbin/init"
