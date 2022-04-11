#!/bin/bash
cd mysql
./create.sh
cd ../control
./create.sh
cd ../web-app
./create.sh
cd ../phpmyadmin
./create.sh
