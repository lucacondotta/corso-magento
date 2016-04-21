#!/usr/bin/env bash

mkdir extracted-media

cd extracted-media

tar xvf ../compressed-no-mp3-magento-sample-data-1.9.1.0.tgz

cp -R magento-sample-data-1.9.1.0/media/* ../media/
cp -R magento-sample-data-1.9.1.0/skin/* ../skin/

mysql -h magento-db -u corsomagento -p corsomagento < magento-sample-data-1.9.1.0/magento_sample_data_for_1.9.1.0.sql

cd ../ && rm -rf extracted-media
