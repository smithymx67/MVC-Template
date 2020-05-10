#!/bin/bash
printf "==== Running npm install ====\n"
npm install

printf "\n==== Running composer install on /src ====\n"
cd src
composer install

printf "\n==== Running composer install on /tests ====\n"
cd ../
cd tests
composer install

printf "\n==== Running gulp ====\n"
cd ../
gulp build